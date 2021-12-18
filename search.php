<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$s = (get_query_var('s')) || '';
$allsearch = new WP_Query("s=$s&showposts=0");
$num_results = $allsearch->found_posts;
$num_pages = $wp_query->max_num_pages;
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<div class="row">
		<div class="col-sm-3">
			<h5>Search Results <?php if ($s) echo ' for<br>"' . $s . '"'; ?></h5>
		</div>
	</div>
	<hr>
	<div class="row inner-content">
		<aside class="col-sm-3">
			<?php if ($num_pages > 1) : ?><h4><?php echo ($paged ? 'Page ' . $paged . ' of ' . $num_pages : ''); ?></h4><?php endif; ?>
			<h4><?php echo $num_results; ?> result<?php if ($num_results > 1) echo "s"; ?></h4>
		</aside>
		<div class="col-sm-9">
			<?php $i = 1;
			while (have_posts()) : the_post(); ?>
				<?php $post_type = get_post_type(); ?>
				<article <?php post_class('post-excerpt') ?> id="post-<?php the_ID(); ?>">
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
						<h4><?php echo $i; ?>. <a href="<?php the_permalink(); ?>"><?php the_title(); ?> — <?php echo $event_date; ?></a> <small>(<?php echo ucfirst($post_type); ?>)</small></h4>
						<div class="meta">
							<p><?php echo implode(" - ", $event_meta); ?></p>
						</div>
					<?php elseif ($post_type == "post") : ?>
						<h4>
							<?php echo $i; ?>. <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
							<small>(<?php echo ucfirst($post_type); ?>)</small>
						</h4>
						<?php include(TEMPLATEPATH . '/_/inc/meta-post.php'); ?>
					<?php else : ?>
						<h4>
							<?php echo $i; ?>. <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
							<small>(<?php echo ucfirst($post_type); ?>)</small>
						</h4>
					<?php endif; ?>
					<?php
					switch ($post_type) {
						case 'post':
						case 'page':
					?>
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
						<?php
							break;
						case 'sgw-poetry-readings':
						case 'audio-archives':
						?>
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
						<?php break;
						default:
						?>
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
					<?php
							break;
					}
					?>
				</article>
			<?php $i++;
			endwhile; ?>
		<?php else : ?>
			<h3>No results for <?php if ($s) echo ' for <span> ' . $s . '</span>'; ?></h3>
			<br />
		<?php endif; ?>
		<?php if ($num_pages > 1) {
			include(TEMPLATEPATH . '/_/inc/nav-posts.php');
		} ?>
		</div>
	</div>
	<?php get_footer(); ?>