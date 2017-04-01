<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package anyutv 向安宇注释
 */

get_header(); ?>

	<div class="row">
		<main id="main" class="site-main col-md-8 col-sm-12 col-xs-12 <?php anyutv_sidebar_class(); ?>" role="main">

		<?php if ( have_posts() ) : ?><!-- #判断是否有文章 -->

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php /* Start the Loop开始循环 */ ?>
			<?php while ( have_posts() ) : the_post(); ?><!-- #the_post获取下一篇文章信息，并将信息存入全局变量 -->

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php get_template_part( 'template-parts/content', 'pagination' ); ?>

		<?php else : ?><!-- #如果没有文章就执行下面代码 -->

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?><!-- #动作钩子 -->
