<?php
/**
 * anyutv functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package anyutv
 */

if ( ! function_exists( 'anyutv_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function anyutv_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on anyutv, use a find and replace
	 * to change 'anyutv' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'anyutv', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 770, 475, true );
	add_image_size( 'anyutv-slider-thumbnail', 2000, 600, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'anyutv' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'anyutv_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Setup custom logo feature
	add_theme_support( 'custom-logo' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'anyutv' ),
		'social'  => esc_html__( 'Social Menu', 'anyutv' ),
	) );
}
endif; // anyutv_setup
add_action( 'after_setup_theme', 'anyutv_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function anyutv_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'anyutv_content_width', 640 );
}
add_action( 'after_setup_theme', 'anyutv_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function anyutv_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'anyutv' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'anyutv' ),
		'id'            => 'footer-sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'anyutv' ),
		'id'            => 'footer-sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 3', 'anyutv' ),
		'id'            => 'footer-sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 4', 'anyutv' ),
		'id'            => 'footer-sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'anyutv_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function anyutv_scripts() {

	$base = get_template_directory_uri();

	wp_enqueue_style( 'anyutv-fonts', anyutv_fonts_url() );
	wp_enqueue_style( 'font-awesome', $base . '/css/font-awesome.min.css', false, '4.5.0' );
	wp_enqueue_style( 'anyutv-style', get_stylesheet_uri() );

	wp_enqueue_script( 'slider-pro', $base . '/js/jquery.sliderpro.min.js', array( 'jquery' ), '1.2.4', true );
	wp_enqueue_script( 'magnific-popup', $base . '/js/magnific-popup.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'anyutv-scripts', $base . '/js/script.js', array( 'jquery', 'hoverIntent' ), '1.0.0', true );
	wp_enqueue_script( 'anyutv-skip-link-focus-fix', $base . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'anyutv_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template actions for this theme.
 */
require get_template_directory() . '/inc/template-actions.php';

/**
 * Post format specific template tags
 */
require get_template_directory() . '/inc/template-post-formats.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// 部分内容输入密码可见
function e_secret($atts, $content=null){
    extract(shortcode_atts(array('key'=>null), $atts));
    if(isset($_POST['e_secret_key']) && $_POST['e_secret_key']==$key){
        return '
<div class="e-secret">'.$content.'</div>
';
    }
    else{
        return '
<form class="post-password-form" action="'.get_permalink().'" method="post" name="e-secret"><p><label for="pwbox-142">输入密码查看加密内容： <input type="password" name="e_secret_key" size="20" /></label> <input type="submit" class="euc-y-s" value="确定" /></p>
</form>
';
    }
}
add_shortcode('secret','e_secret');
//文章内容回复可见
add_shortcode('reply', 'reply_to_read');
 
function reply_to_read($atts, $content=null) {
extract(shortcode_atts(array("notice" => '<p>温馨提示：此处内容需要<a href="#respond" title="评论本文">评论本文</a>后才能查看。</p>'), $atts));
$email = null;
$user_ID = (int) wp_get_current_user()->ID;
if ($user_ID > 0) {
$email = get_userdata($user_ID)->user_email;
//对博主直接显示内容
$admin_email = "550005887@qq.com"; //<span style="color: #0000ff;">博主Email</span>
if ($email == $admin_email) {
return $content;
}
} else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
$email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
} else {
return $notice;
}
if (empty($email)) {
return $notice;
}
global $wpdb;
$post_id = get_the_ID();
$query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
if ($wpdb->get_results($query)) {
return do_shortcode($content);
} else {
return $notice;
}
}
//折叠收缩功能
function xcollapse($atts, $content = null){
    extract(shortcode_atts(array("title"=>""),$atts));
    return '<div style="margin: 0.5em 0;">
        <div class="xControl">
            <span class="xTitle">'.$title.'</span> 
            <a href="javascript:void(0)" class="collapseButton xButton">展开/收缩</a>
            <div style="clear: both;"></div>
        </div>
        <div class="xContent" style="display: none;">'.$content.'</div>
    </div>';
}
add_shortcode('collapse', 'xcollapse');
// 添加HTML按钮
	function appthemes_add_quicktags() {
	?> 

	<script type="text/javascript"> 
				QTags.addButton('hr', '横线', "<hr />\n");//添加横线
				QTags.addButton('h3', 'H3标签', "<h3>", "</h3>\n"); //添加标题3
				QTags.addButton('h4', 'H4标签', "<h4>", "</h4>\n"); //添加标题4
				QTags.addButton('shsj', '首行缩进', "&nbsp;&nbsp;");
				QTags.addButton('hc', '回车', "<br />");
				QTags.addButton('jz', '居中', "<center>", "</center>");
				QTags.addButton('mark', '黄字', "<mark>", "</mark>");
				QTags.addButton('xhx', '下划线', "<u>", "</u>");
				QTags.addButton('pre', '代码pre', "<pre>", "</pre>\n"); //添加代码
			    QTags.addButton( 'reply1', '评论可见1', '[reply]','[/reply]' );
			    QTags.addButton( 'reply2', '评论可见2', '[reply notice="自定义提醒回复内容"]','[/reply]' );
	 		    QTags.addButton( 'mimakejian', '密码可见', '[secret key="输入密码"]', '[/secret]' );
	 		    QTags.addButton( 'zhedie', '折叠', '[collapse title="标题"]', '[/collapse]' );
				
	</script>

	<?php
}
add_action('admin_print_footer_scripts', 'appthemes_add_quicktags' );
// 禁止WordPress头部加载s.w.org
	function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
	return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
	}
	add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
// 移除后台 Google Font API
	function remove_open_sans_from_wp_core() {
	    wp_deregister_style('open-sans');
	    wp_register_style('open-sans', FALSE);
	    wp_enqueue_style('open-sans', '');
	}
	add_action('init', 'remove_open_sans_from_wp_core');
// 禁用 emoji's表情
	     function disable_emojis() {
		     remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		     remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		     remove_action( 'wp_print_styles', 'print_emoji_styles' );
		     remove_action( 'admin_print_styles', 'print_emoji_styles' );
		     remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		     remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		     remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		     add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	     }
	     add_action( 'init', 'disable_emojis' );
		 
		
		 	add_filter('get_avatar', 'mimelove_get_ssl_avatar');
			
// 去除emojis wpemoji插件
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
	
//禁用REST API/移除wp-json链接
	    add_filter('rest_enabled', '__return_false');
	    add_filter('rest_jsonp_enabled', '__return_false');
	    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
		
//替换Gravatar头像库
	function mimelove_get_ssl_avatar($avatar) {
		$avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
		return $avatar;
	}
	add_filter('get_avatar', 'mimelove_get_ssl_avatar');
	
//禁用xmlrpc离线发布协议
add_filter('xmlrpc_enabled', '__return_false');

