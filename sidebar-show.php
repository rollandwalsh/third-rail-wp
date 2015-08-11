<?php
/**
<<<<<<< HEAD
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="show-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
  
  <?php if ( has_post_thumbnail() ) { ?>
  	<article class="show-sidebar-section show-thumbnail">
  	  <?php the_post_thumbnail( 'medium' ); ?>
  	</article>
  <?php } ?>
	
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
	    'meta_query' 	   => array( 
        array(
          'key'        => 'parent_show',
          'value'      => get_the_title()
        )
	    ),
	    'tax_query'      => array(
		    array(
  		    array(
		        'taxonomy' => 'post_format',
		        'field'    => 'slug',
		        'terms'    => array( 'post-format-quote' ),
          )
        ),
      ),
		);
	
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) { ?>
			<h3 class="section-title">Reviews</h3>
			<div class="show-sidebar-section">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				  <?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		<?php }
	
    wp_reset_postdata();
	?>
  
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>

<script>var show = '<?php the_title(); ?>';</script>
=======
 * The sidebar containing the show sidebar.
 *
 * @package third-rail
 */
?>

<div id="secondary" class="page-sidebar" role="complementary">
  <?php get_template_part( 'template-parts/calendar', 'show' ); ?>
</div>
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
