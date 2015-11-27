<?php
/**
 * The sidebar containing the main widget area for 'Company Member' pages
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

$name = get_the_title();
$firstName = strtok($name, " ");
$slug = basename(get_permalink());
$today = getdate();
?>
<aside id="sidebar" class="tr-page-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	
	<article class="tr-sidebar-widget upcoming-shows">
  	<?php
  		$args = array(
	  		'meta_compare'		=> '>',
				'meta_key'        => 'closing_date',
				'meta_value'			=> date('Ymd'),
			  'order' 					=> 'ASC',
			  'orderby'         => 'meta_value',
  	    'post_type'				=> 'page',
  	    'post_status'			=> 'publish',
  	    'posts_per_page'	=> 3,
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
  			<h3 class="tr-sidebar-section-title">Upcoming Shows Featuring <?php echo $firstName; ?></h3>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  			  <div class="tr-sidebar-upcoming-show">
            <?php if ( has_post_thumbnail() ) { ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'poster-small' , array( 'class' => '' ) ); ?></a> 
            <?php } ?>
            <div class="tr-sidebar-upcoming-show-content">
              <header>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ;?></a></h2>
                <?php echo '<time class="opening-date">' .
	                					date( 'F j, Y', strtotime( get_post_meta( get_the_id(), 'opening_date' )[0] ) )  .
	                					'</time> - <time class="closing-date">' .
	                					date( 'F j, Y', strtotime( get_post_meta( get_the_id(), 'closing_date' )[0] ) )  .
	                					'</time>'; ?>
                <?php echo cats(); ?>
              </header>
            </div>
          </div>
        <?php endwhile; ?>
  		<?php }
  	
      wp_reset_postdata();
  	?>
	</article>
	
	<article class="tr-sidebar-widget recent-news">
  	<?php
  		$args = array(
  	    'post_type'				=> 'post',
  	    'post_status'			=> 'publish',
  	    'posts_per_page'	=> 3,
  	    'tag'							=> $slug
  		);
  	
  		$query = new WP_Query( $args );
  		
  		if ( $query->have_posts() ) { ?>
  			<h3 class="tr-sidebar-section-title">News About <?php echo $firstName; ?></h3>
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  			  <div class="tr-sidebar-recent-news-item">
            <?php if ( has_post_thumbnail() ) { ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'poster-small' , array( 'class' => '' ) ); ?></a> 
            <?php } ?>
            <div class="tr-sidebar-recent-news-content">
              <header>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ;?></a></h2>
                <?php echo '<time class="updated date" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( '%s', 'thirdrail' ), get_the_date() ) .'</time>'; ?>
                <?php echo cats(); ?>
              </header>
            </div>
          </div>
        <?php endwhile; ?>
  		<?php }
  	
      wp_reset_postdata();
  	?>
	</article>
	
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>
