<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>

<article class="tr-page-article" id="post-<?php the_ID(); ?>">
  <header class="tr-blog-header">
    <div class="title">
      <?php the_title( sprintf( '<h1><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
      <h4><?php the_time('l - F jS, Y') ?></h4>
      <h5><?php the_category( ' ' ); ?></h5>
<!--       <?php thirdrail_entry_meta(); ?> -->
    </div>
    <div class="image">
      <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium' , array( 'class' => '' ) ); ?></a> 
      <?php } ?>
    </div>
  </header>
	<div class="tr-entry-content">
		<?php the_content( __( 'Continue reading...', 'thirdrail' ) ); ?>
	</div>
	<footer class="tr-blog-footer">
    <?php if ( get_the_tags() ) { ?>
      <ul class="tr-blog-tags">
        <?php the_tags('<li>', '</li><li>', '</li>'); ?>
      </ul>
    <?php } ?>
	</footer>
</article>