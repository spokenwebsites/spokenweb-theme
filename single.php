<?php get_header(); ?>

<?php if (has_category("spokenweblog")) : ?>
	<?php get_template_part('single', 'spokenweblog'); ?>
<?php elseif (has_category("opportunities")) : ?>
	<?php get_template_part('single', 'opportunities'); ?>
<?php else : ?>
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<?php if (has_category("audio-of-the-week")) : ?>
					<h5 class="title">Audio of the Week</h5>
					<?php
					$post_custom_fields = get_post_custom();
					$author = $post_custom_fields['author'][0];
					?>
				<?php elseif (has_category("spokenweblog")) : ?>
					<h5 class="title">SPOKENWEBLOG</h5>
					<?php
					$post_custom_fields = get_post_custom();
					$author = $post_custom_fields['author'][0];
					?>
				<?php else : ?>
					<h5 class="title">News</h5>
				<?php endif; ?>
			</div>
		</div>

		<hr>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<div class="col-sm-12">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<?php if (has_category("audio-of-the-week") || has_category("spokenweblog")) : ?>
						<div class="meta">Posted <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F j, Y'); ?></time> | By <?php echo $author; ?></p>
						</div>

					<?php else : include(TEMPLATEPATH . '/_/inc/meta-post.php'); ?>

					<?php endif; ?>
				</div>

				<div class="row inner-content">
					<div class="col-6 col-md-3">
						<div class="entry blogthumb">
							<?php if (has_post_thumbnail()) : ?>
								<?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
								$img_lg = $img_lg[0]; ?>
								<a href="<?php echo $img_lg; ?>" class="fancybox">
									<?php $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
									$img_thumb = $img_thumb[0]; ?>
									<img src="<?php echo $img_thumb; ?>" width="100%">
								</a>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-sm-9">


						<article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">


							<div class="entry">
								<?php the_content(); ?>
							</div>

							<p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>

							<div style="position:relative; top:10px;">
								<a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
								<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
								<div class="fb-share-button" data-href="<?php echo $actual_link; ?>" data-layout="button" data-size="large" data-mobile-iframe="true"></div>

							</div>

						</article>

						<hr />

						<nav class="nav-single">
							<span class="nav-previous"><?php previous_post_link('&larr; Previous post: %link'); ?></span>
							<span class="nav-next"><?php next_post_link('Next post: %link &rarr;'); ?></span>
							<div class="clear"></div>
						</nav>

						<hr />

						<?php //comments_template(); 
						?>


					</div>
				</div>

		<?php endwhile;
		endif; ?>
	</section>
<?php endif; ?>
<?php get_footer(); ?>