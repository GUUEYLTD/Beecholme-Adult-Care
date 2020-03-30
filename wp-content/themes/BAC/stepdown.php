<?php /*Template Name: stepdown*/
 get_header();
  ?>

<div class="stepdown-text">
	<h2><p><?php the_field('stepd_text'); ?></p></h2>
</div> 

<div class="gray-table stepdown-table">
	<h2 class="gray-table-title">Semi Independent Step Down Features</h2>
	<div class="table-content d-flex justify-content-between flex-wrap">
		<?php if(get_field('step_h1')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h1') ?></h3>
				<p><?php the_field('step_t1') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('step_h2')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h2') ?></h3>
				<p><?php the_field('step_t2') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('step_h3')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h3') ?></h3>
				<p><?php the_field('step_t3') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('step_h4')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h4') ?></h3>
				<p><?php the_field('step_t4') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('step_h5')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h5') ?></h3>
				<p><?php the_field('step_t5') ?></p>
			</div>	
		<?php } ?>												
		<?php if(get_field('step_h6')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h6') ?></h3>
				<p><?php the_field('step_t6') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('step_h7')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h7') ?></h3>
				<p><?php the_field('step_t7') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('step_h8')) { ?>
			<div class="single-table-feature">
				<h3><?php the_field('step_h8') ?></h3>
				<p><?php the_field('step_t8') ?></p>
			</div>	
		<?php } ?>			
	</div>
</div>

<div class="book-block d-flex">
	<div class="book-block-content align-self-center">
		<h4>Visit our home and book a visit</h4>
		<a class="cta-button" href="/contact-us">Book a visit <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right-green.svg" alt="arrow right"></a>
		<p>8 Downe Road<br>Micham,<br>Surrey<br>CR4 2JL</p>
	</div>
</div>

<div class="google-map">
	<div class="google-map-overlay"></div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.760991696881!2d-0.16214257869303722!3d51.40744616754054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876064067e8c715%3A0xb08ed28862d49e2b!2zOCBEb3duZSBSZCwgTWl0Y2hhbSBDUjQgMkpMLCDQktC10LvQuNC60L7QsdGA0LjRgtCw0L3QuNGP!5e0!3m2!1sru!2sua!4v1519898552889" width="1920" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>	

<?php get_footer(); ?>  