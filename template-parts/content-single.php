<?php
/**
 * Template part for displaying single posts.
 *
 * @package anyutv
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'is-single' ); ?>>
	<?php anyutv_post_thumbnail( false ); ?>
	<header class="entry-header">

		<?php
			$format = get_post_format();

			if ( ! $format ) {
				$format = 'standard';
			}

			anyutv_format_icon( $format );
		?>
		<div class="entry-header-data">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">
				<?php anyutv_post_meta( 'single' ); ?>
			</div><!-- .entry-meta -->
		</div>
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
		<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="post-nav-label button">' . __( 'Prev', 'anyutv' ) . '</span><span class="post-nav-title">%title</span>',
					'next_text' => '<span class="post-nav-label button">' . __( 'Next', 'anyutv' ) . '</span><span class="post-nav-title">%title</span>'
				)
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php do_action( 'anyutv_after_single_post_content' ); ?>