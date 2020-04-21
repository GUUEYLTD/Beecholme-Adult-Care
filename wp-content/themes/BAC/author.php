<?php

/** @var WP_User $user */
$user = get_user_by('slug', get_query_var('author_name'));
$user->amelia_employee = \BAC\Practitioners::getByEmail($user->user_email);

$userServices = \BAC\Service::getAllByPractitionerId($user->amelia_employee->id);
get_header(); ?>

    <div class="profile mid-container">
        <a class="back-button d-flex align-items-center" href="/our-counsellors">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-left.png" alt="">
            back to list
        </a>

<!--        --><?php //if(have_posts()) : the_post(); ?>
            <div class="profile-container block1">
                <div class="personal-info d-flex left">
                    <div class="avatar">
                        <img src="<?php echo $user->amelia_employee->pictureThumbPath ?? (get_stylesheet_directory_uri() . '/images/profile-placeholder.png'); ?>" alt="">
                    </div>
                    <div class="info">
<!--                        <div class="rating">-->
<!--                            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
<!--                            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
<!--                            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
<!--                            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
<!--                            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
<!--                        </div>-->
                        <div class="name"><?= $user->amelia_employee->firstName . ' ' . $user->amelia_employee->lastName ?></div>
                        <div class="specialty"><?= \BAC\Category::getByPractitionerId($user->amelia_employee->id)->name ?></div>
                        <div class="actions d-flex align-items-center">
                            <div class="price">
                                <span>$<?= \BAC\Practitioners::getPriceByPractitionerId($user->amelia_employee->id) ?></span> / session
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
<!--                            --><?php //if(get_field('location', $user->id)) ?>
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
//                                var_dump($languages); die;
                            ?>
                            <div class="message"><?= $languages ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>

            <div class="profile-container block2">
                <div class="about left">
                    <div class="heading">About me</div>
<!--                    <div class="text">--><?php //the_field('about', "user_{$user->ID}") ?><!--</div>-->
                    <div class="text"><?php echo get_the_author_meta('description', $user->id) ?></div>
<!--                    <div class="text"></div>-->
                </div>
                <div class="specializations right">
                    <div class="heading">Areas of Expertise</div>
                    <div class="text">
                        <?php foreach (getACFLoopValues('specializations', $user->ID) as $service) { ?>
                            <span>- </span><?php echo $service; ?><br>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="profile-container block3">
                <div class="details left">
                    <div class="heading">Session details</div>
                    <div class="single-detail d-flex">
                        <div class="text caption">Duration</div>
                        <div class="text info">
                            <?= formatDuration($userServices[0]->duration); ?>
                        </div>
                    </div>
                    <div class="single-detail d-flex">
                        <div class="text caption">Price</div>
                        <div class="text info">$<?= \BAC\Practitioners::getPriceByPractitionerId($user->amelia_employee->id); ?></div>
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
                        <button>Book a Session</button>
                    </div>
                </div>
                <div class="education right">
                    <div class="heading">Licence, accreditations & certifications</div>
                    <?php
                    if(have_rows('certifications', "user_{$user->ID}")) : while(have_rows('certifications', "user_{$user->ID}")) : the_row(); ?>
                        <div class="single-item d-flex flex-column">
                            <div class="name text"><?php the_sub_field('title'); ?></div>
                            <div class="info d-flex justify-content-between">
                                <div class="date"><?php echo date(get_option('date_format'), get_sub_field('date')); ?></div>
                                <?php if(get_sub_field('link')) : ?>
                                    <div class="link"><a href="<?php the_sub_field('link'); ?>" target="_blank">View</a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile;
                    endif;
                    ?>
                </div>
            </div>
<!--        --><?php //else :
            //
//        endif; ?>
    </div>

<?php get_footer(); ?>