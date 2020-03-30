<?php /*Template Name: referral*/
 get_header();
  ?>

<div class="text-block-800">
	<div class="ref-subheading"><?php the_field('ref_subheading'); ?></div>
</div>  

<div class="form-wrapper contact">
	<div class="mobile-switcher">
		<button class="switch-button patient-button active">Patient form</button>
		<button class="switch-button provider-button">Provider form</button>
	</div>		
	<div class="thousand-container referral-form-container d-flex justify-content-between">
		<div class="contact-form-container patient-form align-self-start">
			<h4>Are you a patient or family member?</h4>
			<?php echo do_shortcode('[contact-form-7 id="190" title="Patient form"]'); ?>	
		</div>
		<div class="contact-form-container provider-form align-self-start">
			<h4>Are you a provider?</h4>
			<?php echo do_shortcode('[contact-form-7 id="191" title="Member form"]'); ?>	
		</div>		
	</div>
</div>

<?php get_footer(); ?>  