<?php /*Template Name: Our Counsellors*/
 get_header();
?>

<div class="our-counsellors">
  <div class="content">
    <?php get_template_part('template-parts/counsellors/searchbar'); ?>
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