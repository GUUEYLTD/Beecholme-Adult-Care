<?php /*Template Name: Booking */
 get_header();
?>
<div class="booking-page mid-container d-flex">
  <div class="booking-form">
    <?php $userId = $_GET['user']; ?>
    <?php echo do_shortcode('[ameliabooking employee=1]'); ?>
  </div>
  <div class="about-info">

  </div>
</div>
<?php get_footer(); ?>