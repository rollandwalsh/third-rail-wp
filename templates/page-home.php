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
	
	<section id="homeTiles" class="page-home-banner">
		<div class="current-shows">
			<h2 class="section-title">On Stage Now</h2>
			<div id="showSlider">
			<?php
			$args = array(
		    'post_type'  	=> 'page',
		    'post_status' => 'publish',
		    'meta_query' 	=> array( 
		      array(
		        'key'   	=> '_wp_page_template', 
		        'value' 	=> array('templates/page-show-mainstage.php', 'templates/page-show-ntlive.php')
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
		    'post_type'  	=> 'post',
		    'post_status' => 'publish'
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
			<?php echo file_get_contents(get_template_directory_uri() . "/template-parts/calendar-full.php"); ?>
		</div>
	</section>
	
	<div id="primary" class="page-content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>

<script>
  $('#showSlider').slick();
</script>
