<nav class="posts">
	
	<?php
		if ( function_exists( 'wp_pagenavi' ) ) { 
			if (is_home() ) // page-blog.php
				wp_pagenavi( array( 'query' => $my_query ) );
			else // search.php, archive.php
				wp_pagenavi( );
		} else {
			echo "Pagination disabled";
		}
	?>
	
	<div class="clear"></div>
</nav>