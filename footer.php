<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package anyutv
 */

?>
		</div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php anyutv_footer_sidebars(); ?>
		<div class="site-info">
			<div class="container">
			<?php
				$anyutv_custm_copyright = anyutv_get_option( 'footer_copyright' );
				if ( ! empty( $anyutv_custm_copyright ) ) {
					echo wp_kses_post( $anyutv_custm_copyright );
				} else {
			?>
				<div class="footer-logo">
					<a class="footer-logo-link" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a>
				</div>
				<a rel="nofollow" href="<?php echo esc_url( __( 'http://wordpress.org/', 'anyutv' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'anyutv' ), 'WordPress' ); ?></a>
				<br>
				<?php
					printf(
						__( '%1$s WordPress Theme, &copy; 2016 <a href="%2$s" rel="nofollow">Tefox</a>.', 'anyutv' ),
						'Renard',
						'http://www.tefox.net/'
					);
				?>
			<?php } ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
