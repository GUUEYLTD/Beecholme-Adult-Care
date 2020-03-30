<?php /*Template Name: galleries*/

$args = array(
    'post_type' => 'rl_gallery',
    'posts_per_page' => 30,
);
$query = new WP_Query( $args );
get_header();
?>

<div class="gallery-page">
    <?php if ($query->have_posts()) : ?>
        <div class="container">
            <div class="row">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-sm-6 col-md-4">
                        <a href="<?= get_permalink() ?>" class="gallery-card">
                            <div class="gallery-card-thumb">
                                <?php the_post_thumbnail(); ?>
                            </div>

                            <h3 class="gallery-card-title">
                                <?php the_title(); ?>
                            </h3>
                        </a>
                    </div>
                <?php endwhile;  ?>
            </div>
            <div class="posts-pagination">
                <?= paginate_links(array(
                    'prev_text' => '<',
                    'next_text' => '>',
                    'total' => $query->max_num_pages,
                )) ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
