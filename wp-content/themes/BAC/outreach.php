<?php /*Template Name: outreach*/
 get_header();
?>

<div class="text-block-800 outreach-community">
	<h2 class="out-subheading"><?php the_field('out_subheading'); ?></h2>
</div>

<div class="outreach-info wide-container">
	<img src="<?php the_field('out_info_image'); ?>"  alt="info">
	<div class="outreach-info-container">
		<?php if(get_field('out_info_h1', $cur_page)) { ?>
			<h2><?php the_field('out_info_h1'); ?></h2>
			<h3><p><?php the_field('out_info_t1'); ?></p></h3>
		<?php } ?>	
		<?php if(get_field('out_info_h2', $cur_page)) { ?>
			<h2><?php the_field('out_info_h2'); ?></h2>
            <h3><p><?php the_field('out_info_t2'); ?></p></h3>
		<?php } ?>			
	</div>
</div>

<div class="outreach-events">
	<div class="small-container">
		<h2><?php the_field('out_event_heading'); ?></h2>
		<h2 class="event-subheading"><?php the_field('out_event_subheading'); ?></h2>
		<h3><p class="out-event-text"><?php the_field('out_event_text'); ?></p></h3>

		<div class="outreach-events-table">
			<?php if(get_field('out_event_h1', $cur_page)) { ?>
				<div class="single-outreach-event d-flex">
					<div class="left-part d-flex">
						<div class="outreach-event-heading align-self-center d-flex justify-content-start">
							<img src="<?php the_field('out_event_i1'); ?>" alt="event">
							<h4><?php the_field('out_event_h1'); ?></h4>
						</div>
					</div>
					<div class="right-part">
						<div class="outreach-event-text">
							<?php the_field('out_event_t1'); ?>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if(get_field('out_event_h2', $cur_page)) { ?>
				<div class="single-outreach-event d-flex">
					<div class="left-part d-flex">
						<div class="outreach-event-heading align-self-center d-flex justify-content-start">
							<img src="<?php the_field('out_event_i2'); ?>" alt="event">
							<h4><?php the_field('out_event_h2'); ?></h4>
						</div>
					</div>
					<div class="right-part">
						<div class="outreach-event-text">
							<?php the_field('out_event_t2'); ?>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if(get_field('out_event_h3', $cur_page)) { ?>
				<div class="single-outreach-event d-flex">
					<div class="left-part d-flex">
						<div class="outreach-event-heading align-self-center d-flex justify-content-start">
							<img src="<?php the_field('out_event_i3'); ?>" alt="event">
							<h4><?php the_field('out_event_h3'); ?></h4>
						</div>
					</div>
					<div class="right-part">
						<div class="outreach-event-text">
							<?php the_field('out_event_t3'); ?>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if(get_field('out_event_h4', $cur_page)) { ?>
				<div class="single-outreach-event d-flex">
					<div class="left-part d-flex">
						<div class="outreach-event-heading align-self-center d-flex justify-content-start">
							<img src="<?php the_field('out_event_i4'); ?>" alt="event">
							<h4><?php the_field('out_event_h4'); ?></h4>
						</div>
					</div>
					<div class="right-part">
						<div class="outreach-event-text">
							<?php the_field('out_event_t4'); ?>
						</div>
					</div>
				</div>
			<?php } ?>												
		</div>

		<div class="outreach-events-contact">
			<a class="cta-button" href="/contact-us">Get in touch with us <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-right.svg" alt="arrow-right"></a>
		</div>

		<h2><?php the_field('out_event_heading2'); ?></h2>
		<h2 class="event-subheading"><?php the_field('out_event_subheading2'); ?></h2>

<!-- 		<div class="outreach-individual-table d-flex flex-column">
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Day/Time</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<span>10:00</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<span>15:30</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<span>20:30</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<span>21:30</span>
				</div>				
			</div>		
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Monday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('monday_event_1')) { ?>
					<span><?php the_field('monday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('monday_event_2')) { ?>
					<span><?php the_field('monday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('monday_event_3')) { ?>
					<span><?php the_field('monday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('monday_event_4')) { ?>
					<span><?php the_field('monday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Tuesday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('tuesday_event_1')) { ?>
					<span><?php the_field('tuesday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('tuesday_event_2')) { ?>
					<span><?php the_field('tuesday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('tuesday_event_3')) { ?>
					<span><?php the_field('tuesday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('tuesday_event_4')) { ?>
					<span><?php the_field('tuesday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Wednesday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('wednesday_event_1')) { ?>
					<span><?php the_field('wednesday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('wednesday_event_2')) { ?>
					<span><?php the_field('wednesday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('wednesday_event_3')) { ?>
					<span><?php the_field('wednesday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('wednesday_event_4')) { ?>
					<span><?php the_field('wednesday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>	
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Thursday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('thursday_event_1')) { ?>
					<span><?php the_field('thursday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('thursday_event_2')) { ?>
					<span><?php the_field('thursday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('thursday_event_3')) { ?>
					<span><?php the_field('thursday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('thursday_event_4')) { ?>
					<span><?php the_field('thursday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Friday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('friday_event_1')) { ?>
					<span><?php the_field('friday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('friday_event_2')) { ?>
					<span><?php the_field('friday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('friday_event_3')) { ?>
					<span><?php the_field('friday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('friday_event_4')) { ?>
					<span><?php the_field('friday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Saturday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('saturday_event_1')) { ?>
					<span><?php the_field('saturday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('saturday_event_2')) { ?>
					<span><?php the_field('saturday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('saturday_event_3')) { ?>
					<span><?php the_field('saturday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('saturday_event_4')) { ?>
					<span><?php the_field('saturday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>		
			<div class="single-day d-flex">
				<div class="single-individual-event d-flex justify-content-center">
					<span>Sunday</span>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('sunday_event_1')) { ?>
					<span><?php the_field('sunday_event_1'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('sunday_event_2')) { ?>
					<span><?php the_field('sunday_event_2'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('sunday_event_3')) { ?>
					<span><?php the_field('sunday_event_3'); ?></span>
					<?php } ?>
				</div>
				<div class="single-individual-event d-flex justify-content-center">
					<?php if(get_field('sunday_event_4')) { ?>
					<span><?php the_field('sunday_event_4'); ?></span>
					<?php } ?>
				</div>				
			</div>																							
		</div> -->	

		<div id="booking">
			<?php echo do_shortcode('[ninja_tables id="299"]'); ?>
		</div>
		<div class="activities-description">
			<h2>Activities description</h2>
			<?php if(get_field('an_1')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_1'); ?></h3>
					<p><?php the_field('ad_1'); ?></p>
				</div>
			<?php } ?> 
			<?php if(get_field('an_2')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_2'); ?></h3>
					<p><?php the_field('ad_2'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_3')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_3'); ?></h3>
					<p><?php the_field('ad_3'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_4')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_4'); ?></h3>
					<p><?php the_field('ad_4'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_5')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_5'); ?></h3>
					<p><?php the_field('ad_5'); ?></p>
				</div>
			<?php } ?>		
			<?php if(get_field('an_6')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_6'); ?></h3>
					<p><?php the_field('ad_6'); ?></p>
				</div>
			<?php } ?> 
			<?php if(get_field('an_7')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_7'); ?></h3>
					<p><?php the_field('ad_7'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_8')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_8'); ?></h3>
					<p><?php the_field('ad_8'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_9')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_9'); ?></h3>
					<p><?php the_field('ad_9'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_10')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_10'); ?></h3>
					<p><?php the_field('ad_10'); ?></p>
				</div>
			<?php } ?>	
			<?php if(get_field('an_11')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_11'); ?></h3>
					<p><?php the_field('ad_11'); ?></p>
				</div>
			<?php } ?> 
			<?php if(get_field('an_12')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_12'); ?></h3>
					<p><?php the_field('ad_12'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_13')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_13'); ?></h3>
					<p><?php the_field('ad_13'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_14')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_14'); ?></h3>
					<p><?php the_field('ad_14'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_15')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_15'); ?></h3>
					<p><?php the_field('ad_15'); ?></p>
				</div>
			<?php } ?>	
			<?php if(get_field('an_16')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_16'); ?></h3>
					<p><?php the_field('ad_16'); ?></p>
				</div>
			<?php } ?> 
			<?php if(get_field('an_17')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_17'); ?></h3>
					<p><?php the_field('ad_17'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_18')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_18'); ?></h3>
					<p><?php the_field('ad_18'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_19')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_19'); ?></h3>
					<p><?php the_field('ad_19'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_20')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_20'); ?></h3>
					<p><?php the_field('ad_20'); ?></p>
				</div>
			<?php } ?>	
			<?php if(get_field('an_21')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_21'); ?></h3>
					<p><?php the_field('ad_21'); ?></p>
				</div>
			<?php } ?> 
			<?php if(get_field('an_22')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_22'); ?></h3>
					<p><?php the_field('ad_22'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_23')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_23'); ?></h3>
					<p><?php the_field('ad_23'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_24')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_24'); ?></h3>
					<p><?php the_field('ad_24'); ?></p>
				</div>
			<?php } ?>
			<?php if(get_field('an_25')) { ?>
				<div class="single-activity">
					<h3><?php the_field('an_25'); ?></h3>
					<p><?php the_field('ad_25'); ?></p>
				</div>
			<?php } ?>																							
		</div>

		<div class="booking-popup-wrapper">
			<div class="booking-popup">
				<form id="booking-form" method="POST" action="">
					<div class="booking-popup-title"></div>
					<div class="form-name-fields">
						<input type="text" name="fname" class="fname-input" placeholder="First name" required>
						<input type="text" name="lname" class="lname-input" placeholder="Last name" required>
					</div>
					<input type="email" name="email" class="email-input" placeholder="Email" required>
					<input type="text" name="phone" class="phone-input" placeholder="Phone" required>
					<input type="text" id="datepicker" name="datepicker" placeholder="Date" required>
					<select class="time-select">
						
					</select>
					<input type="submit" name="" value="Send">
				</form>
				<div class="popup-exit"><img src="/wp-content/uploads/2018/04/popup-close-icon.png" alt="close"></div>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>  