<?php
/**
 * Template Name: Company Member
 *
 * The template for displaying Company Member pages
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="tr-page-container" role="main">
	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article class="tr-page-article" id="post-<?php the_ID(); ?>">
			<header class="tr-page-cotent-header">
				<h1 class="tr-page-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="tr-page-content">
				<?php the_post_thumbnail( 'portrait', array( 'class' => 'company-member-image' ) ); ?>
				<?php the_content(); ?>
			</div>
			<footer class="tr-page-content-footer">
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'thirdrail' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
