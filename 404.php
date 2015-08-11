<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php _e( 'File Not Found', 'thirdrail' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'thirdrail' ); ?></p>
				</div>
				<p><?php _e( 'Please try the following:', 'thirdrail' ); ?></p>
				<ul>
					<li><?php _e( 'Check your spelling', 'thirdrail' ); ?></li>
					<li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'thirdrail' ), home_url() ); ?></li>
					<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'thirdrail' ); ?></li>
				</ul>
			</div>
		</article>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
