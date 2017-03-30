<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package anyutv
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function anyutv_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'anyutv_body_classes' );


/**
 * Get allowed socials data (to add options into customizer and output on front)
 */
function anyutv_allowed_socials() {

	return apply_filters(
		'anyutv_allowed_socials',
		array(
			'facebook' => array(
				'label'   => __( 'Facebook', 'anyutv' ),
				'icon'    => 'fa fa-facebook',
				'default' => 'https://www.facebook.com/'
			'phone' => array(
				'label'   => __( 'phone', 'anyutv' ),
				'icon'    => 'fa fa-phone',
				'default' => 'https://www.facebook.com/anyuhsiang'
			),
			'github' => array(
				'label'   => __( 'github', 'anyutv' ),
				'icon'    => 'fa fa-github',
				'default' => 'https://github.com/AnyuHsiang'
			),
			'weibo' => array(
				'label'   => __( 'weibo', 'anyutv' ),
				'icon'    => 'fa fa-weibo',
				'default' => 'https://weibo.com/uaskme'
			),
			'qq' => array(
				'label'   => __( 'QQ', 'anyutv' ),
				'icon'    => 'fa fa-qq',
				'default' => 'https://instagram.com/'
			),
			'weixin' => array(
				'label'   => __( 'weixin', 'anyutv' ),
				'icon'    => 'fa fa-weixin',
				'default' => 'https://www.pinterest.com/'
			),
			'envelope' => array(
				'label'   => __( 'envelope', 'anyutv' ),
				'icon'    => 'fa fa-envelope',
				'default' => 'https://dribbble.com/'
			)
		)
	);

}

/**
 * Custom comment output
 */
function anyutv_comment( $comment, $args, $depth ) {

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'anyutv' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'anyutv' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author-thumb">
				<?php echo get_avatar( $comment, 50 ); ?>
			</div><!-- .comment-author -->
			<div class="comment-content">
				<div class="comment-meta">
					<?php printf( '<div class="comment-author">%s</div>', get_comment_author_link() ); ?>
					<time datetime="<?php comment_time( 'c' ); ?>">
						<?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ' . __( 'ago', 'anyutv' ); ?>
					</time>
					<?php
						comment_reply_link( 
							array_merge( $args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply">',
								'after'     => '</div>',
							) ),
							$comment
						);
					?>
				</div>
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'anyutv' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;

}