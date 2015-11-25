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
  		
  		<div class="tr-show-creators">
    		<ul>
    			<?php if ( !null == role('Playwright', $creatives, false) ) { 
      			if ( isCompanyMember( $playwright ) ) {
        			$className = "company-member";
        			$pageUrl = site_url() . "/company/" . strtolower( str_replace( ' ', '-', $playwright ) );
      			} else {
        			$className = "guest-artist";
        			$pageUrl = site_url() . "/creative/" . strtolower( str_replace( ' ', '-', $playwright ) );
        		}?>
    			  <li class="playwright <?php echo $className; ?>">
    			    <div class="tr-card-overlay">
                <header>
                  <h5>Written by</h5>
                  <h2><a href="<?php echo $pageUrl; ?>"><?php echo $playwright; ?></a></h2>
                </header>
    			    </div>
    			  </li>
          <?php } ?>
          
    			<?php if ( !null == role('Director', $creatives, false) ) { 
      			if ( isCompanyMember( $director ) ) {
        			$className = "company-member";
        			$pageUrl = site_url() . "/company/" . strtolower( str_replace( ' ', '-', $director ) );
      			} else {
        			$className = "guest-artist";
        			$pageUrl = site_url() . "/creative/" . strtolower( str_replace( ' ', '-', $director ) );
        		}?>
    			  <li class="director <?php echo $className; ?>">
    			    <div class="tr-card-overlay">
                <header>
                  <h5>Directed by</h5>
                  <h2><a href="<?php echo $pageUrl; ?>"><?php echo $director; ?></a></h2>
                </header>
    			    </div>
    			  </li>
          <?php } ?>
    		</ul>
  		</div>
  		
  		<?php if ( !null == $cast ) { ?>
  			<div class="tr-show-cast">
  			  <h3 class="tr-section-title">Cast</h3>
  			  <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
      			<?php foreach ($cast as $actor) { 
        			if ( isCompanyMember( $actor[1] ) ) { 
          			$actorPage = get_page_by_title( strtolower( str_replace( ' ', '-', $actor[1] ) ) );
          			$className = "company-member";
          			$pageUrl = get_page_link( $actorPage->ID );
                $imageUrl = get_the_post_thumbnail( $actorPage->ID, 'portrait', array( 'class' => 'actor-image' ) );
        			} else {
          			$actorPage = get_page_by_title( strtolower( str_replace( ' ', '-', $actor[1] ) ) );
          			$className = "guest-artist";
          			$pageUrl = site_url() . "/actor/" . strtolower( str_replace( ' ', '-', $actor[1] ) );
                $imageUrl = get_stylesheet_directory_uri() . "/assets/img/actors/" . strtolower( str_replace( ' ', '-', $actor[1] ) );
        			}
      			?>
        			<li class="role <?php echo $className; ?>">
                <a href="<?php echo $pageUrl ?>" title="<?php echo $actor[1]; ?>"><img src="<?php echo $imageUrl; ?>" alt="<?php echo $actor[1]; ?>"></a> 
                <div class="tr-card-overlay">
                  <header>
                    <h2><a href="<?php echo $pageUrl; ?>" title="<?php $actor[1]; ?>"><?php echo $actor[1]; ?></a></h2>
                    <h5><span>as</span> <?php echo $actor[0]; ?></h5>
                  </header>
                </div>
        			</li>
        		<?php } ?>
  			  </ul>
  			</div>
  		<?php } ?>
  		
  		<?php if ( !null == $creatives ) { ?>
  			<div class="tr-show-creative">
  		    <h3 class="tr-section-title">Creative</h3>
  			  <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5">
      			<?php foreach ($creatives as $creative) { 
        			if ( !in_array($creative[1], array($director, $playwright) ) ) { ?>
          			<li class="role">
          			  <?php if ( isCompanyMember( $creative[1] ) ) { ?>
          			    <header>
            			    <h2><a href="<?php echo site_url(); ?>/company/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/"><?php echo $creative[1]; ?></a></h2>
            			    <h5><?php echo $creative[0]; ?></h5>
          			    </header>
          			  <?php } else { ?>
          			    <header>
            			    <h2><a href="<?php echo site_url(); ?>/creative/<?php echo strtolower( str_replace( ' ', '-', $creative[1] ) ); ?>/"><?php echo $creative[1]; ?></a></h2>
            			    <h5><?php echo $creative[0]; ?></h5>
          			    </header>
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
    			<div class="tr-show-media">
    			  <h3 class="tr-section-title">Media</h3>
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

<section class="tr-page-calendar">
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
    return getEvents(api, createMonths, '<?php the_title(); ?>');
  });
</script>