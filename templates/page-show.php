<?php
/**
 * Template Name: Show
 *
 * @package third-rail
 */

get_header(); ?>

  <?php
    $cast = rwmb_meta( 'cast' );
    $creatives = rwmb_meta( 'creatives' );    
    $show_type = rwmb_meta( 'show_type' );
    $opening_date = rwmb_meta( 'opening_date' );
    $closing_date = rwmb_meta( 'closing_date' );
    $current_date = substr(date('c'), 0, 10);
    $show_times = rwmb_meta( 'show_times' );
    $show_days = rwmb_meta( 'show_days' );
    $show_venue = rwmb_meta( 'venue' );
    $run_time = rwmb_meta( 'run_time' );
    $tickets_url = rwmb_meta( 'tickets_url' );
    $ticket_price = rwmb_meta( 'ticket_price' );
    
    switch ($show_venue) {
      case "imago":
        $venue = "Imago Theater";
        break;
      case "coho":
        $venue = "CoHo Theater";
        break;
      case "winningstad":
        $venue = "Winningstad Theater";
        break;
      case "world_trade_center":
        $venue = "World Trade Center Theater";
        break;
      case "ifcc":
        $venue = "Interstate Firehouse Cultural Center";
        break;
      default:
        $venue = "Imago Theater";
    } /* get the $venue name */

    switch ($show_type) {
      case "mainstage":
        $svg = camelCase(get_the_title());
        break;
      case "nt_live":
        $svg = "ntLive";
        break;
      case "wild_card":
        $svg = "thirdRailMembership";
        break;
      case "bloody_sunday":
        $svg = "bloodySunday";
        break;
      case "event":
        $svg = "thirdRailMembership";
        break;
      default:
        $svg = "thirdRailMembership";
    } /* get the svg file based on show type */

    if ( !null == $creatives ) {
      function role($role, $array, $echo = true, $before = '', $after = '') {
      	$name = '';
      	foreach ($array as $entry) {
        	if ($entry[0] === $role) {
            $name = $entry[1];
          }
        }
      	if ( $name === '' )
      		return;
        
        $name = $before . $name . $after;
        if ( $echo )
      		echo $name;
      	else
      		return $name;
      }
    } /* get the name of a creative, optionally wrap / print it */
  ?>

	<header class="page-header">
		<div id="svgHeader" class="container">
			<div class="info-section">
				<div class="content">
				  <hr>
					<?php the_title( '<h2>', '</h2>' ); ?>
					<?php if ( !null == role('Playwright', $creatives, false) ) { role('Playwright', $creatives, true, '<h5>by ', '</h5>'); } ?>
					
					<?php if ($current_date <= $closing_date && isset($tickets_url) && $tickets_url !== '') { ?>
					  <a href="<?php echo $tickets_url; ?>" class="button buy large"><i class="fa fa-ticket"></i> Book Now</a>
          <?php } ?>
				  <hr>
				</div>
			</div>
			<div class="graphic-section">
				<?php echo file_get_contents(get_template_directory_uri() . "/svg/" . $svg . ".svg"); ?>
			</div>
		</div>
	</header>
	
	<section class="page-banner">
	  <div class="show-dates">
	    <?php if ( !null == $opening_date && !null == $closing_date ) { ?>
        <h3><?php if ( $opening_date == $closing_date ) { 
                    echo date( 'F j', strtotime( $opening_date ) );
                  } else {
                    echo date( 'M j', strtotime( $opening_date ) ) . ' - ' . date( 'M j', strtotime( $closing_date ) );
                  } ?></h3>
        <h6 class="subheader"><?php if ( date( 'Y', strtotime( $opening_date ) ) == date( 'Y', strtotime( $closing_date ) ) ) { 
  	                                echo date( 'Y', strtotime( $opening_date ) ); 
  	                              } else { 
    	                              echo date( 'Y', strtotime( $opening_date ) ) . ' - ' . date( 'Y', strtotime( $closing_date ) );
    	                            } ?></h6>
      <?php } ?>
	  </div>
	  <div class="show-times">
	    <?php if ( !null == $show_times ) { ?><h3><?php echo $show_times; ?></h3><?php } ?>
	    <?php if ( !null == $show_days ) { ?><h6 class="subheader"><?php echo $show_days; ?></h6><?php } ?>
	  </div>
	  <div class="show-venue">
	    <?php if ( isset( $venue ) ) { ?><h3><?php echo $venue; ?></h3>
	    <h6 class="subheader"><a href="/directions#<?php echo $show_venue; ?>">Map</a></h6><?php } ?>
	  </div>
	  <div class="show-cost">
	    <?php if ( !null == $ticket_price ) { ?><h3><?php echo $ticket_price; ?></h3><?php } ?>
	    <h6 class="subheader">Free for <a href="/membership/">Members</a></h6>
	  </div>
	</section>

	<div id="primary" class="page-content-area">
		<main id="main" class="show-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'show' ); ?>
			<?php endwhile; // End of the loop. ?>
			
			<?php if ( !null == $run_time ) { ?> <p>Runtime: <strong><?php echo $run_time; ?></strong></p> <?php } ?>
			
			<div class="director-playwright">
  			<?php if ( !null == role('Playwright', $creatives, false) ) { ?>
  			  <div class="playwright">
  			    <h5>Written by</h5>
  			    <a href="#" class="button expand other"><i class="fa fa-user"></i> <?php role('Playwright', $creatives, true); ?></a>
  			  </div>
        <?php } ?>
  			
  			<?php if ( !null == role('Director', $creatives, false) ) { ?>
  			  <div class="director">
  			    <h5>Directed by</h5>
  			    <a href="#" class="button expand"><i class="fa fa-bolt"></i> <?php role('Director', $creatives, true); ?></a>
  			  </div>
        <?php } ?>
			</div>
			
			<?php if ( !null == $cast ) { ?>
  			<h3 class="section-title">Cast</h3>
  			<div class="show-section">
    			<?php foreach ($cast as $actor) { ?>
      			<div class="role-block">
      			  <img src="<?php ?>">
      			  <p><a href="#"><i class="fa fa-bolt"></i> <strong><?php echo $actor[1]; ?></strong></a><br><?php echo $actor[0]; ?></p>
      			</div>
      		<?php } ?>
  			</div>
  		<?php } ?>
			
			<?php if ( !null == $creatives ) { ?>
			  <h3 class="section-title">Creative</h3>
  			<div class="show-section">
    			<?php foreach ($creatives as $creative) { ?>
      			<div class="role-block">
      			  <p><?php echo $creative[0]; ?><br><a href="#" class="button other small"><i class="fa fa-user"></i> <?php echo $creative[1]; ?></a></p>
      			</div>
      		<?php } ?>
        </div>
      <?php } ?>
			
			<h3 class="section-title">Media</h3>
			
			<h3 class="section-title">Sponsors</h3>

		</main><!-- #main -->
		
    <?php get_sidebar( 'show' ); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>

<script>
  $(function() {
    return getEvent(api, createMonths, show);
  });

  $('#svgHeader').equalize();
</script>
