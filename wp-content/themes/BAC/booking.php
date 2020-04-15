<?php /*Template Name: Booking */
 get_header();
?>

<div class="booking-page mid-container d-flex">
  <div class="booking-form">
    <?php $userId = $_GET['user']; ?>
    <?php echo do_shortcode('[ameliabooking employee='.$userId.']'); ?>
  </div>
  <div class="about-info">
    <?php get_template_part('template-parts/counsellors/booking-counsellor-information'); ?>
  </div>
</div>
<?php get_footer(); ?>