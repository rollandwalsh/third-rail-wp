<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

	<?php if ( have_posts() ) : ?>

		<?php do_action( 'thirdrail_before_content' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

		<?php do_action( 'thirdrail_before_pagination' ); ?>

	<?php endif;?>



	<?php if ( function_exists( 'thirdrail_pagination' ) ) { thirdrail_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'thirdrail' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'thirdrail' ) ); ?></div>
		</nav>
	<?php } ?>

	<?php do_action( 'thirdrail_after_content' ); ?>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>