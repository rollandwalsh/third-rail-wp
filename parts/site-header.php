<?php
/**
 * Template part for top bar menu
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>
<header class="site-header contain-to-grid fixed">
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1><a href="<?php echo home_url(); ?>"><?php echo file_get_contents(get_stylesheet_directory_uri() . "/svg/thirdRailLogo.svg"); ?></a></h1>
      </li>
      <li class="toggle-topbar burger-icon"><a href="#"><div></div></a></li>
    </ul>
    <section class="top-bar-section">
      <?php thirdrail_top_bar_r(); ?>
    </section>
  </nav>
</header>