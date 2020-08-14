<?php /*Template Name: Booking */
 get_header();
?>

<div class="booking-page mid-container d-flex">
  <div class="booking-form">
      <div class="text-block-800 text-block-800-consellors">
          <p style="font-family: InterSemiBold, sans-serif; font-size:18px">
              BAC PROMO
          </p>
          <p>
              Book 5 sessions and save 5% using Coupon Code "<strong>SAVE 5</strong>".
          </p>
          <p>
              Book 10 sessions and save 10% using Coupon Code "<strong>SAVE10</strong>"
          </p>
      </div>
    <?php
        $userId = $_GET['user'];
        $service = \BAC\Service::getAllByPractitionerId($userId);
        $shortcode = '[ameliabooking employee='.$userId.' service=' . $service[0]->id . ']';
    ?>
    <?php echo do_shortcode($shortcode); ?>

  </div>
  <div class="about-info">
    <?php get_template_part('template-parts/counsellors/single', 'booking'); ?>
  </div>
</div>
<?php get_footer(); ?>