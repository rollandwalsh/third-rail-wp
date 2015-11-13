<?php
/**
 * The template for displaying 'home' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="tr-home-container">

<section class="tr-page-banner">
  <div class="tr-container">
    <header class="tr-page-banner-header">
			<h2>Third Rail Membership</h2>
			<h5 id="membershipMessage">Join the Movement!</h5>
			<div class="tr-page-banner-buttons">
			  <a href="/test/membership/" class="button">Learn More</a><a href="#" class="button buy" id="membershipJoin"><i class="fa fa-bolt"></i> Join Now</a>
			</div>
		</header>
		
		<?php echo file_get_contents( get_stylesheet_directory_uri() . "/svg/thirdRailMembership.svg" ); ?>
  </div>
</section>
  
<section class="tr-home-show-cards">
	<?php
		$args = array(
	    'post_type'  	   => 'page',
	    'post_status'    => 'publish',
	    'post__not_in'   => array( ), // Use for shows to hide
	    'order'          => 'ASC',
	    'orderby'        => 'meta_value',
	    'meta_key'       => 'closing_date',
	    'posts_per_page' => 3,
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
            $show_class = '';
            $show_type = 'Mainstage';
            break;
          case 'nt_live':
            $show_class = 'nt-live';
            $show_type = 'National Theatre Live';
            break;
          case 'wildcard':
            $show_class = 'wild-card';
            $show_type = 'Wild Card';
            break;
          case 'bloody_sunday':
            $show_class = 'bloody-sunday';
            $show_type = 'Bloody Sunday';
            break;
          case 'event':
            $show_class = 'event';
            $show_type = 'Event';
            break;
          default:
            $show_type = 'Upcoming Show';
        } // change show_type to print text ?> <!-- Start query for current shows -->
        
        <article class="tr-show-card <?php echo $show_class; ?>" id="post-<?php the_ID(); ?>">
          <?php if ( has_post_thumbnail() ) { ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large' , array( 'class' => '' ) ); ?></a> 
          <?php } ?>
          <div class="tr-show-card-overlay">
            <header>
              <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ;?></a></h2>
              <h5><?php echo date('M j - ', strtotime( rwmb_meta( 'opening_date' ) )), date('M j', strtotime( rwmb_meta( 'closing_date' ) )); ?></h5>
            </header>
            <a href="#" class="button buy large"><i class="fa fa-ticket fa-lg"></i></a>
          </div>
        </article>
      <?php endwhile;
		} else {
			// no posts found
		}
			
    wp_reset_postdata();
  ?> <!-- End query for current shows -->
</section>

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
			
      <article class="tr-home-blog" id="post-<?php the_ID(); ?>">
  			<header class="tr-blog-header">
          <div class="title">
            <?php the_title( sprintf( '<h1><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
            <h4><?php the_time('l - F jS, Y') ?></h4>
            <h5><?php the_category( ' ' ); ?></h5>
          </div>
          <div class="image">
            <?php if ( has_post_thumbnail() ) { ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'square' , array( 'class' => '' ) ); ?></a> 
            <?php } ?>
          </div>
        </header>
  			
  			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
  			<section class="tr-blog-content">
  				<?php the_content(); ?>
  			</section>
  			
  			<footer class="tr-blog-footer">
          <?php if ( get_the_tags() ) { ?>
            <ul class="tr-blog-tags">
              <?php the_tags('<li>', '</li><li>', '</li>'); ?>
            </ul>
          <?php } ?>
  			</footer>
  		</article>

		<?php endwhile;
	}

  wp_reset_postdata();
?>

<section class="tr-home-calendar">
  <div class="tr-container">
    <div id="trCalendar"></div>
    <div class="tr-calendar-display" id="trCalendarDisplay">
      <div class="tr-calendar-loading">Loading <i class="fa fa-spinner fa-spin"></i></div>
    </div>
  </div>
</section>

</div>

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
</script>
