<?php
/**
 * Template part for displaying posts.
 *
 * @package third-rail
 */

?>

<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>		
		<a href="#" class="buy-link"><i class="fa fa-ticket"></i> Book Now</a>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large', array( 'class' => 'thumbnail-link' ) ); ?></a> 
		<?php } ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
