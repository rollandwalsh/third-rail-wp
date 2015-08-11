<?php
/**
 * The template for displaying 'membership' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

  <header class="page-header">
  	<div id="svgHeader" class="row" data-equalizer>
  		<div class="info-section" data-equalizer-watch>
  			<div id="membershipJoinContainer" class="content">
  			  <hr>
  				<h2>Third Rail Membership</h2>
  				<h5 id="membershipMessage">Join the Movement!</h5>
  				<a href="#" class="button buy large" id="membershipJoin"><i class="fa fa-bolt"></i> Join Now</a>
  			  <hr>
  			</div>
  		</div>
  		<div class="graphic-section" data-equalizer-watch>
  			<?php echo file_get_contents( get_stylesheet_directory_uri() . "/svg/thirdRailMembership.svg" ); ?>
  		</div>
  	</div>
  </header>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="section-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>

	</div>
	<?php get_sidebar( 'membership' ); ?>
</div>
<?php get_footer(); ?>
<script>
  $(function() {
    return getEvents(api, createMonths);
  });
  
	$('#membershipJoin').on('click', function (e) {
  	e.preventDefault();
		$('#membershipMessage').replaceWith('<h5>Would you rather join annually or monthly?</h5>');
		$(this).replaceWith('<a href="https://thirdrailrep.secure.force.com/ticket#membership_a0So0000002BughEAC" class="button buy large">$352/year</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" class="button buy large">$29.33/month</a>');
	});	
</script>
