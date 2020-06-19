<?php /*Template Name: Info For Counsellors: Profile*/
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
                <div class="counsellors-info-item-video">
                    <?php the_field('third_block_video', $cur_page); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="counsellors-info-full-background">
        <h2>Profile Picture</h2>
        <div class="mid-container counsellors-info-wrapper">
            <?php if(get_field('profile_picture_first_title', $cur_page)) : ?>
                <div class="profile-picture-item">
                    <div class="profile-picture-item-number">1</div>
                    <div class="profile-picture-item-content">
                        <div class="profile-picture-item-heading"><?php the_field('profile_picture_first_title', $cur_page); ?></div>
                        <div class="profile-picture-item-text">
                            <?php the_field('profile_picture_first_text', $cur_page); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(get_field('profile_picture_second_title', $cur_page)) : ?>
                <div class="profile-picture-item">
                    <div class="profile-picture-item-number">2</div>
                    <div class="profile-picture-item-content">
                        <div class="profile-picture-item-heading"><?php the_field('profile_picture_second_title', $cur_page); ?></div>
                        <div class="profile-picture-item-text">
                            <?php the_field('profile_picture_second_text', $cur_page); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(get_field('profile_picture_third_title', $cur_page)) : ?>
                <div class="profile-picture-item">
                    <div class="profile-picture-item-number">1</div>
                    <div class="profile-picture-item-content">
                        <div class="profile-picture-item-heading"><?php the_field('profile_picture_third_title', $cur_page); ?></div>
                        <div class="profile-picture-item-text">
                            <?php the_field('profile_picture_third_text', $cur_page); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>