<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

if ( ! function_exists( 'thirdrail_theme_support' ) ) :
function thirdrail_theme_support() {
	// Add language support
	load_theme_textdomain( 'thirdrail', get_template_directory() . '/languages' );

	// Add menu support
	add_theme_support( 'menus' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'portrait', 400, 600, true );
	add_image_size( 'square', 300, 300, true );
	add_image_size( 'poster', 2200, 1550, true );
	add_image_size( 'full', 2400, 1600 );
	add_image_size( 'large', 1200, 800 );
	add_image_size( 'medium', 900, 600 );
	add_image_size( 'small', 300, 200 );

	// RSS thingy
	add_theme_support( 'automatic-feed-links' );

	// Add post formarts support: http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );

}

add_action( 'after_setup_theme', 'thirdrail_theme_support' );
endif;
?>