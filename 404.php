<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="tr-page-container" role="main">
	<article class="tr-page-article" id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="tr-404-title">Page Not Found</h1>
		</header>
		<div class="tr-entry-content">
			<p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
			<ul class="tr-404-options">
				<li><a href="javascript:history.back()" class="button">Go Back</a></li>
			  <li><?php get_search_form(); ?></li>
				<li><a href="<?php echo home_url(); ?>" class="button">Home Page</a></li>
			</ul>
		</div>
	</article>

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
