<?php /*Template Name: Policy*/
get_header();
?>
    <div class="policy-page d-flex container">
        <div class="sidebar">
            <div class="sidebar-links d-flex flex-column">
                <a href="<?php echo get_the_permalink(391); ?>" class="<?php echo do_shortcode('[policy_active_link link_name="Privacy Policy" current_page_title="'.get_the_title().'"]'); ?> policy-link-sidebar">Privacy Policy</a>
                <a href="<?php echo get_the_permalink(397); ?>" class="<?php echo do_shortcode('[policy_active_link link_name="Cookie Policy" current_page_title="'.get_the_title().'"]') ?> policy-link-sidebar">Cookie Policy</a>
                <a href="/msas/" class="<?php echo do_shortcode('[policy_active_link link_name="Modern Slavery Act Statement" current_page_title="'.get_the_title().'"]') ?> policy-link-sidebar">Modern Slavery Act Statement</a>
                <a href="/disclaimer/" class="<?php echo do_shortcode('[policy_active_link link_name="Disclaimer" current_page_title="'.get_the_title().'"]') ?> policy-link-sidebar">Disclaimer</a>
                <a href="/terms-and-conditions/" class="<?php echo do_shortcode('[policy_active_link link_name="Terms And Conditions" current_page_title="'.get_the_title().'"]') ?> policy-link-sidebar">Terms And Conditions</a>
            </div>
        </div>
        <div class="policy-content">
            <?php
            if (have_posts()) : ?>
                <?php while (have_posts()) : the_post();
                    the_content();
                endwhile; ?>
            <?php endif;
            ?>
        </div>
    </div>
<?php get_footer(); ?>