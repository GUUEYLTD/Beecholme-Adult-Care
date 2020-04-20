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
    <?php $cur_page = get_the_ID(); ?>
    <!-- Google Analytics -->
	<script>
	window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
	ga('create', 'UA-139963754-1', 'auto');
	ga('send', 'pageview');
	</script>
	<script async src='https://www.google-analytics.com/analytics.js'></script>
	<!-- End Google Analytics -->
</head>

<body class="page-<?php echo $cur_page; ?>">

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
				<a href="/">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="logo">
				</a>
			</div>
			<div class="header-controls d-flex">
				<!-- TrustBox widget - Micro Review Count -->
				<div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5e68a17b7935f90001f6f836" data-style-height="58px" data-style-width="301px" data-theme="light">
					<a href="https://uk.trustpilot.com/review/beecholmeadultcare.co.uk" target="_blank" rel="noopener">Trustpilot</a>
				</div>
				<!-- End TrustBox widget -->
				<!--<a href="#" class="logo-trustpilot"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_trustpilot.png" alt=""></a>-->
<!--				<a class="align-self-center" href="tel:+442086486681">+442086486681</a>
				<a class="align-self-center" href="/make-a-referral">Make a Referral</a>
				<a class="align-self-center" href="/contact-us">Book a visit</a>-->
			</div>
			<div class="mobile-menu d-flex">
				<div class="toggle align-self-center">
				    <div class="toggle-inner"></div>
				</div>
				<div class="mobile-menu-container">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
				</div>
			</div>
		</div>
		<div class="header-menu inner-container <?php if(is_front_page()) {echo 'home-header';} ?> ">
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
			<div class="header-controls d-flex header-mobile-controls">
				<a class="align-self-center" href="tel:+442086486681">+442086486681</a>
				<a class="align-self-center" href="/make-a-referral">Make a Referral</a>
				<a class="align-self-center" href="/contact-us">Book a visit</a>
			</div>
		</div>
	</header>
	<?php if(is_front_page() || is_home() ||  is_singular('post') || is_archive()) {} else { ?>
        <h1 class="page-title"><?php echo get_the_title(); ?></h1>
		<?php if(get_field('hero_image', $cur_page)) { ?>
		<div class="mid-container hero-image d-flex justify-content-center">
			<img src="<?php the_field('hero_image', $cur_page); ?>" alt="hero">
		</div>
	<?php }
	} ?>