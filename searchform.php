<?php
/**
 * The template for displaying search form
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

do_action( 'thirdrail_before_searchform' ); ?>
<form class="tr-search-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<?php do_action( 'thirdrail_searchform_top' ); ?>
	<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'thirdrail' ); ?>">
	<?php do_action( 'thirdrail_searchform_before_search_button' ); ?>
  <button type="submit" id="searchsubmit"><i class="fa fa-search fa-lg"></i></button>
	<?php do_action( 'thirdrail_searchform_after_search_button' ); ?>
</form>
<?php do_action( 'thirdrail_after_searchform' ); ?>