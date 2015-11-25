<?php
/**
 * Template Name: Show
 *
 * The template for displaying 'show' pages
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); 

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
$sponsors = rwmb_meta( 'sponsors' );
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
  case "wildcard":
    $svg = "wildcard";
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

$playwright = role('Playwright', $creatives, false);
$director = role('Director', $creatives, false);

function isCompanyMember( $name ) {
  $args = array(
  	'child_of'     => get_page_by_title( 'Company' )->ID,
  	'post_type'    => 'page',
  	'post_status'  => 'publish'
  );
  $company_members = get_pages($args);
  
  foreach ( $company_members as $member ) {
    if ( $name == $member->post_title ) {
      return $member->guid;
    } else {
      return false;
    }
  }
} /* test to determin if provided name is a company member */
?>

<section class="tr-page-banner">
  <div class="tr-container">
    <header class="tr-page-banner-header">
		  <?php the_title( '<h2>', '</h2>' ); ?>
			<?php if ( !null == role('Playwright', $creatives, false) ) { role('Playwright', $creatives, true, '<h5>by ', '</h5>'); } ?>
			
			<div class="tr-page-banner-buttons">
  			<?php if ($current_date <= $closing_date && isset($tickets_url) && $tickets_url !== '') { ?>
  			  <a href="<?php echo $tickets_url; ?>" class="button buy"><i class="fa fa-ticket"></i> Book Your Tickets</a>
        <?php } ?>
			</div>
		</header>
		
		<?php echo file_get_contents(get_template_directory_uri() . "/svg/" . $svg . ".svg"); ?>
  </div>
</section>
	
<section class="tr-show-details">
  <div class="tr-show-detail">
    <?php if ( !null == $opening_date && !null == $closing_date ) { ?>
      <h3><?php if ( $opening_date == $closing_date ) { 
                  echo date( 'F j', strtotime( $opening_date ) );
                } else {
                  echo date( 'M j', strtotime( $opening_date ) ) . ' - ' . date( 'M j', strtotime( $closing_date ) );
                } ?></h3>
      <h5><?php if ( date( 'Y', strtotime( $opening_date ) ) == date( 'Y', strtotime( $closing_date ) ) ) { 
	                                echo date( 'Y', strtotime( $opening_date ) ); 
	                              } else { 
  	                              echo date( 'Y', strtotime( $opening_date ) ) . ' - ' . date( 'Y', strtotime( $closing_date ) );
  	                            } ?></h5>
    <?php } ?>
  </div>
  <div class="tr-show-detail">
    <?php if ( !null == $show_times ) { ?><h3><?php echo $show_times; ?></h3><?php } ?>
    <?php if ( !null == $show_days ) { ?><h5 class="subheader"><?php echo $show_days; ?></h5><?php } ?>
  </div>
  <div class="tr-show-detail">
    <?php if ( isset( $venue ) ) { ?><h3><?php echo $venue; ?></h3>
    <h5 class="subheader"><a href="/directions#<?php echo $show_venue; ?>">Map</a></h5><?php } ?>
  </div>
  <div class="tr-show-detail">
    <?php if ( !null == $ticket_price ) { ?><h3><?php echo $ticket_price; ?></h3><?php } ?>
    <h5 class="subheader">Free for <a href="/membership/">Members</a></h5>
  </div>
</section>

<div id="primary" class="tr-page-container" role="main">

  	<?php do_action( 'thirdrail_before_content' ); ?>
  
  	<?php while ( have_posts() ) : the_post(); ?>
  		<article class="tr-page-article" id="post-<?php the_ID(); ?>">
  			<header class="tr-article-header">
  				<h1 class="tr-page-title show"><?php the_title(); ?></h1>
  			</header>
  			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
  			<div class="tr-show-content">
  				<?php the_content(); ?>
  			</div>
  			<footer>
  				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'thirdrail' ), 'after' => '</p></nav>' ) ); ?>
  				<p><?php the_tags(); ?></p>
  			</footer>
  		</article>
  	<?php endwhile;?>
  
  	<?php do_action( 'thirdrail_after_content' ); ?>
  	
  	<div class="tr-container">
		
  		<?php if ( !null == $run_time ) { ?> <p>Runtime: <strong><?php echo $run_time; ?></strong></p> <?php } ?>
  		
  		<ul class="small-block-grid-1 medium-block-grid-2">
  			<?php if ( !null == role('Playwright', $creatives, false) ) { ?>
  			  <li class="playwright">
  			    <h5>Written by</h5>
  			      <?php if ( isCompanyMember( $playwright ) ) { ?>
      			    <a href="<?php echo site_url(); ?>/company/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/" class="button expand"><i class="fa fa-bolt"></i> <?php echo $playwright; ?></a>
      			  <?php } else { ?>
      			    <a href="<?php echo site_url(); ?>/creative/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/" class="button other expand"><i class="fa fa-user"></i> <?php echo $playwright; ?></a>
      			  <?php } ?>
  			  </li>
        <?php } ?>
  			
  			<?php if ( !null == role('Director', $creatives, false) ) { ?>
  			  <li class="director">
  			    <h5>Directed by</h5>
  			      <?php if ( isCompanyMember( $director ) ) { ?>
      			    <a href="<?php echo site_url(); ?>/company/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/" class="button expand"><i class="fa fa-bolt"></i> <?php echo $director; ?></a>
      			  <?php } else { ?>
      			    <a href="<?php echo site_url(); ?>/creative/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/" class="button other expand"><i class="fa fa-user"></i> <?php echo $director; ?></a>
      			  <?php } ?>
  			  </li>
        <?php } ?>
  		</ul>
  		
  		<?php if ( !null == $cast ) { ?>
  			<h3 class="section-title">Cast</h3>
  			<div class="show-section">
  			  <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
      			<?php foreach ($cast as $actor) { ?>
        			<li class="role-block">
        			  <?php if ( isCompanyMember( $actor[1] ) ) { 
          			  $actorPage = get_page_by_title( $actor[1] ); ?>
          			  <?php echo get_the_post_thumbnail( $actorPage->ID, 'portrait', array( 'class' => 'actor-image' ) ); ?>
          			  <a href="<?php echo site_url(); ?>/company/<?php echo strtolower( str_replace( ' ', '-', $actor[1] ) ); ?>/" class="button small expand"><i class="fa fa-bolt"></i> <?php echo $actor[1]; ?></strong></a>
                <?php } else { 
                  $actorSlug = strtolower( str_replace( ' ', '-', $actor[1] ) ); ?>
          			  <img src="<?php echo site_url() . '/wp-content/themes/third-rail-wp/assets/img/actors/' . $actorSlug; ?>">
          			  <a href="<?php echo site_url(); ?>/actor/<?php echo $actorSlug; ?>/" class="button other small expand"><i class="fa fa-user"></i> <?php echo $actor[1]; ?></strong></a>
                <?php } ?>
                <p class="actor-role"><span><?php echo $actor[0]; ?></span></p>
        			</li>
        		<?php } ?>
  			  </ul>
  			</div>
  		<?php } ?>
  		
  		<?php if ( !null == $creatives ) { ?>
  		  <h3 class="section-title">Creative</h3>
  			<div class="show-section">
  			  <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
      			<?php foreach ($creatives as $creative) { 
        			if ( !in_array($creative[1], array($director, $playwright) ) ) { ?>
          			<li class="role-block">
          			  <?php if ( isCompanyMember( $creative[1] ) ) { ?>
          			    <h6><?php echo $creative[0]; ?></h6>
          			    <a href="<?php echo site_url(); ?>/company/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/" class="button small expand"><i class="fa fa-bolt"></i> <?php echo $creative[1]; ?></a>
          			  <?php } else { ?>
          			    <h6><?php echo $creative[0]; ?></h6>
          			    <a href="<?php echo site_url(); ?>/creative/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/" class="button other small expand"><i class="fa fa-user"></i> <?php echo $creative[1]; ?></a>
          			  <?php } ?>
          			</li>
        		<?php } } ?>
          </ul>
        </div>
  		<?php } ?>
  		
  		<?php
  			$args = array(
  		    'post_type'  	   => 'post',
  		    'posts_per_page' => '5',
    	    'meta_query' 	   => array( 
            array(
              'key'        => 'parent_show',
              'value'      => get_the_title()
            )
    	    ),
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
  			
  			if ( $query->have_posts() ) { ?>
    			<h3 class="section-title">Media</h3>
    			<div class="show-section">
    			  <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
      				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <li <?php post_class() ?> id="post-<?php the_ID(); ?>">
            		  <div class="media-container">
            		    <?php the_content(); ?>
            		  </div>
            		</li>
      				<?php endwhile; ?>
    			  </ul>
    			</div>
  			<?php }
  		
        wp_reset_postdata();
  		?>
  		
  		<?php if ( !null == $sponsors ) { ?>
  		  <h3 class="section-title">Sponsors</h3>
  			<div class="show-section">
  			
  			</div>
  		<?php } ?>

	</div>
	
</div><!-- #primary -->

<section class="tr-home-calendar">
  <div class="tr-container">
    <div id="trCalendar"></div>
    <div class="tr-calendar-display" id="trCalendarDisplay">
      <div class="tr-calendar-loading">Loading <i class="fa fa-spinner fa-spin"></i></div>
    </div>
  </div>
</section>

<?php get_sidebar( 'show' ); ?>

<?php get_footer(); ?>

<script>
  $(function() {
    return getEvents(api, createMonths);
  });
</script>