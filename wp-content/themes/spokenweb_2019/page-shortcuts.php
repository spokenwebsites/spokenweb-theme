<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    $post_custom_fields = get_post_custom();
    $top_header = $post_custom_fields['top_header'][0];
    $left_column = $post_custom_fields['left_column'][0];
    $right_column = $post_custom_fields['right_column'][0];
    $bottom_section = $post_custom_fields['bottom_section'][0];
    $bottom_section_title = $post_custom_fields['bottom_title'][0];
    $bottom_section_left = $post_custom_fields['bottom_section_left'][0];
    $bottom_section_right = $post_custom_fields['bottom_section_right'][0];
    ?>
    <section class="container episodes-container">
      <div class="row">
        <div class="col-sm-12">
          <p class="return-link"><a href="<?php echo  get_permalink(get_page_by_title('Episodes')); ?>"><span class="return-arrow">‹</span><span class="return-text">Return to the Podcast Home Page</span></a></p>
          <h1>SpokenWeb</h1>
          <div class="accent">
            <h1>Shortcuts</h1>
          </div>
          <div class="text-center logo-container mt-2"><img src="<?php bloginfo('template_directory'); ?>/_/img/shortcuts_logo.png" width="300" /></div>
        </div>
        <div class="col-sm-12 text-center">
          <div class="subscribe-link-container"><a id="subscribe-link" href="https://the-spokenweb-podcast.simplecast.com/" target="_blank"><button class="btn btn-sw"><span class="oi oi-rss-alt"></span>SUBSCRIBE</button></a></div>
          <div class="header-container text-center">
            <?php echo wpautop($top_header); ?>
          </div>
          <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12">
              <hr>
            </div>
          </div>
        </div>
        <div class="col-md-11 col-sm-12">
          <div class="row entry-content">
            <div class="col-md-5 offset-md-1 col-sm-6">
              <?php echo wpautop($left_column); ?>
            </div>
            <div class="col-md-5 offset-md-1 col-sm-6">
              <?php echo wpautop($right_column); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endwhile;
endif; ?>



<section class="container episodes">
  <div class="row">
    <div class="col-sm-12 col-md-10 offset-md-1 text-center category-select-container">
      <div class="category-select sort mb-5">
        <div class="d-inline">
          <strong class="mr-3">SORT EPISODES BY:</strong>
          <a href="#desc"><button class="btn btn-sw active">DATE (DESC)</button></a>
          <a href="#asc"><button class="btn btn-sw">DATE (ASC)</button></a>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-10 offset-md-1">

      <div class="desc row">
        <?php
        $args = array(
          'posts_per_page' => -1,
          'post_type' => 'podcast',
          'post_status' => 'publish',
          'order' => 'DESC',
          'orderby' => 'date',
          'meta_key' => 'type',
          'meta_value' => array('ShortCuts')
        );

        $podcast_query = new WP_Query($args);
        ?>

        <?php if ($podcast_query->have_posts()) : $i = 0;
          while ($podcast_query->have_posts()) : $podcast_query->the_post(); ?>
            <?php
            $post_custom_fields = get_post_custom();
            $subtitle = $post_custom_fields['subtitle'][0];
            $producer = $post_custom_fields['producer'][0];
            $type = strtolower(str_replace(" ", "_", $post_custom_fields['type'][0]));
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


            <div class="col-sm-4 col-6" data-type="<?php echo $type; ?>">
              <div style="position:relative;">
                <h4 style="position:absolute; z-index:1000; bottom:37px; left:15px; font-size:16px; color: #fff;"><?php echo $subtitle; ?></h4>
                <a href="<?php the_permalink(); ?>">
                  <img class="event-img filter" src="<?php echo $img_thumb; ?>" width="100%">
                  <section class="event-orange"></section>
                  <span class="listen-now"><span class="oi oi-media-play"></span>Listen Now</span>
                </a>
              </div>


              <h5><?php echo get_the_date(); ?></h5>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <?php the_excerpt(); ?>
            </div>

        <?php endwhile;
        endif; ?>
      </div>

      <div class="asc row" style="display:none;">
        <?php
        $args = array(
          'posts_per_page' => -1,
          'post_type' => 'podcast',
          'post_status' => array('publish, private'),
          // 'post_status' => 'publish',
          'order' => 'ASC',
          'orderby' => 'date',
          'meta_key' => 'type',
          'meta_value' => array('ShortCuts')
        );

        $podcast_query = new WP_Query($args);
        ?>

        <?php if ($podcast_query->have_posts()) : $i = 0;
          while ($podcast_query->have_posts()) : $podcast_query->the_post(); ?>
            <?php
            $post_custom_fields = get_post_custom();
            $subtitle = $post_custom_fields['subtitle'][0];
            $producer = $post_custom_fields['producer'][0];
            $type = strtolower(str_replace(" ", "_", $post_custom_fields['type'][0]));
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

            <div class="col-sm-4 col-6" data-type="<?php echo $type; ?>">
              <div style="position:relative;">
                <h4 style="position:absolute; z-index:1000; top:15px; left:15px; font-size:16px; color: #fff;"><?php echo $subtitle; ?></h4>
                <a href="<?php the_permalink(); ?>">
                  <img class="event-img filter" src="<?php echo $img_thumb; ?>" width="100%">
                  <section class="event-orange"></section>
                  <span class="listen-now"><span class="oi oi-media-play"></span>Listen Now</span>
                </a>
              </div>

              <h5><?php echo get_the_date(); ?></h5>
              <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <?php the_excerpt(); ?>
            </div>

        <?php endwhile;
        endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if (isset($bottom_section) && $bottom_section == true) : ?>
  <section class="container" style="padding-top: 0px; margin-top: -2rem;">
    <div class="row pb-5">
      <div class="col-md-10 offset-md-1 col-sm-12">
        <?php if (isset($bottom_section_title) && $bottom_section_title !== "") : ?>
          <div class="header-container text-center">
            <h3><?php echo $bottom_section_title; ?></h3>
          </div>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-10 offset-md-1 col-sm-12">
            <hr>
          </div>
        </div>
      </div>

      <div class="col-md-11 col-sm-12">
        <div class="row entry-content">
          <div class="col-md-5 offset-md-1 col-sm-6">
            <?php echo wpautop($bottom_section_left); ?>
          </div>
          <div class="col-md-5 offset-md-1 col-sm-6">
            <?php echo wpautop($bottom_section_right); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>