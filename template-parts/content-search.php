<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package anyutv
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( anyutv_loop_classes() ); ?>>
	<header class="entry-header">
		<?php anyutv_post_thumbnail(); ?>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php anyutv_post_meta(); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php anyutv_blog_content(); ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php
			anyutv_read_more();
			anyutv_post_meta( 'loop', 'footer' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

