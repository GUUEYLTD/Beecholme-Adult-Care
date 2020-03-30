<?php
/*
 * Template Name: blog
 */
get_header();
?>

<div class="blog-page">
    <?php
    if (have_posts()) : ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <?php while (have_posts()) : the_post();
                        get_template_part( 'template-parts/post/content' );
                    endwhile; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>

        </div>
    <?php endif;
    ?>
</div>

<?php get_footer(); ?>
