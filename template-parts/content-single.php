<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package anyutv
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( anyutv_single_classes() ); ?>>
	<div class="entry-pre-header">
		<?php anyutv_post_thumbnail( false ); ?>
		<div class="entry-meta">
			<?php anyutv_post_meta( 'single' ); ?>
		</div><!-- .entry-meta -->
	</div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anyutv' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php anyutv_post_meta( 'single', 'footer' ); ?>
	</footer><!-- .entry-footer -->
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>

</article><!-- #post-## -->

