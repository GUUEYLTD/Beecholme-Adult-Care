<?php

/** @var WP_User $user */
$user = get_user_by('slug', get_query_var('author_name'));
$user->amelia_employee = \BAC\Practitioners::getByEmail($user->user_email);

$userServices = \BAC\Service::getAllByPractitionerId($user->amelia_employee->id);
get_header(); ?>
<?php
$args = array(
    'post_type' => 'reviews',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => 'review-user-id',
            'value' => $user->ID
        )
    )
);
$loop = new WP_Query($args);
$count_reviews =  $loop->post_count;
$average_sum = 0;
while ($loop->have_posts()) : $loop->the_post();
    $average_sum = $average_sum + get_field('review-stars');
endwhile;
if( $count_reviews > 0 ){
    $average_stars = round($average_sum/$count_reviews, 2);
} else {
    $average_stars = 0;
}

if ( $average_stars > 0 && $average_stars <= 1 ){
    $stars_additional_class = "rating-upper-red";
} else if ( $average_stars > 1 && $average_stars <= 3 ){
    $stars_additional_class = "rating-upper-yellow";
} else {
    $stars_additional_class = "";
}
?>
    <div class="profile mid-container">
        <a class="back-button d-flex align-items-center" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-left.png" alt="">
            back to list
        </a>

        <div class="profile-container block1">
            <div class="personal-info d-flex left">
                <div class="avatar">
                    <img src="<?php echo $user->amelia_employee->pictureThumbPath ?? (get_stylesheet_directory_uri() . '/images/profile-placeholder.png'); ?>" alt="">
                </div>

                <div class="info">

                    <!-- The Modal -->
                    <div id="formRating" class="rating-modal">
                        <div class="rating-modal-content">
                            <span class="rating-close">&times;</span>
                            <div class="">
                                <div class="review-title">Please leave your feedback about <span><?= $user->amelia_employee->firstName . ' ' . $user->amelia_employee->lastName ?></span></div>
                                <?php echo do_shortcode('[contact-form-7 id="2705" title="Review form"]');?>
                            </div>
                        </div>
                    </div>

                    <div id="modalSuccess" class="modal-success">
                        <div class="popup-body">
                            <span class="rating-close">&times;</span>
                            <div class="popup-content">Thank you for review</div>
                        </div>
                    </div>

                    <div id="modalNotfound" class="modal-not-found">
                        <div class="popup-body">
                            <span class="rating-close">&times;</span>
                            <div class="popup-content">Our records say you didn`t have sessions with <span><?= $user->amelia_employee->firstName . ' ' . $user->amelia_employee->lastName ?></span>. Unfortunately you can`t leave a feedback. Please book a session with counselor in order to leave feedback about quality of counselor`s services</div>
                        </div>
                    </div>

                    <div id="btnRating" class="rating d-flex justify-content-start">

                        <div class="stars stars-top">
                            <div class="rating-hover">
                                <div class="one"></div>
                                <div class="two"></div>
                                <div class="three"></div>
                                <div class="four"></div>
                                <div class="five"></div>
                            </div>
                            <div class="rating-upper <?php echo $stars_additional_class; ?>" style="width: <?php echo ($average_stars*20);?>%"> </div>
                            <div class="rating-lower"></div>
                        </div>

                        <span> <?php echo $average_stars;?> (<?php echo $count_reviews; ?> reviews)</span>
                    </div>

                    <div class="name"><?= $user->amelia_employee->firstName . ' ' . $user->amelia_employee->lastName ?></div>
                    <div class="specialty"><?= implode(", ", getACFLoopValues('type', $user->ID)) ?></div>
                    <div class="actions d-flex align-items-center">
                        <div class="price">
                            <span>&#163;<?= \BAC\Practitioners::getPriceByPractitionerId($user->amelia_employee->id) ?></span> / session
                        </div>
                        <div class="button-wrapper">
                            <a href="/booking/?user=<?= $user->amelia_employee->id ?>">
                                <button>Book a session</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="summary d-flex flex-column right">
                <div class="single-item d-flex"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-location.png" alt="">
                    <div class="info d-flex flex-column">
                        <div class="caption">Located in</div>
                        <div class="message"><?php echo get_field('location', "user_{$user->id}") ?? '' ?></div>
                    </div>
                </div>
                <div class="single-item d-flex">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-graduate.png" alt="">
                    <div class="info d-flex flex-column">
                        <div class="caption">Education</div>
                        <div class="message"><?php echo get_field('education', "user_{$user->id}") ?? '' ?></div>
                    </div>
                </div>
                <div class="single-item d-flex"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-languages.png" alt="">
                    <div class="info d-flex flex-column">
                        <div class="caption">Languages</div>
                        <?php
                        $languages = array();
                        if(have_rows('languages', "user_{$user->ID}")) : while(have_rows('languages', "user_{$user->ID}")) : the_row();
                            $languages[] = get_sub_field('language');
                        endwhile;
                        endif;
                        $languages = implode(", ", $languages);
                        ?>
                        <div class="message"><?= $languages ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>

        <div class="profile-container block2">

            <div class="about left">

                <div class="about">
                    <div class="heading">About me</div>
                    <div class="text"><?php echo get_the_author_meta('description', $user->id) ?></div>
                </div>

                <?php if( get_field('show_video', "user_{$user->id}") && get_field('video_link', "user_{$user->id}") ) : ?>

                    <div class="video-counsellors">

                        <div id="ytplayer">
                            <?php $src_image = get_field('video_thumbnail', "user_{$user->id}") ?? ''; ?>
                            <?php if($src_image):?>
                                <img id="ytThumb" src=<?php echo $src_image; ?> >
                            <?php endif; ?>
                            <div id="ytClick">
                                <div class="img-wrapper">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-right-video.svg" alt="ytClick">
                                </div>
                            </div>
                        </div>

                    </div>

                    <script>
                        var tag = document.createElement('script');
                        tag.src = "https://www.youtube.com/player_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        var videoId = '<?php echo get_field('video_link', "user_{$user->id}");?>';

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

                <?php endif; ?>

                <div class="details">
                    <div class="heading">Session details</div>
                    <div class="single-detail d-flex">
                        <div class="text caption">Duration</div>
                        <div class="text info">
                            <?= formatDuration($userServices[0]->duration); ?>
                        </div>
                    </div>
                    <div class="single-detail d-flex">
                        <div class="text caption">Price</div>
                        <div class="text info">&#163;<?= \BAC\Practitioners::getPriceByPractitionerId($user->amelia_employee->id); ?></div>
                    </div>
                    <div class="single-detail d-flex">
                        <div class="text caption">Approach</div>
                        <div class="text info"><?php the_field('approach', "user_{$user->ID}"); ?></div>
                    </div>
                    <div class="single-detail d-flex">
                        <div class="text caption">How it works</div>
                        <div class="text info"><?php the_field('how_it_works', "user_{$user->ID}"); ?></div>
                    </div>
                    <div class="button-wrapper">
                        <a href="/booking/?user=<?= $user->amelia_employee->id ?>">
                            <button>Book a Session</button>
                        </a>
                    </div>
                </div>

            </div>

            <div class="specializations right">

                <div class="areas">
                    <div class="heading">Areas of Expertise</div>
                    <div class="text">
                        <?php foreach (getACFLoopValues('specializations', $user->ID) as $service) { ?>
                            <span>- </span><?php echo $service; ?><br>
                        <?php } ?>
                    </div>
                </div>

                <div class="education ">
                    <div class="heading">Licence, accreditations & certifications</div>
                    <?php
                    if(have_rows('certifications', "user_{$user->ID}")) : while(have_rows('certifications', "user_{$user->ID}")) : the_row(); ?>
                        <div class="single-item d-flex flex-column">
                            <?php if(!get_sub_field('hide')) : ?>
                                <div class="name text"><?php the_sub_field('title'); ?></div>
                                <div class="info d-flex justify-content-between">
                                    <div class="date"><?php the_sub_field('date'); ?></div>
                                    <?php if(get_sub_field('link')) : ?>
                                        <div class="link"><a href="<?php the_sub_field('link'); ?>" target="_blank">View</a></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endwhile;
                    endif;
                    ?>
                </div>

            </div>

        </div>

        <div class="reviews">
            <div class="reviews-head d-flex">
                <div class="heading">
                    Reviews
                </div>
                <div class="stars-wrapper">
                    <div class="stars">
                        <div class="rating-upper  <?php echo $stars_additional_class; ?>" style="width: <?php echo ($average_stars*20);?>%"> </div>
                        <div class="rating-lower"></div>
                    </div>
                    <span> <?php echo $average_stars;?> (<?php echo $count_reviews; ?> reviews)</span>
                </div>
            </div>

            <div class="reviews-content">
                <?php
                $args = array(
                    'post_type' => 'reviews',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'review-user-id',
                            'value' => $user->ID
                        )
                    ),
                    'order' => 'DESC'
                );
                $loop = new WP_Query($args);
                while ($loop->have_posts()) : $loop->the_post();
                    $review_stars_loop = get_field('review-stars');
                    if ( $review_stars_loop > 0 && $review_stars_loop <= 1 ){
                        $stars_additional_class_loop = "rating-upper-red";
                    } else if ( $review_stars_loop > 1 && $review_stars_loop <= 3 ){
                        $stars_additional_class_loop = "rating-upper-yellow";
                    } else {
                        $stars_additional_class_loop = "";
                    }
                    ?>
                    <div class="reviews-content-item">
                        <div class="reviews-content-top d-flex justify-content-between">
                            <div class="reviews-content-top-item d-flex">
                                <img src="<?php echo get_template_directory_uri().'/images/profile-placeholder.png';?>" alt="<?php the_title(); ?>" width="64" height="64">
                                <div>
                                    <div class="reviews-content-top-item-title"><?php the_title(); ?></div>
                                    <div class="reviews-content-top-item-date"><?php echo get_the_date( 'M d Y'); ?></div>
                                </div>
                            </div>
                            <div class="stars">
                                <div class="rating-upper  <?php echo $stars_additional_class_loop; ?>" style="width: <?php echo (get_field('review-stars')*20);?>%"></div>
                                <div class="rating-lower"></div>
                            </div>

                        </div>
                        <div class="reviews-content-bottom">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata();?>
            </div>

        </div>

    </div>

<?php get_footer(); ?>
<script>
    jQuery(function($){
        document.getElementById("revId").value = '<?php echo $user->ID;?>';

        $('.rating-hover').mouseout(function() {
            var ratingwidth = <?php echo ($average_stars*20);?>+'%';
            $('.stars-top .rating-upper').css('width', ratingwidth);
        });
    });
</script>
