<?php
/**
 * The template for displaying search results pages.
 *
<<<<<<< HEAD
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
=======
 * @package third-rail
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
 */

get_header(); ?>

<<<<<<< HEAD
<div class="row">
	<div class="small-12 large-8 columns" role="main">

		<?php do_action( 'thirdrail_before_content' ); ?>

		<h2><?php _e( 'Search Results for', 'thirdrail' ); ?> "<?php echo get_search_query(); ?>"</h2>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif;?>

	<?php do_action( 'thirdrail_before_pagination' ); ?>

	<?php if ( function_exists( 'thirdrail_pagination' ) ) { thirdrail_pagination(); } else if ( is_paged() ) { ?>

		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'thirdrail' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'thirdrail' ) ); ?></div>
		</nav>
	<?php } ?>

	<?php do_action( 'thirdrail_after_content' ); ?>

	</div>
	<?php get_sidebar(); ?>

=======
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'third-rail' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
<?php get_footer(); ?>
