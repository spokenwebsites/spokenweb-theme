<?php get_header(); ?>
<section class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h1 id="slogan">Sounding<br />Literature</h1>
    </div>
    <div id="about" class="col-sm-5">
      <p>The SSHRC-funded <strong>SpokenWeb</strong> partnership aims to develop coordinated and collaborative approaches to literary historical study, digital development, and critical and pedagogical engagement with diverse collections of literary sound recordings from across Canada and beyond.

      </p>
      <a href="<?php echo get_permalink(get_page_by_path('about-us/spokenweb/')) ?>"><button class="btn btn-sw">MORE ABOUT US &nbsp; <span class="oi oi-arrow-right"></span></button></a>
    </div>
  </div>
</section>
<?php
// BLM Post
// include('post-blm.php');
?>
<?php
// TR Day Post
// include('post-tr-day.php');
?>
<section class="container-fluid" style="background:#fff;">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="title">
        <a href="https://search.spokenweb.ca" style="color:inherit; text-decoration:none;">
          The SpokenWeb Search Engine
        </a>
      </h1>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col-sm-7">
      <p>The SpokenWeb Search Engine allows users to search collections of literary sound recordings held at organizations and institutions across Canada. Metadata about the recordings are held in the SpokenWeb Swallow Database. The contents of this database are made available through this SpokenWeb Search Engine which works as a directory to information about the recordings, and in some cases to the audiovisual materials themselves. This version of the SpokenWeb Search Engine is currently in development. The first official version of the SWSE will launched at the SpokenWeb Institute in May 2025.</p>
      <a href="https://search.spokenweb.ca" class="btn btn-sw">GO TO THE SEARCH ENGINE &nbsp; <span class="oi oi-arrow-right"></span></a>
    </div>
    <div class="col-sm-3 offset-sm-1 col-6 offset-3 desktop">
      <!-- Yellow half-circle background -->
      <div id="image-background" style="background: rgb(233, 142, 74); display: inline-block; width: 300px; position: absolute; transform: rotate(45deg); transform-origin: 50% 100% 0px; height: 150px; border-radius: 300px 300px 0px 0px; top: -15px; left: 0px;"></div>
      <!-- Image container -->
      <a href="https://search.spokenweb.ca">
        <div style="position:relative;">
          <img src="https://spokenweb.ca/wp-content/uploads/2025/03/spokenweb-search-engine-page1024x839.png" alt="SpokenWeb Search Engine" style="width:256px; height:256px; border-radius:50%;position: relative;">
        </div>
      </a>
    </div>
  </div>
</section>
<?php
query_posts(
  array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'post_type' => 'podcast'
  )
);
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php
    $audio_url = get_field('audio_download_url');
    $subtitle = get_field('subtitle');
  ?>
    <section id="audio" class="alt container-fluid" data-audio="<?php echo $audio_url; ?>" style="background: #202727; color: #fff;">
      <div class="row">
        <div class="col-sm-12">
          <h1 class="title">
            New Audio from 
            <span style="position: relative; display: inline-block;">
              <span style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; transform: rotate(-1deg); background-color: #EC8E43; display: inline-block; z-index: 0;"></span>
              <span style="position: relative; z-index: 1; color: rgb(58, 70, 70);">SpokenWeb Podcast</span>
            </span>
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <h3 class="subtitle">
            <?php the_title(); ?><br />
            <?php echo $subtitle; ?>
	        </h3>
          <?php if ($audio_url) : ?>
            <div style="margin-top:30px; margin-bottom:30px;">
              <div class="container-audio">
                <div class="audio-play"><span class="oi oi-media-play"></span></div>
                <div class="container-waveform">
                  <div id="waveform" class="waveform"></div>
                  <div class="time-container"><span class="currentTime">00:00</span> <span class="timeslash">/</span> <span class="duration">00:00</span></div>
                </div>
              </div>
	          </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="row align-items-center">
        <!--div class="col-sm-3 offset-sm-1 col-6 offset-3 mobile audiocontainer">
          <div id="audio-img-container1" style="background: #E98E4A; display: inline-block; width:100%; position:absolute; transform: rotate(45deg); transform-origin: 50% 100%;"></div>
          php if (has_post_thumbnail()) : ?>
            php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $img_lg = $img_lg[0]; ?>
            <a href="php the_permalink(); ?>" target="_blank">
              <div style="position:relative;"><img id="audio-img1" src="php echo $img_lg; ?>" width="100%" style="border-radius:50%;"></div>
            </a>
          php endif; ?>
        </div-->
        <div class="col-sm-7">
          <?php the_excerpt(); ?>
          <h4><a href="<?php the_permalink(); ?>" style="color:white;">Read more...</a></h4>
        </div>
        <?php if (has_post_thumbnail()) : ?>
          <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
          $img_lg = $img_lg[0]; ?>
          <div class="col-sm-3 offset-sm-1 col-6 offset-3 desktop">
            <div id="audio-img-container2" style="background: #E98E4A; display: inline-block; width:100%; position:absolute; transform: rotate(45deg); transform-origin: 50% 100%;"></div>
            <a href="<?php the_permalink(); ?>" target="_blank">
              <div style="position:relative;">          <img id="podcast-img2" src="https://staging.spokenweb.ca/wp-content/themes/spokenweb-theme/_/img/podcast_logo.png" width="100%" style="max-width: 256px; height: auto; border-radius:50%;"></div>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </section>
<?php endwhile;
endif; ?>

<section class="container-fluid" style="background:#fff;">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="title">Upcoming Events</h1>
      <div class="row">
        <?php
        query_posts(
          array(
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
          )
        );
        ?>
        <?php if (have_posts()) : $events_num = 0; ?>
          <?php while (have_posts()) : the_post(); ?>
            <?php
            $post_custom_fields = get_post_custom();
            $event_start_orig = get_field('event_start');
            $event_end_orig = get_field('event_end');
            $event_time = get_field('event_time');
            $event_start = date_create_from_format("Y/m/d", $event_start_orig);
            $event_start_mini = date_format($event_start, "M j");
            $event_start = date_format($event_start, "M d, Y");
            $event_end = date_create_from_format("Y/m/d", $event_end_orig);
            $event_end_mini = date_format($event_end, "j, Y");
            $event_end = date_format($event_end, "M d, Y");
            if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
            else $event_date = $event_start;
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
              <a class="event-link" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                  $img_lg = $img_lg[0]; ?>
                  <div class="event-container">
                    <div class="event-img filter" style="background:url('<?php echo $img_lg; ?>') center center;"></div>
                    <div class="event-gradient"></div>
                    <div class="event-gradient2"></div>
                    <div class="event-text">
                      <h5><?php the_title() ?></h5>
                      <p><?php echo $event_date; ?></p>
                    </div>
                  </div>
                <?php endif; ?>
              </a>
            </div>

          <?php $events_num++;
          endwhile; ?>
        <?php else : ?>
          <p>There are currently no upcoming events.</p>
        <?php endif;
        wp_reset_query(); ?>
      </div>
    </div>
  </div>
  </div>
  </div>
  <?php get_footer(); ?>
  <script>
    var bg = document.getElementById("bg");
    window.addEventListener("scroll", function() {
      bg.style.transform = "rotate(" + window.pageYOffset / 10 + "deg)";
    });
    $(document).ready(function() {
      var width = $("#audio-img1").width() + 30;
      var height = width / 2;
      var top = $("#audio-img1").position().top - 15;
      var left = $("#audio-img1").position().left;
      $("#audio-img-container1").css({
        "height": height + "px",
        "width": width + "px",
        "border-radius": width + "px " + width + "px 0 0",
        "top": top + "px",
        "left": left + "px"
      });
      var width = $("#audio-img2").width() + 30;
      var height = width / 2;
      var top = $("#audio-img2").position().top - 15;
      var left = $("#audio-img2").position().left;
      $("#audio-img-container2").css({
        "height": height + "px",
        "width": width + "px",
        "border-radius": width + "px " + width + "px 0 0",
        "top": top + "px",
        "left": left + "px"
      });
    });
    $(window).on("resize", function(e) {
      var width = $("#audio-img1").width() + 30;
      var height = width / 2;
      var top = $("#audio-img1").position().top - 15;
      var left = $("#audio-img1").position().left;
      $("#audio-img-container1").css({
        "height": height + "px",
        "width": width + "px",
        "border-radius": width + "px " + width + "px 0 0",
        "top": top + "px",
        "left": left + "px"
      });
      var width = $("#audio-img2").width() + 30;
      var height = width / 2;
      var top = $("#audio-img2").position().top - 15;
      var left = $("#audio-img2").position().left;
      $("#audio-img-container2").css({
        "height": height + "px",
        "width": width + "px",
        "border-radius": width + "px " + width + "px 0 0",
        "top": top + "px",
        "left": left + "px"
      });
    });
  </script>
