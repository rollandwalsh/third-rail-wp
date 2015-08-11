<?php
/**
 * The template for displaying 'home' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

  <header class="page-header">
  	<div id="svgHeader" class="row" data-equalizer="header">
  		<div class="info-section" data-equalizer-watch="header">
  			<div class="content">
  			  <hr>
  				<h2>Third Rail Membership</h2>
  				<h5 id="membershipMessage">Join the Movement!</h5>
  				<a href="/test/membership/" class="button large">Learn More</a> <a href="#" class="button buy large" id="membershipJoin"><i class="fa fa-bolt"></i> Join Now</a>
  			  <hr>
  			</div>
  		</div>
  		<div class="graphic-section" data-equalizer-watch="header">
  			<?php echo file_get_contents( get_stylesheet_directory_uri() . "/svg/thirdRailMembership.svg" ); ?>
  		</div>
  	</div>
  </header>
  
  <section id="homeTiles" class="page-banner">
		<?php
			$args = array(
		    'post_type'  	   => 'page',
		    'post_status'    => 'publish',
		    'post__not_in'   => array( 186, 195, 197, 199, 202, 259 ),
		    'order'          => 'ASC',
		    'orderby'        => 'meta_value',
		    'meta_key'       => 'closing_date',
		    'posts_per_page' => 4,
		    'meta_query' 	   => array( 
          'relation'    => 'AND',
		      array(
		        'key'   	   => '_wp_page_template', 
		        'value' 	   => array('page-show.php')
		      ),
          array(
            'key'        => 'closing_date',
            'value'      => date('Y-m-d'),
            'type'       => 'DATE',
            'compare'    => '>='
          )
		    )
			);
			
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) : $query->the_post(); 
				
  				switch ( rwmb_meta( 'show_type' ) ) {
            case 'mainstage':
              $show_type = 'Mainstage';
              break;
            case 'nt_live':
              $show_type = 'National Theatre Live';
              break;
            case 'wildcard':
              $show_type = 'Wild Card';
              break;
            case 'bloody_sunday':
              $show_type = 'Bloody Sunday';
              break;
            case 'event':
              $show_type = 'Event';
              break;
            default:
              $show_type = 'Upcoming Show';
          } // change show_type to print text ?> <!-- Start query for current shows -->
				
        	<div class="home-current-shows">
        		<h2 class="section-title"><?php echo $show_type; ?></h2>
					
        		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        			<div class="entry-content">
            		<?php if ( has_post_thumbnail() ) { ?>
            			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium' , array( 'class' => 'th' ) ); ?></a> 
            		<?php } ?>
        			</div>
            	<header class="entry-header">
            		<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>		
            		<a href="#" class="buy-link"><i class="fa fa-ticket"></i> Book Now</a>
            	</header>
        			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
        		</article>
        	</div>
				<?php endwhile;
			} else {
				// no posts found
			}
			
			wp_reset_postdata();
		?> <!-- End query for current shows -->
  </section>
  
  <section class="page-home-secondary">
  	<div class="home-current-news">
  		<h2 class="section-title">News</h2>
  		<?php
    		$args = array(
    	    'post_type'  	   => 'post',
    		  'posts_per_page' => 1,
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
    		  while ( $query->have_posts() ) : $query->the_post(); ?>
  					
            <article <?php post_class() ?> id="post-<?php the_ID(); ?>" data-equalizer-watch>
        			<header class="entry-header">
        				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
        				<a href="http://thirdrailrep.org/news/" title="Third Rail News" class="read-more-link">More News</a>
            		<p class="post-category"><?php the_category( ' ' ); ?></p>
        			</header>
        			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
        			<div class="entry-content">
        				<?php the_content(); ?>
        			</div>
        		</article>

  				<?php endwhile;
  			}
  		
        wp_reset_postdata();
  		?>
  	</div>
  	
  	<div class="home-current-calendar">
  		<h2 class="section-title">Calendar</h2>
        <article class="tr-calendar" data-equalizer-watch>
          <span class="calendar-nav" id="calendarNavPrev"><i class="fa fa-long-arrow-left"></i> Prev</span>
          <span class="calendar-nav" id="calendarNavNext">Next <i class="fa fa-long-arrow-right"></i></span>
        	<div id="calendar">
        	</div>
        	<div id="calendarDisplay">
        	</div>
        </div>
  	</div>
  </section>
  
  <section class="page-home-tertiary">
    <div class="home-membership">
      <h2 class="section-title"><i classs="fa fa-bolt"></i> Membership</h2>
        <?php do_action( 'thirdrail_before_content' ); ?>
        
        <?php while ( have_posts() ) : the_post(); ?>
        	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        		<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
        		<div class="entry-content">
        			<h4>Be seen. Be heard. Be a Member.</h4>
              <p>As part of Third Rail’s commitment to deepen dialogue between audiences and artists we invite you to join the <strong>Third Rail Membership Program</strong>!  Offering flexibility, increased programming, stimulating collaborations, and deeper engagement with the artistic ensemble, Third Rail Membership is a whole new way to think about participation with <strong>Third Rail</strong>.</p>
              <div class="text-center">
                <a href="http://thirdrailrep.org/membership/" class="button">Learn More</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" class="button buy"><i class="fa fa-bolt"></i> Join Now</a>
              </div>
        		</div>
        	</article>
        <?php endwhile; ?>
        
        <?php do_action( 'thirdrail_after_content' ); ?>
    </div>
    <div class="home-current-media">
      <h2 class="section-title">Media</h2>
  		<div id="mediaSliderControls" class="home-slider-controls">
  		  <i class="fa fa-2x fa-caret-left"></i>
  		  <i class="fa fa-2x fa-caret-right"></i>
  		</div>
  		<div id="mediaSlider">
  			<?php
    			$args = array(
    		    'post_type'  	   => 'post',
    		    'posts_per_page' => 5,
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
    				while ( $query->have_posts() ) : $query->the_post(); ?>
    					
              <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          			<header class="entry-header">
          				<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
          			</header>
          			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
          			<div class="entry-content">
          				<?php the_content(); ?>
          			</div>
          		</article>
          		
    				<?php endwhile;
    			}
    		
          wp_reset_postdata();
    		?>
  		</div>
    </div>
    <div class="home-donate">
      <h2 class="section-title">Donate</h2>
    	<article>
    		<div class="entry-content">
    			<h4>We can’t get there without you!</h4>
    			<p>Since 2005, Third Rail Repertory Theatre has committed itself to bringing theatrical excellence to Portland stages. You trust us to choose thoughtful, provocative work and produce it at the highest level. This mutual commitment and trust is the very core of Third Rail’s success. By donating to Third Rail you are ensuring our ability to continue to surprise, delight, and entertain you.</p>
    			<div class="text-center">
    			  <a href="http://thirdrailrep.org/support/" class="button">Ways to Give</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no0000005rHELAA2" class="button buy"><i class="fa fa-bolt"></i> Donate Now</a>
    			</div>
    		</div>
    	</article>
    </div>
    <div class="home-company-member">
      <h2 class="section-title">Meet A Company Member</h2>
  		<?php
    		$args = array(
    	    'post_type'      => 'page',
    	    'post_status'    => 'publish',
    	    'post_parent'    => 77,
    	    'posts_per_page' => 5,
    	    'orderby'        => 'rand'
    		);
  		
  			$query = new WP_Query( $args );
  			
  			if ( $query->have_posts() ) {
    		  while ( $query->have_posts() ) : $query->the_post(); ?>
  					
            <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        			<header class="entry-header">
        				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
        				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="read-more-link">Read more</a>
        			</header>
        			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
        			<div class="entry-content">
        				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'th' ) ); ?></a>
        			</div>
        		</article>

  				<?php endwhile;
  			}
  		
    		wp_reset_postdata();
  		?><!-- Reset post data -->
    </div>
  </section>

<?php get_footer(); ?>

<script>
  $(function() {
    return getEvents(api, createMonths);
  });
  
  $('#membershipJoin').on('click', function (e) {
  	e.preventDefault();
		$('#membershipMessage').replaceWith('<h5>Would you rather join annually or monthly?</h5>');
		$(this).replaceWith('<br><a href="https://thirdrailrep.secure.force.com/ticket#membership_a0So0000002BughEAC" class="button buy large">$352/year</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" class="button buy large">$29.33/month</a>');
	});	
  
  $('#mediaSlider').slick({
    autoplay: true,
    autoplaySpeed: 6000,
    prevArrow: $('#mediaSliderControls i:first-child'),
    nextArrow: $('#mediaSliderControls i:last-child'),
    speed: 1500
  });
</script>
