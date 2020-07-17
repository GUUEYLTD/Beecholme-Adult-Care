<?php
/**
 * Template part for displaying posts
 */
?>

<div class="post-container">
    <h2 class="post-title"><?php the_title(); ?></h2>

    <div class="post-meta">
        <div class="post-meta-item">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
            <?php the_date(); ?>
        </div>
        <div class="post-meta-item">
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <?php the_category(); ?>
        </div>
        <div class="post-meta-item">
            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
            <?= get_comments_number(); ?>
        </div>
        <div class="post-meta-item">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <?php the_author(); ?>
        </div>
    </div>

    <?php if ( has_post_thumbnail() ): ?>
        <div class="post-featured-image">
            <?php the_post_thumbnail() ?>
        </div>
    <?php else: ?>
        <div class="post-featured-image">
            <img src="<?= get_template_directory_uri(); ?>/images/no-photo.png" alt="">
        </div>
    <?php endif; ?>



    <div class="post-content">
        <?php if ( is_single() ) {
            the_content();
        } else {
            the_excerpt();
        } ?>
    </div>

    <?php if ( !is_single() ): ?>
        <a href="<?= get_permalink() ?>" class="read-more-btn">
            Read More
        </a>
    <?php endif; ?>

    <div class="post-social-share">
        <div class="post-social-item">Share this: </div>

        <div class="post-social-item">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
               class="twitter-share-button"
               data-show-count="false"
               data-url="<?= get_permalink() ?>"
               data-text="<?php the_title() ?>"
               rel="canonical"
            >
                Tweet
            </a>
        </div>

        <div class="post-social-item">
            <div class="fb-share-button"
                 data-layout="button"
                 data-size="small"
                 data-href="<?= get_permalink() ?>"
            >
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore"
                >
                    Share
                </a>
            </div>
        </div>
    </div>
</div>