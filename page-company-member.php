<?php
/**
 * Template Name: Company Member
 *
 * The template for displaying Company Member pages
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header();
$name = get_the_title();
$firstName = strtok($name, " "); 
$slug = basename(get_permalink());
?>

<div class="tr-page-container" role="main">
	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article class="tr-page-article" id="post-<?php the_ID(); ?>">
			<header class="tr-page-cotent-header">
				<h1 class="tr-page-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="tr-page-content company-member">
				<?php the_post_thumbnail( 'portrait', array( 'class' => 'tr-company-member-image' ) ); ?>
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile;?>
	
	<section class="tr-company-member-history">
  	<?php
  		$args = array(
				'meta_key'        => 'closing_date',
			  'order' 					=> 'DESC',
			  'orderby'         => 'meta_value',
  	    'post_type'				=> 'page',
  	    'post_status'			=> 'publish',
  	    'posts_per_page'	=> 50,
  	    'tax_query'				=> array(
	  	    													'relation'			=> 'OR',
	  	    													array (
		  	    																'taxonomy'	=> 'actor',
		  	    																'field'			=> 'slug',
		  	    																'terms'			=> $slug
	  	    													),
	  	    													array (
		  	    																'taxonomy'	=> 'creative',
		  	    																'field'			=> 'slug',
		  	    																'terms'			=> $slug
	  	    													),
  	    )
  		);
  	
  		$query = new WP_Query( $args );
  		
  		if ( $query->have_posts() ) { ?>
  			<h2 class="tr-company-member-section-title"><?php echo $firstName; ?>'s Production History at Third Rail</h3>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  			  <div class="tr-company-member-show">
            <?php if ( has_post_thumbnail() ) { ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'poster-small' , array( 'class' => '' ) ); ?></a> 
            <?php } ?>
            <div class="tr-company-member-show-content">
              <header>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ;?></a></h2>
                <?php echo '<time class="year">' .
	                					date( 'Y', strtotime( get_post_meta( get_the_id(), 'closing_date' )[0] ) )  .
	                					'</time>'; ?>
                <?php echo cats(); ?>
              </header>
            </div>
          </div>
        <?php endwhile; ?>
  		<?php }
  	
      wp_reset_postdata();
  	?>
	</section>

	<?php do_action( 'thirdrail_after_content' ); ?>
</div>

<?php get_sidebar( 'company-member' ); ?>

<?php get_footer(); ?>
