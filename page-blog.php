<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  ?>
<?php get_header(); ?>
<div class="grid_7 alpha left">
	<!-- we modify the default query_post call and enable pagination -->
	<?php
	$args =  array(
		'post_status' => 'publish',
		'posts_per_page' => '5',
		'paged' => $paged
	);
	$my_query = new WP_Query($args);
	?>
	<?php echo ($paged > 1 ? '<h1>Page ' . $paged . ' </h1>' : '<h1>Latest entries</h1>'); ?>
	<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<article <?php post_class('post-excerpt') ?> id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<?php include(TEMPLATEPATH . '/_/inc/meta-post.php'); ?>
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>
				<p class="category">Filed under <?php the_category(', ') ?></p>
			</article>
	<?php endwhile;
	endif; ?>
	<?php include(TEMPLATEPATH . '/_/inc/nav-posts.php'); ?>
</div>
<?php get_footer(); ?>