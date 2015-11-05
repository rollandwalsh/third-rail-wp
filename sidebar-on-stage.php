<?php
/**
 * The sidebar containing the main widget area for 'On Stage' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="show-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	
	<article class="row widget widget_search">
	  <h3 class="section-title">Search</h3>
	  <?php do_action( 'thirdrail_before_searchform' ); ?>
    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    	<div class="row collapse">
    		<?php do_action( 'thirdrail_searchform_top' ); ?>
    		<div class="small-10 columns">
    			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Type here...', 'thirdrail' ); ?>">
    		</div>
    		<?php do_action( 'thirdrail_searchform_before_search_button' ); ?>
    		<div class="small-2 columns">
    			<button type="submit" id="searchsubmit" class="prefix button"><i class="fa fa-search fa-lg"></i></button>
    		</div>
    		<?php do_action( 'thirdrail_searchform_after_search_button' ); ?>
    	</div>
    </form>
    <?php do_action( 'thirdrail_after_searchform' ); ?>
	</article>
  		
	<?php
		$args = array(
	    'post_type'  	   => 'post',
	    'post_status'    => 'publish',
	    'posts_per_page' => 1,
	    'category_name'  => 'This Week at Third Rail'
		);
	
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) { ?>
			<h3 class="section-title">This Week</h3>
			<div class="show-sidebar-section">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<header>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</header>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
					<footer>
						<hr>
					</footer>
				<?php endwhile; ?>
			</div>
		<?php }
	
    wp_reset_postdata();
	?>
  		
	<?php
		$args = array(
	    'post_type'  	   => 'post',
	    'post_status'    => 'publish',
	    'posts_per_page' => 1,
	    'category_name'  => 'This Month at Third Rail'
		);
	
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) { ?>
			<h3 class="section-title">This Month</h3>
			<div class="show-sidebar-section">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<header>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</header>
					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div>
					<footer>
						<hr>
					</footer>
				<?php endwhile; ?>
			</div>
		<?php }
	
    wp_reset_postdata();
	?>
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>
