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
            <option value="apples">Stress, Anxiety</option>
            <option value="bananas">Depression</option>
            <option value="oranges">Trauma and abuse</option>
            <option value="oranges">Relationship / Couples issues</option>
            <option value="oranges">Domestic Violence</option>
            <option value="oranges">Anger management</option>
            <option value="oranges">Substance abuse disorder</option>
            <option value="oranges">Eating Disorders</option>
            <option value="oranges">Self esteem</option>
            <option value="oranges">Other</option>
          </select>
        </div>

        <div class="question-filter coach-question-filter flex-column align-left">
          <div class="caption">Type of coaching</div>
          <select class="question-select">
            <option value="" data-display-text="All">All</option>
            <option value="apples">Life</option>
            <option value="bananas">Health and Wellness</option>
            <option value="oranges">Family or Parenting</option>
            <option value="oranges">Relationship or Dating</option>
            <option value="oranges">Career</option>
            <option value="oranges">Business</option>
            <option value="oranges">Finance</option>
            <option value="oranges">Retirement</option>
            <option value="oranges">Women Empowerment</option>
          </select>
        </div>

        <div class="question-filter empty-filter flex-column align-left">
          <div class="caption">Choose type</div>
          <select class="question-select">
            <option value="" data-display-text="All">All</option>
            <option value="apples">Life</option>
            <option value="bananas">Health and Wellness</option>
            <option value="oranges">Family or Parenting</option>
            <option value="oranges">Relationship or Dating</option>
            <option value="oranges">Career</option>
            <option value="oranges">Business</option>
            <option value="oranges">Finance</option>
            <option value="oranges">Retirement</option>
            <option value="oranges">Women Empowerment</option>
            <option value="apples">Stress, Anxiety</option>
            <option value="bananas">Depression</option>
            <option value="oranges">Trauma and abuse</option>
            <option value="oranges">Relationship / Couples issues</option>
            <option value="oranges">Domestic Violence</option>
            <option value="oranges">Anger management</option>
            <option value="oranges">Substance abuse disorder</option>
            <option value="oranges">Eating Disorders</option>
            <option value="oranges">Self esteem</option>
            <option value="oranges">Other</option>
          </select>
        </div>

        <div class="language-filter flex-column align-left">
          <div class="caption">Select language</div>
          <select class="question-select">
            <option value="" data-display-text="All">All</option>
            <option value="apples">English</option>
            <option value="bananas">French</option>
            <option value="oranges">German</option>
            <option value="oranges">Spanish</option>
            <option value="oranges">Italian</option>
            <option value="oranges">Portoguese</option>
            <option value="oranges">Russian</option>
            <option value="oranges">Chinese</option>
            <option value="oranges">Japanese</option>
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
            <option value="" data-display-text="Recommended">Recommended</option>
            <option value="apples">Rating</option>
            <option value="apples">Price</option>
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

        <?php do_action('bac_list_counsellors'); ?>
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