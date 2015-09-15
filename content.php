<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php thirdrail_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading...', 'thirdrail' ) ); ?>
	</div>
	<footer>
		<?php if ( get_the_tags() ) { ?><p class="tags"><?php the_tags('', ' '); ?></p><?php } ?>
	</footer>
	<hr>
</article>