<?php /*Template Name: home*/
get_header();
$cur_page = get_the_ID();

do_shortcode("[declare_recent_posts posts_number=4]");
global $recentPosts;

/*Return counsellors*/
$practitioners = new \BAC\Practitioners();
$counsellors   = apply_filters('bac_listed_counsellors', $practitioners->mobileCounsellors($_GET));

if(!empty($counsellors)) {
    add_action('bac_list_counsellors', array('\BAC\Practitioners', 'listCatalogue'), 10, 1);
}
?>

<?php if ( !wp_is_mobile() ) : ?>
    <div class="home-top-banner d-flex align-items-center justify-content-center" style="background-image: url(<?php the_field('hero_image', $cur_page); ?>)">
        <div class="dark-bg"></div>
        <div class="banner-content d-flex">
            <div class="heading">
                <h1><?php the_field('hero_heading', $cur_page); ?></h1>
                <h2 class="second-heading"><?php the_field('hero_subheading', $cur_page); ?></h2>
                <div class="heading-button-wrapper">
                    <a class="cta-button" href="/our-counsellors/" target="_blank">Book A Free Session Now</a>
                </div>
            </div>
            <div class="home-form-wrapper">
                <div class="october-promo">
                    <div class="octobet-promo-deko">October Promo</div>
                    <div class="octobet-promo-text">
                        <div class="deco-leaf-one"></div>
                        <div class="deco-leaf-two"></div>
                        <div class="deco-leaf-three"></div>
                        <div class="deco-leaf-four"></div>
                        Free 20 min counsultation with the code WELCOME20
                    </div>
                </div>
                <div class="tabs d-flex justify-content-center">
                    <div class="tab active" data-tab="find-tab">Find a Counsellor</div>
                    <div class="tab" data-tab="referral-tab">Make a Referral</div>
                </div>
                <form class="tab-content find-tab active" action="our-counsellors">
                    <div class="homepage-filter type-filter d-flex flex-column align-left">
                        <div class="caption">I am looking for a</div>
                        <div class="type-tabs d-flex">
                            <label for="radio-type-coach"
                                   class="single-tab coach <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'active' : ''; ?>"
                                   data-type="coach">Life Coach</label>
                            <label for="radio-type-therapist"
                                   class="single-tab therapist <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'active' : ''; ?>"
                                   data-type="therapist">Therapist</label>
                            <label for="radio-type-all"
                                   class="single-tab all active <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'active' : ''; ?>"
                                   data-type="all">All</label>
                            <input type="radio" name="type" value="Life coach" class="hidden"
                                   id="radio-type-coach" <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'checked' : ''; ?>/>
                            <input type="radio" name="type" value="Therapist" class="hidden"
                                   id="radio-type-therapist" <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'checked' : ''; ?>/>
                            <input type="radio" name="type" value="" class="hidden"
                                   id="radio-type-all" <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'checked' : ''; ?>/>
                        </div>
                    </div>

                    <div class="homepage-filter question-filter therapist-question-filter flex-column align-left">
                        <div class="caption">What are you suffering from?</div>
                        <select class="question-select" name="therapy">
                            <option value="" data-display-text="All">All</option>
                            <?php foreach (getServices('Therapist') as $serviceName) : ?>
                                <option
                                        value="<?php echo $serviceName ?>"
                                    <?php echo isset($_GET['therapy']) && $_GET['therapy'] === $serviceName ? 'selected' : '' ?>
                                ><?php echo $serviceName ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="homepage-filter question-filter coach-question-filter flex-column align-left">
                        <div class="caption">Type of coaching</div>
                        <select class="question-select" name="coaching">
                            <option value="" data-display-text="All">All</option>
                            <?php foreach (getServices('Life coach') as $serviceName) : ?>
                                <option
                                        value="<?php echo $serviceName ?>"
                                    <?php echo isset($_GET['coaching']) && $_GET['coaching'] === $serviceName ? 'selected' : '' ?>
                                ><?php echo $serviceName ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="homepage-filter question-filter empty-filter flex-column align-left active">
                        <div class="caption">Choose type</div>
                        <select class="question-select" name="common">
                            <option value="" data-display-text="All">All</option>
                            <?php foreach (getServices() as $serviceName) : ?>
                                <option
                                        value="<?php echo $serviceName ?>"
                                    <?php echo isset($_GET['common']) && $_GET['common'] === $serviceName ? 'selected' : '' ?>
                                ><?php echo $serviceName ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="button-wrapper">
                        <button>Search</button>
                    </div>
                    <div class="add-text-main">
                        <?php the_field('hero_subheading_p2', $cur_page); ?>
                    </div>
                </form>
                <div class="tab-content referral-tab">
                    <?php echo do_shortcode('[contact-form-7 id="18" title="Home page"]'); ?>
                    <div class="form-addition">
                        <div class="form-addition-text">or you can call us directly</div>
                        <div class="form-addition-action d-flex justify-content-between">
                            <div class="d-flex"><a href="tel:+44 20 8648 6681">+44 20 8648 6681</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="text-center home-top-banner-mobile ">
        <img src="<?php echo get_template_directory_uri().'/images/mobile-main-first.png' ?>" alt="mobile-main-first-block">
        <div class="home-top-banner-mobile-text-buttons">
            <div data-wow-delay="0.7s" class="home-top-banner-mobile-text wow fadeIn">
                <h1><?php the_field('home_page_h1', $cur_page); ?></h1>
                <h2><?php the_field('home_page_h2', $cur_page); ?></h2>
            </div>
            <div class="home-top-banner-mobile-buttons">
                <div data-wow-delay="1.4s" class="cta-button-wrapper wow fadeInUpBig">
                    <a class="cta-button cta-button-sessions" href="/our-counsellors/">Book Your Free Session Now</a>
                </div>
                <div class="cta-button-wrapper">
                    <a class="cta-button cta-button-wellbeing" href="/our-counsellors/">Test Your Wellbeing</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ( wp_is_mobile() ) : ?>
    <div class="main-mob-counsellors">
        <h2>Our Counsellors</h2>
        <div class="main-mob-counsellors-subtitle">Affordable online therapy and life coaching for all. Book a FREE session with a professional counsellor</div>
        <div class="owl-carousel owl-theme our-counsellors">
            <?php do_action('bac_list_counsellors', $counsellors); ?>
        </div>
        <div class="cta-button-wrapper">
            <a class="cta-button" href="/our-counsellors/">Meet All Counsellors</a>
        </div>
    </div>

    <div class="main-mob-counsellors-form">

        <div class="banner-content  home-form-wrapper">
            <div class="october-promo">
                <div class="octobet-promo-deko">October Promo</div>
                <div class="octobet-promo-text">
                    <div class="deco-leaf-one"></div>
                    <div class="deco-leaf-two"></div>
                    <div class="deco-leaf-three"></div>
                    <div class="deco-leaf-four"></div>
                    Free 20 min counsultation with the code WELCOME20
                </div>
            </div>
            <h2>Find Your Counsellor</h2>
            <form class="tab-content find-tab active" action="our-counsellors">
                <div class="homepage-filter type-filter d-flex flex-column align-left">
                    <div class="caption">I am looking for a</div>
                    <div class="type-tabs d-flex">
                        <label for="radio-type-coach"
                               class="single-tab coach <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'active' : ''; ?>"
                               data-type="coach">Life Coach</label>
                        <label for="radio-type-therapist"
                               class="single-tab therapist <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'active' : ''; ?>"
                               data-type="therapist">Therapist</label>
                        <label for="radio-type-all"
                               class="single-tab all active <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'active' : ''; ?>"
                               data-type="all">All</label>
                        <input type="radio" name="type" value="Life coach" class="hidden"
                               id="radio-type-coach" <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'checked' : ''; ?>/>
                        <input type="radio" name="type" value="Therapist" class="hidden"
                               id="radio-type-therapist" <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'checked' : ''; ?>/>
                        <input type="radio" name="type" value="" class="hidden"
                               id="radio-type-all" <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'checked' : ''; ?>/>
                    </div>
                </div>

                <div class="homepage-filter question-filter therapist-question-filter flex-column align-left">
                    <div class="caption">What are you suffering from?</div>
                    <select class="question-select" name="therapy">
                        <option value="" data-display-text="All">All</option>
                        <?php foreach (getServices('Therapist') as $serviceName) : ?>
                            <option
                                    value="<?php echo $serviceName ?>"
                                <?php echo isset($_GET['therapy']) && $_GET['therapy'] === $serviceName ? 'selected' : '' ?>
                            ><?php echo $serviceName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="homepage-filter question-filter coach-question-filter flex-column align-left">
                    <div class="caption">Type of coaching</div>
                    <select class="question-select" name="coaching">
                        <option value="" data-display-text="All">All</option>
                        <?php foreach (getServices('Life coach') as $serviceName) : ?>
                            <option
                                    value="<?php echo $serviceName ?>"
                                <?php echo isset($_GET['coaching']) && $_GET['coaching'] === $serviceName ? 'selected' : '' ?>
                            ><?php echo $serviceName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="homepage-filter question-filter empty-filter flex-column align-left active">
                    <div class="caption">Choose type</div>
                    <select class="question-select" name="common">
                        <option value="" data-display-text="All">All</option>
                        <?php foreach (getServices() as $serviceName) : ?>
                            <option
                                    value="<?php echo $serviceName ?>"
                                <?php echo isset($_GET['common']) && $_GET['common'] === $serviceName ? 'selected' : '' ?>
                            ><?php echo $serviceName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="button-wrapper">
                    <button>Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="main-mob-how-it-work">
        <h2>How It Works?</h2>
        <div data-wow-delay="0.4s" class="main-mob-how-it-work-item wow fadeInUp">
            <div class="main-mob-how-it-work-item-number"><?php the_field('number_first', $cur_page); ?></div>
            <div class="main-mob-how-it-work-item-title"><?php the_field('title_first', $cur_page); ?></div>
            <div class="main-mob-how-it-work-item-text"><?php the_field('subtitle_first', $cur_page); ?></div>
        </div>
        <div data-wow-delay="0.5s" class="main-mob-how-it-work-item wow fadeInUp">
            <div class="main-mob-how-it-work-item-number"><?php the_field('number_second', $cur_page); ?></div>
            <div class="main-mob-how-it-work-item-title"><?php the_field('title_second', $cur_page); ?></div>
            <div class="main-mob-how-it-work-item-text"><?php the_field('subtitle_second', $cur_page); ?></div>
        </div>
        <div data-wow-delay="0.6s" class="main-mob-how-it-work-item wow fadeInUp">
            <div class="main-mob-how-it-work-item-number"><?php the_field('number_third', $cur_page); ?></div>
            <div class="main-mob-how-it-work-item-title"><?php the_field('title_third', $cur_page); ?></div>
            <div class="main-mob-how-it-work-item-text"><?php the_field('subtitle_third', $cur_page); ?></div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            new WOW().init();
        });
    </script>
<?php endif; ?>

<?php if ( !wp_is_mobile() ) : ?>
    <div class="services">
        <h2>Services</h2>
        <div class="services-container d-flex justify-content-between">
            <?php if(get_field('serv_h1')) { ?>
                <a href="/12-week-recovery-program/" class="single-service-container d-flex align-items-top justify-content-center">
                    <div class="single-service">
                        <h3><?php the_field('serv_h1'); ?></h3>
                        <p><?php the_field('serv_t1'); ?></p>
                    </div>
                </a>
            <?php } ?>
            <?php if(get_field('serv_h2')) { ?>
                <a href="/24-hour-residential-care-home/" class="single-service-container d-flex align-items-top justify-content-center">
                    <div class="single-service">
                        <h3><?php the_field('serv_h2'); ?></h3>
                        <p><?php the_field('serv_t2'); ?></p>
                    </div>
                </a>
            <?php } ?>
            <?php if(get_field('serv_h3')) { ?>
                <a href="/life-coaching-surrey/" class="single-service-container d-flex align-items-top justify-content-center">
                    <div class="single-service">
                        <h3><?php the_field('serv_h3'); ?></h3>
                        <p><?php the_field('serv_t3'); ?></p>
                    </div>
                </a>
            <?php } ?>
            <?php if(get_field('serv_h4')) { ?>
                <a href="/therapist-surrey/" class="single-service-container d-flex align-items-top justify-content-center">
                    <div class="single-service">
                        <h3><?php the_field('serv_h4'); ?></h3>
                        <p><?php the_field('serv_t4'); ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="features">
        <h2>Why Choose BAC Supported<br>Living Accommodation?</h2>
        <div class="features-container mid-container d-flex flex-wrap">
            <?php if(get_field('feat_h1', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h1'); ?></h3>
                    <p><?php the_field('feat_t1'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h2', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h2'); ?></h3>
                    <p><?php the_field('feat_t2'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h3', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h3'); ?></h3>
                    <p><?php the_field('feat_t3'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h4', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h4'); ?></h3>
                    <p><?php the_field('feat_t4'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h5', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h5'); ?></h3>
                    <p><?php the_field('feat_t5'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h6', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h6'); ?></h3>
                    <p><?php the_field('feat_t6'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h7', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h7'); ?></h3>
                    <p><?php the_field('feat_t7'); ?></p>
                </div>
            <?php } ?>
            <?php if(get_field('feat_h8', $cur_page)) { ?>
                <div class="single-feature">
                    <h3><?php the_field('feat_h8'); ?></h3>
                    <p><?php the_field('feat_t8'); ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="features-booking">
            <a class="cta-button" href="/contact-us/">View Our Homes and Book a Visit</a>
        </div>
    </div>

    <div class="boxes">
        <div class="boxes-container inner-container">
            <div class="top-boxes d-flex justify-content-around">
                <a class="single-box d-flex flex-column justify-content-end" href="<?php the_field('gif_l1'); ?>">
                    <div class="box-content">
                        <img src="<?php the_field('gif_i1'); ?>" alt="">
                        <h4><?php the_field('gif_c1'); ?></h4>
                        <p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
                    </div>
                </a>
                <a class="single-box d-flex flex-column justify-content-end" href="<?php the_field('gif_l2'); ?>">
                    <div class="box-content">
                        <img src="<?php the_field('gif_i2'); ?>"  alt='arrow-left'>
                        <h4><?php the_field('gif_c2'); ?></h4>
                        <p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
                    </div>
                </a>
            </div>
            <div class="bottom-boxes d-flex justify-content-around">
                <a class="single-box d-flex flex-column justify-content-end" href="<?php the_field('gif_l3'); ?>">
                    <div class="box-content">
                        <img src="<?php the_field('gif_i3'); ?>"  alt='arrow-right'>
                        <h4><?php the_field('gif_c3'); ?></h4>
                        <p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
                    </div>
                </a>
                <a class="single-box d-flex flex-column justify-content-end" href="">
                    <div class="box-content">
                        <img src="<?php the_field('gif_i4'); ?>" alt='arrow-left'>
                        <h4><?php the_field('gif_c4'); ?></h4>
                        <p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="brochures small-container">
        <h3>Brochures</h3>
        <?php if(get_field('doc_n1')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n1'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f1'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f1'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n2')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n2'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f2'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f2'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n3')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n3'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f3'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f3'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n4')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n4'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f4'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f4'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n5')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n5'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f5'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f5'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n6')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n6'); ?></a>
                <div class="preview">   q
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f6'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f6'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n7')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n7'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f7'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f7'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n8')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n8'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f8'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f8'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n9')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n9'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f9'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f9'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
        <?php if(get_field('doc_n10')) { ?>
            <div class="single-brochure">
                <a class="single-brochure-link" href=""><?php the_field('doc_n10'); ?></a>
                <div class="preview">
                    <iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f10'); ?>&embedded=true"></iframe>
                    <a href="<?php the_field('doc_f10'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
                </div>
            </div>
        <?php } ?>
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

    <div class="information life-coaching">
        <div class="mid-container d-flex justify-between align-items-center">
            <div class="text">
                <h2><?php the_field('home_lc_heading'); ?></h2>
                <?php the_field('home_lc_text'); ?>
                <div class="link"><a href="/life-coaching-surrey/">Read More</a></div>
            </div>
            <div class="perks d-flex flex-column">
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_lc_perk_image_1'); ?>">
                    <span><?php the_field('home_lc_perk_text_1'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_lc_perk_image_2'); ?>">
                    <span><?php the_field('home_lc_perk_text_2'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_lc_perk_image_3'); ?>">
                    <span><?php the_field('home_lc_perk_text_3'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_lc_perk_image_4'); ?>">
                    <span><?php the_field('home_lc_perk_text_4'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_lc_perk_image_5'); ?>">
                    <span><?php the_field('home_lc_perk_text_5'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="information therapy">
        <div class="mid-container d-flex justify-between align-items-center">
            <div class="text">
                <h2><?php the_field('home_therapy_heading'); ?></h2>
                <?php the_field('home_therapy_text'); ?>
                <div class="link"><a href="/therapist-surrey/">Read More</a></div>
            </div>
            <div class="perks d-flex flex-column">
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_therapy_perk_image_1'); ?>">
                    <span><?php the_field('home_therapy_perk_text_1'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_therapy_perk_image_2'); ?>">
                    <span><?php the_field('home_therapy_perk_text_2'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_therapy_perk_image_3'); ?>">
                    <span><?php the_field('home_therapy_perk_text_3'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_therapy_perk_image_4'); ?>">
                    <span><?php the_field('home_therapy_perk_text_4'); ?></span>
                </div>
                <div class="single-perk d-flex align-items-center">
                    <img src="<?php the_field('home_therapy_perk_image_5'); ?>">
                    <span><?php the_field('home_therapy_perk_text_5'); ?></span>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

    <div class="blog-section d-flex flex-column container">
        <h2 class="title">
            Blog Posts
        </h2>
        <div class="posts d-flex flex-row">
            <?php foreach ($recentPosts as $post) { ?>
                <div class="post d-flex flex-column">
                    <div class="image">
                        <?php if(has_post_thumbnail()):?>
                            <img src="<?= wp_get_attachment_url( get_post_thumbnail_id($post->ID)) ?>" alt="">
                        <?php else: ?>
                            <img src="<?= get_template_directory_uri(); ?>/images/no-photo.png" alt="">
                        <?php endif;?>
                    </div>
                    <div class="content">
                        <div class="title"><?= $post->post_title ?></div>
                        <div class="description"><?= wp_filter_nohtml_kses($post->post_content) ?></div>
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
                                <span><?= date('M j, Y', strtotime($post->post_date)) ?></span>
                            </div>
                            <a href="<?= $post->guid ?>" target="_blank" class="read-more">Read more</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="explore-more d-flex justify-content-center">
            <a href="/blog/" target="_blank">Explore more posts</a>
        </div>
    </div>


<?php get_footer(); ?>