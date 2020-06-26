<div class="single-item" data-rating="" data-price="<?= \BAC\Practitioners::getPriceByPractitionerId($listingUser->ameliaId) ?>" data-index="<?= $listingUser->ameliaId ?>">
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
    <div class="specialty">
        <?= implode(", ", getACFLoopValues('specializations', $listingUser->externalId)) ?>
    </div>
    <div class="details">
        <!--        <div class="rating d-flex justify-content-center">wp_user->ID-->
        <!--            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
        <!--            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
        <!--            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
        <!--            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
        <!--            <img src="--><?php //echo get_stylesheet_directory_uri(); ?><!--/images/rating-grey-star.png" alt="">-->
        <!--        </div>-->
        <div class="price-wrapper d-flex justify-content-between align-items-center">

            <div class="price"><span>&#163;<?= \BAC\Practitioners::getPriceByPractitionerId($listingUser->ameliaId) ?></span> / session</div>
            <div class="languages d-flex">
                <?php
                $count = 0;
                //                echo "<pre>";
                //                var_dump(getACFLoopValues('languages', $listingUser->wp_user->ID));
                //                echo "</pre>";
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