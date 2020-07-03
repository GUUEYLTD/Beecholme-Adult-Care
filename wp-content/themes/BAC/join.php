<?php /*Template Name: join*/
 get_header();
  ?>

<div class="form-wrapper contact">
	<div class="small-container join-team d-flex justify-content-between">
		<div class="vacancies">
			<h4><?php the_field('vac_heading'); ?></h4>
			<?php if(get_field('vac_name_1')) { ?>
			<a class="single-vacancy" href="<?php the_field('vac_link_1'); ?>"><?php the_field('vac_name_1'); ?></a>
			<?php } ?>
			<?php if(get_field('vac_name_2')) { ?>
			<a class="single-vacancy" href="<?php the_field('vac_link_2'); ?>"><?php the_field('vac_name_2'); ?></a>
			<?php } ?>
			<?php if(get_field('vac_name_3')) { ?>
			<a class="single-vacancy" href="<?php the_field('vac_link_3'); ?>"><?php the_field('vac_name_3'); ?></a>
			<?php } ?>
			<?php if(get_field('vac_name_4')) { ?>
			<a class="single-vacancy" href="<?php the_field('vac_link_4'); ?>"><?php the_field('vac_name_4'); ?></a>
			<?php } ?>	
			<?php if(get_field('vac_name_5')) { ?>
			<a class="single-vacancy" href="<?php the_field('vac_link_5'); ?>"><?php the_field('vac_name_5'); ?></a>
			<?php } ?>	
			<?php if(get_field('vac_name_6')) { ?>
			<a class="single-vacancy" href="<?php the_field('vac_link_6'); ?>"><?php the_field('vac_name_6'); ?></a>
			<?php } ?>																
		</div>
		<div class="contact-form-container">
			<h4>Apply for a position</h4>
			<?php echo do_shortcode('[contact-form-7 id="189" title="Join our team"]'); ?>
		</div>
	</div>
</div>  

<?php get_footer(); ?>   