<?php
/**
 * Template Name: NT Live
 *
 * @package third-rail
 */

get_header(); ?>

  <?php
    $cast = rwmb_meta( 'cast' );
    $creatives = rwmb_meta( 'creative' );
    
    $tickets_url = rwmb_meta( 'tickets_url' );

    function creative($role, $before = '', $after = '', $echo = true) {
    	foreach (rwmb_meta( 'creatives' ) as &$creative) {$name = is_null( $creative[0] == $role ) ? '' : $creative[1];}
    	if ( strlen($name) == 0 )
    		return;
      
      $name = $before . $name . $after;
      if ( $echo )
    		echo $name;
    	else
    		return $name;
    }
  ?>

	<header class="page-header">
		<div class="container">
			<div class="info-section">
				<div class="content">
					<?php the_title( '<h2>', '</h2>' ); ?>
					<?php creative('Playwright', '<h5>by ', '</h5>'); ?>
					
					<a href="<?php echo $tickets_url; ?>" class="button buy large"><i class="fa fa-ticket"></i> Book Now</a>
				</div>
			</div>
			<div class="graphic-section">
				<?php echo file_get_contents(get_template_directory_uri() . "/svg/ntLive.svg"); ?>
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
echo rwmb_meta('open');
?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
