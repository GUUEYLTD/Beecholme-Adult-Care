<?php /*Template Name: Our Counsellors*/
    get_header();
    $practitioners = new \BAC\Practitioners();
    $counsellors   = apply_filters('bac_listed_counsellors', $practitioners->all($_GET));

    add_action('bac_list_counsellors', array('\BAC\Practitioners', 'listCatalogue'), 10, 1);
    add_filter('bac_total_results', function ($total) use ($counsellors){
        return count($counsellors);
    })
?>

<div class="our-counsellors">
  <div class="content">
    <?php get_template_part('template-parts/counsellors/searchbar'); ?>

    <?php get_template_part('template-parts/counsellors/sorting'); ?>

    <div class="counsellors-list d-flex">
        <?php do_action('bac_list_counsellors', $counsellors); ?>
    </div>

<!--    <div class="pagination d-flex justify-content-center">-->
<!--      <div class="pagination-item"><</div>-->
<!--      <div class="pagination-item">1</div>-->
<!--      <div class="pagination-item active">2</div>-->
<!--      <div class="pagination-item">3</div>-->
<!--      <div class="pagination-item empty">...</div>-->
<!--      <div class="pagination-item">12</div>-->
<!--      <div class="pagination-item">></div>-->
<!---->
<!--    </div>-->


  </div>
</div>

<?php get_footer(); ?>