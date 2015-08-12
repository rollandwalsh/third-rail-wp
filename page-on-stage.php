<?php
/**
 * The template for displaying 'on stage' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

  <header class="page-header">
  	<div id="svgHeader" class="row" data-equalizer>
  		<div class="info-section" data-equalizer-watch>
  			<div id="membershipJoinContainer" class="content">
  			  <hr>
  				<h2>Third Rail Membership</h2>
  				<h5 id="membershipMessage">Join the Movement!</h5>
  				<a href="#" class="button buy large" id="membershipJoin"><i class="fa fa-bolt"></i> Join Now</a>
  			  <hr>
  			</div>
  		</div>
  		<div class="graphic-section" data-equalizer-watch>
  			<?php echo file_get_contents( get_stylesheet_directory_uri() . "/svg/thirdRailMembership.svg" ); ?>
  		</div>
  	</div>
  </header>

	<div class="small-12 large-8 columns" role="main">

	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="section-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			
  		<?php
  			$args = array(
  		    'post_type'  	   => 'page',
  		    'post_status'    => 'publish',
  		    'order'          => 'ASC',
  		    'orderby'        => 'meta_value',
  		    'meta_key'       => 'closing_date',
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
                $show_class = 'mainstage';
                break;
              case 'nt_live':
                $show_type = 'National Theatre Live';
                $show_class = 'nt-live';
                break;
              case 'wildcard':
                $show_type = 'Wild Card';
                $show_class = 'wild-card';
                break;
              case 'bloody_sunday':
                $show_type = 'Bloody Sunday';
                $show_class = 'bloody-sunday';
                break;
              case 'event':
                $show_type = 'Event';
                $show_class = 'event';
                break;
              default:
                $show_type = 'Upcoming Show';
            } // change show_type to print text ?> <!-- Start query for current shows -->
  				
          	<div class="on-stage-current-show">
          		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
          			<div class="entry-content">
              		<?php if ( has_post_thumbnail() ) { ?>
              			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium' , array( 'class' => 'th' ) ); ?></a> 
              		<?php } ?>
          			</div>
          			<?php do_action( 'thirdrail_after_content' ); ?>
              	<header class="entry-header">
              		<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>		
              		<a href="#" class="buy-link"><i class="fa fa-ticket"></i> Book Now</a>
              	</header>
              	<footer>
              	  <?php if( $post->post_parent ) { $parent_link = get_permalink($post->post_parent); ?>
                    <a href="<?php echo $parent_link; ?>" class="<?php echo $show_class; ?>"><?php echo $show_type; ?></a>
                  <?php } ?>
              	</footer>
          		</article>
          	</div>
  				<?php endwhile;
  			} else {
  				// no posts found
  			}
  			
  			wp_reset_postdata();
  		?> <!-- End query for current shows -->
			
			<footer>
				
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>

	</div>
	<?php get_sidebar( 'membership' ); ?>

  <?php get_footer(); ?>
  <script>
    $(function() {
      return getEvents(api, createMonths);
    });
    
  	$('#membershipJoin').on('click', function (e) {
    	e.preventDefault();
  		$('#membershipMessage').replaceWith('<h5>Would you rather join annually or monthly?</h5>');
  		$(this).replaceWith('<a href="https://thirdrailrep.secure.force.com/ticket#membership_a0So0000002BughEAC" class="button buy large">$352/year</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" class="button buy large">$29.33/month</a>');
  	});	
  </script>
