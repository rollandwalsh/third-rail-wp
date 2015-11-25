<?php
/**
 * The template for displaying 'membership' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<div class="tr-page-container" role="main">

	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<section>
				  <header>
				    <h3>Third Rail Company Members</h3>
				  </header>
				  <div class="tr-company-members">
					  <ul>
					    <?php
							  $args = array(
							  	'post_parent'	=> get_page_by_title( 'Company' )->ID,
							  	'orderby'			=> 'rand',
							  	'post_type'   => 'page',
							  	'post_status' => 'publish',
							  	'posts_per_page'	=>	50
							  );
							  $company_query = new WP_Query( $args );
							  $company_members = $company_query->get_posts();
							  
							  foreach ( $company_members as $member ) {
								  $memberName = get_the_title($member->ID);
	          			$memberLink = get_page_link($member);
	                $memberImage = get_the_post_thumbnail( $member->ID, 'portrait', array( 'class' => 'actor-image' ) );
								  
								  echo '<li>' .
								  	'<a href="' . $memberLink . '" title="' . $memberName . '">' . $memberImage . '</a>' . 
							  		'<div class="tr-card-overlay">' .
							  			'<header>' . 
							  				'<h2><a href="' . $memberLink . '" title="' . $memberName . '">' . $memberName . '</a></h2>'. 
							  			'</header>' .
							  		'</div>' .
								  '</li>';
		  					}
		  					
		  					wp_reset_query();
		  				?>
	  				</ul>
				  </div>
				</section>
			</div>
			<footer>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'thirdrail' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
