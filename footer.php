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
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'third-rail' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'third-rail' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'third-rail' ), 'third-rail', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/equalize.js/1.0.1/equalize.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>
<script>
  $('#svgHeader').equalize();
//   $('#homeTiles').equalize({children: '.entry-content'});
  
</script>

</body>
</html>
