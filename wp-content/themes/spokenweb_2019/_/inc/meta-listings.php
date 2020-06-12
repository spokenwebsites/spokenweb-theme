
		<div class="grid_5 alpha omega">
			
			<?php if ( is_page('sgw-poetry-readings') ) : ?>

				<?php if ($list_type=="closed") : ?>
			
					<h3><?php echo $count; ?> password-protected poetry readings available</h3>
			
				<?php elseif ($list_type=="open") : ?>

					<h3><?php echo $count; ?> poetry readings available</h3>

				<?php else : ?>

					<h3><?php echo $count; ?> poetry readings available</h3>

				<?php endif;?>


			<?php elseif ( is_page('oral-literary-history') ) : ?>

				<?php if ($list_type=="closed") : ?>

					<h3><?php echo $count; ?> password-protected interviews available</h3>

				<?php elseif ($list_type=="open") : ?>

					<h3><?php echo $count; ?> interviews available</h3>

				<?php else : ?>

					<h3><?php echo $count; ?> interviews available</h3>

				<?php endif;?>

			
			<?php elseif ( is_page('audio-archives') ) : ?>
			
			<h3><?php echo $count; ?> audio archives</h3>
			
			<?php elseif ( is_post_type_archive('digital-toolbox') ) : ?>
			
			<h3><?php echo $count; ?> entries in the Digital Toolbox</h3>
			
			<?php elseif(is_page('calendar') || is_page('readings-in-canada')):?>
			
			<h3><?php echo $count; ?> readings</h3>
			
			<?php endif; ?>

			<form id="filter-form">
				<small><label for="filter">Filter</label></small> <input name="filter" id="filter" value="" maxlength="30" size="30" type="text">
				<small><a id="clearfilter" href="#">Clear</a></small>
			</form>
		</div>
		
		<div class="hints grid_7 alpha omega">
			<p><a class="help" href="#">Help?</a></p>
			<ul>
				<li>You can sort the entries in ascending or descending order by clicking on the table headers. You can sort multiple columns by holding down the shift key and clicking on another header.</li>
				<li>You can filter the entries by typing in text in the filter box. The filter will try to match any column.</li>
			</ul>
		</div>

		<div class="clear"></div>