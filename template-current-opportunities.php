<div class="row">
	<div>
		<h5 id="current">Current Opportunities</h5>
		<?php
		$args = array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'category_name' => 'opportunities',
			'meta_query' => array(
				array(
					'key' => 'date_end',
					'value' => date("Ymd"),
					'compare' => '>='
				)
			)
		);
		$opportunities_query = new WP_Query($args);
		?>
		<?php if ($opportunities_query->have_posts()) : $i = 0;
			while ($opportunities_query->have_posts()) : $opportunities_query->the_post(); ?>
				<?php
				$date_end_orig = get_field('date_end');
				$date_end = date_create_from_format("Ymd", $date_end_orig);
				$date_end = date_format($date_end, "M d, Y");
				?>
				<article>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?> — <?php echo $date_end; ?></a></h4>
					<?php include(TEMPLATEPATH . '/_/inc/meta-post.php'); ?>
					<div class="row">
						<div class="col-6 col-sm-3">
							<div class="entry blogthumb">
								<a href="<?php the_permalink(); ?>">
									<?php if (has_post_thumbnail()) : ?>
										<?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
										$img_lg = $img_lg[0]; ?>
										<img src="<?php echo $img_lg; ?>" width="100%">
									<?php endif; ?>
								</a>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
							<p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p>There are no current opportunities at the moment. View past opportunities <a href="<?php echo get_permalink(get_page_by_title('Opportunities')); ?>">here</a>.</p>
		<?php endif; ?>
	</div>
</div>