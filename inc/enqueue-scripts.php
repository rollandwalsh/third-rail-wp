<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package WordPress
 * @subpackage ThirdRail
 */

if ( ! function_exists( 'thirdrail_scripts' ) ) :
	function thirdrail_scripts() {

	wp_enqueue_style( 'third-rail-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/node_modules/font-awesome/css/font-awesome.css' );

	// Deregister the jquery version bundled with WordPress.
	wp_deregister_script( 'jquery' );

	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.8.3', false );

	// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', false );

	// Enqueue all registered scripts.
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery' );

	}

	add_action( 'wp_enqueue_scripts', 'thirdrail_scripts' );
endif;

?>