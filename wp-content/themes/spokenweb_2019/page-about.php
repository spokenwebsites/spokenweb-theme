<?php get_header(); ?>
<div class="row">
	<div class="col-sm-7">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">

					<section class="entry">
						<h5><?php the_title(); ?></h5>
						<?php the_content(); ?>
					</section>

					<!--start childen-->
					<?php $children = get_pages('sort_column=menu_order&child_of=' . $post->ID); ?>
					<?php foreach ($children as $child) : ?>
						<section class="entry" style="margin-top:40px;">
							<h5><?php echo $child->post_title; ?></h5>
							<?php echo wpautop($child->post_content); ?>
						</section>
					<?php endforeach; ?>
					<!--end children-->

					<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

				</article>

				<?php// comments_template(); ?>

		<?php endwhile;
		endif; ?>
	</div>
</div>
<?php get_footer(); ?>