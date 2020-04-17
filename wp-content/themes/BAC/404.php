<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="coming-soon">
  <p>The page you are looking for doesn't exist</p>

  <div class="button">
    <a href="<?php echo home_url(); ?>">Go To Homepage</a>
  </div>
</div>

<?php get_footer();
