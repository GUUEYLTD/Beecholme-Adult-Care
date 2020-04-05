<?php /*Template Name: Our Counsellors*/
 get_header();
?>

<div class="our-counsellors">
  <div class="content">
    <div class="filter-bar-wrapper">
      <div class="mobile-filter-bar-button justify-content-center align-items-center">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-filters.png" alt="">
        Filters
      </div>
      <div class="filter-bar">
        <div class="type-filter d-flex flex-column align-left">
          <div class="caption">I am looking for a</div>
          <div class="type-tabs d-flex">
            <div class="single-tab coach" data-type="coach">Life Coach</div>
            <div class="single-tab therapist active" data-type="therapist">Therapist</div>
            <div class="single-tab all" data-type="all">All</div>
          </div>
        </div>

        <div class="question-filter therapist-question-filter flex-column align-left">
          <div class="caption">What are you suffering from?</div>
          <select class="question-select">
            <option value="" data-display-text="All">All</option>
            <option value="apples">1</option>
            <option value="bananas">2</option>
            <option value="oranges">3</option>
          </select>
        </div>

        <div class="question-filter coach-question-filter flex-column align-left">
          <div class="caption">Type of coaching</div>
          <select class="question-select">
            <option value="" data-display-text="All">All</option>
            <option value="apples">Life</option>
            <option value="bananas">Business</option>
            <option value="oranges">Career</option>
            <option value="oranges">Finance</option>
            <option value="oranges">Retirement</option>
          </select>
        </div>

        <div class="question-filter empty-filter">

        </div>

        <div class="language-filter flex-column align-left">
          <div class="caption">Select language</div>
          <select class="question-select">
            <option value="" data-display-text="All">All</option>
            <option value="apples">English</option>
            <option value="bananas">French</option>
            <option value="oranges">German</option>
          </select>
        </div>

        <div class="search-button">
          <button>Search</button>
        </div>

      </div>
    </div>
    <div class="sort-bar d-flex justify-content-between align-items-center">
      <div class="sort d-flex align-items-center">
        <div class="caption">Sort by</div>
        <div class="question-filter sort-filter d-flex flex-column align-left">
          <select class="question-select">
            <option value="" data-display-text="Price">Price</option>
            <option value="apples">Rating</option>
          </select>
        </div>
        <div class="order-filter ascending">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-order-icon.png" alt="">
        </div>
      </div>
      <div class="results-amount">
        <span class="results-number">245</span> results
      </div>
    </div>


    <div class="counsellors-list d-flex">

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

      <div class="single-item">
        <div class="personal-info d-flex">
          <div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-avatar.png" alt=""></div>
          <div class="info d-flex">
            <div class="name">Hanna Saris</div>
            <div class="type">Therapist</div>
          </div>
        </div>
        <div class="specialty">
          Substance abuse disorder, Self esteem
        </div>
        <div class="details">
          <div class="rating d-flex justify-content-center">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rating-grey-star.png" alt="">
          </div>
          <div class="price-wrapper d-flex justify-content-between align-items-center">
            <div class="price"><span>&#163;150</span> / hour</div>
            <div class="languages d-flex">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
            </div>
          </div>
        </div>
        <div class="button-wrapper">
          <button>Book</button>
        </div>
      </div>

    </div>

    <div class="pagination d-flex justify-content-center">
      <div class="pagination-item"><</div>
      <div class="pagination-item">1</div>
      <div class="pagination-item active">2</div>
      <div class="pagination-item">3</div>
      <div class="pagination-item empty">...</div>
      <div class="pagination-item">12</div>
      <div class="pagination-item">></div>

    </div>


  </div>
</div>

<?php get_footer(); ?>