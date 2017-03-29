<?php
get_header(); ?>

	<div class="row">
		<div class="col-md-9">

			<?php if ( ! is_front_page() ) : ?>
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>

				<div class="row" id="content">

					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;
					?>

				</div>

				<?php
				the_posts_navigation( array(
					'prev_text' => '' . esc_html__( '下一页', 'mimelove' ),
					'next_text' => esc_html__( '上一页', 'mimelove' ) . '',
				) );
				?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();
