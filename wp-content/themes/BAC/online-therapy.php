<?php /*Template Name: Online THerapy*/
 get_header();
?>

<div class="training-info">
  <div class="text d-flex">
    <div class="left-text"><?php the_field('ot_lefttext'); ?></div>
    <div class="right-text">
      <?php the_field('ot_righttext'); ?>
      <div class="action-button"><a href="#">Start your journey</a></div>
    </div>
  </div>

  <div class="reasons">
    <div class="reasons-content">
      <h2><?php the_field('ot_reasons_heading'); ?></h2>
      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('ot_r_img_1'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('ot_r_h_1'); ?></div>
          <div class="reason-text"><?php the_field('ot_r_t_1'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('ot_r_img_2'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('ot_r_h_2'); ?></div>
          <div class="reason-text"><?php the_field('ot_r_t_2'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('ot_r_img_3'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('ot_r_h_3'); ?></div>
          <div class="reason-text"><?php the_field('ot_r_t_3'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('ot_r_img_4'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('ot_r_h_4'); ?></div>
          <div class="reason-text"><?php the_field('ot_r_t_4'); ?></div>
        </div>
      </div>

      <div class="single-reason d-flex">
        <div class="reason-image">
          <img src="<?php the_field('ot_r_img_5'); ?>" alt="">
        </div>
        <div class="reason-info">
          <div class="reason-heading"><?php the_field('ot_r_h_5'); ?></div>
          <div class="reason-text"><?php the_field('ot_r_t_5'); ?></div>
        </div>
      </div>
      
      <div class="action-button ot-action-button">
        <a href="#"><?php the_field('ot_r_button'); ?></a>
      </div>

      <div class="additional-text">
        <?php the_field('ot_r_add_text'); ?>
      </div>
    </div>
  </div>

  <div class="information">
    <div class="information-content">
      <h2><?php the_field('ot_i_heading'); ?></h2>
      <div class="subheading"><?php the_field('ot_i_subheading'); ?></div>
      <div class="topics d-flex">
        <div class="single-topic">
          <img src="<?php the_field(ot_t_img_1); ?>" alt="">
          <h4><?php the_field(ot_t_h_1); ?></h4>
          <p><?php the_field(ot_t_t_1); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(ot_t_img_2); ?>" alt="">
          <h4><?php the_field(ot_t_h_2); ?></h4>
          <p><?php the_field(ot_t_t_2); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(ot_t_img_3); ?>" alt="">
          <h4><?php the_field(ot_t_h_3); ?></h4>
          <p><?php the_field(ot_t_t_3); ?></p>
        </div>
        <div class="single-topic">
          <img src="<?php the_field(ot_t_img_4); ?>" alt="">
          <h4><?php the_field(ot_t_h_4); ?></h4>
          <p><?php the_field(ot_t_t_4); ?></p>
        </div>
      </div>
      <div class="action-button">
        <a href="#"><?php the_field('ot_i_button'); ?></a>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>