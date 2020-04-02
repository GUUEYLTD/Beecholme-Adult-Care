<?php /*Template Name: FAQ*/
 get_header();
?>

<div class="faq">
  <div class="faq-content">
    <div class="single-topic">
      <div class="topic d-flex justify-content-between">
        <div class="name"><?php the_field('faq_type_1'); ?></div>
        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt=""></div>
      </div>
      <div class="questions-wrapper">
        <div class="questions">
          <div class="question"><?php the_field('faq_1_q1'); ?></div>
          <div class="answer"><?php the_field('faq_1_a1'); ?></div>
          <div class="question"><?php the_field('faq_1_q2'); ?></div>
          <div class="answer"><?php the_field('faq_1_a2'); ?></div>
          <div class="question"><?php the_field('faq_1_q3'); ?></div>
          <div class="answer"><?php the_field('faq_1_a3'); ?></div>
        </div>
      </div>
    </div>
    <div class="single-topic">
      <div class="topic d-flex justify-content-between">
        <div class="name"><?php the_field('faq_type_2'); ?></div>
        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt=""></div>
      </div>
      <div class="questions-wrapper">
        <div class="questions">
          <div class="question"><?php the_field('faq_2_q1'); ?></div>
          <div class="answer"><?php the_field('faq_2_a1'); ?></div>
          <div class="question"><?php the_field('faq_2_q2'); ?></div>
          <div class="answer"><?php the_field('faq_2_a2'); ?></div>
          <div class="question"><?php the_field('faq_2_q3'); ?></div>
          <div class="answer"><?php the_field('faq_2_a3'); ?></div>
        </div>
      </div>
    </div>
    <div class="single-topic">
      <div class="topic d-flex justify-content-between">
        <div class="name"><?php the_field('faq_type_3'); ?></div>
        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt=""></div>
      </div>
      <div class="questions-wrapper">
        <div class="questions">
          <div class="question"><?php the_field('faq_3_q1'); ?></div>
          <div class="answer"><?php the_field('faq_3_a1'); ?></div>
          <div class="question"><?php the_field('faq_3_q2'); ?></div>
          <div class="answer"><?php the_field('faq_3_a2'); ?></div>
          <div class="question"><?php the_field('faq_3_q3'); ?></div>
          <div class="answer"><?php the_field('faq_3_a3'); ?></div>
        </div>
      </div>
    </div>
    <div class="single-topic">
      <div class="topic d-flex justify-content-between">
        <div class="name"><?php the_field('faq_type_4'); ?></div>
        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt=""></div>
      </div>
      <div class="questions-wrapper">
        <div class="questions">
          <div class="question"><?php the_field('faq_4_q1'); ?></div>
          <div class="answer"><?php the_field('faq_4_a1'); ?></div>
          <div class="question"><?php the_field('faq_4_q2'); ?></div>
          <div class="answer"><?php the_field('faq_4_a2'); ?></div>
          <div class="question"><?php the_field('faq_4_q3'); ?></div>
          <div class="answer"><?php the_field('faq_4_a3'); ?></div>
        </div>
      </div>
    </div>
    <div class="single-topic">
      <div class="topic d-flex justify-content-between">
        <div class="name"><?php the_field('faq_type_5'); ?></div>
        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt=""></div>
      </div>
      <div class="questions-wrapper">
        <div class="questions">
          <div class="question"><?php the_field('faq_5_q1'); ?></div>
          <div class="answer"><?php the_field('faq_5_a1'); ?></div>
          <div class="question"><?php the_field('faq_5_q2'); ?></div>
          <div class="answer"><?php the_field('faq_5_a2'); ?></div>
          <div class="question"><?php the_field('faq_5_q3'); ?></div>
          <div class="answer"><?php the_field('faq_5_a3'); ?></div>
        </div>
      </div>
    </div>
    <div class="single-topic">
      <div class="topic d-flex justify-content-between">
        <div class="name"><?php the_field('faq_type_6'); ?></div>
        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.png" alt=""></div>
      </div>
      <div class="questions-wrapper">
        <div class="questions">
          <div class="question"><?php the_field('faq_6_q1'); ?></div>
          <div class="answer"><?php the_field('faq_6_a1'); ?></div>
          <div class="question"><?php the_field('faq_6_q2'); ?></div>
          <div class="answer"><?php the_field('faq_6_a2'); ?></div>
          <div class="question"><?php the_field('faq_6_q3'); ?></div>
          <div class="answer"><?php the_field('faq_6_a3'); ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>