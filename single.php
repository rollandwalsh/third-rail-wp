<?php
/**
 * The template for displaying all single posts and attachments
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
			<header class="tr-blog-header">
        <div class="title">
          <h1><?php the_title(); ?>
          <h4><?php the_time('l - F jS, Y') ?></h4>
          <h5><?php the_category( ' ' ); ?></h5>
        </div>
        <div class="image">
          <?php if ( has_post_thumbnail() ) { ?>
            <?php the_post_thumbnail( 'square' , array( 'class' => '' ) ); ?>
          <?php } ?>
        </div>
      </header>
			<?php do_action( 'thirdrail_post_before_entry_content' ); ?>
			
			<section class="tr-blog-content">
			  <?php the_content(); ?>
			</section>
			
      <footer class="tr-blog-footer">
        <?php if ( get_the_tags() ) { ?>
          <ul class="tr-blog-tags">
            <?php the_tags('<li>', '</li><li>', '</li>'); ?>
          </ul>
        <?php } ?>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'thirdrail' ), 'after' => '</p></nav>' ) ); ?>
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>