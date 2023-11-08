<?php
//
$postID = 15041;

query_posts(
  array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'p' => $postID,
  )
);
if (have_posts()) : while (have_posts()) : the_post();

?>

<section id="memoriam" class="container-fluid" style="background:#fff;">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="title"><?php the_title(); ?></h1>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <?php the_content(); ?>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="row">
          <?php 
            $images = array(15042,15044,15045,15047);
            foreach ($images as $image) {
              echo '<div class="col-6" style="padding-bottom: 15px;">' . wp_get_attachment_image($image, 'thumbnail', '', array('class' => 'img-fluid')) . '</div>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endwhile;
endif;

