<div id="hero" class="hero">
  <h1>Institutes</h1>
</div>
<section class="container-fluid">
  <div class="row">
    <div class="col-md-5 col-lg-4 sidebar-container" data-toggle="affix">
      <ul id="symposiaNav" class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link year active" href="#"></a>
        </li>
        <li class="nav-item" style="display:none;">
          <a class="nav-link year" href="#"></a>
        </li>
        <li class="nav-item" style="display:none;">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Past years</a>
          <div class="dropdown-menu"></div>
        </li>
      </ul>

      <aside class="sidebar">
        <h4 class="symposium-date"></h4>

        <h5 class="symposium-title"></h5>
        <div class="symposium-location">
          <div>
            <span class="symposium-institution"></span>, <span class="symposium-city"></span>
          </div>
          <div>
            <span class="symposium-venue"></span>
          </div>
        </div>
        <div class="symposium-links">
          <h3><a href="#notableEvents" class="year">Notable Events</a></h3>
          <h3><a href="#schedule" class="year">Conference Schedule</a></h3>
          <h3><a href="#participants" class="year">Participants</a></h3>
          <h3><a href="#participantInfo" class="year">Information for Participants</a></h3>
        </div>
      </aside>

    </div>
    <article class="col-md-7 col-lg-8 pt-5 offset-md-5 offset-lg-4  mt-2">
      <?php

      $args = array(
        'post_type' => 'events',
        'posts_per_page' => -1,
        'post_status' => array('publish'),
        'category_name' => 'institutes',
        'order' => 'DESC',
        'orderby' => 'meta_value',
        'meta_key' => 'event_start'
      );
      $institutes_query = new WP_Query($args);
      $count = $institutes_query->post_count;

      ?>

      <?php if ($institutes_query->have_posts()) : $i = 0;
        while ($institutes_query->have_posts()) : $institutes_query->the_post(); ?>
          <?php if (has_post_thumbnail()) {
            $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
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
          }

          $post_custom_fields = get_post_custom();
          $event_start_orig = $post_custom_fields['event_start'][0];
          $event_end_orig = $post_custom_fields['event_end'][0];

          $permalink = get_permalink();
          $post_name = $post->post_name;

          $title = get_the_title();
          $subtitle = $post_custom_fields['subtitle'][0];

          $description = $post_custom_fields['description'][0];

          $notable_events = $post_custom_fields['notable_events'][0];
          $participants = $post_custom_fields['conf_participants'][0];
          $schedule = $post_custom_fields['schedule'][0];
          $participant_info_travel = $post_custom_fields['conf_participant_info_travel'][0];
          $participant_info_activity = $post_custom_fields['conf_participant_info_activity'][0];
          $participant_info_accommodations = $post_custom_fields['information_for_participants_accomodations'][0];

          $participants = wpautop($participants);
          $schedule = wpautop($schedule);
          $participant_info_travel = wpautop($participant_info_travel);
          $participant_info_activity = wpautop($participant_info_activity);
          $participant_info_accommodations = wpautop($participant_info_accommodations);
          $notable_events = wpautop($notable_events);

          $event_start = date_create_from_format("Y/m/d", $event_start_orig);
          $event_end = date_create_from_format("Y/m/d", $event_end_orig);

          $start_month = date_format($event_start, "F");
          $start_day = date_format($event_start, "j");
          $start_year = date_format($event_start, "Y");

          $end_month = date_format($event_end, "F");
          $end_day = date_format($event_end, "j");
          $end_year = date_format($event_end, "Y");

          $event_start_mini = date_format($event_start, "F j");
          $event_start = date_format($event_start, "F d, Y");
          $event_end_mini = date_format($event_end, "j, Y");
          $event_end = date_format($event_end, "F d, Y");

          if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
          else $event_date = $event_start;

          $time = $post_custom_fields['time'][0];

          $city = $post_custom_fields['city'][0];
          $venue = $post_custom_fields['venue'][0];
          $institution = $post_custom_fields['institution'][0];

          $alert_message = $post_custom_fields['alert_message'][0];
          $alert_title = $post_custom_fields['alert_title'][0];
          $alert_color = $post_custom_fields['alert_color'][0];
          $alert_content = $post_custom_fields['alert_content'][0];

          $event_meta = array();

          if (isset($city) && $city != "") $event_meta[] = $city;
          if (isset($institution) && $institution != "") $event_meta[] = $institution;
          if (isset($venue) && $venue != "") $event_meta[] = $venue;
          ?>
          <div id="<?php echo $post_name; ?>" class="row symposium <?php echo $cat_list; ?>" data-i="<?php echo $i; ?>" data-institution="<?php echo $institution; ?>" data-location="<?php echo $city; ?>" data-eventdate="<?php echo $event_date; ?>" data-startyear="<?php echo $start_year; ?>" data-startmonth="<?php echo $start_month; ?>" data-startday="<?php echo $start_day; ?>" data-endyear="<?php echo $end_year; ?>" data-endmonth="<?php echo $end_month; ?>" data-endday="<?php echo $end_day; ?>" data-content="<?php echo $content; ?>" data-permalink="<?php echo $permalink; ?>" data-img="<?php echo $img_lg_url; ?>" data-imgwidth="<?php echo $img_lg_width; ?>" data-imgheight="<?php echo $img_lg_height; ?>" data-title="<?php echo $title; ?>" data-city="<?php echo $city; ?>" data-institution="<?php echo $institution; ?>" data-venue="<?php echo $venue; ?>" data-time="<?php echo $time; ?>" data-eventstart="<?php echo $event_start; ?>" data-eventend="<?php echo $event_end; ?>" data-type="upcoming" data-cats='<?php echo $cats; ?>' data-tags='<?php echo $tags; ?>' data-eventtype="<?php echo $event_type; ?>">
          <?php
            if (post_password_required()) {
              echo get_the_password_form();
            } ?>
            <?php if ($alert_message == true) : ?>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <h4 class="alert-heading"><?php echo $alert_title; ?></h4>
                <?php echo wpautop($alert_content); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>

            <h2><?php echo $title; ?><?php if (isset($subtitle)) echo ": $subtitle"; ?></h2>

            <div class="event-share" style="position:relative; top:0px; width:100%; margin-bottom:0.5rem;">
              <span class="twitter-share-button-container"><a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a></span>
              <span class="fb-share-button-container">
                <div class="fb-share-button" data-href="<?php echo $permalink; ?>" data-layout="button" data-size="large" data-mobile-iframe="true"></div>
              </span>
            </div>

            <?php if (isset($description) && $description != "") echo wpautop($description); ?>

            <div class="event-conference">
              <?php if (isset($notable_events) && $notable_events != "") : ?>
                <h3 id="notableEvents<?php echo $i; ?>" class="conf-notable-events title">Notable Events</h3>
                <div class="conf-notable-events text"><?php echo $notable_events; ?></div>
              <?php endif; ?>

              <?php if (empty($post->post_password) || post_password_required()) : ?>
                <?php if (isset($schedule) && $schedule != "") : ?>
                  <h3 id="schedule<?php echo $i; ?>" class="conf-schedule title">Conference Schedule</h3>
                  <div class="conf-schedule text"><?php echo $schedule; ?></div>
                <?php endif; ?>
              <?php else : ?>
                <?php if (isset($schedule_private) && $schedule_private != "") : ?>
                  <h3 id="schedule<?php echo $i; ?>" class="conf-schedule title">Conference Schedule</h3>
                  <div class="conf-schedule text"><?php echo $schedule_private; ?></div>
                <?php endif; ?>
              <?php endif; ?>
              
              <?php if (isset($participants) && $participants != "") : ?>
                <h3 id="participants<?php echo $i; ?>" class="conf-participants title">Participants</h3>
                <div class="conf-participants text"><?php echo $participants; ?></div>
              <?php endif; ?>

              <?php if (isset($participant_info_travel) && $participant_info_travel != "") : ?>
                <h3 id="travel<?php echo $i; ?>" class="conf-participant-info-travel title">Travel</h3>
                <div class="conf-participant-info-travel text"><?php echo $participant_info_travel; ?></div>
              <?php endif; ?>

              <?php if (isset($participant_info_accommodations) && $participant_info_accommodations != "") : ?>
                <h3 id="accommodations<?php echo $i; ?>" class="conf-participant-info-accommodations title">Accommodations</h3>
                <div class="conf-participant-info-accommodations text"><?php echo $participant_info_accommodations; ?></div>
              <?php endif; ?>

              <?php if (isset($participant_info_activity) && $participant_info_activity != "") : ?>
                <h3 id="activity<?php echo $i; ?>" class="conf-participant-info-activity title">Things to do around the area</h3>
                <div class="conf-participant-info-activity text"><?php echo $participant_info_activity; ?></div>
              <?php endif; ?>

            </div>

          </div>
      <?php $i++;
        endwhile;
      endif; ?>

    </article>

  </div>
</section>

<?php get_footer(); ?>