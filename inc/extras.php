<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package third-rail
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function third_rail_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'third_rail_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function third_rail_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'third-rail' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'third_rail_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function third_rail_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'third_rail_render_title' );
endif;

if ( ! function_exists('camelCase'))
{
  function camelCase($subject, $delimiters=' _-', $lcfirst=true)
  {
    if ( ! is_string($subject))
    {
      throw new Exception("Subject must be of type string");
    }
    $subject = preg_replace('/[\s]+/', ' ', $subject);
 
    $subject = preg_split("/[$delimiters]/", $subject, -1, PREG_SPLIT_NO_EMPTY);
 
    foreach ($subject as $key => &$word)
    {
      $word = preg_replace('/[[:punct:]]/', '', $word);
 
      if (preg_match('/[A-Z]+$/', $word)) $word = ucfirst($word);
 
      else $word = ucfirst( strtolower($word) );
    }
    $subject = implode('', $subject);
 
    if ($lcfirst)
    {
      return function_exists('lcfirst') ? lcfirst($subject)
      :
      strtolower($subject[0]).substr($subject,1);
    }
    return $subject;
  }
}