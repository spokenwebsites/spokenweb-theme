<?php $paged = $wp_query->get('paged');
$num_pages = $wp_query->max_num_pages; ?>
<?php get_header(); ?>
<?php $slug = get_queried_object()->slug; ?>
<?php if (is_category() && ($slug == "audio-of-the-week")) : ?>
	<?php get_template_part('archive', 'audio-of-the-week'); ?>
<?php elseif (is_category() && ($slug == "shortcuts")) : ?>
	<?php get_template_part('archive', 'shortcuts'); ?>
<?php elseif (is_category() && ($slug == "spokenweblog")) : ?>
	<?php get_template_part('archive', 'spokenweblog'); ?>
<?php elseif (is_category() && ($slug == "institutes")) : ?>
	<?php get_template_part('archive', 'institutes'); ?>
<?php elseif (is_category() && ($slug == "symposia")) : ?>
	<?php get_template_part('archive', 'symposia'); ?>
<?php elseif (is_category() && ($slug == "opportunities")) : ?>
	<?php get_template_part('archive', 'opportunities'); ?>
<?php else : ?>
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. 
		?>
		<div class="row">
			<div class="col-sm-3">
				<h5 class="title">
					<?php if (is_category()) : ?>Category Archive
					<?php elseif (is_tag()) : ?>Tags Archive
					<?php elseif (is_day()) : ?>Archive
					<?php elseif (is_month()) : ?>Archive
					<?php elseif (is_year()) : ?>Archive
				<?php elseif (is_author()) : ?> Author Archive
					<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>Blog Archives
					<?php endif; ?><?php echo ($paged ? ' &ndash; page ' . $paged : ''); ?>
				</h5>
			</div>
		</div>
		<hr>
		<div class="row inner-content">
			<aside class="col-sm-3">
				<?php if (is_category()) : ?><h4>Category: <?php single_cat_title(); ?></h4>
				<?php elseif (is_tag()) : ?><h4>Tag: <?php single_tag_title(); ?></h4>
				<?php elseif (is_day()) : ?><h4><?php the_time('F jS, Y'); ?></h4>
				<?php elseif (is_month()) : ?><h4><?php the_time('F, Y'); ?></h4>
				<?php elseif (is_year()) : ?><h4><?php the_time('Y'); ?></h4>
				<?php endif; ?>
			</aside>
			<div class="col-sm-9">
				<?php if ($paged && $paged >= 2) include(TEMPLATEPATH . '/_/inc/nav-posts.php'); ?>
				<?php while (have_posts()) : the_post(); ?>
					<article <?php post_class('post-excerpt') ?> id="post-<?php the_ID(); ?>">
						<?php $post_type = get_post_type(); ?>
						<?php if ($post_type == "events") : ?>
							<?php
							$event_start_orig = get_field('event_start');
							$event_end_orig = get_field('event_end');
							$event_time = get_field('event_time');
							$event_start = date_create_from_format("Y/m/d", $event_start_orig);
							$event_start_mini = date_format($event_start, "M j");
							$event_start = date_format($event_start, "M d, Y");
							$event_end = date_create_from_format("Y/m/d", $event_end_orig);
							$event_end_mini = date_format($event_end, "j, Y");
							$event_end = date_format($event_end, "M d, Y");
							if ($event_start != $event_end) $event_date = $event_start_mini . "-" . $event_end_mini;
							else $event_date = $event_start;
							$city = get_field('city');
							$venue = get_field('venue');
							$institution = get_field('institution');
							$event_meta = array();
							if (isset($city) && $city != "") $event_meta[] = $city;
							if (isset($institution) && $institution != "") $event_meta[] = $institution;
							if (isset($venue) && $venue != "") $event_meta[] = $venue;
							?>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?> — <?php echo $event_date; ?></a> <small>(<?php echo ucfirst($post_type); ?>)</small></h4>
							<div class="meta">
								<p><?php echo implode(" - ", $event_meta); ?></p>
							</div>
						<?php else : ?>
							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> <small>(<?php echo ucfirst($post_type); ?>)</small></h4>
							<?php include(TEMPLATEPATH . '/_/inc/meta-post.php'); ?>
						<?php endif; ?>
						<div class="entry">
							<?php the_excerpt(); ?>
						</div>
						<p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	<?php else : ?>
		<h1>
			No posts found
			<?php if (is_category()) : ?>for the category <span><?php single_cat_title(); ?></span>
			<?php elseif (is_tag()) : ?>with the tags <span><?php single_tag_title(); ?></span>
			<?php elseif (is_day()) : ?>for <span><?php the_time('F jS, Y'); ?></span>
			<?php elseif (is_month()) : ?>for <span><?php the_time('F, Y'); ?></span>
			<?php elseif (is_year()) : ?>for <span><?php the_time('Y'); ?></span>
		<?php endif; ?>
		</h1>
	<?php endif; ?>
	<?php if ($num_pages > 1) {
		include(TEMPLATEPATH . '/_/inc/nav-posts.php');
	} ?>
<?php endif; ?>
<?php get_footer(); ?>