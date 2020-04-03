<?php /*Template Name: Our Counsellors*/
 get_header();
?>

<div class="our-counsellors">
  <div class="content">
    <div class="filter-bar d-flex">
      <div class="type-filter d-flex flex-column align-left">
        <div class="caption">I am looking for a</div>
        <div class="type-tabs d-flex">
          <div class="single-tab" data-type="coach">Life Coach</div>
          <div class="single-tab active" data-type="therapist">Therapist</div>
          <div class="single-tab" data-type="all">All</div>
        </div>
      </div>

      <div class="question-filter d-flex flex-column align-left">
        <div class="caption">I am looking for a</div>
        <select class="question-select">
          <option value="" data-display-text="Fruits">None</option>
          <option value="apples">Apples</option>
          <option value="bananas">Bananas</option>
          <option value="oranges">Oranges</option>
        </select>
      </div>

    </div>
    <div class="sort-bar">

    </div>
    <div class="counsellors-list">

    </div>
  </div>
</div>

<?php get_footer(); ?>