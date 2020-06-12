<div id="sidebar" class="sticky">

	<h1><span>matra<span class="normal">people</span></span></h1>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php
			$people_id = get_the_ID();
			$post_custom_fields = get_post_custom();
			$field = get_field_object('type');

			$status = $post_custom_fields['status'][0];
			$type = $post_custom_fields['type'][0];
			$display_name = $post_custom_fields['display_name'][0];
			

			$type =  $field['choices'][$type];


			?>
			

		<h2 style="padding-bottom:0px;"><?php echo $display_name;?></h2>
		<h4>matralab <?php echo $type;?></h4>


	<?php endwhile; endif;?>


</div>