<?php /*Template Name: Info For Counsellors: Main*/
get_header();
?>

    <?php if(get_field('counsellors_info_image', $cur_page)) : ?>
    <div class="mid-container counsellors_info_image">
        <img src="<?php the_field('counsellors_info_image', $cur_page); ?>" alt="counsellors_info_image">
    </div>
    <?php endif; ?>
    <h1 class="page-title"><?php echo get_the_title(); ?></h1>

    <div class="mid-container counsellors-info-wrapper">
        <?php if(get_field('first_block_title', $cur_page) || get_field('first_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('first_block_title', $cur_page); ?></div>
                <a href="<?php the_field('first_block_link', $cur_page); ?>" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('first_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('second_block_title', $cur_page) || get_field('second_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('second_block_title', $cur_page); ?></div>
                <a href="<?php the_field('second_block_link', $cur_page); ?>" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('second_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('third_block_title', $cur_page) || get_field('third_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('third_block_title', $cur_page); ?></div>
                <a href="#" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('third_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('fourth_block_title', $cur_page) || get_field('fourth_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('fourth_block_title', $cur_page); ?></div>
                <a href="#" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('fourth_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('fifth_block_title', $cur_page) || get_field('fifth_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-33">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('fifth_block_title', $cur_page); ?></div>
                <a href="#" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('fifth_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('sixth_block_title', $cur_page) || get_field('sixth_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-33">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('sixth_block_title', $cur_page); ?></div>
                <a href="#" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('sixth_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(get_field('seventh_block_title', $cur_page) || get_field('seventh_block_text', $cur_page)) : ?>
        <div class="counsellors-info-item counsellors-info-item-33">
            <div class="counsellors-info-item-heading">
                <div class="counsellors-info-item-heading-text"><?php the_field('seventh_block_title', $cur_page); ?></div>
                <a href="#" class="counsellors-info-item-heading-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-next.svg" alt="arrow-next">
                </a>
            </div>
            <div class="counsellors-info-item-text">
                <?php the_field('seventh_block_text', $cur_page); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

<?php get_footer(); ?>