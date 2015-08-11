<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="show-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	
  <h3 class="section-title">Calendar</h3>
	<article class="show-sidebar-section tr-calendar">
    <span class="calendar-nav" id="calendarNavPrev"><i class="fa fa-long-arrow-left"></i> Prev</span>
    <span class="calendar-nav" id="calendarNavNext">Next <i class="fa fa-long-arrow-right"></i></span>
  	<div id="calendar">
  	</div>
  	<div id="calendarDisplay">
  	</div>
  </article>
  		
	<?php
		$args = array(
	    'post_type'  	   => 'post',
	    'post_status'    => 'publish',
	    'posts_per_page' => 5,
	    'tag'            => 'third-rail-membership'
		);
	
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) { ?>
			<h3 class="section-title">News</h3>
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
