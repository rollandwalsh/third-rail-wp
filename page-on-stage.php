<?php
/**
 * The template for displaying 'on stage' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

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

<div class="tr-page-container" role="main">

	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article class="tr-page-article" id="post-<?php the_ID(); ?>">
			<header class="tr-article-header">
				<h1 class="tr-page-title"><?php the_title(); ?></h1>
			</header>
			
    	<?php
        $categories = get_children(array(
          'post_parent'   => get_the_ID(),
          'numberposts'   => -1,
          'post_status'   => 'publish',
        	'child_of'      => 'on-stage',
        	'orderby'       => 'menu_order',
        	'order'         => 'ASC'
        ));
    		foreach ($categories as $category) {
    			$args = array(
    		    'post_type'  	  => 'page',
    		    'post_status'   => 'publish',
    		    'post_parent'   => $category->ID,
    		    'order'         => 'ASC',
    		    'orderby'       => 'meta_value',
    		    'meta_key'      => 'closing_date',
    		    'meta_query' 	  => array( 
              'relation'    => 'AND',
    		      array(
    		        'key'   	  => '_wp_page_template', 
    		        'value' 	  => array('page-show.php')
    		      ),
              array(
                'key'       => 'closing_date',
                'value'     => date('Y-m-d'),
                'type'      => 'DATE',
                'compare'   => '>='
              )
    		    )
    			);
    			
    			$query = new WP_Query( $args );
    			
    			if ( $query->have_posts() ) { 
    			
    				switch ( get_the_title( $category->ID ) ) {
              case 'Mainstage':
                $show_class = 'main-stage';
                break;
              case 'NT Live':
                $show_class = 'hi-def-screening';
                break;
              case 'Branagh':
                $show_class = 'hi-def-screening';
                break;
              case 'Wild Card':
                $show_class = 'wild-card';
                break;
              case 'Bloody Sunday':
                $show_class = 'bloody-sunday';
                break;
              case 'Event':
                $show_class = 'event';
                break;
              default:
                $show_type = ''; 
            } ?>
    			
      			<section class="tr-on-stage-show-cards <?php echo $show_class; ?>">
      			  <header class="tr-on-stage-show-cards-header">
      			    <h2 class="tr-section-title"><a href="<?php echo get_page_link( get_page_by_title( get_the_title( $category->ID ) )->ID ); ?>" title="<?php echo get_the_title( $category->ID ); ?>"><?php echo get_the_title( $category->ID ); ?></a></h2>
      			  </header>
      			  
      			  <div class="tr-page-show-cards">
                <?php while ( $query->have_posts() ) : $query->the_post(); 
        				  
          				switch ( rwmb_meta( 'show_type' ) ) {
                    case 'mainstage':
                      $show_type = 'Mainstage';
                      break;
                    case 'nt_live':
                      $show_type = 'Hi-Definition Screening';
                      break;
                    case 'branagh':
                      $show_type = 'Hi-Definition Screening';
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
        				
                  <article class="tr-show-card <?php echo $show_class; ?>" id="post-<?php the_ID(); ?>">
                    <?php if ( has_post_thumbnail() ) { ?>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large' , array( 'class' => '' ) ); ?></a> 
                    <?php } ?>
                    <div class="tr-card-overlay">
                      <header>
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ;?></a></h2>
                        <h5>by *Playwright*</h5>
                      </header>
                      <a href="#" class="button buy large"><i class="fa fa-ticket fa-lg"></i></a>
                    </div>
                  </article>
        				<?php endwhile; ?>
      			  </div>
      			</section>
    			<?php } else {
    				// no posts found
    			}
    			wp_reset_postdata();
    		}
    	?> <!-- End query for current shows -->
			
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			
			<div class="tr-on-stage-content">
        <?php the_content(); ?>
			</div>
      
      <?php do_action( 'thirdrail_after_content' ); ?>
			
			<footer class="tr-article-footer">
				
			</footer>
		</article>
	<?php endwhile;?>
</div>

<div class="tr-on-stage-post">
  <?php
		$args = array(
	    'post_type'  	   => 'post',
	    'post_status'    => 'publish',
	    'posts_per_page' => 1,
	    'category_name'  => 'this-month'
		);
	
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) { ?>
		  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <article class="tr-page-article" id="post-<?php the_ID(); ?>">
          <header class="tr-blog-header">
            <div class="title">
              <?php the_title( sprintf( '<h1><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
              <h4><?php the_time('l - F jS, Y') ?></h4>
              <h5><?php the_category( ' ' ); ?></h5>
        <!--       <?php thirdrail_entry_meta(); ?> -->
            </div>
            <div class="image">
              <?php if ( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'square' , array( 'class' => '' ) ); ?></a> 
              <?php } ?>
            </div>
          </header>
        	<div class="tr-blog-content">
        		<?php the_content( __( 'Continue reading...', 'thirdrail' ) ); ?>
        	</div>
        	<footer class="tr-blog-footer">
            <?php if ( get_the_tags() ) { ?>
              <ul class="tr-blog-tags">
                <?php the_tags('<li>', '</li><li>', '</li>'); ?>
              </ul>
            <?php } ?>
        	</footer>
        </article>
  		<?php endwhile; ?>
		<?php }
	
    wp_reset_postdata();
	?>
</div>

<section class="tr-page-calendar">
  <div id="trCalendar"></div>
  <div class="tr-calendar-display" id="trCalendarDisplay">
    <div class="tr-calendar-loading">Loading <i class="fa fa-spinner fa-spin"></i></div>
  </div>
</section>

<?php get_sidebar( 'on-stage' ); ?>

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
