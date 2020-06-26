<div class="sort-bar d-flex justify-content-between align-items-center">
    <div class="sort d-flex align-items-center">
        <div class="caption">Sort by</div>
        <div class="question-filter sort-filter d-flex flex-column align-left">
            <select class="question-select sort-by">
                <option value="index" data-display-text="Recommended">Recommended</option>
<!--                <option value="rating">Rating</option>-->
                <option value="price">Price</option>
            </select>
        </div>
        <div class="order-filter ascending">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-order-icon.png" alt="">
        </div>
    </div>
    <div class="results-amount">
        <span class="results-now">0</span>
        <span class="results-0">of</span>
        <span class="results-number"><?php echo apply_filters('bac_total_results', 0) ?></span> results
    </div>
</div>