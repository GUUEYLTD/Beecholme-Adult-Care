<?php /*Template Name: Online Life Coaching*/
 get_header();
?>

<div class="training-info coaching-info">
  <div class="text d-flex">
    <div class="left-text"><?php the_field('lc_lefttext'); ?></div>
    <div class="right-text">
      <?php the_field('lc_righttext'); ?>
      <div class="action-button"><a href="#"><?php the_field('lc_righttext_button'); ?></a></div>
    </div>
  </div>

  <div class="reasons">
    <div class="reasons-content">
      <h2><?php the_field('lc_reasons_heading'); ?></h2>
      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('lc_r_img_1'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('lc_r_h_1'); ?></div>
          <div class="reason-text"><?php the_field('lc_r_t_1'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('lc_r_img_2'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('lc_r_h_2'); ?></div>
          <div class="reason-text"><?php the_field('lc_r_t_2'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('lc_r_img_3'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('lc_r_h_3'); ?></div>
          <div class="reason-text"><?php the_field('lc_r_t_3'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('lc_r_img_4'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('lc_r_h_4'); ?></div>
          <div class="reason-text"><?php the_field('lc_r_t_4'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('lc_r_img_5'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('lc_r_h_5'); ?></div>
          <div class="reason-text"><?php the_field('lc_r_t_5'); ?></div>
        </div>
      </div>

      <div class="additional-text">
        <?php the_field('lc_r_add_text'); ?>
      </div>

      <div class="action-button ot-action-button">
        <a href="#"><?php the_field('lc_r_button'); ?></a>
      </div>
    </div>
  </div>

  <div class="information">
    <div class="information-content">
      <h2><?php the_field('lc_i_heading'); ?></h2>
      <div class="subheading"><?php the_field('lc_i_subheading'); ?></div>
      <div class="topics d-flex">
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_1); ?>" alt="">
          <h4><?php the_field(lc_t_h_1); ?></h4>
          <p><?php the_field(lc_t_t_1); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_2); ?>" alt="">
          <h4><?php the_field(lc_t_h_2); ?></h4>
          <p><?php the_field(lc_t_t_2); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_3); ?>" alt="">
          <h4><?php the_field(lc_t_h_3); ?></h4>
          <p><?php the_field(lc_t_t_3); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_4); ?>" alt="">
          <h4><?php the_field(lc_t_h_4); ?></h4>
          <p><?php the_field(lc_t_t_4); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_5); ?>" alt="">
          <h4><?php the_field(lc_t_h_5); ?></h4>
          <p><?php the_field(lc_t_t_5); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_6); ?>" alt="">
          <h4><?php the_field(lc_t_h_6); ?></h4>
          <p><?php the_field(lc_t_t_6); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_7); ?>" alt="">
          <h4><?php the_field(lc_t_h_7); ?></h4>
          <p><?php the_field(lc_t_t_7); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(lc_t_img_8); ?>" alt="">
          <h4><?php the_field(lc_t_h_8); ?></h4>
          <p><?php the_field(lc_t_t_8); ?></p>
        </div>
      </div>
      <div class="action-button">
        <a href="#"><?php the_field('lc_i_button'); ?></a>
      </div>
    </div>
  </div>

  <div class="slider">
    <div class="slider-content">
      <h3><?php the_field('lc_slider_heading'); ?></h3>
      <div id="coaches-slider" class="owl-carousel owl-theme review-carousel">
        <div class="single-item"><img src="<?php the_field('lc_item_1'); ?>" alt=""></div>
        <div class="single-item"><img src="<?php the_field('lc_item_2'); ?>" alt=""></div>
        <div class="single-item"><img src="<?php the_field('lc_item_3'); ?>" alt=""></div>
        <div class="single-item"><img src="<?php the_field('lc_item_4'); ?>" alt=""></div>
        <div class="single-item"><img src="<?php the_field('lc_item_5'); ?>" alt=""></div>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>