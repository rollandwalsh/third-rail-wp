<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package third-rail
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-links">
			<ul class="footer-nav">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo file_get_contents(get_template_directory_uri() . "/svg/thirdRailLogo.svg"); ?></a></li>
				<li><a href="<?php echo esc_url( home_url() ); ?>/on-sale">Shows</a></li>
				<li><a href="<?php echo esc_url( home_url() ); ?>/about">About</a></li>
				<li><a href="<?php echo esc_url( home_url() ); ?>/join">Join</a></li>
				<li><a href="<?php echo esc_url( home_url() ); ?>/support">Support</a></li>
				<li><a href="<?php echo esc_url( home_url() ); ?>/contact">Contact</a></li>
				<li><a href="<?php echo esc_url( home_url() ); ?>/press">Press</a></li>
			</ul>
		</div>
		
		<div class="footer-contact">
			<ul class="contact-nav">
				<li><a href="<?php echo esc_url( home_url() ); ?>/location">17 SE 8th Ave PDX, OR 97214</a></li>
				<li><a href="tel:15032351101">503-235-1101</a></li>
				<li><a href="mailto:info@thirdrailrep.org">info@thirdrailrep.org</a></li>
			</ul>
		</div>
		
		<div class="footer-membership">
			<a href="/membership" class="membership"><i class="fa fa-bolt"></i> Membership</a>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>
//  $('#svgHeader').equalize();
//  $('#homeTiles').equalize({children: '.entry-content'});
</script>

</body>
</html>
