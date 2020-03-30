<?php /*Template Name: 24hour*/
 get_header();
  ?>

<div class="image-slider">
	<div id="image-carousel" class="owl-carousel owl-theme image-carousel">
	<?php if(get_field('img_slide_1')) { ?>
		<div class="single-image">
			<img src="<?php the_field('img_slide_1'); ?>" alt="slide">
		</div>
	<?php } ?>
	<?php if(get_field('img_slide_2')) { ?>
		<div class="single-image">
			<img src="<?php the_field('img_slide_2'); ?>" alt="slide">
		</div>
	<?php } ?>
	<?php if(get_field('img_slide_3')) { ?>
		<div class="single-image">
			<img src="<?php the_field('img_slide_3'); ?>" alt="slide">
		</div>
	<?php } ?>
	<?php if(get_field('img_slide_4')) { ?>
		<div class="single-image">
			<img src="<?php the_field('img_slide_4'); ?>" alt="slide">
		</div>
	<?php } ?>
	<?php if(get_field('img_slide_5')) { ?>
		<div class="single-image">
			<img src="<?php the_field('img_slide_5'); ?>" alt="slide">
		</div>
	<?php } ?>
	<?php if(get_field('img_slide_6')) { ?>
		<div class="single-image">
			<img src="<?php the_field('img_slide_6'); ?>" alt="slide">
		</div>
	<?php } ?>													
</div>
</div>

<div class="text-block-800 twentyfour-hour-text">
	<?php the_field('page_text', $cur_page); ?>	
</div>

<div class="gray-table twentyfour-hour-table">
	<h2 class="gray-table-title" style="color:#5AB9AC;text-align:center;">Beecholme Features</h2>
	<div class="table-content d-flex justify-content-between flex-wrap">
		<?php if(get_field('ftr_h1')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h1') ?></h3>
				<p><?php the_field('ftr_t1') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h2')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h2') ?></h3>
				<p><?php the_field('ftr_t2') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h3')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h3') ?></h3>
				<p><?php the_field('ftr_t3') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h4')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h4') ?></h3>
				<p><?php the_field('ftr_t4') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h5')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h5') ?></h3>
				<p><?php the_field('ftr_t5') ?></p>
			</div>	
		<?php } ?>												
		<?php if(get_field('ftr_h6')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h6') ?></h3>
				<p><?php the_field('ftr_t6') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h7')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h7') ?></h3>
				<p><?php the_field('ftr_t7') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h8')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h8') ?></h3>
				<p><?php the_field('ftr_t8') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h9')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h9') ?></h3>
				<p><?php the_field('ftr_t9') ?></p>
			</div>	
		<?php } ?>
		<?php if(get_field('ftr_h10')) { ?>
			<div class="single-table-feature">
				<h3 class="feature-title"><?php the_field('ftr_h10') ?></h3>
				<p><?php the_field('ftr_t10') ?></p>
			</div>	
		<?php } ?>				
	</div>
</div>

<div class="twentyfour-hour-booking">
	<a class="cta-button" href="/make-a-referral">Make a referral <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="arrow right"></a>
</div>

<div class="twentyfour-table twentyfour-community">
	<div class="wide-container twentyfour-community-container d-flex justify-content-between">
		<div class="left-part align-self-center">
			<h2 class="side-title"><?php the_field('24_com_heading'); ?></h2>
			<h3 class="section-description"><?php the_field('24_com_subheading'); ?></h3>
            <h3 class="section-main"><?php the_field('24_com_text'); ?></h3>
			<div class="twentyfour-community-list d-flex flex-wrap">
				<?php if(get_field('24_com_l1')) { ?>
					<li><?php the_field('24_com_l1'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l2')) { ?>
					<li><?php the_field('24_com_l2'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l3')) { ?>
					<li><?php the_field('24_com_l3'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l4')) { ?>
					<li><?php the_field('24_com_l4'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l5')) { ?>
					<li><?php the_field('24_com_l5'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l6')) { ?>
					<li><?php the_field('24_com_l6'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l7')) { ?>
					<li><?php the_field('24_com_l7'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l8')) { ?>
					<li><?php the_field('24_com_l8'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l9')) { ?>
					<li><?php the_field('24_com_l9'); ?></li>	
				<?php } ?>				
				<?php if(get_field('24_com_l10')) { ?>
					<li><?php the_field('24_com_l10'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_com_l11')) { ?>
					<li><?php the_field('24_com_l11'); ?></li>	
				<?php } ?>				
				<?php if(get_field('24_com_l12')) { ?>
					<li><?php the_field('24_com_l12'); ?></li>	
				<?php } ?>																																									
			</div>
		</div>
		<div class="right-part">
			<div class="community-image-container">
				<img src="<?php the_field('24_community_image', $cur_page); ?>" alt="community">
			</div>
		</div>
	</div>
</div>

<div class="twentyfour-table twentyfour-dining">
	<div class="wide-container twentyfour-community-container d-flex justify-content-between">
		<div class="left-part align-self-center">
			<h2 class="side-title"><?php the_field('24_din_heading'); ?></h2>
			<h3 class="section-description"><?php the_field('24_din_subhead'); ?></h3>
			<h3 class="section-main"><?php the_field('24_din_text'); ?></h3>
			<div class="twentyfour-community-list d-flex flex-wrap">
				<?php if(get_field('24_din_l1')) { ?>
					<li><?php the_field('24_din_l1'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l2')) { ?>
					<li><?php the_field('24_din_l2'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l3')) { ?>
					<li><?php the_field('24_din_l3'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l4')) { ?>
					<li><?php the_field('24_din_l4'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l5')) { ?>
					<li><?php the_field('24_din_l5'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l6')) { ?>
					<li><?php the_field('24_din_l6'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l7')) { ?>
					<li><?php the_field('24_din_l7'); ?></li>	
				<?php } ?>
				<?php if(get_field('24_din_l8')) { ?>
					<li><?php the_field('24_din_l8'); ?></li>	
				<?php } ?>
			</div>	
		</div>
		<div class="right-part">
			<div class="community-image-container">
				<?php if(get_field('24_din_r1')) { ?>
                    <?php the_field('24_din_r1'); ?>
				<?php } ?>
			</div>
		</div>		
	</div>
</div>

<div class="book-block d-flex">
	<div class="book-block-content align-self-center">
		<h4>Visit our home and book a visit</h4>
		<a class="cta-button" href="/contact-us">Book a visit <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right-green.svg" alt="arrow right"></a>
	</div>
</div>

<div class="google-map">
	<div class="google-map-overlay"></div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.388272210313!2d-0.15435908423344974!3d51.41429387961996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760668a774df57%3A0xc25249c9ed825206!2sBeecholme+Adult+Care!5e0!3m2!1sru!2sua!4v1518099027832" width="1920" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>	

<?php get_footer(); ?>   