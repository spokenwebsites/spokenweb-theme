<?php get_header(); ?>
<?php if (have_posts()) :
	while (have_posts()) : the_post(); ?>
		<div class="p-md-5 header d-lg-flex py-4 align-content-center">
			<div class="w-100 w-sm-50 px-4 px-md-0  mt-3">
				<h1><span><?php the_title(); ?></span></h1>
				<h2 class="my-md-5 my-sm-4 my-3"><?php the_content(); ?></h2>
			</div>
			<div class="w-100 mr-lg-5 px-5 py-4 py-lg-2 mt-3">
				<img class="w-lg-100 w-sm-75 w-100 mx-auto" src="<?php bloginfo('template_directory'); ?>/_/img/research/collections.svg" />
			</div>
		</div>
		<section id="research-content" class="container-fluid pt-5 mt-4">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-5">
					<div class="filters sticky p-4 mb-5 w-100 w-sm-75 w-md-100">
						<h2>FILTER BY</h2>
						<div class="form-group mt-4">
							<label for="selectInstitution" class="h2 mb-0">Institution</label>
							<select class="form-control" id="selectInstitution">
								<option selected>All</option>
							</select>
						</div>
					</div>
				</div>
				<div id="teamContainer" class="col-sm-9">
					<?php
					$args = array('post_type' => 'collections', 'posts_per_page' => -1, 'post_status' => array('publish'), 'order' => 'ASC', 'orderby' => 'title');
					$research_query = new WP_Query($args);
					$count = $research_query->post_count;
					?>
					<div class="row" style="margin-bottom:40px;">
						<?php if ($research_query->have_posts()) : $i = 0;
							while ($research_query->have_posts()) : $research_query->the_post(); ?>
								<?php
								$institution = get_field('institution');
								$type = get_field('type');
								$subtype = get_field('subtype');
								$collection_url = get_field('url');
								?>
								<div class="col-3 people-container<?php if ($i % 4 == 0) echo " first"; ?>" data-i="<?php echo $i; ?>" data-institution="<?php echo $institution; ?>">
									<div>
										<a href="#<?php echo $post->post_name; ?>">
											<?php if (has_post_thumbnail()) : ?>
												<?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
												$img_lg = $img_lg[0]; ?>
												<img src="<?php echo $img_lg; ?>" width="100%" class="img-thumbnail">
											<?php else : ?>
												<img src="<?php bloginfo('template_directory'); ?>/_/img/blank.gif" width="100%" class="img-thumbnail">
											<?php endif; ?>
											<h6><strong><?php the_title(); ?></strong></h6>
										</a>
										<div class="bio-content" style="display:none;">
											<?php if (get_the_content() != "") : ?>
												<?php the_content(); ?>
											<?php else : ?>
												<p>More info coming soon.</p>
											<?php endif; ?>
											<?php if (isset($collection_url) && $collection_url != "") : ?>
												<p><a href="<?php echo $collection_url; ?>" class="external" target="_blank"><?php echo $collection_url; ?></a></p>
											<?php endif; ?>
										</div>
										<h6 class="subtitle"><?php echo $institution; ?></h6>
									</div>
								</div>
								<?php //endif;
								?>
						<?php $i++;
							endwhile;
						endif; ?>
						<div id="bioContainer" class="col-sm-12" style="display:none;"></div>
					</div>
				</div>
			</div>
	<?php endwhile;
endif; ?>
	<?php get_footer(); ?>
