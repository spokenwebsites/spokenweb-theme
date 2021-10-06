<?php if (has_category("symposia")) {
  $url = site_url() . "/symposia/#/$post->post_name";
  wp_redirect($url);
  exit;
} ?>
<?php if (has_category("institutes")) {
  $url = site_url() . "/institutes/#/$post->post_name";
  wp_redirect($url);
  exit;
} ?>
<?php get_header(); ?>

<div class="row">
  <div id="upcoming" class="col-sm-12">
    <?php

    $args = array(
      'post_type' => 'events',
      'posts_per_page' => 1,
      'post_status' => array('publish'),
      'post_type' => 'events',
      'meta_query' => array(
        array(
          'key' => 'event_end',
          'value' => date("Y/m/d"),
          'compare' => '>='
        )
      ),
      'order' => 'ASC',
      'orderby' => 'meta_value',
      'meta_key' => 'event_start'
    );
    $event_query = new WP_Query($args);
    $count = $event_query->post_count;

    ?>

    <?php if ($event_query->have_posts()) : $i = 0;
      while ($event_query->have_posts()) : $event_query->the_post(); ?>
        <?php if (has_post_thumbnail()) {
          $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
          $img_lg_url = $img_lg[0];
          $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
          $img_thumb = $img_thumb[0];
          $img_lg_width = $img_lg[1];
          $img_lg_height = $img_lg[2];
        } else {
          $img_lg_url = "";
          $img_lg_width = "";
          $img_lg_height = "";
          $img_thumb = "";
        } ?>
        <section id="upcomingEvent" class="event-container">
          <div style="background:url('<?php echo $img_lg_url; ?>') center center; background-size:cover;" class="event-img filter"></div>
          <section class="event-red container-fluid row">
            <div class="col-md-3 col-sm-4">
              <h1 class="title"><span>Upcoming<br />Events</span>
                <hr>
              </h1>
            </div>
            <div class="offset-sm-1 col-md-8 col-sm-7">
              <div class="info-container">

                <?php
                $post_custom_fields = get_post_custom();
                $event_start_orig = $post_custom_fields['event_start'][0];
                $event_end_orig = $post_custom_fields['event_end'][0];

                $permalink = get_permalink();
                $post_name = $post->post_name;

                $event_type = $post_custom_fields['type'][0];
                if ($event_type == "Conference") {
                  $participants = $post_custom_fields['conf_participants'][0];
                  $schedule = $post_custom_fields['schedule'][0];
                  $participant_info_travel = $post_custom_fields['conf_participant_info_travel'][0];
                  $participant_info_activity = $post_custom_fields['conf_participant_info_activity'][0];
                  $participant_info_accommodations = $post_custom_fields['information_for_participants_accommodations'][0];
                  $notable_events = $post_custom_fields['notable_events'][0];

                  $participants = htmlentities(wpautop($participants));
                  $participants = trim(str_replace("&nbsp;", " ", $participants));
                  $schedule = htmlentities(wpautop($schedule));
                  $schedule = trim(str_replace("&nbsp;", " ", $schedule));
                  $participant_info_travel = htmlentities(wpautop($participant_info_travel));
                  $participant_info_travel = trim(str_replace("&nbsp;", " ", $participant_info_travel));
                  $participant_info_activity = htmlentities(wpautop($participant_info_activity));
                  $participant_info_activity = trim(str_replace("&nbsp;", " ", $participant_info_activity));
                  $participant_info_accommodations = htmlentities(wpautop($participant_info_accommodations));
                  $participant_info_accommodations = trim(str_replace("&nbsp;", " ", $participant_info_accommodations));
                  $notable_events = htmlentities(wpautop($notable_events));
                  $notable_events = trim(str_replace("&nbsp;", " ", $notable_events));
                } else {
                  $participants = "";
                  $schedule = "";
                  $participant_info_travel = "";
                  $participant_info_activity = "";
                  $participant_info_accommodations = "";
                  $notable_events = "";
                }

                $event_start = date_create_from_format("Y/m/d", $event_start_orig);
                $event_end = date_create_from_format("Y/m/d", $event_end_orig);

                $start_month = date_format($event_start, "F");
                $start_day = date_format($event_start, "j");
                $start_year = date_format($event_start, "Y");

                $end_month = date_format($event_end, "F");
                $end_day = date_format($event_end, "j");
                $end_year = date_format($event_end, "Y");

                $event_start_mini = date_format($event_start, "M j");
                $event_start = date_format($event_start, "M d, Y");
                $event_end_mini = date_format($event_end, "j, Y");
                $event_end = date_format($event_end, "M d, Y");

                if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
                else $event_date = $event_start;

                $time = $post_custom_fields['time'][0];

                $city = $post_custom_fields['city'][0];
                $venue = $post_custom_fields['venue'][0];
                $institution = $post_custom_fields['institution'][0];

                $event_meta = array();

                if (isset($city) && $city != "") $event_meta[] = $city;
                if (isset($institution) && $institution != "") $event_meta[] = $institution;
                if (isset($venue) && $venue != "") $event_meta[] = $venue;
                ?>

                <h1><?php the_title(); ?></h1>

                <div class="meta">
                  <p><?php echo $event_date; ?></p>

                  <p><?php echo implode(" - ", $event_meta); ?></p>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="entry">
                      <?php the_excerpt(); ?>
                    </div>
                    <a class="read-more" href="<?php echo $permalink; ?>"><button class="btn btn-sw white">READ MORE &nbsp; <span class="oi oi-arrow-right"></span></button></a>
                  </div>
                </div>
              </div>

          </section>

  </div>
  </section>

<?php endwhile; ?>


</div>

<section class="container-fluid">

  <div class="row">

    <div class="col-sm-3">
      <h1 class="title">sort events by:</h1>
    </div>
    <div class="category-select col-sm-9">
      <a href="#all"><button class="btn btn-sw red active">ALL</button></a>
      <a href="#conferences"><button class="btn btn-sw red">CONFERENCES</button></a>
      <a href="#workshops"><button class="btn btn-sw red">WORKSHOPS</button></a>
      <a href="#performances"><button class="btn btn-sw red">PERFORMANCES</button></a>
      <a href="#presentations"><button class="btn btn-sw red">PRESENTATIONS</button></a>
    </div>

    <?php
      $args = array(
        'posts_per_page' => -1,
        'post_type' => 'events',
        'post_status' => 'publish',
        'meta_query' => array(
          array(
            'key' => 'event_end',
            'value' => date("Y/m/d"),
            'compare' => '>='
          )
        ),
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => 'event_start'
      );

      $events_query = new WP_Query($args);

    ?>


    <?php if ($events_query->have_posts()) : $i = 0;
        while ($events_query->have_posts()) : $events_query->the_post(); ?>

        <?php
          $post_custom_fields = get_post_custom();
          $event_start_orig = $post_custom_fields['event_start'][0];
          $event_end_orig = $post_custom_fields['event_end'][0];

          $permalink = get_permalink();

          $post_name = $post->post_name;

          $event_type = $post_custom_fields['type'][0];
          if ($event_type == "Conference") {
            $participants = $post_custom_fields['conf_participants'][0];
            $schedule = $post_custom_fields['schedule'][0];
            $participant_info_travel = $post_custom_fields['conf_participant_info_travel'][0];
            $participant_info_activity = $post_custom_fields['conf_participant_info_activity'][0];
            $participant_info_accommodations = $post_custom_fields['information_for_participants_accommodations'][0];
            $notable_events = $post_custom_fields['notable_events'][0];

            $participants = htmlentities(wpautop($participants));
            $participants = trim(str_replace("&nbsp;", " ", $participants));
            $schedule = htmlentities(wpautop($schedule));
            $schedule = trim(str_replace("&nbsp;", " ", $schedule));
            $participant_info_travel = htmlentities(wpautop($participant_info_travel));
            $participant_info_travel = trim(str_replace("&nbsp;", " ", $participant_info_travel));
            $participant_info_activity = htmlentities(wpautop($participant_info_activity));
            $participant_info_activity = trim(str_replace("&nbsp;", " ", $participant_info_activity));
            $participant_info_accommodations = htmlentities(wpautop($participant_info_accommodations));
            $participant_info_accommodations = trim(str_replace("&nbsp;", " ", $participant_info_accommodations));
            $notable_events = htmlentities(wpautop($notable_events));
            $notable_events = trim(str_replace("&nbsp;", " ", $notable_events));
          } else {
            $participants = "";
            $schedule = "";
            $participant_info_travel = "";
            $participant_info_activity = "";
            $participant_info_accommodations = "";
            $notable_events = "";
          }

          $event_start = date_create_from_format("Y/m/d", $event_start_orig);
          $event_end = date_create_from_format("Y/m/d", $event_end_orig);

          $start_month = date_format($event_start, "F");
          $start_day = date_format($event_start, "j");
          $start_year = date_format($event_start, "Y");

          $end_month = date_format($event_end, "F");
          $end_day = date_format($event_end, "j");
          $end_year = date_format($event_end, "Y");

          $event_start_mini = date_format($event_start, "M j");
          $event_start = date_format($event_start, "M d, Y");
          $event_end_mini = date_format($event_end, "j, Y");
          $event_end = date_format($event_end, "M d, Y");

          if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
          else $event_date = $event_start;

          $time = $post_custom_fields['time'][0];

          $city = $post_custom_fields['city'][0];
          $venue = $post_custom_fields['venue'][0];
          $institution = $post_custom_fields['institution'][0];

          if (isset($city) && $city != "") $event_meta[] = $city;
          if (isset($institution) && $institution != "") $event_meta[] = $institution;
          if (isset($venue) && $venue != "") $event_meta[] = $venue;
          if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
          else $event_date = $event_start;

          $title = get_the_title();
          //if (strlen($title)>50) $title = substr($title, 0, 50) . "...";

          $cats = wp_get_post_categories(get_the_ID());
          $cat_list = [];
          $cat_print = [];
          foreach ($cats as $cat) {
            $slug = get_category($cat)->slug;
            $name = get_category($cat)->name;
            if ($name == "Conferences") $name = "Conference";
            elseif ($name == "Workshops") $name = "Workshop";
            elseif ($name == "Performances") $name = "Performance";
            elseif ($name == "Presentations") $name = "Presentation";
            $cat_list[] = "cat_" . $slug;
            $cat_print[] = $name;
          }
          $cat_list = " " . implode(" ", $cat_list);
          $cat_print = implode(" / ", $cat_print);
          $content = htmlentities(wpautop(get_the_content('', true)));
          $content = trim(str_replace("&nbsp;", " ", $content));

          $tags = get_the_tags(get_the_ID());
          //print_r($tags);
          $tag_array = [];
          foreach ($tags as $key => $tag) {
            $tag_array[$key]->slug = $tag->slug;
            $tag_array[$key]->name = $tag->name;
          }
          $cats = get_the_category(get_the_ID());
          $cat_array = [];
          foreach ($cats as $key => $cat) {
            $cat_array[$key]->slug = $cat->slug;
            $cat_array[$key]->name = $cat->name;
          }

          $tags = json_encode($tag_array);
          $cats = json_encode($cat_array);


        ?>
        <?php if (has_post_thumbnail()) {
            $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $img_lg_url = $img_lg[0];
            $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
            $img_thumb = $img_thumb[0];
            $img_lg_width = $img_lg[1];
            $img_lg_height = $img_lg[2];
          } else {
            $img_lg_url = "";
            $img_lg_width = "";
            $img_lg_height = "";
            $img_thumb = "";
          } ?>
        <div id="<?php echo $post_name; ?>" class="event col-lg-3 col-md-4<?php echo $cat_list; ?>" data-i="<?php echo $i; ?>" data-institution="<?php echo $institution; ?>" data-location="<?php echo $city; ?>" data-startyear="<?php echo $start_year; ?>" data-startmonth="<?php echo $start_month; ?>" data-startday="<?php echo $start_day; ?>" data-endyear="<?php echo $end_year; ?>" data-endmonth="<?php echo $end_month; ?>" data-endday="<?php echo $end_day; ?>" data-content="<?php echo $content; ?>" data-img="<?php echo $img_lg_url; ?>" data-imgwidth="<?php echo $img_lg_width; ?>" data-imgheight="<?php echo $img_lg_height; ?>" data-title="<?php echo $title; ?>" data-city="<?php echo $city; ?>" data-institution="<?php echo $institution; ?>" data-venue="<?php echo $venue; ?>" data-time="<?php echo $time; ?>" data-eventstart="<?php echo $event_start; ?>" data-eventend="<?php echo $event_end; ?>" data-type="upcoming" data-cats='<?php echo $cats; ?>' data-tags='<?php echo $tags; ?>' , data-permalink="<?php echo $permalink; ?>" data-confparticipants="<?php echo $participants; ?>" data-confschedule="<?php echo $schedule; ?>" data-conftravel="<?php echo $participant_info_travel; ?>" data-confactivity="<?php echo $participant_info_activity; ?>" data-confnotableevents="<?php echo $notable_events; ?>" data-confaccommodations="<?php echo $participant_info_accommodations; ?>" data-eventtype="<?php echo $event_type; ?>">
          <?php if (has_category("symposia") || has_category("institutes")) : ?>
            <a class="event-link" href="<?php echo $permalink; ?>" target="_blank">
            <?php else : ?>
              <a class="event-link" href="<?php echo $permalink; ?>" data-toggle="modal" data-target="#eventModal">
              <?php endif; ?>
              <div class="event-container">
                <div class="event-img" style="background:url('<?php echo $img_lg_url; ?>') center top;"></div>
                <div class="event-text bottom red">
                  <p class="title"><?php echo $cat_print; ?></p>
                  <h5>
                    <?php echo $title; ?>
                  </h5>
                  <p class="footer"><?php echo $event_date; ?><span class="location"><?php echo $city; ?></span></p>
                </div>
              </div>
              </a>
        </div>

    <?php $events_num++;
        endwhile;
      endif;
      wp_reset_query(); ?>

</section>


<?php else : ?>
  <section id="upcomingEvent" class="event-container">
    <div style="height:400px;" class=""></div>
    <section class="event-red container-fluid row">
      <div class="col-md-3 col-sm-4">
        <h1 class="title"><span>Upcoming<br />Events</span>
          <hr>
        </h1>
      </div>
      <div class="col-sm-12">
        <p>There are currently no upcoming events.</p>
      </div>
    </section>

  </section>

<?php endif; ?>

<section id="past">
  <?php
  $args = array(
    'posts_per_page' => 1,
    'post_type' => 'events',
    'post_status' => 'publish',
    'meta_query' => array(
      array(
        'key' => 'event_end',
        'value' => date("Y/m/d"),
        'compare' => '<'
      )
    ),
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start'
  );

  $past_event_query = new WP_Query($args);
  ?>

  <?php if ($past_event_query->have_posts()) : $i = 0;
    while ($past_event_query->have_posts()) : $past_event_query->the_post(); ?>
      <?php if (has_post_thumbnail()) {
        $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        $img_lg_url = $img_lg[0];
        $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
        $img_thumb = $img_thumb[0];
        $img_lg_width = $img_lg[1];
        $img_lg_height = $img_lg[2];
      } else {
        $img_lg_url = "";
        $img_lg_width = "";
        $img_lg_height = "";
        $img_thumb = "";
      } ?>
      <section id="pastEvents" class="event-container">
        <div style="background:url('<?php echo $img_lg_url; ?>') center center; background-size:cover; height:400px;" class="event-img filter"></div>
        <section class="event-orange container-fluid row">
          <div class="col-sm-12">
            <h1 class="title"><span>Past<br />Events</span>
              <hr>
            </h1>
          </div>
        </section>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>


  <?php

  $args = array(
    'posts_per_page' => -1,
    'post_type' => 'events',
    'post_status' => 'publish',
    'meta_query' => array(
      array(
        'key' => 'event_end',
        'value' => date("Y/m/d"),
        'compare' => '<'
      )
    ),
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start'
  );

  $past_events_query = new WP_Query($args);

  ?>

  <section class="container-fluid">
    <div class="row">

      <div class="col-sm-3">
        <h1 class="title orange">sort events by:</h1>
      </div>
      <div class="category-select col-sm-9">
        <a href="#all"><button class="btn btn-sw orange active">ALL</button></a>
        <a href="#conferences"><button class="btn btn-sw orange">CONFERENCES</button></a>
        <a href="#workshops"><button class="btn btn-sw orange">WORKSHOPS</button></a>
        <a href="#performances"><button class="btn btn-sw orange">PERFORMANCES</button></a>
        <a href="#presentations"><button class="btn btn-sw orange">PRESENTATIONS</button></a>
      </div>

      <div class="col-lg-3 col-md-4 col-sm-6">
        <h5>Filter by</h5>

        <div class="form-group">
          <label for="selectLocation" class="small"><strong>Location</strong></label>
          <select class="form-control" id="selectLocation">
            <option selected>All</option>
          </select>
        </div>

        <div class="form-group">
          <label for="selectYear" class="small"><strong>Year</strong></label>
          <select class="form-control" id="selectYear">
            <option selected>All</option>
          </select>
        </div>

        <div class="form-group">
          <label for="selectInstitution" class="small"><strong>Institution</strong></label>
          <select class="form-control" id="selectInstitution">
            <option selected>All</option>
          </select>
        </div>
      </div>
      <?php if ($past_events_query->have_posts()) : $i = 0;
        while ($past_events_query->have_posts()) : $past_events_query->the_post(); ?>

          <?php
          $post_custom_fields = get_post_custom();
          $event_start_orig = $post_custom_fields['event_start'][0];
          $event_end_orig = $post_custom_fields['event_end'][0];

          $permalink = get_permalink();
          $post_name = $post->post_name;

          $event_type = $post_custom_fields['type'][0];

          if ($event_type == "Conference") {
            $participants = $post_custom_fields['conf_participants'][0];
            $schedule = $post_custom_fields['schedule'][0];
            $participant_info_travel = $post_custom_fields['conf_participant_info_travel'][0];
            $participant_info_activity = $post_custom_fields['conf_participant_info_activity'][0];
            $participant_info_accommodations = $post_custom_fields['information_for_participants_accommodations'][0];
            $notable_events = $post_custom_fields['notable_events'][0];

            $participants = htmlentities(wpautop($participants));
            $participants = trim(str_replace("&nbsp;", " ", $participants));
            $schedule = htmlentities(wpautop($schedule));
            $schedule = trim(str_replace("&nbsp;", " ", $schedule));
            $participant_info_travel = htmlentities(wpautop($participant_info_travel));
            $participant_info_travel = trim(str_replace("&nbsp;", " ", $participant_info_travel));
            $participant_info_activity = htmlentities(wpautop($participant_info_activity));
            $participant_info_activity = trim(str_replace("&nbsp;", " ", $participant_info_activity));
            $participant_info_accommodations = htmlentities(wpautop($participant_info_accommodations));
            $participant_info_accommodations = trim(str_replace("&nbsp;", " ", $participant_info_accommodations));
            $notable_events = htmlentities(wpautop($notable_events));
            $notable_events = trim(str_replace("&nbsp;", " ", $notable_events));
          } else {
            $participants = "";
            $schedule = "";
            $participant_info_travel = "";
            $participant_info_activity = "";
            $participant_info_accommodations = "";
            $notable_events = "";
          }

          $event_start = date_create_from_format("Y/m/d", $event_start_orig);
          $event_end = date_create_from_format("Y/m/d", $event_end_orig);

          $start_month = date_format($event_start, "F");
          $start_day = date_format($event_start, "j");
          $start_year = date_format($event_start, "Y");

          $end_month = date_format($event_end, "F");
          $end_day = date_format($event_end, "j");
          $end_year = date_format($event_end, "Y");

          $event_start_mini = date_format($event_start, "M j");
          $event_start = date_format($event_start, "M d, Y");
          $event_end_mini = date_format($event_end, "j, Y");
          $event_end = date_format($event_end, "M d, Y");

          if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
          else $event_date = $event_start;

          $time = $post_custom_fields['time'][0];

          $city = $post_custom_fields['city'][0];
          $venue = $post_custom_fields['venue'][0];
          $institution = $post_custom_fields['institution'][0];

          $cats = wp_get_post_categories(get_the_ID());
          $cat_list = [];
          $cat_print = [];
          foreach ($cats as $cat) {
            $slug = get_category($cat)->slug;
            $name = get_category($cat)->name;
            if ($name == "Conferences") $name = "Conference";
            elseif ($name == "Workshops") $name = "Workshop";
            elseif ($name == "Performances") $name = "Performance";
            elseif ($name == "Presentations") $name = "Presentation";
            $cat_list[] = "cat_" . $slug;
            $cat_print[] = $name;
          }
          $cat_list = " " . implode(" ", $cat_list);
          $cat_print = implode(" / ", $cat_print);

          $content = htmlentities(wpautop(get_the_content('', true)));
          $content = trim(str_replace("&nbsp;", " ", $content));
          $title = get_the_title();

          $tags = get_the_tags(get_the_ID());
          $tag_array = [];
          foreach ($tags as $key => $tag) {
            $tag_array[$key]->slug = $tag->slug;
            $tag_array[$key]->name = $tag->name;
          }
          $cats = get_the_category(get_the_ID());
          $cat_array = [];
          foreach ($cats as $key => $cat) {
            $cat_array[$key]->slug = $cat->slug;
            $cat_array[$key]->name = $cat->name;
          }

          $tags = json_encode($tag_array);
          $cats = json_encode($cat_array);


          ?>
          <?php if (has_post_thumbnail()) {
            $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $img_lg_url = $img_lg[0];
            $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $img_thumb = $img_thumb[0];
            $img_lg_width = $img_lg[1];
            $img_lg_height = $img_lg[2];
          } else {
            $img_lg_url = "";
            $img_lg_width = "";
            $img_lg_height = "";
            $img_thumb = "";
          } ?>

          <div id="<?php echo $post_name; ?>" class="event col-lg-3 col-md-4 col-sm-6<?php echo $cat_list; ?>" data-i="<?php echo $i; ?>" data-institution="<?php echo $institution; ?>" data-location="<?php echo $city; ?>" data-startyear="<?php echo $start_year; ?>" data-startmonth="<?php echo $start_month; ?>" data-startday="<?php echo $start_day; ?>" data-endyear="<?php echo $end_year; ?>" data-endmonth="<?php echo $end_month; ?>" data-endday="<?php echo $end_day; ?>" data-content="<?php echo $content; ?>" data-img="<?php echo $img_lg_url; ?>" data-imgwidth="<?php echo $img_lg_width; ?>" data-imgheight="<?php echo $img_lg_height; ?>" data-title="<?php echo $title; ?>" data-city="<?php echo $city; ?>" data-institution="<?php echo $institution; ?>" data-venue="<?php echo $venue; ?>" data-time="<?php echo $time; ?>" data-eventstart="<?php echo $event_start; ?>" data-eventend="<?php echo $event_end; ?>" data-type="past" data-cats='<?php echo $cats; ?>' data-tags='<?php echo $tags; ?>' , data-permalink="<?php echo $permalink; ?>" data-confparticipants="<?php echo $participants; ?>" data-confschedule="<?php echo $schedule; ?>" data-conftravel="<?php echo $participant_info_travel; ?>" data-confactivity="<?php echo $participant_info_activity; ?>" data-confaccommodations="<?php echo $participant_info_accommodations; ?>" data-eventtype="<?php echo $event_type; ?>" data-confnotableevents="<?php echo $notable_events; ?>">
            <?php if (has_category("symposia") || has_category("institutes")) : ?>
              <a class="event-link" href="<?php echo $permalink; ?>" target="_blank">
              <?php else : ?>
                <a class="event-link" href="<?php echo $permalink; ?>" data-toggle="modal" data-target="#eventModal">
                <?php endif; ?>
                <div class="event-container">
                  <div class="event-img" style="background:url('<?php echo $img_lg_url; ?>') center top;"></div>
                  <div class="event-text bottom orange">
                    <p class="title"><?php echo $cat_print; ?></p>
                    <h5>
                      <?php echo $title; ?>
                    </h5>
                    <p class="footer"><?php echo $event_date; ?><span class="location"><?php echo $city; ?></span></p>
                  </div>
                </div>
                </a>
          </div>

      <?php $events_num++;
        endwhile;
      endif;
      wp_reset_query(); ?>

    </div>
  </section>
</section>



</div>


<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <a href="#" class="fancybox">
            <div class="event-image">
              <div class="event-gradient4"></div>
            </div>
          </a>
          <div class="event-title-container col-md-9 offset-md-2">
            <h1 class="event-title"></h1>
          </div>
          <div class="col-md-4" style="z-index:-1;">

          </div>
          <div class="col-md-7 content-container">
            <div class="event-date event-start-date">
              <span class="event-month event-start-month"></span>
              <span class="event-day event-start-day"></span>
              <span class="event-year event-start-year"></span>
            </div>
            <div class="event-date event-date-dash">-</div>
            <div class="event-date event-end-date">
              <span class="event-month event-end-month"></span>
              <span class="event-day event-end-day"></span>
              <span class="event-year event-end-year"></span>
            </div>
            <div class="event-meta-table">
              <div class="event-meta event-time"><span></span></div>
              <div class="event-meta event-institution"><span></span></div>
              <!--<div class="event-meta event-location"><span></span></div>-->
              <div class="event-meta event-venue"><span></span></div>
            </div>
            <div class="event-content"></div>

            <div class="event-conference" style="display:none;">
              <h5 class="conf-notable-events title">Notable events</h5>
              <div class="conf-notable-events text"></div>
              <h5 class="conf-conf-schedule title">Schedule</h5>
              <div class="conf-schedule text"></div>
              <h5 class="conf-participants title">Information for Participants</h5>
              <div class="conf-participants text"></div>
              <h5 class="conf-participant-info-travel title">Travel</h5>
              <div class="conf-participant-info-travel text"></div>
              <h5 class="conf-participant-info-activity title">Location Activities</h5>
              <div class="conf-participant-info-activity text"></div>
              <h5 class="conf-participant-info-accommodations title">Accommodations</h5>
              <div class="conf-participant-info-accommodations text"></div>
            </div>

            <div class="event-footer">
              <div class="tags-container"><span class="oi oi-tags"></span>
                <!--<span class="cats"></span> | --><span class="tags"></span>
              </div>
            </div>

            <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

            <div class="event-share" style="position:relative; top:10px;">
              <span class="twitter-share-button-container"></span><span class="fb-share-button-container"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php get_footer(); ?>