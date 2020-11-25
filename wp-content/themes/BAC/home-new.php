<?php /*Template Name: home-new*/
get_header('new');
$cur_page = get_the_ID();

/*Return counsellors*/
$practitioners = new \BAC\Practitioners();
$counsellors   = apply_filters('bac_listed_counsellors', $practitioners->mobileCounsellors($_GET));

if(!empty($counsellors)) {
    add_action('bac_list_counsellors', array('\BAC\Practitioners', 'listCatalogue'), 10, 1);
}
?>


    <div class="" style="background:#E5F5F4">
    <div class="text-center home-top-banner-new" style="background-image: url(<?php echo wp_is_mobile() ? get_template_directory_uri().'/images/main-new/first-screen-mob.png' : get_template_directory_uri().'/images/main-new/first-screen-desk.svg' ?>)">

        <div class="home-top-banner-wrapper inner-container">
            <div class="home-top-banner-top">
                <div class="home-top-banner-top-left">
                    <h1>Online Therapy and Coaching for you.</h1>
                    <div class="home-top-banner-sub-one">Help when you need it most</div>
                    <div class="home-top-banner-sub-two">Talk to a licensed counsellor now.</div>
                </div>
                <div class="home-top-banner-top-right">
                    <img src="<?php echo get_template_directory_uri().'/images/main-new/home-top-banner-image.svg' ?>" alt="with-bac">
                </div>
            </div>

            <div class="home-top-banner-bottom">
                <div class="banner-content  home-form-wrapper">
                    <div class="home-form-title">I Need Help With...</div>
                    <form class="tab-content find-tab active" action="our-counsellors">
                        <div class="homepage-filter question-filter empty-filter active">
                            <select class="question-select" name="common">
                                <option value="" data-display-text="All">All</option>
                                <?php foreach (getServices() as $serviceName) : ?>
                                    <option
                                            value="<?php echo $serviceName ?>"
                                        <?php echo isset($_GET['common']) && $_GET['common'] === $serviceName ? 'selected' : '' ?>
                                    ><?php echo $serviceName ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="button-wrapper">
                                <button>
                                    <?php if(!wp_is_mobile()) :?>
                                        Find a Counsellor
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri().'/images/main-new/icon-search.svg' ?>" class="main-new-search-ico" alt="search-icon">
                                    <?php endif; ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="home-form-captions">
                    <div class="home-form-caption-item">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/icon-check.svg' ?>" class="home-form-caption-item-icon" alt="check-icon">
                        Professional licenced therapists and coaches</div>
                    <div class="home-form-caption-item">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/icon-check.svg' ?>" class="home-form-caption-item-icon" alt="check-icon">
                        Affordable
                    </div>
                    <div class="home-form-caption-item">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/icon-check.svg' ?>" class="home-form-caption-item-icon" alt="check-icon">
                        Secure
                    </div>
                    <div class="home-form-caption-item">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/icon-check.svg' ?>" class="home-form-caption-item-icon" alt="check-icon">
                        Satisfaction Guarantee
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>


    <div class="main-mob-counsellors">
        <h2 class="text-center">What our clients say</h2>

        <div class="owl-carousel owl-theme our-counsellors inner-container">

            <div class="single-item">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/quote.svg' ?>" class="single-item-icon" alt="quote-icon">
                <div class="single-item-text-wrapper">
                    <div class="single-item-text">
                        Online therapy helped me when I needed the most. I was quite reluctant to go give it a go but I do not regret it!
                    </div>
                    <div class="single-item-stars-name">
                        <div class="single-item-stars">
                            <img src="<?php echo get_template_directory_uri().'/images/main-new/rating.svg' ?>" class="" alt="quote-icon">
                        </div>
                        <div class="single-item-name">- G.A.</div>
                    </div>
                </div>

            </div>
            <div class="single-item">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/quote.svg' ?>" class="single-item-icon" alt="quote-icon">
                <div class="single-item-text-wrapper">
                    <div class="single-item-text">
                        I did not have the motivation to make the changes in my life that I needed but my Life Coach changed my perspective and helped me to keep my wellbeing.
                    </div>
                    <div class="single-item-stars-name">
                        <div class="single-item-stars">
                            <img src="<?php echo get_template_directory_uri().'/images/main-new/rating.svg' ?>" class="" alt="quote-icon">
                        </div>
                        <div class="single-item-name">- G.A.</div>
                    </div>
                </div>
            </div>
            <div class="single-item">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/quote.svg' ?>" class="single-item-icon" alt="quote-icon">
                <div class="single-item-text-wrapper">
                    <div class="single-item-text">
                        With the lockdown I felt overwhelmed with all the pressure and scared with the future. I found an online therapist who helps me to manage my anxiety. A lifesaver!
                    </div>
                    <div class="single-item-stars-name">
                        <div class="single-item-stars">
                            <img src="<?php echo get_template_directory_uri().'/images/main-new/rating.svg' ?>" class="" alt="quote-icon">
                        </div>
                        <div class="single-item-name">- G.A.</div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <div class="" style="background:#E5F5F4">
    <div class="main-mob-how-it-work" style="background-image: url(<?php echo wp_is_mobile() ? get_template_directory_uri().'/images/main-new/how-it-works-mob-bg.png' : get_template_directory_uri().'/images/main-new/how-it-works-bg.png' ?>)">
        <h2 class="text-center">How It Works?</h2>
        <div class="inner-container how-it-work-container">

            <div class="main-mob-how-it-work-item">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/how1.svg' ?>" class="how-it-work-item-image" alt="quote-icon">
                <div class="how-it-work-item-number">01</div>
                <div class="how-it-work-item-content">
                    <div class="how-it-work-item-title">Choose your counsellor</div>
                    <div class="how-it-work-item-text">Select the counsellor that best suits your needs from 50+ verified therapists and coaches</div>
                </div>
            </div>
            <div class="main-mob-how-it-work-item">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/how2.svg' ?>" class="how-it-work-item-image" alt="quote-icon">
                <div class="how-it-work-item-number">02</div>
                <div class="how-it-work-item-content">
                    <div class="how-it-work-item-title">Book online</div>
                    <div class="how-it-work-item-text">Choose the day and time that best fits your schedule and fill out the booking form</div>
                </div>
            </div>
            <div class="main-mob-how-it-work-item">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/how3.svg' ?>" class="how-it-work-item-image" alt="quote-icon">
                <div class="how-it-work-item-number">03</div>
                <div class="how-it-work-item-content">
                    <div class="how-it-work-item-title">Start therapy / coaching</div>
                    <div class="how-it-work-item-text">Begin the journey towards a happier and healthier your</div>
                </div>
            </div>
        </div>

        <div class="why-choose">
            <h2>Why Choose BAC Online Therapy and Coaching?</h2>
            <div class="why-choose-items inner-container">
                <div class="why-choose-item">
                    <div class="why-choose-img">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/why1.svg' ?>" alt="why-choose-icon">
                    </div>
                    <div class="why-choose-content">
                        <div class="why-choose-title">Verified Counsellors</div>
                        <div class="why-choose-text">BAC counsellors are all licensed, trained, experienced, and accredited</div>
                    </div>
                </div>
                <div class="why-choose-item">
                    <div class="why-choose-img">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/why2.svg' ?>" alt="why-choose-icon">
                    </div>
                    <div class="why-choose-content">
                        <div class="why-choose-title">Secure</div>
                        <div class="why-choose-text">BAC takes several steps to ensure safe services and guarantee confidentiality</div>
                    </div>
                </div>
                <div class="why-choose-item">
                    <div class="why-choose-img">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/why3.svg' ?>" alt="why-choose-icon">
                    </div>
                    <div class="why-choose-content">
                        <div class="why-choose-title">Accessible</div>
                        <div class="why-choose-text">Wherever you wish to be, you can still get your sessions</div>
                    </div>
                </div>
                <div class="why-choose-item">
                    <div class="why-choose-img">
                        <img src="<?php echo get_template_directory_uri().'/images/main-new/why4.svg' ?>" alt="why-choose-icon">
                    </div>
                    <div class="why-choose-content">
                        <div class="why-choose-title">Easy To Use</div>
                        <div class="why-choose-text">Easy booking process, secure payment system and 24/7 support</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>


    <div class="testimonials">
        <h3>Testimonials</h3>

        <div id="review-carousel" class="owl-carousel owl-theme review-carousel">
            <?php if(get_field('testimonial_1')) { ?>
                <div class="single-testimonial">
                    <p><?php the_field('testimonial_1'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('testimonial_2')) { ?>
                <div class="single-testimonial">
                    <p><?php the_field('testimonial_2'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('testimonial_3')) { ?>
                <div class="single-testimonial">
                    <p><?php the_field('testimonial_3'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('testimonial_4')) { ?>
                <div class="single-testimonial">
                    <p><?php the_field('testimonial_4'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('testimonial_5')) { ?>
                <div class="single-testimonial">
                    <p><?php the_field('testimonial_5'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('testimonial_6')) { ?>
                <div class="single-testimonial">
                    <p><?php the_field('testimonial_6'); ?></p>
                </div>
            <?php } ?>
        </div>

        <div class="review-button">
            <a class="cta-button" href="http://www.cqc.org.uk/location/1-121892109">Rating and review on the Care Quality Commission <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></a>
        </div>
    </div>


    <div class="with-you">
        <h2>With BAC you can rely on Quality, Safety and Trust</h2>
        <div class="with-you-content inner-container">
            <div class="with-you-content-left">
                <img src="<?php echo get_template_directory_uri().'/images/main-new/with-bac.png' ?>" class="" alt="with-you-content-left">
            </div>
            <div class="with-you-content-right">
                <div class="with-you-content-right-text">
                    If you're not satisfied, we'll arrange a free session with an alternative counsellor for you or offer you a full refund.
                </div>
                <div class="banner-content  home-form-wrapper">
                    <div class="home-form-title">Help me with...</div>
                    <form class="tab-content find-tab active" action="our-counsellors">
                        <div class="homepage-filter question-filter empty-filter active">
                            <select class="question-select" name="common">
                                <option value="" data-display-text="All">All</option>
                                <?php foreach (getServices() as $serviceName) : ?>
                                    <option
                                            value="<?php echo $serviceName ?>"
                                        <?php echo isset($_GET['common']) && $_GET['common'] === $serviceName ? 'selected' : '' ?>
                                    ><?php echo $serviceName ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="button-wrapper">
                                <button>
                                    <?php if(!wp_is_mobile()) :?>
                                        Find a Counsellor
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri().'/images/main-new/icon-search.svg' ?>" class="main-new-search-ico" alt="search-icon">
                                    <?php endif; ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="blog-section d-flex flex-column inner-container">
        <div class="posts-title-wrapper">
            <h2 class="title">
                Blog Posts
            </h2>
            <?php if(!wp_is_mobile()) : ?>
            <a href="/blog/" target="_blank">Explore more posts</a>
            <?php endif; ?>
        </div>

        <div class="posts d-flex flex-row">

            <?php $query = new WP_Query( 'posts_per_page=5' ); ?>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="post d-flex flex-column">
                    <div class="image" style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID()) ?>)"></div>
                    <div class="content">
                        <a href="<?php echo get_the_permalink() ?>" target="_blank" class="title"><?php echo get_the_title(); ?></a>
                        <div class="description"><?= wp_filter_nohtml_kses(get_the_content()) ?></div>
                        <div class="other d-flex flex-row justify-content-between">
                            <div class="date d-flex flex-row align-items-center">
                                <div class="icon">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M5.83121 8.82716C5.83121 8.62673 5.66864 8.46436 5.46805 8.46436H4.20074C4.00037 8.46436 3.83777 8.62673 3.83777 8.82716V10.0943C3.83777 10.295 4.00037 10.4574 4.20074 10.4574H5.46805C5.66864 10.4574 5.83121 10.295 5.83121 10.0943V8.82716Z" fill="#C4C4C4"/>
                                            <path d="M8.99674 8.82716C8.99674 8.62673 8.83414 8.46436 8.63393 8.46436H7.36645C7.16609 8.46436 7.00348 8.62673 7.00348 8.82716V10.0943C7.00348 10.295 7.16609 10.4574 7.36645 10.4574H8.63393C8.83414 10.4574 8.99674 10.295 8.99674 10.0943V8.82716Z" fill="#C4C4C4"/>
                                            <path d="M12.1651 8.82716C12.1651 8.62673 12.0025 8.46436 11.8021 8.46436H10.5348C10.3342 8.46436 10.1716 8.62673 10.1716 8.82716V10.0943C10.1716 10.295 10.3342 10.4574 10.5348 10.4574H11.8021C12.0025 10.4574 12.1651 10.295 12.1651 10.0943V8.82716Z" fill="#C4C4C4"/>
                                            <path d="M5.83121 11.9946C5.83121 11.7938 5.66864 11.6316 5.46805 11.6316H4.20074C4.00037 11.6316 3.83777 11.7938 3.83777 11.9946V13.2615C3.83777 13.4621 4.00037 13.6245 4.20074 13.6245H5.46805C5.66864 13.6245 5.83121 13.462 5.83121 13.2615V11.9946Z" fill="#C4C4C4"/>
                                            <path d="M8.99674 11.9946C8.99674 11.7938 8.83414 11.6316 8.63393 11.6316H7.36645C7.16609 11.6316 7.00348 11.7938 7.00348 11.9946V13.2615C7.00348 13.4621 7.16609 13.6245 7.36645 13.6245H8.63393C8.83414 13.6245 8.99674 13.462 8.99674 13.2615V11.9946Z" fill="#C4C4C4"/>
                                            <path d="M12.1651 11.9946C12.1651 11.7938 12.0025 11.6316 11.8023 11.6316H10.5348C10.3342 11.6316 10.1716 11.7938 10.1716 11.9946V13.2615C10.1716 13.4621 10.3342 13.6245 10.5348 13.6245H11.8023C12.0025 13.6245 12.1651 13.462 12.1651 13.2615V11.9946Z" fill="#C4C4C4"/>
                                            <path d="M14.4309 1.78161V3.71707C14.4309 4.59189 13.7212 5.29685 12.8465 5.29685H11.847C10.9723 5.29685 10.2532 4.59189 10.2532 3.71707V1.77466H5.74839V3.71707C5.74839 4.59189 5.02934 5.29685 4.15473 5.29685H3.15507C2.28042 5.29685 1.57078 4.59189 1.57078 3.71707V1.78161C0.806327 1.80465 0.178162 2.43721 0.178162 3.2147V14.5575C0.178162 15.3496 0.820191 16.0001 1.6123 16.0001H14.3893C15.1802 16.0001 15.8235 15.3482 15.8235 14.5575V3.2147C15.8235 2.43721 15.1953 1.80465 14.4309 1.78161ZM13.9667 13.8511C13.9667 14.1934 13.6891 14.4712 13.3466 14.4712H2.62766C2.28521 14.4712 2.00766 14.1934 2.00766 13.8511V7.99218C2.00766 7.64973 2.28518 7.37201 2.62766 7.37201H13.3466C13.6891 7.37201 13.9666 7.64973 13.9666 7.99218L13.9667 13.8511Z" fill="#C4C4C4"/>
                                            <path d="M3.15189 4.25917H4.1405C4.44057 4.25917 4.68387 4.01622 4.68387 3.71615V0.543208C4.68387 0.243105 4.44057 0 4.1405 0H3.15189C2.85179 0 2.60852 0.243105 2.60852 0.543208V3.71615C2.60852 4.01622 2.85179 4.25917 3.15189 4.25917Z" fill="#C4C4C4"/>
                                            <path d="M11.8345 4.25917H12.8231C13.123 4.25917 13.3663 4.01622 13.3663 3.71615V0.543208C13.3663 0.243105 13.123 0 12.8231 0H11.8345C11.5344 0 11.2911 0.243105 11.2911 0.543208V3.71615C11.2911 4.01622 11.5344 4.25917 11.8345 4.25917Z" fill="#C4C4C4"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <span><?php echo get_the_date('M j, Y') ?></span>
                            </div>

                            <div class="post-social-items">
<!--                                <div class="post-social-items-ico">-->
<!--                                    <img src="--><?php //echo get_template_directory_uri().'/images/main-new/icon-share.svg' ?><!--" class="main-new-search-ico" alt="share-icon">-->
<!--                                </div>-->
                                <div class="post-social-item-wrapper">

                                    <div class="post-social-item">
                                        <div class="fb-share-button"
                                             data-layout="button"
                                             data-size="small"
                                             data-href="<?php echo get_the_title() ?>"
                                        >
                                            <a target="_blank"
                                               href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                               class="fb-xfbml-parse-ignore"
                                            >Share</a>
                                        </div>
                                    </div>
                                    <div class="post-social-item">
                                        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-url="<?php echo get_the_title() ?>"
                                           data-text="<?php echo get_the_permalink() ?>"
                                           rel="canonical"
                                        >Tweet</a>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>

        </div>
        <?php if(wp_is_mobile()) : ?>
        <div class="explore-more d-flex justify-content-center">
            <a href="/blog/" target="_blank">Explore more posts</a>
        </div>
        <?php endif; ?>
    </div>


<?php get_footer('new'); ?>