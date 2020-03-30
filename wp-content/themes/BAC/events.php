<?php /*Template Name: events*/
 get_header();
  ?>

<div class="text-block-800">
	<div class="out-subheading"><?php the_field('events_subheading'); ?></div>
</div>

<div class="upcoming-events">
	<div class="small-container">
		<h4><?php the_field('upcoming_events_heading'); ?></h4>
		<div class="events-table">
			<?php if(get_field('ev_date_1')) { ?>
			<div class="single-event d-flex">
				<div class="event-date d-flex justify-content-center flex-column"><?php the_field('ev_date_1'); ?></div>
				<div class="event-name d-flex justify-content-center flex-column"><?php the_field('ev_name_1'); ?></div>
				<div class="event-details d-flex justify-content-center flex-column">
					<div class="single-detail"><span>Time: </span><?php the_field('ev_time_1'); ?></div>
					<div class="single-detail"><span>Venue: </span><?php the_field('ev_venue_1'); ?></div>
					<div class="single-detail"><span>Description: </span><?php the_field('ev_desc_1'); ?></div>
					<div class="single-detail">Please <a href="mailto:info@beecholmeadultcare.co.uk">email us</a> for more information.</div>
				</div>
			</div>
			<?php } ?>
			<?php if(get_field('ev_date_2')) { ?>
			<div class="single-event d-flex">
				<div class="event-date d-flex justify-content-center flex-column"><?php the_field('ev_date_2'); ?></div>
				<div class="event-name d-flex justify-content-center flex-column"><?php the_field('ev_name_2'); ?></div>
				<div class="event-details d-flex justify-content-center flex-column">
					<div class="single-detail"><span>Time: </span><?php the_field('ev_time_2'); ?></div>
					<div class="single-detail"><span>Venue: </span><?php the_field('ev_venue_2'); ?></div>
					<div class="single-detail"><span>Description: </span><?php the_field('ev_desc_2'); ?></div>
					<div class="single-detail">Please <a href="mailto:info@beecholmeadultcare.co.uk">email us</a> for more information.</div>
				</div>
			</div>
			<?php } ?>	
			<?php if(get_field('ev_date_3')) { ?>
			<div class="single-event d-flex">
				<div class="event-date d-flex justify-content-center flex-column"><?php the_field('ev_date_3'); ?></div>
				<div class="event-name d-flex justify-content-center flex-column"><?php the_field('ev_name_3'); ?></div>
				<div class="event-details d-flex justify-content-center flex-column">
					<div class="single-detail"><span>Time: </span><?php the_field('ev_time_3'); ?></div>
					<div class="single-detail"><span>Venue: </span><?php the_field('ev_venue_3'); ?></div>
					<div class="single-detail"><span>Description: </span><?php the_field('ev_desc_3'); ?></div>
					<div class="single-detail">Please <a href="mailto:info@beecholmeadultcare.co.uk">email us</a> for more information.</div>
				</div>
			</div>
			<?php } ?>	
			<?php if(get_field('ev_date_4')) { ?>
			<div class="single-event d-flex">
				<div class="event-date d-flex justify-content-center flex-column"><?php the_field('ev_date_4'); ?></div>
				<div class="event-name d-flex justify-content-center flex-column"><?php the_field('ev_name_4'); ?></div>
				<div class="event-details d-flex justify-content-center flex-column">
					<div class="single-detail"><span>Time: </span><?php the_field('ev_time_4'); ?></div>
					<div class="single-detail"><span>Venue: </span><?php the_field('ev_venue_4'); ?></div>
					<div class="single-detail"><span>Description: </span><?php the_field('ev_desc_4'); ?></div>
					<div class="single-detail">Please <a href="mailto:info@beecholmeadultcare.co.uk">email us</a> for more information.</div>
				</div>
			</div>
			<?php } ?>							
		</div>
	</div>
</div>

<?php get_footer(); ?>    