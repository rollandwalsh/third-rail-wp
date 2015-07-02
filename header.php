<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package third-rail
 */
 date_default_timezone_set('America/Los_Angeles');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.5/slick.css"/>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'third-rail' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo file_get_contents(get_template_directory_uri() . "/svg/thirdRailLogo.svg"); ?></a>
			</div><!-- .site-branding -->
	
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<a class="main-nav-toggle" aria-controls="primary-menu" aria-expanded="false">Menu</a>
				<?php thirdrail_main_nav(); ?>
			</nav><!-- #site-navigation -->
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
