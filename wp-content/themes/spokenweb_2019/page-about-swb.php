<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="swb-about">
			<div class="bg d-flex flex-wrap align-items-start">

				<?php $orig = $post; ?>

				<?php $parent_id = wp_get_post_parent_id($post->ID); ?>
				<?php $parent = get_post($parent_id, OBJECT); ?>
				<?php $args = array('p' => $parent_id, 'post_type' => 'page'); ?>
				<?php $query = new WP_Query($args); ?>
				<?php if ($query->have_posts()) : $i = 0;
					while ($query->have_posts()) : $query->the_post(); ?>
						<section class="container-fluid w-100" style="margin-top: 80px; background: #f4f4f4; padding: 40px 60px 1.5rem;">
							<div class="row">
								<div class="col-sm-3">
									<h5 class="title"><?php the_title(); ?></h5>
								</div>
							</div>
						</section>
				<?php endwhile;
				endif; ?>

				<p class="w-md-75 w-lg-50 py-5 px-5 mx-auto h3" style="line-height: 120%;"><strong>SPOKENWEBLOG (SWB)</strong> is a curated online space for the publication of articles in a variety of forms and formats that document and contribute to the research, development and creation activities of the SpokenWeb research network.</p>
			</div>

			<section class="container-fluid mt-4">
				<div class="row inner-content">

					<aside class="col-sm-3">
						<?php if (has_children()) : ?>
							<?php $children = new WP_Query(array('post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order')); ?>
							<?php if ($children->have_posts()) : while ($children->have_posts()) : $children->the_post(); ?>
									<h4 class="<?php if ($post->ID == $orig->ID) echo 'active'; ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
							<?php endwhile;
							endif; ?>
							<?php wp_reset_query(); ?>
						<?php endif; ?>
					</aside>

					<div class="col-sm-7">

						<article class="page" id="post-<?php the_ID(); ?>">

							<div class="entry">
								<?php the_content(); ?>

								<?php if (is_page('get-involved')) : ?>
									<hr>
									<?php get_template_part('template', 'current-opportunities'); ?>
								<?php endif; ?>

							</div>


						</article>

					</div>
				</div>
			</section>
		</div>
<?php endwhile;
endif; ?>

<?php get_footer(); ?>