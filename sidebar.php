<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<aside id="sidebar" class="tr-page-sidebar">
	<?php do_action( 'thirdrail_before_sidebar' ); ?>
	
	<article class="tr-sidebar-widget recent-news">
  	<?php
  		$args = array(
  	    'post_type'  	   => 'post',
  	    'post_status'    => 'publish',
  	    'posts_per_page' => 3
  		);
  	
  		$query = new WP_Query( $args );
  		
  		if ( $query->have_posts() ) { ?>
  			<h3 class="tr-sidebar-section-title">Recent News</h3>
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
	
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	
	<?php do_action( 'thirdrail_after_sidebar' ); ?>
</aside>