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


    <div class="mid-container counsellors-info-wrapper counsellors-video-wrapper">
        <?php if( get_field('show_video')  ) : ?>

            <div class="video-counsellors">

                <div id="ytplayer">
                    <?php $src_image = get_field('video_thumbnail') ?? ''; ?>
                    <?php if($src_image):?>
                        <img id="ytThumb" src=<?php echo $src_image; ?> >
                    <?php endif; ?>
                    <?php if(get_field('video_link')):?>
                    <div id="ytClick">
                        <div class="img-wrapper">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-right-video.svg" alt="ytClick">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="ytplayer-title">
                    Example of a good video presentation
                </div>

            </div>

            <script>
                var tag = document.createElement('script');
                tag.src = "https://www.youtube.com/player_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                var videoId = '<?php echo get_field('video_link');?>';

                jQuery(function($) {
                    $(document).on('click', '#ytClick', function(){
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                    });

                    var is_video_thumbnail = document.getElementById("ytThumb");
                    if (!is_video_thumbnail){
                        var video_thumbnail = $('<img id="ytThumb" src="//img.youtube.com/vi/'+videoId+'/0.jpg">');
                        $('#ytplayer').append(video_thumbnail);
                    }
                });

                var player;
                function onYouTubePlayerAPIReady() {
                    player = new YT.Player('ytplayer', {
                        height: '100%',
                        width: '100%',
                        autoplay: 'true',
                        videoId: videoId,
                        events: {
                            'onReady': onPlayerReady
                        }
                    });
                }
                function onPlayerReady(event) {
                    event.target.playVideo();
                }
            </script>

            <div class="description-counsellors">
                <h2><?php echo get_field('video_title');?></h2>
                <div class="description-counsellors-text">
                    <?php echo get_field('video_text');?>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <div class="mid-container counsellors-info-wrapper counsellors-video-structure-wrapper">
        <h2>Video Structure</h2>
        <div class="counsellors-video-structure">
            <div class="counsellors-video-structure-item">
                <?php if( get_field('item1_image')  ) : ?>
                <div class="counsellors-video-structure-item-img">
                    <img src="<?php echo get_field('item1_image'); ?>" alt="vstructure-one">
                </div>
                <?php endif; ?>
                <div class="counsellors-video-structure-item-title"><?php echo get_field('item1_title'); ?></div>
                <div class="counsellors-video-structure-item-text"><?php echo get_field('item1_text'); ?></div>
            </div>
            <div class="counsellors-video-structure-item">
                <?php if( get_field('item2_image')  ) : ?>
                    <div class="counsellors-video-structure-item-img">
                        <img src="<?php echo get_field('item2_image'); ?>" alt="vstructure-two">
                    </div>
                <?php endif; ?>
                <div class="counsellors-video-structure-item-title"><?php echo get_field('item2_title'); ?></div>
                <div class="counsellors-video-structure-item-text"><?php echo get_field('item2_text'); ?></div>
            </div>
            <div class="counsellors-video-structure-item">
                <?php if( get_field('item3_image')  ) : ?>
                    <div class="counsellors-video-structure-item-img">
                        <img src="<?php echo get_field('item3_image'); ?>" alt="vstructure-three">
                    </div>
                <?php endif; ?>
                <div class="counsellors-video-structure-item-title"><?php echo get_field('item3_title'); ?></div>
                <div class="counsellors-video-structure-item-text"><?php echo get_field('item3_text'); ?></div>
            </div>
        </div>
    </div>

    <div class="mid-container counsellors-info-wrapper counsellors-video-presentation-wrapper">

        <h2>Video Presentation Guidelines</h2>
        <div class="counsellors-video-presentation">

            <div class="counsellors-video-presentation-left">
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">1</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item1g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item1g_text'); ?></div>
                    </div>
                </div>
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">2</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item2g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item2g_text'); ?></div>
                    </div>
                </div>
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">3</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item3g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item3g_text'); ?></div>
                    </div>
                </div>
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">4</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item4g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item4g_text'); ?></div>
                    </div>
                </div>
            </div>

            <div class="counsellors-video-presentation-right">
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">5</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item5g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item5g_text'); ?></div>
                    </div>
                </div>
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">6</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item6g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item6g_text'); ?></div>
                    </div>
                </div>
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">7</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item7g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item7g_text'); ?></div>
                    </div>
                </div>
                <div class="counsellors-video-presentation-item">
                    <div class="counsellors-video-presentation-item-counter">8</div>
                    <div class="counsellors-video-presentation-item-title-text">
                        <div class="counsellors-video-presentation-item-title"><?php echo get_field('item8g_title'); ?></div>
                        <div class="counsellors-video-presentation-item-text"><?php echo get_field('item8g_text'); ?></div>
                    </div>
                </div>
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
            if( current == 1 && direction == 'next'){current++}
            if( current == 3 && direction == 'prev'){current--}
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
