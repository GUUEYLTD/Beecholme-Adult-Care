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
              Book 5 sessions and save 5% using Coupon Code "<strong>SAVE5</strong>".
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

<script>
    jQuery(document).ready(function($) {
        if( ($('.type').html() == 'Life coach, Therapist') || ($('.type').html() == 'Therapist, Life coach') ){
            console.log('2:'+$('.type').html());
        } else {
            var style = document.createElement('style');
            style.innerHTML =
                '.am-custom-fields .el-row .el-col:nth-last-of-type(2){' +
                'display:none;' +
                '}';
            var ref = document.querySelector('script');
            ref.parentNode.insertBefore(style, ref);
            console.log('1:'+$('.type').html());
        }
    });
</script>

