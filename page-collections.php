<style>
 
 .filterby{
	width: 313.23px;
	height: 180.77px;
	background:#DF7F28;
 }
 .collections_text{
	transform: rotate(-1deg);
	 background-color: #EC8E43; 
	 display:inline-block;
 }

 .collections_pg{
	font-family: Futura; 
	font-style: normal;
	font-weight: bold;
	font-size: 19px;
	line-height: 27px;
	color: #312E2D;
	padding-left: 40px;
 }
 .collections_logo{
	width:670px; 
	height: 409px; 
	margin-left: 150px;
 }

 .filterby h5{
	margin-left:20px;
	 padding-top:17px
 }

 .filterby select{
	border-radius: 12px!important; 
	border: 1px solid #ced4da; 
	margin-left:15px;
	 width:90%
 }
 
</style>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<?php $orig = $post; ?>
		<?php if (has_parent()) : ?>

			<?php $parent_id = wp_get_post_parent_id($post->ID); ?>
			<?php $args = array('p' => $parent_id, 'post_type' => 'page'); ?>
			<?php $query = new WP_Query($args); ?>
			<?php if ($query->have_posts()) : $i = 0;
				while ($query->have_posts()) : $query->the_post(); ?>
					<!-- <div class="row">
						<div class="col-sm-3">
							<h5 class="title"><?php the_title(); ?></h5>
						</div>
					</div> -->
			<?php endwhile;
			endif; ?>

		<?php else : ?>
			<!-- <div class="row">
				<div class="col-sm-3">
					<h4 class="title"><?php the_title(); ?></h4>
				</div>
			</div> -->
		<?php endif; ?>

		<hr>


		<div class="row inner-content">

			<!-- <aside class="col-sm-3">
				<?php if (has_children()) : ?>
					<?php $children = new WP_Query(array('post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order')); ?>
					<?php if ($children->have_posts()) : while ($children->have_posts()) : $children->the_post(); ?>
							<h4 class="<?php if ($post->ID == $orig->ID) echo 'active'; ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
					<?php endwhile;
					endif; ?>
					<?php wp_reset_query(); ?>
				<?php endif; ?>


			</aside> -->

			<div class="col-sm-12 jumbotron" style="background: #F0F0F0;">
				<div class="row">
					<div class="col-sm-3">
						<div class="collections_text">
							<h1>Collections</h1>
						</div>
						<p class="collections_pg">
						<b>	<?php the_content(); ?></b>
						<ul style="border: 1px solid #000000; width:180px "></ul>
						</p>
						
					</div>
					<div class="col-sm-6">
						<img class="collections_logo" src="<?php bloginfo('template_directory'); ?>/_/img/collections_logo.png" />
					</div>
				</div>
			</div>

			
			<div class="col-sm-3">
				<hr>
				<div class="form-group filterby "  >
					<div><h5>Filter by</h5></div>
					<label for="selectInstitution" class="small" style="margin-left:20px;"><strong>Institution</strong></label>
					<select class="form-control" id="selectInstitution">
						<option selected>All</option>
					</select>
				</div>
			</div>

			<div id="teamContainer" class="col-sm-9">

				<hr>
				<h5>Collections</h5>
				<br>

				<?php
				$args = array('post_type' => 'collections', 'posts_per_page' => -1, 'post_status' => array('publish'), 'order' => 'ASC', 'orderby' => 'title');
				$team_query = new WP_Query($args);
				$count = $team_query->post_count;
				?>


				<div class="row" style="margin-bottom:40px;">

					<?php if ($team_query->have_posts()) : $i = 0;
						while ($team_query->have_posts()) : $team_query->the_post(); ?>
							<?php
							$post_custom_fields = get_post_custom();
							$institution = $post_custom_fields['institution'][0];
							$type = $post_custom_fields['type'][0];
							$subtype = $post_custom_fields['subtype'][0];
							$collection_url = $post_custom_fields['url'][0];
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