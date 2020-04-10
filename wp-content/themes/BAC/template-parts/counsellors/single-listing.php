<div class="single-item" data-rating="" data-price="<?= \BAC\Practitioners::getPriceByPractitionerId($listingUser->id) ?>" data-index="<?= $listingUser->id ?>">
    <a href="<?php echo get_author_posts_url($listingUser->wp_user->ID) ?>">
        <div class="personal-info d-flex">
            <div class="avatar"><img
                        src="<?php echo $listingUser->pictureThumbPath ?? get_stylesheet_directory_uri(); ?>/images/profile-placeholder.png"
                        alt=""></div>
            <div class="info d-flex">
                <div class="name"><?= "{$listingUser->firstName} {$listingUser->lastName}" ?></div>
                <div class="type"><?= $listingUser->category->name ?></div>
            </div>
        </div>
    </a>
    <div class="specialty">
        <?php
        $serviceNames = [];
        foreach ($listingUser->services as $service) {
            $serviceNames[] = $service->name;
        }
        ?>
        <?= implode(", ", $serviceNames) ?>
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
            <div class="price"><span>&#163;<?= \BAC\Practitioners::getPriceByPractitionerId($listingUser->id) ?></span> / session</div>
            <div class="languages d-flex">
                <?php
                if (have_rows('languages', "user_{$listingUser->wp_user->id}")) :
                    while (have_rows('languages', "user_{$listingUser->wp_user->id}")) : the_row();
                        echo get_sub_field('language');
                    endwhile; ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-fr.png" alt="">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/counsellor-lang-en.png" alt="">
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="button-wrapper">
        <a href="<?= "/booking/?user={$listingUser->id}" ?>">
            <button>Book</button>
        </a>
    </div>
</div>