<?php /*Template Name: FAQ-unlimited*/
get_header();
?>

    <div class="faq">
        <div class="faq-content">

            <?php
            $faq_groups = get_field('group');
            foreach ($faq_groups as $faq_group) : ?>
                <div class="single-topic">
                    <div class="topic d-flex justify-content-between">
                        <div class="name"><?php echo $faq_group['question_type']; ?></div>
                        <div class="arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_up.svg" alt=""></div>
                    </div>
                    <div class="questions-wrapper">
                        <div class="questions">
                            <?php foreach ($faq_group['questionanswer'] as $faq_qstansw) : ?>
                                <div class="question"><?php echo $faq_qstansw['question']; ?></div>
                                <div class="answer"><?php echo $faq_qstansw['answer']; ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

<?php get_footer(); ?>