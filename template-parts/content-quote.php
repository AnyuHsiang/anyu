<?php
/**
 * Template part for displaying posts.
 *
 * @package anyutv
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'is-loop' ); ?>>
	
	<div class="entry-content">
		<?php anyutv_blog_content(); ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php 
			anyutv_post_meta( 'loop', 'footer' );
			anyutv_read_more();
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
