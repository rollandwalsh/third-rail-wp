<?php
/**
 * Enqueue all styles and scripts
 *
 * @package WordPress
 * @subpackage ThirdRail
 */

if ( ! function_exists( 'thirdrail_scripts' ) ) :
	function thirdrail_scripts() {

	wp_enqueue_style( 'third-rail-style', get_template_directory_uri() . '/css/app.css' );
	
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/css/font-awesome.css' );
	
	wp_enqueue_style( 'slick-carousel-style', get_template_directory_uri() . '/css/slick.css' );

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

if ( ! function_exists( 'thirdrail_footer_scripts' ) ) :
	function thirdrail_footer_scripts() { ?>
	
	<scripts src="<?php echo get_template_directory_uri(); ?>/js/app.js"></scripts>
	<scripts src="<?php echo get_template_directory_uri(); ?>/js/vendor/equalizer.min.js"></scripts>
	<scripts src="<?php echo get_template_directory_uri(); ?>/js/vendor/slick.min.js"></scripts>
	
	<?php } 

	add_action('wp_footer', 'thirdrail_footer_scripts');
endif;

?>