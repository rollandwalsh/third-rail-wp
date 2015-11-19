<?php
/**
 * The sidebar containing the main widget area for 'On Stage' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="rn-page-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	
	<article class="rn-sidebar-widget search">
    <h3 class="tr-sidebar-section-title">Search</h3>
	  <?php do_action( 'thirdrail_before_searchform' ); ?>
    <form class="tr-search-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    	<?php do_action( 'thirdrail_searchform_top' ); ?>
    	<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'thirdrail' ); ?>">
    	<?php do_action( 'thirdrail_searchform_before_search_button' ); ?>
      <button type="submit" id="searchsubmit"><i class="fa fa-search fa-lg"></i></button>
    	<?php do_action( 'thirdrail_searchform_after_search_button' ); ?>
    </form>
    <?php do_action( 'thirdrail_after_searchform' ); ?>
	</article>
  		
	<?php
		$args = array(
	    'post_type'  	   => 'post',
	    'post_status'    => 'publish',
	    'posts_per_page' => 1,
	    'category_name'  => 'this-week'
		);
	
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) { ?>
  		<article class="rn-sidebar-widget post">
  			<h3 class="tr-sidebar-section-title">This Week at Third Rail</h3>
  			<div class="tr-sidebar-post this-week">
  				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
  					<header>
  						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
  					</header>
  					<div class="tr-sidebar-post-content">
  						<?php the_excerpt(); ?>
  					</div>
  					<footer>
  					</footer>
  				<?php endwhile; ?>
  			</div>
  		</article>
		<?php }
	
    wp_reset_postdata();
	?>
	
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>
