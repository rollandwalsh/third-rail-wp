<?php
/**
 * Author: Rolland Walsh
 * URL: http://rollandwalsh.com
 *
 * Third Rail functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
 * @subpackage third-rail
 */

require_once( 'inc/cleanup.php' );

require_once( 'inc/third-rail.php' );

require_once( 'inc/navigation.php' );

require_once( 'inc/widget-areas.php' );

require_once( 'inc/entry-meta.php' );

require_once( 'inc/enqueue-scripts.php' );

require_once( 'inc/custom-types.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/meta-box/show_data.php';
