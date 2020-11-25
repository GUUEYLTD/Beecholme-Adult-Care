<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
    <?php wp_head(); ?>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/mobile-991.css" media="only screen and (max-width: 991px)">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/mobile-767.css" media="only screen and (max-width: 767px)">
    <link rel="icon" href="https://beecholmeadultcare.co.uk/wp-content/uploads/2020/06/favicon-1.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="https://beecholmeadultcare.co.uk/wp-content/uploads/2020/06/favicon-1.ico" type="image/x-icon" />
    <?php $cur_page = get_the_ID(); ?>
    <!-- Google Analytics -->
    <script>
      window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
      ga('create', 'UA-139963754-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <!-- End Google Analytics -->
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/6e72fa740d0fb29dca49fb646/2b3d4bba124de2800ffbe3afa.js");</script>
</head>

<body <?php body_class();?> class="page-<?php echo $cur_page; ?>">

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0"></script>

<div class="popup">
    <div class="popup-body">
        <h3>Thank you for contacting us. We have received your enquiry and will respond to you shortly. For urgent requests please call us on  <br><a href="tel:+442086486681">+44 20 8648 6681</a></h3>
    </div>
</div>
<header id="header">
    <div class="inner-container header-container d-flex justify-content-between">
        <div class="logo">
            <a class="logo-black-letters" href="/">
                <img src="<?php echo get_template_directory_uri(); ?>/images/main-new/logo-new.svg" alt="logo">
            </a>

        </div>
        <div class="mobile-menu d-flex">
            <div class="desk-nav">
                <a href="/our-counsellors">Find Your Counsellor</a>
                <a href="/frequently-asked-questions">Help</a>
                <a href="/info-for-counsellors">Join BAC</a>
                <?php //wp_nav_menu( array( 'theme_name' => 'Header-top' ) ); ?>
            </div>
            <div class="toggle align-self-center">
                <div class="toggle-inner"></div>
            </div>
            <div class="mobile-menu-container">
                <div class="inner-container menu-container-new">
                    <div class="mobile-only mobile-only-top-buttons">
                        <a href="/frequently-asked-questions" class="menu-button-50">Help</a>
                        <a href="/info-for-counsellors" class="menu-button-50">Join BAC</a>
                    </div>
                    <?php
                    if (wp_is_mobile()){
                       wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
                    }else {
                        wp_nav_menu( array( 'theme_name' => 'Header-new' ) );
                    }
                    ?>

                    <div class="menu-socials-wrapper">
                        <a href="/our-counsellors" class="mobile-only menu-button-100">Find Your Counsellor</a>
                        <div class="menu-socials">
                            <a href="https://www.facebook.com/BeecholmeAdultCare/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/main-new/icon-facebook.svg" alt="fb"></a>
                            <a href="https://twitter.com/BeecholmeAC" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/main-new/icon-twitter.svg" alt="twitter"></a>
                            <a href="https://www.instagram.com/bac_beecholmeadultcare/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/main-new/icon-instagram.svg" alt="instagram"></a>
                            <a href="https://www.linkedin.com/company/beecholme-adult-care-ltd/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/main-new/icon-linkedin.svg" alt="linkedin"></a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

<!--    </div>-->
<!--    <div class="header-menu inner-container --><?php //if(is_front_page()) {echo 'home-header';} ?><!-- ">-->
<!--        --><?php //wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
<!--        <div class="header-controls d-flex header-mobile-controls">-->
<!--            <a class="align-self-center" href="tel:+442086486681">+442086486681</a>-->
<!--            <a class="align-self-center" href="/make-a-referral">Make a Referral</a>-->
<!--            <a class="align-self-center" href="/contact-us">Book a visit</a>-->
<!--        </div>-->
<!--    </div>-->
</header>
<?php if(is_front_page() || is_home() ||  is_singular('post') || is_archive() || is_page_template(array('home-redesign.php', 'info-for-counsellors.php', 'info-for-counsellors-registration.php', 'info-for-counsellors-clients.php', 'info-for-counsellors-payments.php', 'info-for-counsellors-cancellation.php', 'info-for-counsellors-zoom-account.php', 'info-for-counsellors-sessions.php', 'info-for-counsellors-profile.php'))) {} else { ?>
<h1 class="page-title"><?php echo get_the_title(); ?></h1>
<?php if(get_field('hero_image', $cur_page)) { ?>
<div class="mid-container hero-image d-flex justify-content-center">
    <img src="<?php the_field('hero_image', $cur_page); ?>" alt="hero">
</div>
<?php }
} ?>