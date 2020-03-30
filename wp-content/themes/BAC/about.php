<?php /*Template Name: about*/
 get_header();
  ?>
<div class="about-content-first small-container">
	<?php if(get_field('pros_h1')) { ?>
	<div class="single-about-text d-flex justify-content-between">
		<div class="about-heading d-flex justify-content-start flex-column">
			<h2><?php the_field('pros_h1'); ?></h2>
			<div class="about-img-wrapper">
				<img src="<?php the_field('pros_i1'); ?>" alt="about">
			</div>
		</div>
		<div class="about-text">
			<h2><?php the_field('pros_t1'); ?></h2>
		</div>
	</div>
	<?php } ?>
</div>

<div class="principles">
	<h2>Principles & Values Underspinning Our Services</h2>
	<div class="principles-container d-flex justify-content-between flex-wrap">
		<?php if(get_field('prin_h1')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h1'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t1'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h2')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h2'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t2'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h3')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h3'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t3'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h4')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h4'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t4'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h5')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h5'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t5'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h6')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h6'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t6'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h7')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h7'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t7'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h8')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h8'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t8'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h9')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h9'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t9'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h10')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h10'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t10'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h11')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h11'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t11'); ?></p>
		</div>
		<?php } ?>
		<?php if(get_field('prin_h12')) { ?>
		<div class="single-principle">
			<h3 class="principle-heading"><?php the_field('prin_h12'); ?></h3>
			<p class="principle-text"><?php the_field('prin_t12'); ?></p>
		</div>
		<?php } ?>																						
	</div>
	<div class="principles-button">
		<a class="cta-button" href="">Contact Us <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="about"></a>
	</div>
</div>

<div class="about-content-second small-container">
	<?php if(get_field('pros_h2')) { ?>
	<div class="single-about-text d-flex justify-content-between">
		<div class="about-heading d-flex justify-content-start flex-column">
			<h2><?php the_field('pros_h2'); ?></h2>
			<div class="about-img-wrapper">
				<img src="<?php the_field('pros_i2'); ?>" alt="about">
			</div>
		</div>
		<div class="about-text">
			<h2><?php the_field('pros_t2'); ?></h2>
		</div>
	</div>
	<?php } ?>
	<?php if(get_field('pros_h3')) { ?>
	<div class="single-about-text d-flex justify-content-between">
		<div class="about-heading d-flex justify-content-start flex-column">
			<h2><?php the_field('pros_h3'); ?></h2>
			<div class="about-img-wrapper">
				<img src="<?php the_field('pros_i3'); ?>" alt="about">
			</div>
		</div>
		<div class="about-text">
			<h2><?php the_field('pros_t3'); ?></h2>
		</div>
	</div>
	<?php } ?>	
</div>

<div class="timeline inner-container d-flex">
	<div class="left-part d-flex justify-content-start flex-column">
		<h2>Story</h2>
		<img src="/wp-content/uploads/2018/03/story-anim_1.gif" alt="about">
	</div>
	<div class="timeline-container">
		<div class="single-timeline-container">
			<div class="single-timeline-content">
				<h2><?php the_field('timeline_1'); ?></h2>
			</div>
		</div>
		<div class="single-timeline-container">
			<div class="single-timeline-content">
                <h2><?php the_field('timeline_2'); ?></h2>
			</div>
		</div>
		<div class="single-timeline-container">
			<div class="single-timeline-content">
				<h2><?php the_field('timeline_3'); ?></h2>
			</div>
		</div>				
	</div>
</div>


 <?php get_footer(); ?>