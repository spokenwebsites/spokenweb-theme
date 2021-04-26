<section class="container-fluid">
	<div class="row" style="margin-bottom:-15px;">
		<div class="col-12">
			<h5 class="title">The SpokenWeb Wire</h5>
		</div>
	</div>


	<div class="row inner-content">
		<div class="col-12">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php
					$post_custom_fields = get_post_custom();
					$author = $post_custom_fields['author'][0];
					?>

					<article <?php post_class('post-full wire') ?> id="post-<?php the_ID(); ?>">

						<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
							<small><?php if (isset($author) && $author != "") : ?>By <?php echo $author; ?>, <?php endif; ?><time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F j, Y'); ?></time></small>
						</h2>
						<?php include(TEMPLATEPATH . '/_/inc/meta-post-wire.php'); ?>

						<div class="entry blogthumb">
							<?php if (has_post_thumbnail()) : ?>
								<?php $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
								$img_thumb = $img_thumb[0]; ?>
								<img src="<?php echo $img_thumb; ?>" width="100%">
							<?php endif; ?>
						</div>


						<div class="entry">
							<?php the_content(); ?>
						</div>

						<p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>

						<div style="position:relative; top:10px;">
							<a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
							<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
							<div class="fb-share-button" data-href="<?php echo $actual_link; ?>" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; top:-8px; margin-bottom:5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
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

			<?php endwhile;
			endif; ?>

		</div>
	</div>
</section>