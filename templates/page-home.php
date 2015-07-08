<?php
/**
 * Template Name: Home
 *
 * @package third-rail
 */

get_header(); ?>

	<header class="page-header">
		<div id="svgHeader" class="container">
			<div class="info-section">
				<div class="content">
				  <hr>
					<h2>Third Rail Membership</h2>
					<h5>Join the Movement!</h5>
					<a href="#" class="button buy large"><i class="fa fa-bolt"></i> Join Now</a>
				  <hr>
				</div>
			</div>
			<div class="graphic-section">
				<?php echo file_get_contents(get_template_directory_uri() . "/svg/thirdRailMembership.svg"); ?>
			</div>
		</div>
	</header>
	
	<section id="homeTiles" class="page-banner">
		<div class="current-shows">
			<h2 class="section-title">On Stage</h2>
			<div id="showSliderControls" class="home-slider-controls">
			  <i class="fa fa-2x fa-caret-left"></i>
			  <i class="fa fa-2x fa-caret-right"></i>
			</div>
			<div id="showSlider">
  			<?php
  			$args = array(
  		    'post_type'  	   => 'page',
  		    'post_status'    => 'publish',
  		    'posts_per_page' => '5',
  		    'meta_query' 	   => array( 
  		      array(
  		        'key'   	   => '_wp_page_template', 
  		        'value' 	   => array('templates/page-show.php')
  		      )
  		    )
  			);
  			
  			$query = new WP_Query( $args );
  			
  			if ( $query->have_posts() ) {
  				while ( $query->have_posts() ) {
  					$query->the_post();
  			?><!-- Get current shows and loop through -->
  			<?php get_template_part( 'template-parts/content', 'current-show' ); ?>
  			<?php
  				}
  			} else {
  				// no posts found
  			}
  			
  			wp_reset_postdata();
  			?><!-- Reset post data -->
			</div>
		</div>
		
		<div class="current-news">
			<h2 class="section-title">News</h2>
			<?php
			$args = array(
		    'post_type'  	   => 'post',
  		  'posts_per_page' => '1',
		    'post_status'    => 'publish',
		    'tax_query'      => array(
      		'relation'     => 'OR',
      		array(
      			'taxonomy'   => 'category',
      			'field'      => 'slug',
      			'terms'      => array( 'this-month', 'this-week' ),
      		),
      	),
			);
			
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
			?><!-- Get current shows and loop through -->
			<?php get_template_part( 'template-parts/content', 'current-news' ); ?>
			<?php
				}
			} else {
				// no posts found
			}
			
			wp_reset_postdata();
			?><!-- Reset post data -->
		</div>
		
		<div class="current-calendar">
			<h2 class="section-title">Calendar</h2>
			<?php get_template_part( 'template-parts/calendar', 'full' ); ?>
		</div>
	</section>
	
	<section class="page-home-secondary">
	  <div class="home-membership">
	    <h2 class="section-title"><i classs="fa fa-bolt"></i> Membership</h2>
  			<?php
  			$args = array(
  		    'post_type'  	   => 'page',
  		    'post_status'    => 'publish',
  		    'name'           => 'membership'
  			);
  			
  			$query = new WP_Query( $args );
  			
  			if ( $query->have_posts() ) {
  				while ( $query->have_posts() ) {
  					$query->the_post();
  			?><!-- Get Membership page -->
  			<?php get_template_part( 'template-parts/content', 'home' ); ?>
  			<?php
  				}
  			} else {
  				// no posts found
  			}
  			
  			wp_reset_postdata();
  			?><!-- Reset post data -->
	  </div>
	  <div class="current-media">
	    <h2 class="section-title">Media</h2>
			<div id="mediaSliderControls" class="home-slider-controls">
			  <i class="fa fa-2x fa-caret-left"></i>
			  <i class="fa fa-2x fa-caret-right"></i>
			</div>
			<div id="mediaSlider">
  			<?php
  			$args = array(
  		    'post_type'  	   => 'post',
  		    'posts_per_page' => '5',
  		    'tax_query'      => array(
    		    array(
      		    'relation'   => 'OR',
      		    array(
  			        'taxonomy' => 'post_format',
  			        'field'    => 'slug',
  			        'terms'    => array( 'post-format-gallery' ),
              ),
      		    array(
  			        'taxonomy' => 'post_format',
  			        'field'    => 'slug',
  			        'terms'    => array( 'post-format-image' ),
              ),
      		    array(
  			        'taxonomy' => 'post_format',
  			        'field'    => 'slug',
  			        'terms'    => array( 'post-format-video' ),
              ),
            ),
          ),
  			);
  			
  			$query = new WP_Query( $args );
  			
  			if ( $query->have_posts() ) {
  				while ( $query->have_posts() ) {
  					$query->the_post();
  			?><!-- Get current media and loop through -->
  			<?php get_template_part( 'template-parts/content', 'current-media' ); ?>
  			<?php
  				}
  			} else {
  				// no posts found
  			}
  			
  			wp_reset_postdata();
  			?><!-- Reset post data -->
			</div>
	  </div>
	  <div class="home-donate">
	    <h2 class="section-title">Donate</h2>
  			<?php
  			$args = array(
  		    'post_type'  	   => 'page',
  		    'post_status'    => 'publish',
  		    'name'           => 'donate'
  			);
  			
  			$query = new WP_Query( $args );
  			
  			if ( $query->have_posts() ) {
  				while ( $query->have_posts() ) {
  					$query->the_post();
  			?><!-- Get Donate page -->
  			<?php get_template_part( 'template-parts/content', 'home' ); ?>
  			<?php
  				}
  			} else {
  				// no posts found
  			}
  			
  			wp_reset_postdata();
  			?><!-- Reset post data -->
	  </div>
	  <div class="home-company-member">
	    <h2 class="section-title">Meet A Company Member</h2>
			<?php
			$args = array(
		    'post_type'      => 'page',
		    'post_status'    => 'publish',
		    'post_parent'    => '77',
		    'posts_per_page' => '5',
		    'orderby'        => 'rand'
			);
			
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
			?><!-- Get a random company member -->
			<?php get_template_part( 'template-parts/content', 'home-company-member' ); ?>
			<?php
				}
			} else {
				// no posts found
			}
			
			wp_reset_postdata();
			?><!-- Reset post data -->
	  </div>
	</section>
	
<?php get_footer(); ?>

<script>
  $('#svgHeader').equalize();
  
  $('#showSlider').slick({
    autoplay: true,
    autoplaySpeed: 6000,
    prevArrow: $('#showSliderControls i:first-child'),
    nextArrow: $('#showSliderControls i:last-child'),
    speed: 1500
  });
  $('#mediaSlider').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    prevArrow: $('#mediaSliderControls i:first-child'),
    nextArrow: $('#mediaSliderControls i:last-child'),
    speed: 1500
  });
</script>
