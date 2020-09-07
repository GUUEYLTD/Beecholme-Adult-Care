<?php /*Template Name: Eligibility Criteria*/
get_header();
?>


<div class="mid-container eligibility-wrapper">
    <div class="eligibility-tabs d-flex justify-content-center">
        <div class="therapist-tab tab active" data-tab="therapist-tab">For Therapists</div>
        <div class="coach-tab tab" data-tab="coach-tab">For Coaches</div>
    </div>

    <div class="eligibility-tab-content active therapist-tab " >
        <div class="eligibility-title-text">
            <h2 class="page-title"><?php echo get_field('for_therapists_title'); ?></h2>
            <div class="eligibility-subtitle text-center"><?php echo get_field('for_therapists_subtitle'); ?></div>
        </div>
        <div class="eligibility-title text-center"><?php the_title();?></div>
        <div class=" eligibility-info-wrapper">

            <?php
            if ( !empty(get_field('eligibility_criteria_therapist_item')) ):
                $eligibility_items = get_field('eligibility_criteria_therapist_item');
                $item_count = 1;
                foreach ($eligibility_items as $eligibility_item) :
                    ?>
                    <div class="eligibility-info-item eligibility-info-item-<?php echo $eligibility_item['columns'];?>">
                        <div class="eligibility-info-item-number">
                            <?php echo $item_count;?>
                        </div>
                        <div class="eligibility-info-item-text">
                            <?php echo $eligibility_item['text']; ?>
                        </div>
                    </div>
                    <?php
                    $item_count += 1;
                endforeach;
            endif;
            ?>

        </div>
    </div>

    <div class="eligibility-tab-content coach-tab " >
        <div class="eligibility-title-text">
            <h2 class="page-title"><?php echo get_field('for_coaches_title'); ?></h2>
            <div class="eligibility-subtitle text-center"><?php echo get_field('for_coaches_subtitle'); ?></div>
        </div>
        <div class="eligibility-title text-center"><?php the_title();?></div>
        <div class=" eligibility-info-wrapper">

            <?php
            if ( !empty(get_field('eligibility_criteria_coaches_item')) ):
                $eligibility_items = get_field('eligibility_criteria_coaches_item');
                $item_count = 1;
                foreach ($eligibility_items as $eligibility_item) :
                    ?>
                    <div class="eligibility-info-item eligibility-info-item-<?php echo $eligibility_item['columns'];?>">
                        <div class="eligibility-info-item-number">
                            <?php echo $item_count;?>
                        </div>
                        <div class="eligibility-info-item-text">
                            <?php echo $eligibility_item['text']; ?>
                        </div>
                    </div>
                    <?php
                    $item_count += 1;
                endforeach;
            endif;
            ?>

        </div>
    </div>
</div>


<?php get_footer();?>

<script>
    jQuery(document).ready(function($) {
        // Home page banner tabs
        $('.eligibility-tabs .tab').on('click', function () {
            $('.eligibility-tabs .tab, .eligibility-tab-content').removeClass('active');
            $(this).addClass('active');
            $('.' + $(this).attr('data-tab')).addClass('active');
        });
    });
</script>
