<?php
/**
 * Template part for displaying posts.
 *
 * @package anyutv
 */

the_posts_pagination(
	array(
		'prev_text' => sprintf( __( '%s Prev', 'anyutv' ), '<i class="fa fa-angle-left"></i>' ),
		'next_text' => sprintf( __( 'Next %s', 'anyutv' ), '<i class="fa fa-angle-right"></i>' ),
	)
);
