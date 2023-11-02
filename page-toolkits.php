<?php get_header(); ?>
<?php if (have_posts()) :
	while (have_posts()) : the_post(); ?>
		<div class="p-md-5 header d-lg-flex py-4 align-content-center">
			<div class="w-100 w-sm-50 px-4 px-md-0  mt-3">
				<h1><span><?php the_title(); ?></span></h1>
				<h2 class="my-md-5 my-sm-4 my-3"><?php the_content(); ?></h2>
			</div>
			<div class="w-100 mr-lg-5 px-5 py-4 py-lg-2 mt-3">
				<img class="w-lg-100 w-sm-75 w-100 mx-auto" src="<?php bloginfo('template_directory'); ?>/_/img/research/toolkits.svg" />
			</div>
		</div>
		<section id="research-content" class="container-fluid pt-5 mt-4">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-md-5">
				</div>
				<div class="col-sm-9 research-content-container">
					<?php
					$field = get_field_object('field_5c134d174bc83');
					$types = $field['choices'];
					foreach ($types as $type) :
					?>
						<div class="type-container pb-4">
							<h1 class="mb-5"><?php echo $type; ?></h1>
							<?php
							$args = array('post_type' => 'toolkits', 'posts_per_page' => -1, 'post_status' => array('publish'), 'order' => 'ASC', 'orderby' => 'title', 'meta_key' => 'type', 'meta_value' => $type);
							$research_query = new WP_Query($args);
							$count = $research_query->post_count;
							if ($research_query->have_posts()) :
								while ($research_query->have_posts()) : $research_query->the_post(); ?>
									<div class="post-container mb-2 pb-5">
										<?php $url = get_field('url'); ?>
										<h2 class="pb-4"><?php if (isset($url) && $url !== "") : ?><a href="<?php echo $url; ?>" target="_blank"><?php endif; ?>
												<?php the_title(); ?>
												<?php if (isset($url) && $url !== "") : ?></a><?php endif; ?>
										</h2>
										<div class="img-container mb-4">
											<?php if (isset($url) && $url !== "") : ?><a href="<?php echo $url; ?>" target="_blank"><?php endif; ?>
												<?php if (has_post_thumbnail()) : ?>
													<?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>
													<img src="<?php echo $img_lg; ?>" class="w-lg-75 w-100 img-thumbnail rounded-0">
												<?php else : ?>
													<img src="<?php bloginfo('template_directory'); ?>/_/img/blank.gif" width="100%">
												<?php endif; ?>
												<?php if (isset($url) && $url !== "") : ?></a><?php endif; ?>
										</div>
										<?php if (null !== get_the_content() && get_the_content() !== "") : ?>
											<div class="description-container px-4 pt-4 pb-2">
												<div class="measure">
													<?php the_content(); ?>
                                                                                                        <?php if (isset($url) && $url !== "") : ?>
                                                                                                                <a href="<?php echo $url; ?>" rel="nofollow" class="btn btn-sw red mt-2 mb-4">Learn more</a>
                                                                                                        <?php endif; ?>
												</div>
											</div>
										<?php endif; ?>
									</div>
							<?php
								endwhile;
							endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
	<?php endwhile;
endif; ?>
	<?php get_footer(); ?>

