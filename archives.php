<?php
/**
 *
 * Template Name: 归档
 *
 */

get_header(); ?>
	<div class="row">
		<div class="col-md-9" id="content">

			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile; // End of the loop.
			?>

				<!-- 文章归档 -->
				<div id="primary">
		            <div class="anyutv_tags">
		                <h3>标签云</h3>
		                    <?php wp_tag_cloud(); ?>
		            </div>
		            <div class="post-content">
		                <?php
		                $the_query = new WP_Query('posts_per_page=-1&ignore_sticky_posts=1'); //update: 加上忽略置顶文章
		                $year = 0;
		                $mon = 0;
		                $i = 0;
		                $j = 0;
		                $all = array();
		                $output = '<div id="archives">';
		                while ($the_query->have_posts()) : $the_query->the_post();
		                    $year_tmp = get_the_time('Y');
		                    $mon_tmp = get_the_time('n');
		                    //var_dump($year_tmp);
		                    $y = $year;
		                    $m = $mon;
		                    if ($mon != $mon_tmp && $mon > 0)
		                        $output .= '</div></div>';
		                    if ($year != $year_tmp) {
		                        $year = $year_tmp;
		                        $all[$year] = array();
		                    }

		                    if ($mon != $mon_tmp) {
		                        $mon = $mon_tmp;
		                        array_push($all[$year], $mon);
		                        $output .= "<div class='archive-title' id='arti-$year-$mon'><h3>$year-$mon<a class='fr' href='/date/$year/$mon'>查看当月全部文章</a></h3><div class='archives archives-$mon' data-date='$year-$mon'>"; //输出月份
		                    }
		                    $output .= '<a href="' . get_permalink() . '"><span class="time">' . get_the_time('n-d') . '</span>' . get_the_title() . '<i>'  . custom_the_views($post->ID) . ' 次浏览 / ' . get_comments_number() .' 则留言</i></a>'; //输出文章日期和标题
		                endwhile;
		                wp_reset_postdata();
		                $output .= '</div></div></div>';
		                echo $output;
		                ?>
		            </div>
		        </div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		</div>
	</div>
<?php
get_footer();
