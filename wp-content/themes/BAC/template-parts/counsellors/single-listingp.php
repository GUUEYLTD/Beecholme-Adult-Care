<div class="single-item" data-rating="" data-price="<?= \BAC\Practitioners::getPriceByPractitionerId($listingUser->ameliaId) ?>" data-index="<?php echo get_field('counsellor_score', "user_{$listingUser->ID}") ? get_field('counsellor_score', "user_{$listingUser->ID}") : 0; ?>" data-surname="<?php echo $listingUser->lastName;?>">
    <a href="<?php echo get_author_posts_url($listingUser->ID) ?>">
        <div class="personal-info d-flex">
            <div class="avatar"><img
                    src="<?php echo $listingUser->pictureThumbPath ?? (get_stylesheet_directory_uri() . '/images/profile-placeholder.png'); ?>"
                    alt=""></div>
            <div class="info d-flex">
                <div class="name"><?= "{$listingUser->firstName} {$listingUser->lastName}" ?></div>
                <div class="type"><?= implode(", ", getACFLoopValues('type', $listingUser->externalId)) ?></div>
            </div>
        </div>
    </a>

    <?php
    $args = array(
        'post_type' => 'reviews',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'review-user-id',
                'value' => $listingUser->externalId
            )
        )
    );
    $loop = new WP_Query($args);
    $count_reviews =  $loop->post_count;
    $average_sum = 0;
    while ($loop->have_posts()) : $loop->the_post();
        $average_sum = $average_sum + get_field('review-stars');
    endwhile;
    if( $count_reviews > 0 ){
        $average_stars = round($average_sum/$count_reviews, 2);
    } else {
        $average_stars = 0;
    }
    if ( $average_stars > 0 && $average_stars <= 1 ){
        $stars_additional_class = "rating-upper-red";
    } else if ( $average_stars > 1 && $average_stars <= 3 ){
        $stars_additional_class = "rating-upper-yellow";
    } else {
        $stars_additional_class = "";
    }
    ?>
    <style>
        .stars {
            position: relative;
            padding: 0;
            text-shadow: 0px 1px 0 #a2a2a2;
            overflow: hidden;
            height: 24px;
        }
        .rating-upper{
            background: url('<?php echo get_template_directory_uri();?>/images/rating-green.svg') 0% no-repeat;
            width:136px;
            height:24px;
            position: absolute;
        }
        .rating-lower{
            background: url('<?php echo get_template_directory_uri();?>/images/rating-gray.svg') 0% no-repeat;
            width:136px;
            height:24px
        }
        .rating-upper-red{
            background: url('<?php echo get_template_directory_uri();?>/images/rating-red.svg') 0% no-repeat;
        }
        .rating-upper-yellow{
            background: url('<?php echo get_template_directory_uri();?>/images/rating-yellow.svg') 0% no-repeat;
        }
    </style>
    <div class="user-score text-center" >Counsellor score : <?php the_field('counsellor_score', "user_{$listingUser->ID}"); ?></div>
    <div class="specialty">
        <?= implode(", ", getACFLoopValues('specializations', $listingUser->externalId)) ?>
    </div>
    <div class="details">
        <div class="rating d-flex justify-content-center">
            <div class="stars">
                <div class="rating-upper <?php echo $stars_additional_class; ?>" style="width: <?php echo ($average_stars*20);?>%"> </div>
                <div class="rating-lower"></div>
            </div>
        </div>
        <div class="price-wrapper d-flex justify-content-between align-items-center">

            <div class="price"><span>&#163;<?= \BAC\Practitioners::getPriceByPractitionerId($listingUser->ameliaId) ?></span> / session</div>
            <div class="languages d-flex">
                <?php
                $count = 0;
                foreach (getACFLoopValues('languages', $listingUser->ID) as $language) : ?>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/images/flags/' . sanitize_title($language) . '.svg'; ?>" alt="">
                    <?php
                    if($count > 0)
                        break;
                    $count++;
                endforeach; ?>
            </div>

        </div>
    </div>
    <div class="button-wrapper">
        <a href="<?= "/booking/?user={$listingUser->ameliaId}" ?>">
            <button>Book</button>
        </a>
    </div>
</div>