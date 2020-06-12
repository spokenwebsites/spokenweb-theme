<?php get_header(); ?>
	
	<!-- The FIRST LOOP is the original Page content in the editor -->

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h5><?php the_title(); ?></h5>
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; endif; ?>

<article style="margin-top:40px;">

	<?php

		$args = array (
					'post_type'   => 'sgw-poetry-readings',
					'post_status' => array('publish','private'),
					'posts_per_page' => -1,
					'order' => 'ASC',
//					'meta_key'=>'date-of-reading-cal',
					'orderby' => 'title'
//				'orderby' => 'meta_value'
				);
		$my_query = new WP_Query( $args );
		$count = $my_query->post_count;
	?>


<div class="row">
	<div class="col-sm-3 col-md-2">

		<div id="filters" style="padding-top:50px;" class="sticky-top button-group">
			<h5>Filters</h5>
			
			<div class="row">
			
			<div class="col-4 col-sm-12"><input class="form-control form-control-sm" type="text" id="quicksearch" placeholder="Search" /></div>


			<div class="showall offset-4 offset-sm-0 col-4 col-sm-12">
				<button class="button btn btn-xs is-checked" data-filter="*">Show all</button><br />
			</div>

			<div class="vertical-buttons col-4 col-sm-12" style="border-top:1px solid #ccc; margin-top:10px; padding-top:10px; min-height:100px;">
				<div style="max-height:300px; min-height:100px; overflow:hidden;" class="scroll-pane-years">
				  	<button class="button btn btn-xs" data-filter=".1966">1966</button>
				  	<button class="button btn btn-xs" data-filter=".1967">1967</button>
				  	<button class="button btn btn-xs" data-filter=".1968">1968</button>
				  	<button class="button btn btn-xs" data-filter=".1969">1969</button>
				  	<button class="button btn btn-xs" data-filter=".1970">1970</button>
				  	<button class="button btn btn-xs" data-filter=".1971">1971</button>
				  	<button class="button btn btn-xs" data-filter=".1972">1972</button>
				  	<button class="button btn btn-xs" data-filter=".1974">1974</button>
					</div>
			</div>

			<div class="vertical-buttons col-4 col-sm-12 " style="border-top:1px solid #ccc; margin-top:10px; padding-top:10px; min-height:100px;">
	
				<div style="max-height:300px; min-height:100px; overflow:hidden;" class="scroll-pane-series">
	
			  	<button class="button btn btn-xs" data-filter=".poetry1">"Poetry 1" - 1966/67</button>
			  	<button class="button btn btn-xs" data-filter=".poetry2">"Poetry 2" - 1967/68</button>
			  	<button class="button btn btn-xs" data-filter=".poetry3">"Poetry 3" - 1968/69</button>
			  	<button class="button btn btn-xs" data-filter=".poetry4">"Poetry 4" - 1969/70</button>
			  	<button class="button btn btn-xs" data-filter=".poetry5">"Poetry 5" - 1970/71</button>
			  	<button class="button btn btn-xs" data-filter=".poetry6">"Poetry 6" - 1971/72</button>		
				</div>
			</div>


			<div class="vertical-buttons col-4 col-sm-12" style="border-top:1px solid #ccc; margin-top:10px; padding-top:10px; min-height:100px;">

				<div style="max-height:300px; min-height:100px; overflow:hidden;" class="scroll-pane-authors">
					<?php
					$poets = get_posts(array('post_type'=>'poets','posts_per_page'=>'-1', 'orderby'=>'title', 'order'=>'ASC'));
					foreach($poets as $poet):
						$poet_name = get_post_meta( $poet->ID, 'display_name', true );
						$poet_class = $poet->post_name;
					?>
				  	<button class="button btn btn-xs" data-filter=".<?php echo $poet_class;?>"><?php echo $poet_name;?></button>
					<?php endforeach;?>

				</div>

			</div>
			
			</div>

		</div>
	</div>

	<div class="col-md-10 col-sm-9">	
		<div id="sorts" class="sticky-top button-group">
			<h5 style="display:inline; margin-right:10px;">Sort by</h5>
		  <button class="btn btn-xs" data-sort-by="date">Date</button>
		  <button class="btn btn-xs" data-sort-by="author">Author</button>
		</div>


		<div id="tape-container" style="margin-top:0px; margin-left:-15px;" class="isotope">

			<?php $i=0;?>

			<?php $tape_num=1; $post_parent_prev=0; ?>
			<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
			
				<?php $num_children=0;?>
			
				<?php $children = get_children(array('post_parent'=>$post->ID,'post_type'=>'sgw-poetry-readings')); $num_children = count($children);?>

				<?php if($num_children==0):?>

				<?php
					// retrieve all the custom fields
					$post_custom_fields = get_post_custom();
					$secret_url = $post_custom_fields['soundcloud-secret'][0];
					$poet_ids = $post_custom_fields['poets'][0];
					$duration = $post_custom_fields['duration'][0];
				
					if ( $post->post_parent > 0 ) {
						$pagelink = get_permalink($post->post_parent) . "#" . $tape_num;
						$print_tape_num=$tape_num;
					
						if($post->post_parent!=$post_parent_prev) $tape_num++;
						else { $tape_num=1; $post_parent_prev = $post->post_parent; }
					
						$series = get_post_meta($post->post_parent, 'series');
						$series = $series[0];
					
						$date_cal = get_post_meta($post->post_parent, 'date-of-reading-cal');
						$date_cal = $date_cal[0];
						$date = date("M j, Y", strtotime($date_cal));
						if($date_cal==""){
							$date_reading = get_post_meta($post->post_parent,'date-of-reading');
							$date_cal = preg_match('/\d{4}/', $date_reading[0], $matches); $date_cal = $matches[0];
						}

						$date_reading = get_post_meta($post->post_parent,'date-of-reading');
						preg_match('/\d{4}/', $date_reading[0], $matches); $year = $matches[0];

					} else {
						$tape_num = 1;
						$print_tape_num=0;
					
						$series = get_post_meta($post->ID, 'series');
						$series = $series[0];
					
						$pagelink = get_permalink();	

						$date_cal = get_post_meta($post->ID, 'date-of-reading-cal');
						$date_cal = $date_cal[0];
						$date = date("M j, Y", strtotime($date_cal));
						if($date_cal==""){
							$date_reading = get_post_meta($post->ID,'date-of-reading');
							$date_cal = preg_match('/\d{4}/', $date_reading[0], $matches); $date_cal = $matches[0];
						}
						$date_reading = get_post_meta($post->ID,'date-of-reading');
						preg_match('/\d{4}/', $date_reading[0], $matches); $year = $matches[0];
						$print_tape_num=0;
					
					}

						$poet_names=array();
						$poet_titles=array();
						$poet_classes=array();

						$poet_ids = unserialize($poet_ids);
						if(is_array($poet_ids)):
						foreach($poet_ids as $poet_id){

							$poet_title = get_the_title($poet_id);
							$poet_name = get_post_meta( $poet_id, 'display_name', true );

							$poet_class = get_post($poet_id);
							$poet_class = $poet_class->post_name;
							$poet_titles[] = $poet_title;
							$poet_names[] = $poet_name;
							$poet_classes[] = $poet_class;
						}
						$poet_classes = implode(" ",$poet_classes);
						$poet_names = implode("<br/>",$poet_names);
						$poet_titles = implode(" ",$poet_titles);
						endif;
					

				?>
			
				<?php  if ( has_post_thumbnail() ):?>
	
			  <div class="element-item <?php echo $poet_classes;?> <?php echo $year;?> <?php echo $series;?>" data-category="transition">

				<a href="<?php echo $pagelink;?>">
					
					<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>
					<img src="<?php echo $img_lg;?>" width="100%">
					
			    <p style="margin-left:0px; font-size:12px; font-weight:bold; margin-top:0px; padding:0px 20px 0px 20px; text-align:center; line-height:140%;" class="title"><?php echo $poet_names;?><br /><?php echo $date;?><?php if($print_tape_num>0) echo "<br />Part " . $print_tape_num;?><br /><span style="display:none;" class="duration"><?php echo $duration;?></span>
					</p>
				</a>
				<span style="display:none;" class="author"><?php echo $poet_titles;?></span>
		    <span style="display:none;" class="year"><?php echo $year;?></span>
		    <span style="display:none;" class="date"><?php echo $date_cal;?></span>
			</div>
			<?php endif;?>

		<?php $i++;?>

		<?php else:?>
			<?php $tape_num=1; $post_parent_prev = 0;?>
		<?php endif;?>

		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div>

	
</article>



<?php get_footer(); ?>