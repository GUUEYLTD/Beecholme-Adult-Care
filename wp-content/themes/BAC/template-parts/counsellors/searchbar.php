<?php
    $languages = array(
        'English',
        'French',
        'German',
        'Spanish',
        'Italian',
        'Portuguese',
        'Russian',
        'Chineese',
        'Japanese'
    );
?>

<div class="filter-bar-wrapper">
    <div class="mobile-filter-bar-button justify-content-center align-items-center">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-filters.png" alt="">
        Filters
    </div>
    <form class="filter-bar" method="GET" action="">
        <div class="type-filter d-flex flex-column align-left">
            <div class="caption">I am looking for a</div>
            <div class="type-tabs d-flex">
                <label for="radio-type-coach"
                       class="single-tab coach <?php echo (isset($_GET['type']) && $_GET['type'] === 'Life coach') ? 'active' : ''; ?>"
                       data-type="coach">Life Coach</label>
                <label for="radio-type-therapist"
                       class="single-tab therapist <?php echo (isset($_GET['type']) && $_GET['type'] === 'Therapist') ? 'active' : ''; ?>"
                       data-type="therapist">Therapist</label>
                <label for="radio-type-all"
                       class="single-tab all <?php echo (is_null($_GET['type'])) || ($_GET['type'] !== 'Therapist' && $_GET['type'] !== 'Life coach') ? 'active' : ''; ?>"
                       data-type="all">All</label>

                <input type="radio" name="type" value="Therapist" class="hidden"
                       id="radio-type-therapist" <?php echo (isset($_GET['type']) && $_GET['type'] === 'Therapist') ? 'checked' : ''; ?>/>
                <input type="radio" name="type" value="Life coach" class="hidden"
                       id="radio-type-coach" <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'checked' : ''; ?>/>
                <input type="radio" name="type" value="" class="hidden"
                       id="radio-type-all" <?php echo (is_null($_GET['type'])) || ($_GET['type'] !== 'Therapist' && $_GET['type'] !== 'Life coach') ? 'checked' : ''; ?>/>
            </div>
        </div>

        <div class="question-filter therapist-question-filter flex-column align-left <?php echo (isset($_GET['type']) && $_GET['type'] === 'Therapist') ? 'active' : ''; ?>">
            <div class="caption">What are you suffering from?</div>
            <select class="question-select" name="therapy">
                <option value="" data-display-text="All">All</option>
                <?php foreach (getServices('Therapist') as $serviceName) : ?>
                    <option
                            value="<?php echo $serviceName ?>"
                        <?php echo isset($_GET['therapy']) && $_GET['therapy'] === $serviceName ? 'selected' : '' ?>
                    ><?php echo $serviceName ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="question-filter coach-question-filter flex-column align-left <?php echo (isset($_GET['type']) && $_GET['type'] === 'Life coach') ? 'active' : ''; ?>">
            <div class="caption">Type of coaching</div>
            <select class="question-select" name="coaching">
                <option value="" data-display-text="All">All</option>
                <?php foreach (getServices('Life coach') as $serviceName) : ?>
                    <option
                        value="<?php echo $serviceName ?>"
                        <?php echo isset($_GET['coaching']) && $_GET['coaching'] === $serviceName ? 'selected' : '' ?>
                    ><?php echo $serviceName ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="question-filter empty-filter flex-column align-left <?php echo (!isset($_GET['type'])) ? 'active' : ''; ?>">
            <div class="caption">Choose type</div>
            <select class="question-select" name="common">
                <option value="" data-display-text="All">All</option>
                <?php foreach (getServices() as $serviceName) : ?>
                    <option
                            value="<?php echo $serviceName ?>"
                        <?php echo isset($_GET['common']) && $_GET['common'] === $serviceName ? 'selected' : '' ?>
                    ><?php echo $serviceName ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="language-filter flex-column align-left">
            <div class="caption">Select language</div>
            <select class="multiple-select" name="languages[]" multiple style="width:246px; display: none">
                <?php foreach ($languages as $language) { ?>
                    <option value="<?= $language ?>" <?php echo (isset($_GET['languages']) && in_array($language,
                            $_GET['languages'])) ? 'selected' : '' ?>><?= $language ?></option>
                <?php } ?>
            </select>
        </div>


        <div class="search-button">
            <button>Search</button>
        </div>

    </form>
</div>