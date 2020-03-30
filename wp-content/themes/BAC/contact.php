<?php /*Template Name: contact*/
 get_header();
  ?>

<div class="google-map">
	<div class="google-map-overlay"></div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.388272210313!2d-0.15435908423344974!3d51.41429387961996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760668a774df57%3A0xc25249c9ed825206!2sBeecholme+Adult+Care!5e0!3m2!1sru!2sua!4v1518099027832" width="1920" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<div class="form-wrapper contact">
	<div class="mobile-switcher">
		<button class="switch-button contact-us-button active">Contact form</button>
		<button class="switch-button book-visit-button">Book a visit</button>
	</div>
	<div class="small-container d-flex justify-content-between">
		<div class="contact-form-container contact-us-form align-self-start">
			<h4>Contact Form</h4>
			<?php echo do_shortcode('[contact-form-7 id="188" title="Contact us"]'); ?>
		</div>
		<div class="contact-form-container book-visit-form align-self-start">
			<h4>Book a visit</h4>
			<?php echo do_shortcode('[contact-form-7 id="214" title="Book a visit"]'); ?>
		</div>		
	</div>
	<div class="small-container">
		<div class="contact-info">
			<?php the_field('cont_info'); ?>
			<div class="social-wrapper">
				<h5>Follow us</h5>
				<div class="contact-social">
					<a href="https://www.facebook.com/BeecholmeAdultCare/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-fb.svg" alt="fb"></a>
					<a href="https://twitter.com/BeecholmeAC" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-twitter.svg"  alt="twitter"></a>
					<a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-insta.svg"  alt="instagram"></a>
					<a href="https://www.linkedin.com/company/beecholme-adult-care-ltd/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-linkedin.svg"  alt="linkedin"></a>
				</div>
			</div>
		</div>		
	</div>
</div>

<?php get_footer(); ?> 