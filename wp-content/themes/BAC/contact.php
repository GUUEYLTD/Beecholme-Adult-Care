<?php /*Template Name: contact*/
 get_header();
?>
<style>
    .contact form{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .contact form p{
        margin-bottom:25px
    }
    .contact form p, .contact form label{
        width:100%
    }
    .contact .wpcf7-form-control-wrap{margin:auto}
    .contact .wpcf7-form input[type="submit"]{
        padding:10px 0;
        max-width: 310px;
    }
    .contact div.wpcf7 .ajax-loader{
        display:none!important
    }
    .contact .wpcf7-form input, .contact .wpcf7-form select, .contact .wpcf7-form textarea{
        width:100%!important
    }
    .contact .wpcf7-form input:focus, .contact .wpcf7-form select:focus, .contact .wpcf7-form textarea:focus{
        border: 1px solid #5AB9AC;
        outline:none
    }

    .contact span.wpcf7-not-valid-tip {
        color: #f00;
        font-weight: normal;
        display: block;
        position: absolute;
        font-size: 12px;
    }
    .contact div.wpcf7-response-output{
        margin:30px auto;
        text-align:center;
    }

    @media all and (min-width: 992px) {
        .contact form p:nth-child(1),
        .contact form p:nth-child(2),
        .contact form p:nth-child(3),
        .contact form p:nth-child(4),
        .contact form p:nth-child(5){
            width:48%
        }
        .contact-form-container{width:800px}
    }
    @media all and (max-width: 991px) {
        .small-container{
            padding:0 15px;
        }
    }
    @media all and (max-width: 374px) {
        .small-container{
            padding:0;
        }
    }

</style>
<!--<div class="google-map">-->
<!--	<div class="google-map-overlay"></div>-->
<!--	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.388272210313!2d-0.15435908423344974!3d51.41429387961996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760668a774df57%3A0xc25249c9ed825206!2sBeecholme+Adult+Care!5e0!3m2!1sru!2sua!4v1518099027832" width="1920" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>-->
<!--</div>-->

<div class="form-wrapper contact">
<!--	<div class="mobile-switcher">-->
<!--		<button class="switch-button contact-us-button active">Contact form</button>-->
<!--		<button class="switch-button book-visit-button">Book a visit</button>-->
<!--	</div>-->
	<div class="small-container d-flex justify-content-center">
		<div class="contact-form-container contact-us-form ">
			<h4>Contact Form</h4>
			<?php echo do_shortcode('[contact-form-7 id="188" title="Contact us"]'); ?>
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