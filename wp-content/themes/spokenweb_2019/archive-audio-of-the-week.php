<?php
$cat = get_queried_object();
$cat_id = $cat->term_id;
$slug = $cat->slug;
?>

<div class="d-flex pt-5" style="background:#f4f4f4; padding-bottom:150px; margin-bottom:-150px;">
  <div class="mx-auto text-center">
    <em>
      <h1>SpokenWeb</h1>
    </em>
    <h1>AUDIO OF THE WEEK</h1>
  </div>
</div>

<div class="px-3">
  <?php
  $args = ['order' => 'DESC', 'category_name' => $slug, 'posts_per_page' => 1];
  $archive_query = new WP_Query($args);
  while ($archive_query->have_posts()) : $archive_query->the_post();

    $post_custom_fields = get_post_custom();
    $date_end_orig = $post_custom_fields['date_end'][0];
    $event_time = $post_custom_fields['event_time'][0];

    $date_end = date_create_from_format("Ymd", $date_end_orig);
    $date_end_mini = date_format($date_end, "j, Y");
    $date_end = date_format($date_end, "M d, Y");

    $author = $post_custom_fields['author'][0];

    $title = get_the_title();

    $audio = $post_custom_fields['audio'][0];
    $subtitle = $post_custom_fields['subtitle'][0];
    $audio_url = wp_get_attachment_url($audio);

  ?>

    <div class="container featured-article mt-4 p-4">

      <div class="row d-flex justify-content-between p-2">
        <div class="col-md-6 justify-content-center align-self-center">
          <h4 class="mb-4">Featured Post</h4>
          <a href="<?php the_permalink(); ?>">
            <h2 class="mb-4"><?php the_title(); ?><?php// if(isset($subtitle) && $subtitle!="") echo " – $subtitle";?></h2>
          </a>
          <div class="mb-2 d-flex justify-content-end flex-row-reverse">
            <h5 class="mb-1"><?php the_time('F j, Y'); ?></h5>
            <h5 class="mb-1 mr-5"><?php echo $author; ?></h5>
          </div>
          <div class="col-md-5 col-9 mb-2 justify-content-center align-self-center mx-auto d-md-none d-block">

            <?php if (has_post_thumbnail()) : ?>
              <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
              $img_lg = $img_lg[0]; ?>
              <img src="<?php echo $img_lg; ?>" width="100%">
            <?php endif; ?>
          </div>
          <p>
            <?php if (isset($audio_url) && $audio_url != "") : ?>
              <audio src="<?php echo $audio_url; ?>" class="w-100 mb-3" controls></audio>
            <?php endif; ?>
            <?php echo get_the_excerpt(); ?>
          </p>
        </div>
        <div class="col-md-5 justify-content-center align-self-center mx-auto d-none d-md-block">
          <?php if (has_post_thumbnail()) : ?>
            <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
            $img_lg = $img_lg[0]; ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $img_lg; ?>" width="100%"></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endwhile; ?>

  <div class="container pt-5 mb-3 text-center category-select-container">
    <span class="title">SORT ENTRIES BY:</span>
    <div class="d-inline-block category-select mb-0 ml-3">
      <div class="dropdown sort d-inline-block mr-2">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dateButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-title="DATE (DESC)" data-type="date-order">DATE (DESC)</button>
        <div class="dropdown-menu" aria-labelledby="dateButton">
          <a class="dropdown-item active" href="#desc">DATE (DESC)</a>
          <a class="dropdown-item" href="#asc">DATE (ASC)</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container pb-5 articles" data-date-order="desc">

    <div class="row" style="margin:0px -1.45rem;">

      <?php

      $args = ['order' => 'DESC', 'category_name' => $slug, 'posts_per_page' => -1];
      $archive_query = new WP_Query($args);
      while ($archive_query->have_posts()) : $archive_query->the_post();

        $post_custom_fields = get_post_custom();
        $date_end_orig = $post_custom_fields['date_end'][0];
        $event_time = $post_custom_fields['event_time'][0];

        $date_end = date_create_from_format("Ymd", $date_end_orig);
        $date_end_mini = date_format($date_end, "j, Y");
        $date_end = date_format($date_end, "M d, Y");

        $author = $post_custom_fields['author'][0];

        $title = get_the_title();

        $audio = $post_custom_fields['audio'][0];
        $subtitle = $post_custom_fields['subtitle'][0];
        $audio_url = wp_get_attachment_url($audio);

        $categories = array();
        //if (has_category('spokenweblog')){
        //if (has_category('article')) $categories[]="article";    
        //if (has_category('audio-of-the-week')) $categories[]="audio-of-the-week";      
        //}
        $categories = implode(" ", $categories);
      ?>

        <div class="article col-md-6 p-2" data-categories="<?php echo $categories; ?>">
          <div class="h-100 position-relative" style="border:1px solid #e4e4e4;">
            <div class="d-flex pt-4">
              <div class="w-50 pl-4 pr-3 justify-content-center align-self-center">
                <?php if (has_post_thumbnail()) : ?>
                  <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                  $img_lg = $img_lg[0]; ?>
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $img_lg; ?>" width="100%"></a>
                <?php endif; ?>
              </div>
              <div class="w-50 pl-3 pr-4 justify-content-center align-self-center">
                <div class="meta">
                  <p><?php the_time('F j, Y'); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>">
                  <h3 class="my-2"><?php the_title(); ?></h3>
                </a>
                <div class="meta">
                  <p class="mt-2"><?php echo $author; ?></p>
                </div>
              </div>
            </div>
            <div class="d-flex flex-column justify-content-between mb-5">
              <div class="px-4 mt-auto mb-3">
                <?php if (isset($audio_url) && $audio_url != "") : ?>
                  <audio src="<?php echo $audio_url; ?>" class="w-100 mt-3" controls></audio>
                <?php endif; ?>
                <p class="small mt-4"><?php echo get_the_excerpt(); ?></p>
              </div>
            </div>
            <div class="position-absolute mt-5" style="bottom:0px; border-top:1px solid #e4e4e4; width:100%">
              <div class="meta w-100 align-self-end">
                <p class="smaller p-3"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
              </div>
            </div>

          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </div>

  <div class="container pb-5 articles" data-date-order="asc" style="display:none;">

    <div class="row" style="margin:0px -1.45rem;">

      <?php
      $args = ['order' => 'ASC', 'category_name' => $slug, 'posts_per_page' => -1];
      $archive_query = new WP_Query($args);
      while ($archive_query->have_posts()) : $archive_query->the_post();
        $post_custom_fields = get_post_custom();
        $date_end_orig = $post_custom_fields['date_end'][0];
        $event_time = $post_custom_fields['event_time'][0];

        $date_end = date_create_from_format("Ymd", $date_end_orig);
        $date_end_mini = date_format($date_end, "j, Y");
        $date_end = date_format($date_end, "M d, Y");

        $author = $post_custom_fields['author'][0];

        $title = get_the_title();

        $audio = $post_custom_fields['audio'][0];
        $subtitle = $post_custom_fields['subtitle'][0];
        $audio_url = wp_get_attachment_url($audio);

        $categories = array();
        //if (has_category('spokenweblog')){
        //if (has_category('article')) $categories[]="article";    
        //if (has_category('audio-of-the-week')) $categories[]="audio-of-the-week";      
        //}
        $categories = implode(" ", $categories);
      ?>

        <div class="article col-md-6 p-2" data-categories="<?php echo $categories; ?>">
          <div class="h-100 position-relative" style="border:1px solid #e4e4e4;">
            <div class="d-flex pt-4">
              <div class="w-50 pl-4 pr-3 justify-content-center align-self-center">
                <?php if (has_post_thumbnail()) : ?>
                  <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                  $img_lg = $img_lg[0]; ?>
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $img_lg; ?>" width="100%"></a>
                <?php endif; ?>
              </div>
              <div class="w-50 pl-3 pr-4 justify-content-center align-self-center">
                <div class="meta">
                  <p><?php the_time('F j, Y'); ?></p>
                </div>
                <a href="<?php the_permalink(); ?>">
                  <h3 class="my-2"><?php the_title(); ?></h3>
                </a>
                <div class="meta">
                  <p class="mt-2"><?php echo $author; ?></p>
                </div>
              </div>
            </div>
            <div class="d-flex flex-column justify-content-between mb-5">
              <div class="px-4 mt-auto mb-3">
                <?php if (isset($audio_url) && $audio_url != "") : ?>
                  <audio src="<?php echo $audio_url; ?>" class="w-100 mt-3" controls></audio>
                <?php endif; ?>
                <p class="small mt-4"><?php echo get_the_excerpt(); ?></p>
              </div>
            </div>
            <div class="position-absolute mt-5" style="bottom:0px; border-top:1px solid #e4e4e4; width:100%">
              <div class="meta w-100 align-self-end">
                <p class="smaller p-3"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
              </div>
            </div>

          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </div>


</div>