<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="small-12 large-4 columns">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	<article class="row widget widget_resent_news">
  	<?php
  		$args = array(
  	    'post_type'  	   => 'post',
  	    'post_status'    => 'publish',
  	    'posts_per_page' => 5
  		);
  	
  		$query = new WP_Query( $args );
  		
  		if ( $query->have_posts() ) { ?>
  		  <div class="large-12 columns">
    			<h3 class="section-title">Recent News</h3>
    			<div class="show-sidebar-section">
    				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
    					<header>
    						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    					</header>
    					<div class="entry-content">
    						<?php the_excerpt(); ?>
    					</div>
    					<footer>
    						<?php thirdrail_entry_meta(); ?>
    					</footer>
    				<?php endwhile; ?>
    			</div>
  		  </div>
  		<?php }
  	
      wp_reset_postdata();
  	?>
	</article>
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>