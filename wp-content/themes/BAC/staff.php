<?php /*Template Name: staff*/
 get_header();
  ?>

<div class="small-container staff-container">
	<div class="staff-text">
	<?php the_field('text', $cur_page) ?>
	</div>
	<div class="staff-members d-flex justify-content-start flex-wrap">
		<?php if(get_field('staff_n1')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i1'); ?>" alt="staff">
				<h6><?php the_field('staff_n1'); ?></h6>
				<p><?php the_field('staff_p1'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n2')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i2'); ?>" alt="staff">
				<h6><?php the_field('staff_n2'); ?></h6>
				<p><?php the_field('staff_p2'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n3')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i3'); ?>" alt="staff">
				<h6><?php the_field('staff_n3'); ?></h6>
				<p><?php the_field('staff_p3'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n4')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i4'); ?>" alt="staff">
				<h6><?php the_field('staff_n4'); ?></h6>
				<p><?php the_field('staff_p4'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n5')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i5'); ?>" alt="staff">
				<h6><?php the_field('staff_n5'); ?></h6>
				<p><?php the_field('staff_p5'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n6')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i6'); ?>" alt="staff">
				<h6><?php the_field('staff_n6'); ?></h6>
				<p><?php the_field('staff_p6'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n7')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i7'); ?>" alt="staff">
				<h6><?php the_field('staff_n7'); ?></h6>
				<p><?php the_field('staff_p7'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n8')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i8'); ?>" alt="staff">
				<h6><?php the_field('staff_n8'); ?></h6>
				<p><?php the_field('staff_p8'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n9')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i9'); ?>" alt="staff">
				<h6><?php the_field('staff_n9'); ?></h6>
				<p><?php the_field('staff_p9'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n10')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i10'); ?>" alt="staff">
				<h6><?php the_field('staff_n10'); ?></h6>
				<p><?php the_field('staff_p10'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n11')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i11'); ?>" alt="staff">
				<h6><?php the_field('staff_n11'); ?></h6>
				<p><?php the_field('staff_p11'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n12')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i12'); ?>" alt="staff">
				<h6><?php the_field('staff_n12'); ?></h6>
				<p><?php the_field('staff_p12'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n13')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i13'); ?>" alt="staff">
				<h6><?php the_field('staff_n13'); ?></h6>
				<p><?php the_field('staff_p13'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n14')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i14'); ?>" alt="staff">
				<h6><?php the_field('staff_n14'); ?></h6>
				<p><?php the_field('staff_p14'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n15')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i15'); ?>" alt="staff">
				<h6><?php the_field('staff_n15'); ?></h6>
				<p><?php the_field('staff_p15'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('staff_n16')) { ?>
			<div class="single-member">
				<img src="<?php the_field('staff_i16'); ?>" alt="staff">
				<h6><?php the_field('staff_n16'); ?></h6>
				<p><?php the_field('staff_p16'); ?></p>
			</div>
		<?php } ?>																		
				<p> Staff page updated on 12th Febraury 2020. </p>
	</div> 
	<div> 
	</div> 
	<div class="staff-booking">
		<a class="cta-button" href="/contact-us">Get in touch with us <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="arrow right"></a>
	</div> 
</div>


 <?php get_footer(); ?>  