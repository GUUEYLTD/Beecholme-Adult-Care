<?php /*Template Name: Booking */
 get_header();
?>

<div class="booking-page mid-container d-flex">
  <div class="booking-form">
    <?php
        $userId = $_GET['user'];
        $service = \BAC\Service::getAllByPractitionerId($userId);
        $shortcode = '[ameliabooking]';
    ?>
    <?php echo do_shortcode($shortcode); ?>
  </div>
  <div class="about-info">
    <?php get_template_part('template-parts/counsellors/single', 'booking'); ?>
  </div>
</div>
<?php get_footer(); ?>