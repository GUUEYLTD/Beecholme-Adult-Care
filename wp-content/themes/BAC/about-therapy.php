<?php /*Template Name: About Coaching & Therapy*/
 get_header();
?>

<div class="about-bac">
  <div class="information d-flex">
    <div class="top-text text text-bar"><?php the_field(about_top_text); ?></div>
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
    <div class="sign-text top-left">Therapy</div>
    <div class="sign-text top-right">Life<br>Coaching</div>
    <div class="sign-text bottom-left d-flex flex-column align-items-start">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_left.png" alt="">
      <span>Past</span>
    </div>
    <div class="sign-text bottom-right d-flex flex-column align-items-end">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_right.png" alt="">
      <span>Future</span>
    </div>
    <div class="diagram-content">
      <div class="text left-text"><?php the_field('about_diagram_left'); ?></div>
      <div class="text center-text"><?php the_field('about_diagram_center'); ?></div>
      <div class="text right-text"><?php the_field('about_diagram_right'); ?></div>
    </div>
  </div>
    <?php if(get_field('free_welcome_session_heading') || get_field('free_welcome_session_button_text')) : ?>
    <div class="about-therapy-free-welcome-session">
        <?php if(get_field('free_welcome_session_heading')) : ?>
            <div class="about-therapy-free-welcome-session-haeding">
                <?php the_field('free_welcome_session_heading'); ?>
            </div>
        <?php endif; ?>
        <?php if(get_field('free_welcome_session_button_text')) : ?>
            <a class="cta-button" href="/our-counsellors/" target="_blank"><?php the_field('free_welcome_session_button_text'); ?></a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
  <div class="choice">
    <div class="choice-wrapper">
      <h2><?php the_field('about_choice_h'); ?></h2>
      <div class="choice-content d-flex">
        <div class="left-text">
          <?php the_field('about_choice_lt'); ?>
          <p>
            <span>– </span><?php the_field('about_choice_lt_1'); ?><br>
            <span>– </span><?php the_field('about_choice_lt_2'); ?><br>
            <span>– </span><?php the_field('about_choice_lt_3'); ?><br>
            <span>– </span><?php the_field('about_choice_lt_4'); ?><br>
          </p>
        </div>
        <div class="right-text">
          <?php the_field('about_choice_rt'); ?>
          <p>
            <span>– </span><?php the_field('about_choice_rt_1'); ?><br>
            <span>– </span><?php the_field('about_choice_rt_2'); ?><br>
            <span>– </span><?php the_field('about_choice_rt_3'); ?><br>
            <span>– </span><?php the_field('about_choice_rt_4'); ?><br>
            <span>– </span><?php the_field('about_choice_rt_5'); ?><br>
            <span>– </span><?php the_field('about_choice_rt_6'); ?><br>
          </p>
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
          <div class="action-button"><a href="/our-counsellors/?type=Life+coach&therapy=&coaching=&common="><?php the_field('about_rt_b_1'); ?></a></div>
          <div class="action-button"><a href="/our-counsellors/?type=Therapist&therapy=&coaching=&common="><?php the_field('about_rt_b_2'); ?></a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>