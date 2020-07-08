<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<div class="blog-single-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <?php while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/post/content' );
                ?>
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="post-comments">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer();
