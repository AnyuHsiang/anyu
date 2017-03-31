<?php
/**
 * Functions hooked to custom theme actions and related functions
 *
 * @package anyutv
 */

/**
 * Attach defined actions
 */

// slider in showcase area
add_action( 'anyutv_showcase_area', 'anyutv_slider' );
// about box in sidebar
add_action( 'anyutv_before_sidebar', 'anyutv_about_box' );
// follow box in sidebar
add_action( 'anyutv_before_sidebar', 'anyutv_follow_box', 15 );
// modify default comment form
add_filter( 'comment_form_default_fields', 'anyutv_comment_form_fields' );
// modify excerpt more symbols
add_filter( 'excerpt_more', 'anyutv_excerpt_more' );


/**
 * Get standard slider output
 */
function anyutv_slider() {

	// do nothing if slider disabled from options
	$show_slider = anyutv_get_option( 'slider_enabled', true );
	if ( ! $show_slider ) {
		return '';
	}

	// check, if slider enabled for current page
	$pages_to_show = anyutv_get_option( 'slider_visibility', 'front' );
	if ( 'front' == $pages_to_show && ! is_front_page() ) {
		return '';
	}

	$slides_from = anyutv_get_option( 'slides_from', 'recent_posts' );
	$num         = anyutv_get_option( 'slides_num', 4 );

	$query_args = array(
		'posts_per_page'      => absint( $num ),
		'ignore_sticky_posts' => 1
	);

	switch ( $slides_from ) {
		case 'category':
			$category = anyutv_get_option( 'slides_cat' );
			if ( $category ) {
				$query_args['category_name'] = esc_attr( $category );
			}
			break;
		
		case 'sticky':
			$sticky = get_option( 'sticky_posts' );
			if ( ! empty( $sticky ) ) {
				$query_args['post__in'] = $sticky;
			}
			break;
	}

	/**
	 * Allow to rewrite slider query arguments from child theme/3rd party plugins
	 */
	$query_args = apply_filters( 'anyutv_slider_query_args', $query_args );

	$slider_query = new WP_Query( $query_args );

	if ( ! $slider_query->have_posts() ) {
		return;
	}

	$show_banner = anyutv_get_option( 'slider_banner', true );
	$btn_text    = anyutv_get_option( 'slider_btn_text', __( 'Read', 'anyutv' ) );

	$result = '';

	while ( $slider_query->have_posts() ) {
		$slider_query->the_post();
		if ( ! has_post_thumbnail( $slider_query->post->ID ) ) {
			continue;
		}
		$image  = get_the_post_thumbnail( $slider_query->post->ID, 'anyutv-slider-thumbnail', array( 'alt' => get_the_title( $slider_query->post->ID ) ) );
		$banner = '';

		if ( $show_banner ) {
			$banner = anyutv_get_slider_banner( $slider_query->post->ID, esc_html( $btn_text ) );
		}

		$result .= '<div class="slider-item">' . $image . $banner . '</div>';
	}

	$slider_defaults = apply_filters(
		'anyutv_slider_default_args',
		array(
			'fade'   => false,
			'arrows' => true,
			'dots'   => true,
			'speed'  => 400
		) 
	);

	$fade   = ( 'fade' == anyutv_get_option( 'slider_animation', 'slide' ) );
	$arrows = anyutv_get_option( 'slider_arrows', true );
	$pager  = anyutv_get_option( 'slider_pager', true );

	$slider_args = wp_parse_args( 
		array(
			'fade'   => (bool)$fade,
			'arrows' => (bool)$arrows,
			'dots'   => (bool)$pager
		), 
		$slider_defaults
	);

	$slider_args = json_encode( $slider_args );

	wp_reset_postdata();
	wp_reset_query();

	/**
	 * Filter slider output before printing
	 */
	$result = apply_filters( 
		'anyutv_slider_output',
		sprintf( '<div class="slider-box" data-args=\'%2$s\'>%1$s</div>', $result, $slider_args )
	);

	echo $result;

}
	
/**
 * Get slider banner content by post ID
 * 
 * @param  int    $post_id  post ID to get banner for
 * @param  string $btn_text banner button text
 */
function anyutv_get_slider_banner( $post_id, $btn_text ) {

	$format = '<div class="slider-banner"><div class="slider-banner-content">%1$s%2$s</div>%3$s</div>';

	$title = '<h2 class="slider-banner-title">' . get_the_title( $post_id ) . '</h2>';

	if ( has_excerpt( $post_id ) ) {
		$excerpt = get_the_excerpt();
	} else {
		$content = get_the_content();
		$excerpt = strip_shortcodes( $content );
		$excerpt = str_replace( ']]>', ']]&gt;', $content );
		$excerpt = wp_trim_words( $excerpt, 20, '' );
	}
	$excerpt = '<div class="slider-banner-excerpt">' . $excerpt . '</div>';

	$button = '<div class="slider-banner-button-box"><a href="' . get_permalink( $post_id ) . '" class="slider-banner-button">' . $btn_text . '</a></div>';

	return sprintf( $format, $title, $excerpt, $button );
}

/**
 * Show about box in sidebar
 */
function anyutv_about_box() {

	$is_enabled = anyutv_get_option( 'about_enabled', true );

	if ( ! $is_enabled ) {
		return;
	}

	// prepare data
	$title   = anyutv_get_option( 'about_title', __( 'About Me', 'anyutv' ) );
	$image   = anyutv_get_option( 'about_img' );
	$message = anyutv_get_option( 'about_message', __( 'Hello! And welcome to my personal website!', 'anyutv' ) );

	$title_html   = ( ! empty( $title ) ) ? sprintf( '<h4 class="widget-title">%s</h4>', sanitize_text_field( $title ) ) : '';
	$image_html   = ( ! empty( $image ) ) ? sprintf( '<img src="%1$s" alt="%2$s">', esc_url( $image ), esc_attr( $title ) ) : '';
	$message_html = ( ! empty( $message ) ) ? sprintf( '<div class="custom-box-about-message">%s</div>', esc_textarea( $message ) ) : '';

	?>
	<div class="widget custom-box-about">
		<?php echo $title_html; ?>
		<?php echo $image_html; ?>
		<?php echo $message_html; ?>
	</div>
	<?php
}

function anyutv_follow_box() {

	$is_enabled = anyutv_get_option( 'follow_enabled', true );

	if ( ! $is_enabled ) {
		return;
	}

	$socials = anyutv_allowed_socials();

	if ( ! is_array( $socials ) ) {
		return;
	}

	$title      = anyutv_get_option( 'follow_title', __( 'Follow Me', 'anyutv' ) );
	$title_html = ( ! empty( $title ) ) ? sprintf( '<h4 class="widget-title">%s</h4>', sanitize_text_field( $title ) ) : '';

	$social_list = '';
	$item_format = '<div class="custom-box-follow-item"><a href="%1$s" class="item-%3$s"><i class="%2$s"></i></a></div>';

	foreach ( $socials as $net => $data ) {
		
		$data = wp_parse_args( $data, array( 'label' => '', 'icon' => '', 'default' => '' ) );
		$url  = anyutv_get_option( 'follow_' . $net, $data['default'] );

		if ( ! $url ) {
			continue;
		}

		$social_list .= sprintf( $item_format, esc_url( $url ), esc_attr( $data['icon'] ), esc_attr( $net ) );

	}

	$social_list_html = ( ! empty( $social_list ) ) ? sprintf( '<div class="custom-box-follow-list">%s</div>', $social_list ) : '';

	?>
	<div class="widget custom-box-follow">
		<?php echo $title_html; ?>
		<?php echo $social_list_html; ?>
	</div>
	<?php

}

/**
 * Modify comment form default fields
 */
function anyutv_comment_form_fields( $fields ) {

	$req       = get_option( 'require_name_email' );
	$html5     = 'html5';
	$commenter = wp_get_current_commenter();
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields = array(
		'author' => '<p class="comment-form-author"><input class="comment-form-input" id="author" name="author" type="text" placeholder="' . __( 'Name', 'anyutv' ) . ( $req ? '*' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><input class="comment-form-input" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . __( 'Email', 'anyutv' ) . ( $req ? '*' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><input class="comment-form-input" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . __( 'Website', 'anyutv' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
	);

	return $fields;
}

/**
 * Replace default excerpt more symbols
 */
function anyutv_excerpt_more($more) {
	return ' ...';
}

/**
 * Backwards compatibility for title tag
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	
	function anyutv_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'anyutv_render_title' );

endif;