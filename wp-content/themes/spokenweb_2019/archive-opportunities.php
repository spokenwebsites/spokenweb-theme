<?php get_header(); ?>
	<div class="row">
		<div class="col-sm-3">
			<h5 class="title">Opportunities</h5>
		</div>
	</div>

	<hr>
	<div class="row inner-content">
		<aside class="col-sm-3">
			<h4 class="active"><a href="<?php echo get_permalink( get_page_by_path( 'opportunities' ) );?>#current" class="scroll"><span>Current</span></a></h4>
			<h4><a href="<?php echo get_permalink( get_page_by_path( 'opportunities' ) );?>#past" class="scroll"><span>Past</span></a></h4>
		</aside>
		<div class="col-sm-9">




	<h5 id="current">Current Opportunities</h5>


		<?php
		global $post;
		$args = array(
			'numberposts'=>-1,
			'post_type'=>'post',
      'category_name'=>'opportunities',
	    'meta_query'=> array(
	        array(
	            'key'=>'date_end',
	            'value'=> date("Ymd"),
	            'compare' => '>='
	        )
	    )
	    );

		$posts = get_posts( $args );


		?>


		<?php if(empty($posts)||$posts==""):?>

		<p>There are no current opportunities at the moment.</p>

		<?php else: ?>
		<?php

		foreach( $posts as $post ) : setup_postdata($post); ?>

		<?php
		$post_custom_fields = get_post_custom();
		$date_end_orig = $post_custom_fields['date_end'][0];
		$date_end=date_create_from_format("Ymd",$date_end_orig);
		$date_end=date_format($date_end,"M d, Y");
		?>


			<article>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title();?> — <?php echo $date_end;?></a></h4>
        <?php include (TEMPLATEPATH . '/_/inc/meta-post.php' ); ?>
        <div class="row">
          <div class="col-6 col-sm-3">
      			<div class="entry blogthumb">
      				<a href="<?php the_permalink();?>">
      				<?php  if ( has_post_thumbnail() ):?>
      					<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); $img_lg = $img_lg[0];?>
      					<img src="<?php echo $img_lg;?>" width="100%">
      				<?php endif;?>
      				</a>
            </div>
          </div>
            <div class="col-sm-9">
        			<div class="entry">
        				<?php the_excerpt(); ?>
        			</div>
              <p class="category"><?php if(has_category()!=0):?><?php the_category(', ');?><?php endif;?><?php if(has_tag()!=0):?><?php if(has_category()!=0):?> | <?php endif;?><?php the_tags('', ', ');?><?php endif;?></p>
            </div>
          </div>
			</article>


		<?php endforeach; ?>

	<?php endif;?>


		<?php
		global $post;
		$args = array(
			'numberposts'=>-1,
			'post_type'=>'post',
      'category_name'=>'opportunities',
		    'meta_query'=> array(
		        array(
		            'key'=>'date_end',
		            'value'=> date("Ymd"),
		            'compare' => '<'
		        )
		    )
	    );

		$posts = get_posts( $args );


		?>
  	<hr>
    <h5 id="past">Past Opportunities</h5>

		<?php if(count($posts)>=1):?>
		<?php
    foreach( $posts as $post ) : setup_postdata($post); ?>

		<?php
		$post_custom_fields = get_post_custom();
		$date_end_orig = $post_custom_fields['date_end'][0];
		$event_time = $post_custom_fields['event_time'][0];

		?>

		<?php

		$date_end=date_create_from_format("Ymd",$date_end_orig);
		$date_end_mini=date_format($date_end,"j, Y");
		$date_end=date_format($date_end,"M d, Y");

		?>
			<article>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title();?> — <?php echo $date_end;?></a></h4>
        <?php include (TEMPLATEPATH . '/_/inc/meta-post.php' ); ?>
        <div class="row">
          <div class="col-6 col-sm-3">
      			<div class="entry blogthumb">
      				<a href="<?php the_permalink();?>">
      				<?php  if ( has_post_thumbnail() ):?>
      					<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); $img_lg = $img_lg[0];?>
      					<img src="<?php echo $img_lg;?>" width="100%">
      				<?php endif;?>
      				</a>
            </div>
          </div>
            <div class="col-sm-9">
        			<div class="entry">
        				<?php the_excerpt(); ?>
        			</div>
              <p class="category"><?php if(has_category()!=0):?><?php the_category(', ');?><?php endif;?><?php if(has_tag()!=0):?><?php if(has_category()!=0):?> | <?php endif;?><?php the_tags('', ', ');?><?php endif;?></p>
            </div>
          </div>
			</article>
		<?php endforeach; ?>

    <?php else:?>
      <p>There are no past opportunities.</z>
    <?php endif;?>


	</div>

</div>

<?php get_footer(); ?>
