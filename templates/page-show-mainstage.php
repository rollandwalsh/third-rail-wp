<?php
/**
 * Template Name: Mainstage
 *
 * @package third-rail
 */

get_header(); ?>

	<header class="page-header">
		<div class="container">
			<div class="info-section">
				<div class="content">
					<?php the_title( '<h2>', '</h2>' ); ?>
					<h5>byline</h5>
					<a href="#" class="button buy large"><i class="fa fa-ticket"></i> Book Now</a>
				</div>
			</div>
			<div class="graphic-section">
				<?php echo file_get_contents(get_template_directory_uri() . "/svg/" . camelCase(get_the_title()) . ".svg"); ?>
			</div>
		</div>
	</header>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
