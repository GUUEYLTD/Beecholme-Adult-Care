<footer>
    <div class="footer-container inner-container">
        <div class="footer-top d-flex justify-content-between">
            <div class="footer-info d-flex">
                <div class="footer-contact">
                    <h4>Contact us</h4>
                    <p>Beecholme Adult Care</p>
                    <p>2-4 Beecholme Ave Mitcham</p>
                    <p>Surrey CR4 2HT</p>
                    <p><a href="tel:020 8648 6681">020 8648 6681</a></p>
                    <p>United Kingdom</p>
                    <p><a href="mailto:info@beecholmeadultcare.co.uk">info@beecholmeadultcare.co.uk</a></p>
                </div>
                <div class="footer-menu">
                    <h4>Links</h4>
                    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                </div>
            </div>
            <div class="footer-controls d-flex justify-content-between">
                <div class="buttons d-flex flex-wrap justify-content-between">
                    <a href="/landing/">For Counsellors</a>
                    <a href="/make-a-referral" class="referral-button">Make a Referral</a>
                    <a href="/our-counsellors/?type=therap&therapy=&coaching=&common=">Therapists</a>
                    <a href="/our-counsellors?type=coach&therapy=&coaching=&common=">Life Coaches</a>
                </div>
                <div class="trustpilot">
                    <div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5e68a17b7935f90001f6f836" data-style-height="58px" data-style-width="340px" data-theme="dark">
                        <a href="https://uk.trustpilot.com/review/beecholmeadultcare.co.uk" target="_blank" rel="noopener">Trustpilot</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-between">
            <div class="copyrights align-self-center">
                <span>Copyright 2020. All Rights Reserved.</span>
                <a href="<?php echo get_the_permalink(391); ?>" class="policy-link">Privacy Policy</a>
                <a href="<?php echo get_the_permalink(397); ?>" class="policy-link">Cookie Policy</a>
                <a href="/msas/" class="policy-link">Modern Slavary Act Statement</a>
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