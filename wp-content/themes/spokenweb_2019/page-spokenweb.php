<?php get_header(); ?>

<?php $title = get_the_title(); ?>
<?php $orig = $post; ?>
<?php $parent_id = wp_get_post_parent_id($post->ID); ?>
<?php $parent = get_post($parent_id, OBJECT); ?>
<?php $parent_id = wp_get_post_parent_id($post->ID); ?>
<?php $parent_content = $parent->post_content; ?>
<?php $args = array('p' => $parent_id, 'post_type' => 'page'); ?>
<?php $query = new WP_Query($args); ?>
<?php if ($query->have_posts()) : $i = 0;
	while ($query->have_posts()) : $query->the_post(); ?>

		<div class="content-header pt-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 order-lg-2 text-center">
						<em>
							<h1>About</h1>
						</em>
						<h1><?php echo strtoupper($title); ?></h1>
						<h2 class="mt-5"><?php echo $parent_content; ?></h2>
					</div>
					<aside class="col-lg-3 order-lg-1 text-center text-lg-left mt-5 mt-lg-0">
						<?php if (has_children()) : ?>
							<?php $children = new WP_Query(array('post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order')); ?>
							<?php if ($children->have_posts()) : while ($children->have_posts()) : $children->the_post(); ?>
									<h4 class="<?php if ($post->ID == $orig->ID) echo 'active'; ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
							<?php endwhile;
							endif; ?>
							<?php wp_reset_query(); ?>
						<?php endif; ?>
					</aside>
				</div>
				<div class="row mt-4 pt-4">
					<div class="text-center col-lg-9 offset-lg-3">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/background-about.png" width="300">
					</div>
				</div>
			</div>
		</div>

		<div class="container mt-4 pt-5">

			<div class="row inner-content">

				<div class="col-lg-9 offset-lg-3">

					<article class="page" id="post-<?php the_ID(); ?>">

						<div class="entry">
							<?php the_content(); ?>
						</div>

					</article>

				</div>

			</div>

		</div>
<?php endwhile;
endif; ?>

<?php get_footer(); ?>