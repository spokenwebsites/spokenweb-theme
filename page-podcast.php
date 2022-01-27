<?php if (is_page('podcast')) : ?>
  <?php wp_redirect(get_permalink(get_page_by_title('Episodes'))); ?>
<?php endif; ?>
<?php get_header(); ?>
<?php if (have_posts()) :
  while (have_posts()) : the_post(); ?>
    <?php
    $post_custom_fields = get_post_custom();
    ?>
    <section class="container podcast">
      <div class="row">
        <div class="col-sm-12">
          <div class="text-center logo-container"><img src="<?php bloginfo('template_directory'); ?>/_/img/podcast_logo.png" width="108" /></div>
          <p class="return-link"><a href="<?php echo  get_permalink(get_page_by_title('Episodes')); ?>"><span class="return-arrow">‹</span><span class="return-text">Return to Episodes Homepage</span></a></p>
          <div class="accent">
            <h4>SpokenWeb Podcast</h4>
          </div>
          <h1><?php the_title(); ?></h1>
        </div>
        <div class="col-md-10 offset-md-1 col-sm-12 entry-content">
          <?php the_content(); ?>
        </div>
    </section>
<?php endwhile;
endif; ?>
<?php get_footer(); ?>