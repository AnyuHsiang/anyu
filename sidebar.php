<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package anyutv
 */
?>

<div id="secondary" class="widget-area col-md-4 col-sm-12 col-xs-12" role="complementary">
	<?php
	
		do_action( 'anyutv_before_sidebar' );

		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' ); 
		}
	?>
</div><!-- #secondary -->
