<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

if ( ! function_exists( 'thirdrail_scripts' ) ) :
	function thirdrail_scripts() {

	wp_enqueue_style( 'normalize-stylesheet', get_stylesheet_directory_uri() . '/css/normalize.css' );
	
	wp_enqueue_style( 'main-stylesheet', get_stylesheet_directory_uri() . '/css/app.css' );
	
	wp_enqueue_style( 'slick-stylesheet', get_stylesheet_directory_uri() . '/css/slick.css' );
	
	wp_enqueue_style( 'icon-stylesheet', get_stylesheet_directory_uri() . '/css/font-awesome.css' );

	wp_deregister_script( 'jquery' );

	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.8.3', false );

	wp_register_script( 'fastclick', get_template_directory_uri() . '/js/vendor/fastclick.js', array(), '1.0.0', false );
	
	wp_register_script( 'slick', get_template_directory_uri() . '/js/vendor/slick.min.js', array(), '1.5.6', false );

	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array(), '2.1.4', false );
	
	wp_register_script( 'app', get_template_directory_uri() . '/js/app.js', array(), '1.0.0', true );

	// Enqueue all registered scripts.
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'fastclick' );
	wp_enqueue_script( 'slick' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'app' );

	}

	add_action( 'wp_enqueue_scripts', 'thirdrail_scripts' );
endif;

if ( ! function_exists( 'third_rail_favicons' ) ) :
  function third_rail_favicons() {
  	?>
  	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-57x57.png">
  	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-60x60.png">
  	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-72x72.png">
  	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-76x76.png">
  	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-114x114.png">
  	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-120x120.png">
  	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-144x144.png">
  	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-152x152.png">
  	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/apple-icon-180x180.png">
  	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/android-icon-192x192.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon-32x32.png">
  	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon-96x96.png">
  	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon-16x16.png">
  	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/manifest.json">
  	<meta name="msapplication-TileColor" content="#ffffff">
  	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/img/icons/ms-icon-144x144.png">
  	<meta name="theme-color" content="#ffffff">
  	<?php
  }
  add_action( 'wp_head', 'third_rail_favicons' );
endif;

?>