<?php /*Template Name: recovery*/
 get_header();
  ?>

<div class="text-block-800 recovery-text">
	<?php the_field('page_text', $cur_page); ?>
	<div class="recovery-booking">
		<a class="cta-button" href="/contact-us">Book a visit <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="arrow-right"></a>
	</div>	
</div>
<div class="gray-table approach-benefits">
	<h4><?php the_field('approach_benefits_text') ?></h4>
	<ul>
		<?php if(get_field('benefit_1')) { ?>
			<li><?php the_field('benefit_1') ?></li>
		<?php } ?>
		<?php if(get_field('benefit_2')) { ?>
			<li><?php the_field('benefit_2') ?></li>
		<?php } ?>	
		<?php if(get_field('benefit_3')) { ?>
			<li><?php the_field('benefit_3') ?></li>
		<?php } ?>	
		<?php if(get_field('benefit_4')) { ?>
			<li><?php the_field('benefit_4') ?></li>
		<?php } ?>	
		<?php if(get_field('benefit_5')) { ?>
			<li><?php the_field('benefit_5') ?></li>
		<?php } ?>	
		<?php if(get_field('benefit_6')) { ?>
			<li><?php the_field('benefit_6') ?></li>
		<?php } ?>												
	</ul>
</div>  

<?php get_footer(); ?> 