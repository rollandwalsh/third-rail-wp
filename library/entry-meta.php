<?php
/**
 * Entry meta information for posts
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

if ( ! function_exists( 'thirdrail_entry_meta' ) ) :
  function cats() {
    foreach( wp_get_post_categories( get_the_ID() ) as $c ) {
      $cat = get_category( $c ); 
      return ' - <a href="'. get_category_link( $cat ) .'" title="'. $cat->name .'" class="category">'. $cat->name .'</a>';
    }
  }
  
	function thirdrail_entry_meta() {
  	echo '<div class="entry-meta">';
		echo '<p class="byline"><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" rel="author" class="author">'. get_the_author() .'</a>'. cats() .'</p>';
		echo '<time class="updated date" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( '%s', 'thirdrail' ), get_the_date() ) .'</time>';
  	echo '</div>';
	}
endif;
?>
