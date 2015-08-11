<?php
/**
 * Entry meta information for posts
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

if ( ! function_exists( 'thirdrail_entry_meta' ) ) :
	function thirdrail_entry_meta() {
		echo '<time class="updated" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( 'Posted on %s at %s.', 'thirdrail' ), get_the_date(), get_the_time() ) .'</time>';
		echo '<p class="byline author">'. __( 'Written by', 'thirdrail' ) .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
	}
endif;
?>
