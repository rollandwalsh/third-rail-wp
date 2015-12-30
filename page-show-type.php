<?php
/**
 * Template Name: Show Type
 *
 * The template for displaying 'show type' pages
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="tr-page-container" role="main">
	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article class="tr-page-article" id="post-<?php the_ID(); ?>">
			<header class="tr-page-cotent-header">
				<h1 class="tr-page-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="tr-page-content">
				<?php the_content(); ?>
				
				<?php
					$parent = new WP_Query( array(
						'post_type'					=> 'page',
						'post_parent'				=> $post->ID,
						'posts_per_page'		=> -1,
						'order'							=> 'ASC',
						'orderby'						=> 'menu_order',
    		    'meta_key'      		=> 'closing_date',
    		    'meta_query' 	  		=> array( 
              'relation'    		=> 'AND',
    		      array(
    		        'key'   	  		=> '_wp_page_template', 
    		        'value' 	  		=> array('page-show.php')
    		      ),	
              array(
                'key'       		=> 'closing_date',
                'value'     		=> date('Y-m-d'),
                'type'      		=> 'DATE',
                'compare'   		=> '>='
              )

					) );
				
					if ( $parent->have_posts() ) :
						while ( $parent->have_posts() ) : $parent->the_post(); ?>
					
							<article class="tr-show-card" id="post-<?php the_ID(); ?>">
							  <?php if ( has_post_thumbnail() ) { ?>
							    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large' , array( 'class' => '' ) ); ?></a> 
							  <?php } ?>
							  <div class="tr-card-overlay">
							    <header>
							      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ;?></a></h2>
							        <h5><?php echo date('M j - ', strtotime( rwmb_meta( 'opening_date' ) )), date('M j', strtotime( rwmb_meta( 'closing_date' ) )); ?></h5>
							    </header>
							    <a href="#" class="button buy large"><i class="fa fa-ticket fa-lg"></i></a>
							  </div>
							</article>
					
					<?php
						endwhile;
					endif; 
					
					wp_reset_query();
				?>
			</div>
			<footer class="tr-page-content-footer">
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'thirdrail' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
