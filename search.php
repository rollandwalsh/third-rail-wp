<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="tr-page-container" role="main">

  <?php do_action( 'thirdrail_before_content' ); ?>
	
	<h1 class="tr-page-title"><?php _e( 'Search Results for', 'thirdrail' ); ?> "<?php echo get_search_query(); ?>"</h1>

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

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
