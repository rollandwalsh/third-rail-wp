<?php
/**
 * Template Name: On Stage
 *
 * @package third-rail
 */

get_header(); ?>

  <?php
    $page_name = get_the_title();
    $tickets_url = rwmb_meta( 'tickets_url' );
    $today = date('Y-m-d');  

    switch ($page_name) {
      case 'Membership':
        $svg = 'thirdRailMembership';
        break;
      default:
        $svg = '';
    } /* get the svg file based on page name */

    if ( $svg !== '' ) { ?>
    	<header class="page-header">
    		<div id="svgHeader" class="container">
    			<div class="info-section">
    				<div class="content">
    				  <hr>
    					<?php the_title( '<h2>', '</h2>' ); ?>
    					
    					<?php if ($tickets_url !== '') { ?>
    					  <a href="<?php echo $tickets_url; ?>" class="button buy large"><i class="fa fa-ticket"></i> Join Now</a>
              <?php } ?>
    				  <hr>
    				</div>
    			</div>
    			<div class="graphic-section">
    				<?php echo file_get_contents(get_template_directory_uri() . "/svg/" . $svg . ".svg"); ?>
    			</div>
    		</div>
    	</header>
    <?php } ?>

	<div id="primary" class="page-content-area">
		<main id="main" class="page-main-full" role="main">
    
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_title( '<h1 class="section-title">', '</h1>' ); ?>

			<?php endwhile; // End of the loop. ?>
			
			<div class="on-stage-shows">
  			<div class="on-stage-show-type">
  			  <h2>Mainstage</h2>
      		<?php
            $args = array (
              'post_type'     => 'page',
              'order'         => 'ASC',
              'orderby'       => 'meta_value_num',
              'meta_key'      => 'closing_date',
              'meta_query'    => array(
                'relation'    => 'AND',
                array(
                  'key'       => 'show_type',
                  'value'     => 'mainstage',
                ),
                array(
                  'key'       => 'closing_date',
                  'value'     => $today,
                  'type'      => 'DATE',
                  'compare'   => '>='
                )
              )
            );
            
            $mainstage = new WP_Query( $args );
            
            if ( $mainstage->have_posts() ) {
      				while ( $mainstage->have_posts() ) {
      					$mainstage->the_post();
      					get_template_part( 'template-parts/content', 'on-stage' );
      
      				}
      			} else {
      				// no posts found
      			}
      			
      			wp_reset_postdata();
          ?>
  			</div>
  			
  			<div class="on-stage-show-type">
  			  <h2>Wild Card</h2>
      		<?php
            $args = array (
              'post_type'     => 'page',
              'order'         => 'DESC',
              'orderby'       => 'meta_value_num',
              'meta_key'      => 'closing_date',
              'meta_query'    => array(
                'relation'    => 'AND',
                array(
                  'key'       => 'show_type',
                  'value'     => 'mainstage',
                ),
                array(
                  'key'       => 'closing_date',
                  'value'     => $today,
                  'type'      => 'DATE',
                  'compare'   => '>='
                )
              )
            );
            
            $mainstage = new WP_Query( $args );
            
            if ( $mainstage->have_posts() ) {
      				while ( $mainstage->have_posts() ) {
      					$mainstage->the_post();
      					get_template_part( 'template-parts/content', 'on-stage' );
      
      				}
      			} else {
      				// no posts found
      			}
      			
      			wp_reset_postdata();
          ?>
  			</div>
  			
  			<div class="on-stage-show-type">
  			  <h2>National Theatre Live</h2>
      		<?php
            $args = array (
              'post_type'     => 'page',
              'order'         => 'DESC',
              'orderby'       => 'meta_value_num',
              'meta_key'      => 'closing_date',
              'meta_query'    => array(
                'relation'    => 'AND',
                array(
                  'key'       => 'show_type',
                  'value'     => 'nt_live',
                ),
                array(
                  'key'       => 'closing_date',
                  'value'     => $today,
                  'type'      => 'DATE',
                  'compare'   => '>='
                )
              )
            );
            
            $mainstage = new WP_Query( $args );
            
            if ( $mainstage->have_posts() ) {
      				while ( $mainstage->have_posts() ) {
      					$mainstage->the_post();
      					get_template_part( 'template-parts/content', 'on-stage' );
      
      				}
      			} else {
      				// no posts found
      			}
      			
      			wp_reset_postdata();
          ?>
  			</div>
  			
  			<div class="on-stage-show-type">
  			  <h2>Bloody Sunday</h2>
      		<?php
            $args = array (
              'post_type'     => 'page',
              'order'         => 'DESC',
              'orderby'       => 'meta_value_num',
              'meta_key'      => 'closing_date',
              'meta_query'    => array(
                'relation'    => 'AND',
                array(
                  'key'       => 'show_type',
                  'value'     => 'mainstage',
                ),
                array(
                  'key'       => 'closing_date',
                  'value'     => $today,
                  'type'      => 'DATE',
                  'compare'   => '>='
                )
              )
            );
            
            $mainstage = new WP_Query( $args );
            
            if ( $mainstage->have_posts() ) {
      				while ( $mainstage->have_posts() ) {
      					$mainstage->the_post();
      					get_template_part( 'template-parts/content', 'on-stage' );
      
      				}
      			} else {
      				// no posts found
      			}
      			
      			wp_reset_postdata();
          ?>
  			</div>
  			
  			<div class="on-stage-show-type">
  			  <h2>Events</h2>
      		<?php
            $args = array (
              'post_type'     => 'page',
              'order'         => 'DESC',
              'orderby'       => 'meta_value_num',
              'meta_key'      => 'closing_date',
              'meta_query'    => array(
                'relation'    => 'AND',
                array(
                  'key'       => 'show_type',
                  'value'     => 'mainstage',
                ),
                array(
                  'key'       => 'closing_date',
                  'value'     => $today,
                  'type'      => 'DATE',
                  'compare'   => '>='
                )
              )
            );
            
            $mainstage = new WP_Query( $args );
            
            if ( $mainstage->have_posts() ) {
      				while ( $mainstage->have_posts() ) {
      					$mainstage->the_post();
      					get_template_part( 'template-parts/content', 'on-stage' );
      
      				}
      			} else {
      				// no posts found
      			}
      			
      			wp_reset_postdata();
          ?>
  			</div>
      </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
