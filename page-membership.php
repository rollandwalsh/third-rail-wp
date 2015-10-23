<?php
/**
 * The template for displaying 'membership' page
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

get_header(); ?>

<section class="tr-page-banner">
  <div class="tr-container">
    <header class="tr-page-banner-header">
			<h2>Third Rail Membership</h2>
			<h5 id="membershipMessage">Join the Movement!</h5>
			<div class="tr-page-banner-buttons">
			  <a href="/test/membership/" class="button">Learn More</a><a href="#" class="button buy" id="membershipJoin"><i class="fa fa-bolt"></i> Join Now</a>
			</div>
		</header>
		
		<?php echo file_get_contents( get_stylesheet_directory_uri() . "/svg/thirdRailMembership.svg" ); ?>
  </div>
</section>

<div class="tr-page-container" role="main">

	<?php do_action( 'thirdrail_before_content' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<article class="tr-page-article" id="post-<?php the_ID(); ?>">
			<header class="tr-article-header">
				<h1 class="section-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action( 'thirdrail_page_before_entry_content' ); ?>
			<div class="tr-entry-content">
				<?php the_content(); ?>
			</div>
			<footer class="tr-article-footer">
				
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action( 'thirdrail_after_content' ); ?>

	<?php get_sidebar( 'membership' ); ?>
</div>

<section class="tr-page-calendar">
  <div id="trCalendar"></div>
  <div class="tr-calendar-display" id="trCalendarDisplay">
    <div class="tr-calendar-loading">Loading <i class="fa fa-spinner fa-spin"></i></div>
  </div>
</section>

<?php get_footer(); ?>
<script>
  $(function() {
    return getEvents(api, createMonths);
  });
  
  $('#membershipJoin').on('click', function (e) {
  	e.preventDefault();
		$('#membershipMessage').replaceWith('<h5>Would you rather join annually or monthly?</h5>');
		$(this).replaceWith('<br><a href="https://thirdrailrep.secure.force.com/ticket#membership_a0So0000002BughEAC" class="button buy large">$352/year</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" class="button buy large">$29.33/month</a>');
	});	
</script>
