<?php /*Template Name: Profile */
 get_header();
?>
<div class="profile mid-container">
  <a class="back-button d-flex align-items-center" href="/our-counsellors">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-left.png" alt="">
    back to list
  </a>
  <div class="profile-container block1">

    <div class="personal-info d-flex left">
      <div class="avatar">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/profile-avatar.png" alt="">
      </div>
      <div class="info">
        <div class="rating">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
        </div>
        <div class="name">Abram Bothman</div>
        <div class="specialty">Therapist</div>
        <div class="actions d-flex align-items-center">
          <div class="price">
            <span>&#163;150</span> / hour
          </div>
          <div class="button-wrapper">
            <button>Book a session</button>
          </div>
        </div>
      </div>
    </div>

    <div class="summary d-flex flex-column right">
      <div class="single-item d-flex"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-location.png" alt="">
        <div class="info d-flex flex-column">
          <div class="caption">Located in</div>
          <div class="message">Amsterdam, Netherlands</div>
        </div>
      </div>
      <div class="single-item d-flex">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-graduate.png" alt="">
        <div class="info d-flex flex-column">
          <div class="caption">Education</div>
          <div class="message">Bachelor's Psychology<br>University of Amsterdam</div>
        </div>
      </div>
      <div class="single-item d-flex"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-languages.png" alt="">
        <div class="info d-flex flex-column">
          <div class="caption">Languages</div>
          <div class="message">English, French</div>
        </div>
      </div>
    </div>
  </div>
  <div class="divider"></div>

  <div class="profile-container block2">
    <div class="about left">
      <div class="heading">About me</div>
      <div class="text">Therapy, also called counseling or psychotherapy, is a long-term process in which a client works with a healthcare professional to diagnose and resolve problematic beliefs, behaviors, relationship issues, feelings and sometimes physical responses.</div>
    </div>
    <div class="specializations right">
      <div class="heading">Specializations</div>
      <div class="text">
        - Relationship issues<br>
        - Substance abuse disorder
      </div>
    </div>
  </div>

  <div class="profile-container block3">
    <div class="details left">
      <div class="heading">Session details</div>
      <div class="single-detail d-flex">
        <div class="text caption">Duration</div>
        <div class="text info">1 hour</div>
      </div>
      <div class="single-detail d-flex">
        <div class="text caption">Price</div>
        <div class="text info">&#163;150</div>
      </div>
      <div class="single-detail d-flex">
        <div class="text caption">Approach</div>
        <div class="text info">Cognitive therapists believe that it's dysfunctional thinking that leads to dysfunctional emotions or behaviors. By changing their thoughts, people can change how they feel and what they do.</div>
      </div>
      <div class="single-detail d-flex">
        <div class="text caption">How it works</div>
        <div class="text info">This approach emphasizes people's capacity to make rational choices and develop to their maximum potential. Concern and respect for others are also important themes.</div>
      </div>
      <div class="button-wrapper">
        <button>Book a Session</button>
      </div>
    </div>
    <div class="education right">
      <div class="heading">Licence, accreditations & certifications</div>
      <div class="single-item d-flex flex-column">
        <div class="name text">Professional Certified Transformative Coach (145 ICF Accredited Coach Training Hours)</div>
        <div class="info d-flex justify-content-between">
          <div class="date">August 1, 2019</div>
          <div class="link"><a href="#">View</a></div>
        </div>
      </div>
      <div class="single-item d-flex flex-column">
        <div class="name text">ICF Professional Certified Coach (PCC)</div>
        <div class="info d-flex justify-content-between">
          <div class="date">September 9, 2019</div>
          <div class="link"><a href="#">View</a></div>
        </div>
      </div>
      <div class="single-item d-flex flex-column">
        <div class="name text">CTI Co-Active Coaching- Fundamentals (ICF accredited coach training hours)</div>
        <div class="info d-flex justify-content-between">
          <div class="date">April 7, 2010</div>
        </div>
      </div>
    </div>
  </div>

</div>
<?php get_footer(); ?>