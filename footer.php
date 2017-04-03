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
				<br>
				<?php
					printf(
						__( '%1$s Theme, &copy; 2016 <a href="%2$s" rel="nofollow">向安宇</a>.', 'anyutv' ),
						'Anyutv',
						'https://anyu.tv/'
					);
				?>
			<?php } ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- #折叠收缩js -->
<script type="text/javascript">  
    jQuery(document).ready(function(jQuery) {  
        jQuery('.collapseButton').click(function() {  
            jQuery(this).parent().parent().find('.xContent').slideToggle('slow');  
        });  
    });  
</script>  

<?php wp_footer(); ?>

</body>
</html>
