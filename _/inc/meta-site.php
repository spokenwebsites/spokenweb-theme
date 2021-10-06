	    	<ul class="list-unstyled">
				<?php if(is_user_logged_in() ) : ?>
				<li>
					<?php include (TEMPLATEPATH . '/_/inc/meta-logged-in-as.php'); ?>
				</li>
				<?php endif; ?>
				
				<?php if ($userdata->user_level >= 1) : ?>
				<li>
					<?php wp_register('','');  ?>					
				</li>
				<?php endif; ?>
					
	    		<li>
	    			<?php wp_loginout(); ?>
	    		</li>
	    	</ul>