<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="rn-page-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>

<script>var show = '<?php the_title(); ?>';</script>