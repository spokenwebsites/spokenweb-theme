<?php
$blm = get_page_by_path('spokenweb-statement-in-condemnation-of-racism-and-in-support-of-black-lives-matter', OBJECT, 'post');
$blm_id = $blm->ID;
query_posts(
  array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
    'p' => $blm_id
  )
);
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="container-fluid blm">
      <?php
      $post_custom_fields = get_post_custom();
      ?>
      <div id="blm-top" class="row inner-content pt-5">
        <div class="col-md-5">
          <h2><?php the_title(); ?></h2>
          <hr>
          <h3><a href="#statement">STATEMENT</a></h3>
          <h3><a href="#fellowship">NEW PROGRAM</a></h3>
          <h3 class="pb-4"><a href="#initiatives">LINKS TO INITIATIVES</a></h3>
        </div>
        <div class="col-md-6 offset-md-1">
          <article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">
            <div class="entry post-excerpt">
              <?php the_excerpt(); ?>
              <h3><a href="#fellowship">Read more...</a></h3>
              <hr>
            </div>
            <div class="entry post-content" style="display:none;">
              <?php the_content(); ?>
              <h3><a href="#blm-top">Back to top</a></h3>
              <hr>
            </div>
          </article>
        </div>
      </div>
    </section>
<?php endwhile;
endif; ?>