<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<div class="gallery-single-page">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
