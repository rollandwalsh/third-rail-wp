<?php
/**
<<<<<<< HEAD
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
=======
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package third-rail
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
 */

?>

<<<<<<< HEAD
    </section>
    
  	<footer class="site-footer">
  		<div class="footer-links">
  			<ul class="footer-nav">
  				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo file_get_contents( get_stylesheet_directory_uri() . "/svg/thirdRailLogo.svg" ); ?></a></li>
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
	
    <footer class="row">
    	<?php do_action( 'thirdrail_before_footer' ); ?>
    	<?php dynamic_sidebar( 'footer-widgets' ); ?>
    	<?php do_action( 'thirdrail_after_footer' ); ?>
    </footer>
    <a class="exit-off-canvas"></a>
    
    	<?php do_action( 'thirdrail_layout_end' ); ?>
    	</div>
    </div>
    <?php wp_footer(); ?>
    <?php do_action( 'thirdrail_before_closing_body' ); ?>
  </body>
</html>
=======
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
</body>
</html>
>>>>>>> 084f6e5e4c6896368154a1af98702b191957ed64
