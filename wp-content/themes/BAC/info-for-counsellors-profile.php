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
            <div class="counsellors-info-item counsellors-info-item-100 counsellors-info-item-profile">
                <div class="counsellors-info-item-heading-text">
                    <div class="counsellors-info-item-heading"><?php the_field('third_block_title', $cur_page); ?></div>
                    <div class="counsellors-info-item-text">
                        <?php the_field('third_block_text', $cur_page); ?>
                    </div>
                </div>
                <div class="counsellors-info-item-video">
                    <video width="100%" height="100%"  controls="controls">
                        <source src="<?php echo get_template_directory_uri().'/video/how-to-edit-your-profile.mp4'; ?>" type="video/mp4" />
                    </video>
                    <?php //the_field('third_block_video', $cur_page); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="counsellors-info-full-background">
        <h2>Profile Picture</h2>
        <div class="mid-container counsellors-info-wrapper">
            <div class="profile-pictures-left">
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
                        <div class="profile-picture-item-number">3</div>
                        <div class="profile-picture-item-content">
                            <div class="profile-picture-item-heading"><?php the_field('profile_picture_third_title', $cur_page); ?></div>
                            <div class="profile-picture-item-text">
                                <?php the_field('profile_picture_third_text', $cur_page); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="profile-pictures-right">
                <img src="<?php the_field('profile_picture_image', $cur_page); ?>" alt="Profile Picture">
                <div class="profile-pictures-right-image-caption"><?php the_field('profile_picture_image_caption', $cur_page); ?></div>
            </div>

        </div>
    </div>

<?php get_footer(); ?>