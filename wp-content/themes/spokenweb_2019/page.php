<?php if (is_page('podcast') || get_post_type()=='podcast' || get_post($post->post_parent)->post_name=='podcast'):?>
  <?php get_template_part( 'page', 'podcast' ); ?>
<?php else:?>

  <?php get_header(); ?>

  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    	<?php $orig = $post;?>
    	<?php if(has_parent()):?>
    		<?php $parent_id = wp_get_post_parent_id($post->ID);?>
        <?php $parent = get_post($parent_id, OBJECT);?>
        <!--<?php //if ($parent->post_name == "about-us"):?>
          <?php// get_template_part('template', 'about-us');?>
        <?php //else:?>-->
      		<?php $args = array('p'=>$parent_id, 'post_type'=>'page');?>
      		<?php $query = new WP_Query( $args );?>
      		<?php if ( $query->have_posts() ): $i=0; while ( $query->have_posts() ): $query->the_post();?>
        		<div class="row">
        			<div class="col-sm-3">
        				<h5 class="title"><?php the_title(); ?></h5>
        			</div>
        		</div>
    		  <?php endwhile; endif;?>
        <?php //endif;?>

    	<?php else:?>
    		<div class="row">
    			<div class="col-sm-3">
    				<h5 class="title"><?php the_title(); ?></h5>
    			</div>
    		</div>
    	<?php endif;?>

      <!--<?php/* if ($parent->post_name != "about-us"):*/?>-->

      	<hr>

        <div class="row inner-content">

      	<aside class="col-sm-3">
      		<?php if(has_children()):?>
      			<?php $children = new WP_Query( array( 'post_type'=>'page', 'post_parent'=>$post->ID, 'order'=>'ASC', 'orderby'=>'menu_order'));?>
      			<?php if($children->have_posts()) : while ($children->have_posts()) : $children->the_post(); ?>
      			<h4 class="<?php if($post->ID==$orig->ID) echo 'active';?>"><a href="<?php the_permalink();?>"><span><?php the_title();?></span></a></h4>
      			<?php endwhile; endif;?>
      			<?php wp_reset_query(); ?>
      		<?php endif;?>
      	</aside>

      	<div class="col-sm-9">

      		<article class="page" id="post-<?php the_ID(); ?>">

      			<div class="entry">
      				<?php the_content(); ?>
      			</div>


      		</article>

      		</div>
        </div>

      <?php// endif;?>

  	<?php endwhile; endif; ?>

  <?php get_footer(); ?>
<?php endif;?>
