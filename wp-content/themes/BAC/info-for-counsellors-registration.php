<?php /*Template Name: Info For Counsellors: Registration*/
get_header();
?>


    <div class="counsellors-page-title-wrapper mid-container">
        <?php $back = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>
        <a href="<?php echo $back; ?>" class="counsellors-page-title-back">
            <img src="<?php echo get_template_directory_uri(); ?>/images/counsellor-arrow-back.svg" alt="arrow-back">
        </a>
        <h1 class="page-title"><?php echo get_the_title(); ?></h1>
    </div>

    <div class="mid-container counsellors-info-wrapper">
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">How do I register?</div>
            <div class="counsellors-info-item-text">
                Please register using this link and completing the registration form.
            </div>
        </div>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">Terms & Conditions</div>
            <div class="counsellors-info-item-text">
                Before starting to work on out platform all counsellors will receive by email our Terms & Conditions to be read and agreed to.
            </div>
        </div>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">DBS Check</div>
            <div class="counsellors-info-item-text">
                If you have a DBS check please provide it to be added to your profile information.
            </div>
        </div>
        <div class="counsellors-info-item counsellors-info-item-50">
            <div class="counsellors-info-item-heading">Contract</div>
            <div class="counsellors-info-item-text">
                BAC will provide a Contract along with a Code of Ethics to all Counsellors before they start using our platform.
            </div>
        </div>

    </div>

    <div class="counsellors-info-full-background">
        <h2>Qualifications</h2>
        <div class="mid-container counsellors-info-wrapper">
            <div class="counsellors-info-item counsellors-info-item-100">
                <div class="counsellors-info-item-heading">What qualifications do I need to be a Life Coach?</div>
                <div class="counsellors-info-item-text">
                    <p>
                        We accept all certifications in Coaching. Potential clients might look upon you more favorably if you have an industry specific qualification - such as the Life Coaching Diploma or Level 3 with Official Certification.
                    </p>
                    <p>
                        Certifications that are accredited by industry associations like the International Coach Federation can also be more attractive to clients when choosing a Coach.
                    </p>
                </div>
            </div>
            <div class="counsellors-info-item counsellors-info-item-100">
                <div class="counsellors-info-item-heading">What qualifications do I need to be a Therapist?</div>
                <div class="counsellors-info-item-text">
                    All therapists will be recognized if they have a bachelor's degree. All therapists need to be licensed to provide counselling.
                </div>
            </div>
            <div class="counsellors-info-item counsellors-info-item-100">
                <div class="counsellors-info-item-heading">What qualifications do I need to be on the platform?</div>
                <div class="counsellors-info-item-text">
                    We accept all levels of experience. It is important that you define your experience in the section «Biographical Info».
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>