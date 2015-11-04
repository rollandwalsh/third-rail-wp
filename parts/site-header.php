<?php
/**
 * Template part for top bar menu
 *
 * @package WordPress
 * @subpackage ThirdRail
 * @since ThirdRail 1.0
 */

?>

<header class="tr-site-header">
  <div class="tr-container">
    <a href="<?php echo home_url(); ?>" class="tr-site-logo"><?php echo file_get_contents(get_stylesheet_directory_uri() . "/svg/thirdRailLogo.svg"); ?></a>
    
    <nav class="tr-site-nav">
      <?php thirdrail_top_bar_r(); ?>

      <a href="#" class="tr-site-nav-button" id="trSiteNavButton"><span class="tr-site-nav-burger"></span></a>
    </nav>
  </div>
</header>
    