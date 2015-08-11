<?php
/**
 * Author: Rolland Walsh
 * URL: http://rollandwalsh.com
 *
 * ThirdRail functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
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
