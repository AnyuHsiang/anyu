<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package anyutv 向安宇注释
 * 
 * 使用bloginfo获取数据库信息，直接打印
 * 使用get_bloginfo,获取并有返回值供处理，如在前面加上输出echo get_bloginfo那根上面函数bloginfo效果是一样的
 * get_option(键入值 ，默认值)：如果没有建儒的值，则返回默认值
 * 
 */

?><!DOCTYPE html><!-- #定义语言 -->
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"><!-- #调取数据库option中wordpress编码值，如UTF8 -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?><!-- #钩子 -->
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'anyutv' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6">
						<div class="site-logo-wrap">
							<?php anyutv_logo(); ?>
							<div class="site-description"><?php bloginfo( 'description' ); ?></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6">
						<?php anyutv_follow_list(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="site-nav">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
								<?php esc_html_e( 'Menu', 'anyutv' ); ?>
							</button>
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'menu_id'        => 'primary-menu'
									)
								);
							?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php do_action( 'anyutv_showcase_area' ); ?>

	<div id="content" class="site-content">
		<div class="container">
 
<!-- #折叠收缩js -->
<script type="text/javascript">  
    jQuery(document).ready(function(jQuery) {  
        jQuery('.collapseButton').click(function() {  
            jQuery(this).parent().parent().find('.xContent').slideToggle('slow');  
        });  
    });  
</script>  

