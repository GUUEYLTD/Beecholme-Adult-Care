<?php get_header(); ?>

<?php
	if (have_posts()) : ?>
		<div class="container">
		<?php while (have_posts()) : the_post();
			the_content();
		endwhile; ?>
		</div>
	<?php endif;
?>

<?php get_footer(); ?>