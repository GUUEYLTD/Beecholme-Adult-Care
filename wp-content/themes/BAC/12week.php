<?php /*Template Name: 12week*/
 get_header();
  ?>

<div class="text-block-800 twelve-week-text">
	<h2 class="twelve-week-title"><?php the_field('text_heading', $cur_page); ?></h2>
	<?php the_field('page_text', $cur_page); ?>	
</div>
<div class="gray-table twelve-week">
	<h2 class="gray-table-title"><?php the_field('key_areas_heading'); ?></h2>
	<div class="keys-container d-flex justify-content-between">
		<div class="left-keys">
			<?php if(get_field('key_1', $cur_page)) { ?>
				<h3><?php the_field('key_1'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_2', $cur_page)) { ?>
				<h3><?php the_field('key_2'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_3', $cur_page)) { ?>
				<h3><?php the_field('key_3'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_4', $cur_page)) { ?>
				<h3><?php the_field('key_4'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_5', $cur_page)) { ?>
				<h3><?php the_field('key_5'); ?></h3>
			<?php } ?>													
		</div>
		<div class="right-keys">
			<?php if(get_field('key_6', $cur_page)) { ?>
				<h3><?php the_field('key_6'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_7', $cur_page)) { ?>
				<h3><?php the_field('key_7'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_8', $cur_page)) { ?>
				<h3><?php the_field('key_8'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_9', $cur_page)) { ?>
				<h3><?php the_field('key_9'); ?></h3>
			<?php } ?>	
			<?php if(get_field('key_10', $cur_page)) { ?>
				<h3><?php the_field('key_10'); ?></h3>
			<?php } ?>				
		</div>
	</div>
</div>
<div class="twelve-week-booking">
	<a class="cta-button" href="/contact-us">For more information please contact us <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="arrow-right"></a>
</div>	 

<?php get_footer(); ?>   