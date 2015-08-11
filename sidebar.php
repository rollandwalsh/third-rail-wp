<?php
/**
<<<<<<< HEAD
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="small-12 large-4 columns">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>
=======
 * The sidebar containing the main widget area.
 *
 * @package third-rail
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
