<footer>
    <div class="footer-container inner-container">
        <div class="footer-top d-flex justify-content-between">
            <div class="footer-info justify-content-between d-flex">

                <div class="card-container footer-controls">
                    <div class="card">
                        <div class="google-map">
                            <div class="google-map-overlay"></div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.388272210313!2d-0.15435908423344974!3d51.41429387961996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760668a774df57%3A0xc25249c9ed825206!2sBeecholme+Adult+Care!5e0!3m2!1sru!2sua!4v1518099027832" width="1920" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="footer-contact">
                    <h4>Contact us</h4>
                    <?php
                    if (have_rows('contact_us', 'option')):
                        while (have_rows('contact_us', 'option')) : the_row(); ?>
                            <p><?php the_sub_field('paragraph', 'option'); ?></p>
                        <?php endwhile;
                    endif;
                    ?>
<!--                    --><?php //$link = get_field('phone', 'option'); ?>
<!--                    <p><a href="--><?php //echo $link['url']; ?><!--">--><?php //echo $link['title']; ?><!--</a></p>-->
<!--                    --><?php //$link = get_field('email', 'option'); ?>
<!--                                       <p><a href="--><?php //echo $link['url']; ?><!--">--><?php //echo $link['title']; ?><!--</a></p>-->
                </div>

                <div class="footer-menu">
                    <h4>Links</h4>
                    <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
                </div>

            </div>
        </div>

        <div class="footer-buttons">
            <div class="footer-controls footer-controls-first">
                <div class="buttons d-flex flex-wrap justify-content-between">
                    <?php $link = get_field('councelor_button', 'option'); ?>
                    <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                    <?php $link = get_field('make_a_refferal_button', 'option'); ?>
                    <a href="<?php echo $link['url']; ?>" class="referral-button"><?php echo $link['title']; ?></a>

                </div>
            </div>

            <div class="footer-controls footer-controls-second">
                <div class="buttons d-flex flex-wrap justify-content-between">
                    <?php $link = get_field('therapists_button', 'option'); ?>
                    <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                    <?php $link = get_field('coaches_button', 'option'); ?>
                    <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                </div>
            </div>
        </div>


        <div class="footer-subscribe-form">
            <div class="footer-subscribe-form-title">
                Subscribe to our newsletter
                <img src="<?php echo get_template_directory_uri().'/images/main-new/letter-plain.svg' ?>" class="footer-subscribe-form-plain" alt="plain-icon">
            </div>

            <?php echo do_shortcode('[contact-form-7 id="2724" title="Subscribe to our newsletter"]'); ?>
        </div>

        <div class="footer-bottom d-flex justify-content-between align-items-center">
            <div class="copyrights align-self-center">
                <span>Copyright 2020. All Rights Reserved.</span>
                <?php $link = get_field('policies', 'option'); ?>
                <a href="<?php echo $link['url']; ?>" class="policy-link"><?php echo $link['title']; ?></a>
                <a href="<?php echo get_site_url().'/eligibility-criteria';?>" class="eligibility-link">Eligibility Criteria</a>
            </div>
            <div class="footer-social d-flex align-items-center">
                <div class="sectigo">
                    <script type="text/javascript"> //<![CDATA[
                        var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
                        document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
                        //]]></script>
                    <script language="JavaScript" type="text/javascript">
                        TrustLogo("https://sectigo.com/images/seals/sectigo_trust_seal_sm_2x.png", "SECOV", "none");
                    </script>
                </div>
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