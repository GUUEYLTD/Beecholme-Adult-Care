<?php /*Template Name: About Coaching & Therapy*/
 get_header();
?>

<div class="about-bac">
  <div class="information d-flex">
    <div class="text-bar left-text">
      <div class="heading"><?php the_field('about_left_h'); ?></div>
      <div class="text"><?php the_field('about_left_t'); ?></div>
    </div>
    <div class="text-bar right-text">
      <div class="heading"><?php the_field('about_right_h'); ?></div>
      <div class="text"><?php the_field('about_right_t'); ?></div>
    </div>
  </div>

  <div class="diagram">
    <div class="diagram-content">
      <div class="text left-text"><?php the_field('about_diagram_left'); ?></div>
      <div class="text center-text"><?php the_field('about_diagram_center'); ?></div>
      <div class="text right-text"><?php the_field('about_diagram_right'); ?></div>
    </div>
  </div>

  <div class="choice">
    <div class="choice-wrapper">
      <h2><?php the_field('about_choice_h'); ?></h2>
      <div class="choice-content d-flex">
        <div class="left-text">
          <?php the_field('about_choice_lt'); ?>
        </div>
        <div class="right-text">
          <?php the_field('about_choice_rt'); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="block3">
    <div class="block3-content">
      <div class="text d-flex">
        <div class="left-text"><?php the_field('about_lt'); ?></div>
        <div class="right-text">
          <?php the_field('about_rt'); ?>
          <div class="action-button"><a href="#"><?php the_field('about_rt_b_1'); ?></a></div>
          <div class="action-button"><a href="#"><?php the_field('about_rt_b_2'); ?></a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>