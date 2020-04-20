<?php /*Template Name: Landing*/
 get_header();
?>

<div class="landing">

  <div class="block1">
    <div class="top-bar-bg"></div>
    <div class="text">
      <h2><?php the_field('b1_h'); ?></h2>
      <h4><?php the_field('b1_sh'); ?></h4>
      <div class="message"><?php the_field('b1_t'); ?></div>
      <div class="action-button">
        <a href="https://docs.google.com/forms/d/e/1FAIpQLScYEKnq_4eo1ABqfmYMvus3BXyswC44vqT4agy9M-I8zlbDgg/viewform?vc=0&c=0&w=1" target="_blank"><?php the_field('b1_b'); ?></a>
      </div>
    </div>
  </div>

  <div class="block2">
    <div class="content d-flex">
      <div class="text left-text">
        <h4><?php the_field('b2_lh'); ?></h4>
        <div><?php the_field('b2_lt'); ?></div>
      </div>
      <div class="text right-text">
        <h4><?php the_field('b2_rh'); ?></h4>
        <div><?php the_field('b2_rt'); ?></div>
      </div>
    </div>
  </div>

  <div class="block3">
    <div class="content">
      <h2><?php the_field('block3_h'); ?></h2>
      <div class="benefits d-flex">
        <div class="single-benefit">
          <img src="<?php the_field('block3_bi_1'); ?>" alt="">
          <h4><?php the_field('block3_bh_1'); ?></h4>
          <div class="message"><?php the_field('block3_bt_1'); ?></div>
        </div>
        <div class="single-benefit">
          <img src="<?php the_field('block3_bi_2'); ?>" alt="">
          <h4><?php the_field('block3_bh_2'); ?></h4>
          <div class="message"><?php the_field('block3_bt_2'); ?></div>
        </div>
        <div class="single-benefit">
          <img src="<?php the_field('block3_bi_3'); ?>" alt="">
          <h4><?php the_field('block3_bh_3'); ?></h4>
          <div class="message"><?php the_field('block3_bt_3'); ?></div>
        </div>
        <div class="single-benefit">
          <img src="<?php the_field('block3_bi_4'); ?>" alt="">
          <h4><?php the_field('block3_bh_4'); ?></h4>
          <div class="message"><?php the_field('block3_bt_4'); ?></div>
        </div>
      </div>
    </div>
  </div>

  <div class="block4">
    <div class="content">
      <h2><?php the_field('block4_h'); ?></h2>
      <div class="steps">
        <div class="single-step d-flex">
          <div class="step-number">step 1</div>
          <div class="image-wrapper">
            <img src="<?php the_field('block4_si_1'); ?>" alt="">
          </div>
          <div class="text d-flex">
            <h4><?php the_field('block4_sh_1'); ?></h4>
            <div class="message">
              <?php the_field('block4_st_1'); ?>
            </div>
          </div>
        </div>
        <div class="single-step d-flex">
          <div class="step-number">step 2</div>
          <div class="image-wrapper">
            <img src="<?php the_field('block4_si_2'); ?>" alt="">
          </div>
          <div class="text d-flex">
            <h4><?php the_field('block4_sh_2'); ?></h4>
            <div class="message">
              <?php the_field('block4_st_2'); ?>
            </div>
          </div>
        </div>
        <div class="single-step d-flex">
          <div class="step-number">step 3</div>
          <div class="image-wrapper">
            <img src="<?php the_field('block4_si_3'); ?>" alt="">
          </div>
          <div class="text d-flex">
            <h4><?php the_field('block4_sh_3'); ?></h4>
            <div class="message">
              <?php the_field('block4_st_3'); ?>
            </div>
          </div>
        </div>
        <div class="single-step d-flex">
          <div class="step-number">step 4</div>
          <div class="image-wrapper">
            <img src="<?php the_field('block4_si_4'); ?>" alt="">
          </div>
          <div class="text d-flex">
            <h4><?php the_field('block4_sh_4'); ?></h4>
            <div class="message">
              <?php the_field('block4_st_4'); ?>
            </div>
          </div>
        </div>
        <div class="single-step d-flex">
          <div class="step-number">step 5</div>
          <div class="image-wrapper">
            <img src="<?php the_field('block4_si_5'); ?>" alt="">
          </div>
          <div class="text d-flex">
            <h4><?php the_field('block4_sh_5'); ?></h4>
            <div class="message">
              <?php the_field('block4_st_5'); ?>
            </div>
          </div>
        </div>
        <div class="single-step d-flex">
          <div class="step-number">step 6</div>
          <div class="image-wrapper">
            <img src="<?php the_field('block4_si_6'); ?>" alt="">
          </div>
          <div class="text d-flex">
            <h4><?php the_field('block4_sh_6'); ?></h4>
            <div class="message">
              <?php the_field('block4_st_6'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="button-wrapper">
        <div class="action-button">
          <a href="https://docs.google.com/forms/d/e/1FAIpQLScYEKnq_4eo1ABqfmYMvus3BXyswC44vqT4agy9M-I8zlbDgg/viewform?vc=0&c=0&w=1" target="_blank"><?php the_field('b1_b'); ?></a>
        </div>
      </div>
    </div>
  </div>

  <div class="block5">
    <h3>For More Information<br>please contact us</h3>
    <div class="link d-flex justify-content-center align-items-center">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_mail.png" alt="">
      <a href="mailto:online@beecholmeadultcare.co.uk">online@beecholmeadultcare.co.uk</a>
    </div>
  </div>

</div>

<?php get_footer(); ?>