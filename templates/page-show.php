<?php
/**
 * Template Name: Show
 *
 * @package third-rail
 */

get_header(); ?>

  <?php
    $cast = rwmb_meta( 'cast' );
    $creatives = rwmb_meta( 'creative' );    
    $show_type = rwmb_meta( 'show_type' );
    $opening_date = rwmb_meta( 'opening_date' );
    $closing_date = rwmb_meta( 'closing_date' );
    $current_date = substr(date('c'), 0, 10);
    $tickets_url = rwmb_meta( 'tickets_url' );
    
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

    function creative($role, $before = '', $after = '', $echo = true) {
    	foreach (rwmb_meta( 'creatives' ) as &$creative) {$name = is_null( $creative[0] == $role ) ? '' : $creative[1];}
    	if ( strlen($name) == 0 )
    		return;
      
      $name = $before . $name . $after;
      if ( $echo )
    		echo $name;
    	else
    		return $name;
    } /* get the name of a creative, optionally wrap / print it */
  ?>

	<header class="page-header">
		<div id="svgHeader" class="container">
			<div class="info-section">
				<div class="content">
				  <hr>
					<?php the_title( '<h2>', '</h2>' ); ?>
					<?php creative('Playwright', '<h5>by ', '</h5>'); ?>
					
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

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<?php 
$valuess = rwmb_meta( 'cast' ); 
foreach ($valuess as $values) {
while (list($key, $value) = each($values)) { 
    echo "$key => $value \r\n"; 
    if ($key == 3) { 
        $values[4] = 'd'; 
    } 
    if ($key == 4) { 
        $values[5] = 'e'; 
    } 
} }
?>

			<?php while ( have_posts() ) : the_post(); ?>
        
				<?php get_template_part( 'template-parts/content', 'show' ); ?>
				
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
