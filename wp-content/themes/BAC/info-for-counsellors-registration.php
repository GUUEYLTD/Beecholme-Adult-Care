<?php /*Template Name: Info For Counsellors: Registration*/
get_header();
?>


    <div class="counsellors-page-title-wrapper mid-container">
        <?php $back = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>
        <a href="<?php echo $back; ?>" class="counsellors-page-title-back">
            <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-back.svg" alt="arrow-back">
        </a>
        <h1 class="page-title"><?php echo get_the_title(); ?></h1>
    </div>

    <div class="mid-container counsellors-info-wrapper">
        <?php if(get_field('first_block_title', $cur_page) || get_field('first_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading"><?php the_field('first_block_title', $cur_page); ?></div>
            <div class="counsellors-info-item-text">
                <?php the_field('first_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('second_block_title', $cur_page) || get_field('second_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading"><?php the_field('second_block_title', $cur_page); ?></div>
            <div class="counsellors-info-item-text">
                <?php the_field('second_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('third_block_title', $cur_page) || get_field('third_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading"><?php the_field('third_block_title', $cur_page); ?></div>
            <div class="counsellors-info-item-text">
                <?php the_field('third_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('fourth_block_title', $cur_page) || get_field('fourth_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading"><?php the_field('fourth_block_title', $cur_page); ?></div>
            <div class="counsellors-info-item-text">
                <?php the_field('fourth_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="counsellors-info-full-background">
        <h2>Qualifications</h2>
        <div class="mid-container counsellors-info-wrapper">
            <?php if(get_field('qualifications_first_block_title', $cur_page) || get_field('qualifications_first_block_text', $cur_page)) : ?>
            <div class="counsellors-info-item counsellors-info-item-100">
                <div class="counsellors-info-item-heading"><?php the_field('qualifications_first_block_title', $cur_page); ?></div>
                <div class="counsellors-info-item-text">
                    <?php the_field('qualifications_first_block_text', $cur_page); ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if(get_field('qualifications_second_block_title', $cur_page) || get_field('qualifications_second_block_text', $cur_page)) : ?>
            <div class="counsellors-info-item counsellors-info-item-100">
                <div class="counsellors-info-item-heading"> <?php the_field('qualifications_second_block_title', $cur_page); ?></div>
                <div class="counsellors-info-item-text">
                    <?php the_field('qualifications_second_block_text', $cur_page); ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if(get_field('qualifications_third_block_title', $cur_page) || get_field('qualifications_third_block_text', $cur_page)) : ?>
            <div class="counsellors-info-item counsellors-info-item-100">
                <div class="counsellors-info-item-heading"> <?php the_field('qualifications_third_block_title', $cur_page); ?></div>
                <div class="counsellors-info-item-text">
                    <?php the_field('qualifications_third_block_text', $cur_page); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>