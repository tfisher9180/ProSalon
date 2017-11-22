<?php
/**
 * The template for the search form
 *
 *
 * @package ProSalon
**/
?>

<div class="container">
  <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
      <span class="screen-reader-text"><?php esc_html_e( 'Search: Type and press enter.', 'prosalon' ); ?></span>
      <input type="search" class="search-field" placeholder="enter terms and press 'enter'" value="" name="s" title="Search field" />
    </label>
    <input type="submit" class="search-submit" value="Search" />
    <a href="#" class="close">
      <span class="screen-reader-text"><?php esc_html_e( 'Close Search Menu', 'prosalon' ); ?></span>×
    </a>
  </form>
</div>
