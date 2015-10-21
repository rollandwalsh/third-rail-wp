<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-body" div.
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'thirdrail_after_body' ); ?>
	
	<?php do_action( 'thirdrail_layout_start' ); ?>

	<?php get_template_part( 'parts/site-header' ); ?>

	<?php do_action( 'thirdrail_after_header' ); ?>
