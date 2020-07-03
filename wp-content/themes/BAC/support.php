<?php /*Template Name: support*/
 get_header();
  ?>

<div class="text-block-800 community-support">
	<h2 class="sup-subheading"><?php the_field('sup_subheading'); ?></h2>
	<h3><?php the_field('sup_text'); ?></h3>
</div>

<div class="support-booking">
	<a class="cta-button" href="mailto:mailto:info@beecholmeadultcare.co.uk">Email us for more info <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg"  alt="arrow-right"></a>
	<p><?php the_field('sup_button_text'); ?></p>
</div>

<?php get_footer(); ?>