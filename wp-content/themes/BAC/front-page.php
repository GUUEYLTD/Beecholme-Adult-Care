<?php /*Template Name: home*/
 get_header();
 $cur_page = get_the_ID(); ?>

<div class="home-top-banner d-flex align-items-center justify-content-center" style="background-image: url(<?php the_field('hero_image', $cur_page); ?>)">
	<div class="dark-bg"></div>
	<div class="banner-content d-flex">
    <div class="heading">
      <h1>Your Mental Health Is On Our Mind</h1>
      <h2 class="second-heading">BAC is a residential care home that provides support for individuals with mental health issues, dual diagnosis and complex needs as they progress through their path to independence.
  Through well planned activities and a personalised mental health care package, we support each client to reach their goals and be proud of their achievements. </h2>
    </div>
		<div class="home-form-wrapper">
		<div class="tabs d-flex justify-content-center">
			<div class="tab active" data-tab="find-tab">Find a Counsellor</div>
			<div class="tab" data-tab="referral-tab">Make a Referral</div>
		</div>
		<form class="tab-content find-tab active" action="our-counsellors">
			<div class="homepage-filter type-filter d-flex flex-column align-left">
				<div class="caption">I am looking for a</div>
				<div class="type-tabs d-flex">
					<label for="radio-type-coach"
								 class="single-tab coach <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'active' : ''; ?>"
								 data-type="coach">Life Coach</label>
					<label for="radio-type-therapist"
								 class="single-tab therapist <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'active' : ''; ?>"
								 data-type="therapist">Therapist</label>
					<label for="radio-type-all"
								 class="single-tab all active <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'active' : ''; ?>"
								 data-type="all">All</label>
					<input type="radio" name="type" value="Life coach" class="hidden"
								 id="radio-type-coach" <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'checked' : ''; ?>/>
					<input type="radio" name="type" value="Therapist" class="hidden"
								 id="radio-type-therapist" <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'checked' : ''; ?>/>
					<input type="radio" name="type" value="" class="hidden"
								 id="radio-type-all" value="" <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'checked' : ''; ?>/>
				</div>
			</div>

			<div class="homepage-filter question-filter therapist-question-filter flex-column align-left">
				<div class="caption">What are you suffering from?</div>
				<select class="question-select" name="therapy">
					<option value="" data-display-text="All">All</option>
                    <?php foreach (getServices('Therapist') as $serviceName) : ?>
                        <option
                                value="<?php echo $serviceName ?>"
                            <?php echo isset($_GET['therapy']) && $_GET['therapy'] === $serviceName ? 'selected' : '' ?>
                        ><?php echo $serviceName ?></option>
                    <?php endforeach; ?>
				</select>
			</div>

			<div class="homepage-filter question-filter coach-question-filter flex-column align-left">
				<div class="caption">Type of coaching</div>
				<select class="question-select" name="coaching">
					<option value="" data-display-text="All">All</option>
                    <?php foreach (getServices('Life coach') as $serviceName) : ?>
                        <option
                                value="<?php echo $serviceName ?>"
                            <?php echo isset($_GET['coaching']) && $_GET['coaching'] === $serviceName ? 'selected' : '' ?>
                        ><?php echo $serviceName ?></option>
                    <?php endforeach; ?>
				</select>
			</div>

			<div class="homepage-filter question-filter empty-filter flex-column align-left">
				<div class="caption">Choose type</div>
				<select class="question-select" name="common">
					<option value="" data-display-text="All">All</option>
                    <?php foreach (getServices() as $serviceName) : ?>
                        <option
                                value="<?php echo $serviceName ?>"
                            <?php echo isset($_GET['common']) && $_GET['common'] === $serviceName ? 'selected' : '' ?>
                        ><?php echo $serviceName ?></option>
                    <?php endforeach; ?>
				</select>
			</div>

			<div class="button-wrapper">
				<button>Search</button>
			</div>
		</form>
		<div class="tab-content referral-tab">
			<?php echo do_shortcode('[contact-form-7 id="18" title="Home page"]'); ?>
			<div class="form-addition">
				<div class="form-addition-text">or you can call us directly</div>
				<div class="form-addition-action d-flex justify-content-between">
					<div class="d-flex"><a href="tel:+44 20 8648 6681">+44 20 8648 6681</a></div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<div class="services">
	<h2>Services</h2>
	<div class="services-container d-flex justify-content-between">
		<?php if(get_field('serv_h1')) { ?>
			<a href="/12-week-recovery-program/" class="single-service-container d-flex align-items-center justify-content-center">
				<div class="single-service">
					<h3><?php the_field('serv_h1'); ?></h3>
					<p><?php the_field('serv_t1'); ?></p>
				</div>
			</a>		
		<?php } ?>
		<?php if(get_field('serv_h2')) { ?>
			<a href="/24-hour-residential-care-home/" class="single-service-container d-flex align-items-center justify-content-center">
				<div class="single-service">
					<h3><?php the_field('serv_h2'); ?></h3>
					<p><?php the_field('serv_t2'); ?></p>
				</div>
			</a>		
		<?php } ?>
		<?php if(get_field('serv_h3')) { ?>
			<a href="/online-life-coaching/" class="single-service-container d-flex align-items-center justify-content-center">
				<div class="single-service">
					<h3><?php the_field('serv_h3'); ?></h3>
					<p><?php the_field('serv_t3'); ?></p>
				</div>
			</a>		
		<?php } ?>
		<?php if(get_field('serv_h4')) { ?>
			<a href="/online-therapy/" class="single-service-container d-flex align-items-center justify-content-center">
				<div class="single-service">
					<h3><?php the_field('serv_h4'); ?></h3>
					<p><?php the_field('serv_t4'); ?></p>
				</div>
			</a>		
		<?php } ?>
	</div>
</div>
<div class="features">
	<h2>Why Choose BAC Supported<br>Living Accommodation?</h2>
	<div class="features-container mid-container d-flex flex-wrap">
		<?php if(get_field('feat_h1', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h1'); ?></h3>
				<p><?php the_field('feat_t1'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h2', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h2'); ?></h3>
				<p><?php the_field('feat_t2'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h3', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h3'); ?></h3>
				<p><?php the_field('feat_t3'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h4', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h4'); ?></h3>
				<p><?php the_field('feat_t4'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h5', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h5'); ?></h3>
				<p><?php the_field('feat_t5'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h6', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h6'); ?></h3>
				<p><?php the_field('feat_t6'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h7', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h7'); ?></h3>
				<p><?php the_field('feat_t7'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('feat_h8', $cur_page)) { ?>
			<div class="single-feature">
				<h3><?php the_field('feat_h8'); ?></h3>
				<p><?php the_field('feat_t8'); ?></p>
			</div>
		<?php } ?>
	</div>
	<div class="features-booking">
		<a class="cta-button" href="/contact-us/">View Our Homes and Book a Visit</a>
	</div>
</div>
<div class="boxes">
	<div class="boxes-container inner-container">
		<div class="top-boxes d-flex justify-content-around">
			<a class="single-box d-flex flex-column justify-content-end" href="<?php the_field('gif_l1'); ?>">
				<div class="box-content">
					<img src="<?php the_field('gif_i1'); ?>" alt="">
					<h4><?php the_field('gif_c1'); ?></h4>
					<p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
				</div>
			</a>
			<a class="single-box d-flex flex-column justify-content-end" href="<?php the_field('gif_l2'); ?>">
				<div class="box-content">
					<img src="<?php the_field('gif_i2'); ?>"  alt='arrow-left'>
					<h4><?php the_field('gif_c2'); ?></h4>
					<p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
				</div>
			</a>
		</div>
		<div class="bottom-boxes d-flex justify-content-around">
			<a class="single-box d-flex flex-column justify-content-end" href="<?php the_field('gif_l3'); ?>">
				<div class="box-content">
					<img src="<?php the_field('gif_i3'); ?>"  alt='arrow-right'>
					<h4><?php the_field('gif_c3'); ?></h4>
					<p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
				</div>
			</a>
			<a class="single-box d-flex flex-column justify-content-end" href="">
				<div class="box-content">
					<img src="<?php the_field('gif_i4'); ?>" alt='arrow-left'>
					<h4><?php the_field('gif_c4'); ?></h4>
					<p>Find out more <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></p>
				</div>
			</a>						
		</div>
	</div>
</div>

<div class="brochures small-container">
	<h3>Brochures</h3>
	<?php if(get_field('doc_n1')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n1'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f1'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f1'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n2')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n2'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f2'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f2'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n3')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n3'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f3'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f3'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n4')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n4'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f4'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f4'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>	
	<?php if(get_field('doc_n5')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n5'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f5'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f5'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n6')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n6'); ?></a>
			<div class="preview">   q
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f6'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f6'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n7')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n7'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f7'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f7'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n8')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n8'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f8'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f8'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>	
	<?php if(get_field('doc_n9')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n9'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f9'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f9'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>
	<?php if(get_field('doc_n10')) { ?>
		<div class="single-brochure">
			<a class="single-brochure-link" href=""><?php the_field('doc_n10'); ?></a>
			<div class="preview">
				<iframe class="doc" src="https://docs.google.com/gview?url=<?php the_field('doc_f10'); ?>&embedded=true"></iframe>
				<a href="<?php the_field('doc_f10'); ?>" download>Download <i class="far fa-arrow-alt-circle-down"></i></a>
			</div>
		</div>
	<?php } ?>					
</div>

<div class="testimonials">
	<h3>Testimonials</h3>
	
	<div id="review-carousel" class="owl-carousel owl-theme review-carousel">
		<?php if(get_field('testimonial_1')) { ?>
			<div class="single-testimonial">
				<p><?php the_field('testimonial_1'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('testimonial_2')) { ?>
			<div class="single-testimonial">
				<p><?php the_field('testimonial_2'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('testimonial_3')) { ?>
			<div class="single-testimonial">
				<p><?php the_field('testimonial_3'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('testimonial_4')) { ?>
			<div class="single-testimonial">
				<p><?php the_field('testimonial_4'); ?></p>
			</div>
		<?php } ?>
		<?php if(get_field('testimonial_5')) { ?>
			<div class="single-testimonial">
				<p><?php the_field('testimonial_5'); ?></p>
			</div>
		<?php } ?>	
		<?php if(get_field('testimonial_6')) { ?>
			<div class="single-testimonial">
				<p><?php the_field('testimonial_6'); ?></p>
			</div>
		<?php } ?>
	</div>

	<div class="review-button">
		<a class="cta-button" href="http://www.cqc.org.uk/location/1-121892109">Rating and review on the Care Quality Commission <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt='arrow-right'></a>
	</div>
</div>

<div class="information life-coaching">
  <div class="mid-container d-flex justify-between align-items-center">
   <div class="text">
    <h2><?php the_field('home_lc_heading'); ?></h2>
    <?php the_field('home_lc_text'); ?>
    <div class="link"><a href="/online-life-coaching/">Read More</a></div>
   </div>
   <div class="perks d-flex flex-column">
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_lc_perk_image_1'); ?>">
      <span><?php the_field('home_lc_perk_text_1'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_lc_perk_image_2'); ?>">
      <span><?php the_field('home_lc_perk_text_2'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_lc_perk_image_3'); ?>">
      <span><?php the_field('home_lc_perk_text_3'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_lc_perk_image_4'); ?>">
      <span><?php the_field('home_lc_perk_text_4'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_lc_perk_image_5'); ?>">
      <span><?php the_field('home_lc_perk_text_5'); ?></span>
    </div>
   </div>
  </div>
</div>

<div class="information therapy">
  <div class="mid-container d-flex justify-between align-items-center">
   <div class="text">
    <h2><?php the_field('home_therapy_heading'); ?></h2>
    <?php the_field('home_therapy_text'); ?>
    <div class="link"><a href="/online-therapy/">Read More</a></div>
   </div>
   <div class="perks d-flex flex-column">
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_therapy_perk_image_1'); ?>">
      <span><?php the_field('home_therapy_perk_text_1'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_therapy_perk_image_2'); ?>">
      <span><?php the_field('home_therapy_perk_text_2'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_therapy_perk_image_3'); ?>">
      <span><?php the_field('home_therapy_perk_text_3'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_therapy_perk_image_4'); ?>">
      <span><?php the_field('home_therapy_perk_text_4'); ?></span>
    </div>
    <div class="single-perk d-flex align-items-center">
      <img src="<?php the_field('home_therapy_perk_image_5'); ?>">
      <span><?php the_field('home_therapy_perk_text_5'); ?></span>
    </div>
   </div>
  </div>
</div>


<?php get_footer(); ?>