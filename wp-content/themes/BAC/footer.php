<footer>
    <div class="footer-container inner-container">
        <div class="footer-top d-flex justify-content-between">
            <div class="footer-info d-flex">
                <div class="footer-contact">
                    <h4>Contact us</h4>
                    <p>Beecholme Adult Care</p>
                    <p>2-4 Beecholme Ave Mitcham</p>
                    <p>Surrey CR4 2HT</p>
                    <p>020 8648 6681</p>
                    <p>United Kingdom</p>
                    <p>info@beecholmeadultcare.co.uk</p>
                </div>
                <div class="footer-menu">
                    <h4>Links</h4>
                    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                </div>
            </div>
            <div class="footer-controls d-flex justify-content-between">
                <div class="buttons d-flex flex-wrap justify-content-between">
                    <a href="#">For Practitioner</a>
                    <a href="/make-a-referral" class="referral-button">Make a Referral</a>
                    <a href="#">Therapists</a>
                    <a href="#">Coaches</a>
                </div>
                <div class="trustpilot">
                    <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_trustpilot_footer.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-between">
            <div class="copyrights align-self-center">
                Copyright 2017. All Rights Reserved.
                <a href="<?php echo get_the_permalink(391); ?>" class="policy-link">Privacy Policy</a>
                <a href="<?php echo get_the_permalink(397); ?>" class="policy-link">Cookie Policy</a>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/BeecholmeAdultCare/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-fb.svg" alt="fb"></a>
                <a href="https://twitter.com/BeecholmeAC" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-twitter.svg" alt="twitter"></a>
                <a href="https://www.instagram.com/bac_beecholmeadultcare/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-insta.svg" alt="instagram"></a>
                <a href="https://www.linkedin.com/company/beecholme-adult-care-ltd/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-linkedin.svg" alt="linkedin"></a>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</body>
</html>