<?php
/**
 * Template part for displaying posts.
 *
 * @package anyutv
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'is-loop' ); ?>>


	<header class="entry-header">
		<?php anyutv_post_image(); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php anyutv_post_meta(); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php
			anyutv_read_more();
			anyutv_post_meta( 'loop', 'footer' );
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
