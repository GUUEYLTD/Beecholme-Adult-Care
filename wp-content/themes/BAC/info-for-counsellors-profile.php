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
        <div class="mid-container counsellors-info-wrapper profile-pictures-wrapper">
            <div class="profile-pictures-left">
                <div class="profile-pictures-slider"  data-current="1">
                    <div class="profile-pictures-slide profile-pictures-slide-1">
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
                    <div class="profile-pictures-slide profile-pictures-slide-2">
                        <?php if(get_field('profile_picture_fourth_title', $cur_page)) : ?>
                            <div class="profile-picture-item">
                                <div class="profile-picture-item-number">4</div>
                                <div class="profile-picture-item-content">
                                    <div class="profile-picture-item-heading"><?php the_field('profile_picture_fourth_title', $cur_page); ?></div>
                                    <div class="profile-picture-item-text">
                                        <?php the_field('profile_picture_fourth_text', $cur_page); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('profile_picture_fifth_title', $cur_page)) : ?>
                            <div class="profile-picture-item">
                                <div class="profile-picture-item-number">5</div>
                                <div class="profile-picture-item-content">
                                    <div class="profile-picture-item-heading"><?php the_field('profile_picture_fifth_title', $cur_page); ?></div>
                                    <div class="profile-picture-item-text">
                                        <?php the_field('profile_picture_fifth_text', $cur_page); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('profile_picture_sixth_title', $cur_page)) : ?>
                            <div class="profile-picture-item">
                                <div class="profile-picture-item-number">6</div>
                                <div class="profile-picture-item-content">
                                    <div class="profile-picture-item-heading"><?php the_field('profile_picture_sixth_title', $cur_page); ?></div>
                                    <div class="profile-picture-item-text">
                                        <?php the_field('profile_picture_sixth_text', $cur_page); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="profile-pictures-slide profile-pictures-slide-3">
                        <?php if(get_field('profile_picture_seventh_title', $cur_page)) : ?>
                            <div class="profile-picture-item">
                                <div class="profile-picture-item-number">7</div>
                                <div class="profile-picture-item-content">
                                    <div class="profile-picture-item-heading"><?php the_field('profile_picture_seventh_title', $cur_page); ?></div>
                                    <div class="profile-picture-item-text">
                                        <?php the_field('profile_picture_seventh_text', $cur_page); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('profile_picture_eighth_title', $cur_page)) : ?>
                            <div class="profile-picture-item">
                                <div class="profile-picture-item-number">8</div>
                                <div class="profile-picture-item-content">
                                    <div class="profile-picture-item-heading"><?php the_field('profile_picture_eighth_title', $cur_page); ?></div>
                                    <div class="profile-picture-item-text">
                                        <?php the_field('profile_picture_eighth_text', $cur_page); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(get_field('profile_picture_ninth_title', $cur_page)) : ?>
                            <div class="profile-picture-item">
                                <div class="profile-picture-item-number">9</div>
                                <div class="profile-picture-item-content">
                                    <div class="profile-picture-item-heading"><?php the_field('profile_picture_ninth_title', $cur_page); ?></div>
                                    <div class="profile-picture-item-text">
                                        <?php the_field('profile_picture_ninth_text', $cur_page); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="slide-buttons">
                    <a href="#" class="prev-button">
                        <img src="<?php echo get_template_directory_uri().'/images/icon_backleft.svg'; ?>" alt="">
                    </a>
                    <div class="slide-current"></div>
                    <div class="slide-of">of</div>
                    <div class="slide-total">3</div>
                    <a href="#" class="next-button">
                        <img src="<?php echo get_template_directory_uri().'/images/icon_nextright.svg'; ?>" alt="">
                    </a>
                </div>
            </div>



            <div class="profile-pictures-right">
                <img src="<?php the_field('profile_picture_image', $cur_page); ?>" alt="Profile Picture">
                <div class="profile-pictures-right-image-caption"><?php the_field('profile_picture_image_caption', $cur_page); ?></div>
            </div>

        </div>
    </div>

<?php get_footer(); ?>

<script>

    jQuery( document ).ready(function( $ ) {
        var slide_strip = $('.profile-pictures-slider');
        var slides = slide_strip.find('> *');

        var next_button = $('.next-button');
        var prev_button = $('.prev-button');

        $('.profile-pictures-slide-1').css('display', 'block');
        $('.profile-pictures-slide-1').css('opacity', '1');
        $('.slide-current').html(1);

        next_button.on('click', function(e){
            goto('next');
            e.preventDefault();
        });
        prev_button.on('click', function(e){
            goto('prev');
            e.preventDefault();
        });

        function goto(direction){
            var current = parseInt(slide_strip.attr('data-current'), 10);
            var visibleSlide = '.profile-pictures-slide-'+current;
            console.log(visibleSlide);

            $('.profile-pictures-slide').css('display', 'none');
            $('.profile-pictures-slide').css('opacity', '0');
            $(visibleSlide).css('display', 'block');
            $(visibleSlide).css('opacity', '1');
            $('.slide-current').html(current);

            if(direction == 'next'){
                if(current >= slides.length) return;
                current++;
            } else {
                if(current <= 1) return;
                current--;
            }

            slide_strip.attr('data-current', current);
        }
    });
</script>
