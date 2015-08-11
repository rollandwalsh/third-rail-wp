<?php
/**
 * Author: Rolland Walsh
 * URL: http://rollandwalsh.com
 *
<<<<<<< HEAD
 * ThirdRail functions and definitions
=======
 * Third Rail functions and definitions
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
<<<<<<< HEAD
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

require_once( 'library/cleanup.php' );

require_once( 'library/foundation.php' );

require_once( 'library/navigation.php' );

require_once( 'library/menu-walker.php' );

require_once( 'library/offcanvas-walker.php' );

require_once( 'library/widget-areas.php' );

require_once( 'library/entry-meta.php' );

require_once( 'library/enqueue-scripts.php' );

require_once( 'library/theme-support.php' );

require_once( 'library/custom-types.php' );

require_once( 'meta-box/show_data.php' );

require_once( 'meta-box/parent_show.php' );

?>
=======
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

require get_template_directory() . '/meta-box/parent_show.php';
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
