<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package third-rail
 */

get_header(); ?>

  <?php
    $page_name = get_the_title();
    $tickets_url = rwmb_meta( 'tickets_url' );

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
		<main id="main" class="page-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
