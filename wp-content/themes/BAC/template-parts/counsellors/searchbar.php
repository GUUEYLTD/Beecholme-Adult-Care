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
                       class="single-tab coach <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'active' : ''; ?>"
                       data-type="coach">Life Coach</label>
                <label for="radio-type-therapist"
                       class="single-tab therapist <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'active' : ''; ?>"
                       data-type="therapist">Therapist</label>
                <label for="radio-type-all"
                       class="single-tab all <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'active' : ''; ?>"
                       data-type="all">All</label>
                <input type="radio" name="type" value="" class="hidden"
                       id="radio-type-all" <?php echo (isset($_GET['type']) && $_GET['type'] === '') ? 'checked' : ''; ?>/>
                <input type="radio" name="type" value="therap" class="hidden"
                       id="radio-type-therapist" <?php echo (isset($_GET['type']) && $_GET['type'] === 'therap') ? 'checked' : ''; ?>/>
                <input type="radio" name="type" value="coach" class="hidden"
                       id="radio-type-coach" <?php echo (isset($_GET['type']) && $_GET['type'] === 'coach') ? 'checked' : ''; ?>/>
            </div>
        </div>

        <div class="question-filter therapist-question-filter flex-column align-left">
            <div class="caption">What are you suffering from?</div>
            <select class="question-select" name="therapy">
                <option value="" data-display-text="All">All</option>
                <?php foreach (\BAC\Service::getServiceNames('therap') as $serviceName) : ?>
                    <option value="<?php echo $serviceName ?>"><?php echo $serviceName ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="question-filter coach-question-filter flex-column align-left">
            <div class="caption">Type of coaching</div>
            <select class="question-select" name="coaching">
                <option value="" data-display-text="All">All</option>
                <?php foreach (\BAC\Service::getServiceNames('coach') as $serviceName) : ?>
                    <option value="<?php echo $serviceName ?>"><?php echo $serviceName ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="question-filter empty-filter flex-column align-left">
            <div class="caption">Choose type</div>
            <select class="question-select" name="common">
                <option value="" data-display-text="All">All</option>
                <?php foreach (\BAC\Service::getServiceNames() as $serviceName) : ?>
                    <option value="<?php echo $serviceName ?>"><?php echo $serviceName ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="language-filter flex-column align-left">
            <div class="caption">Select language</div>
            <select class="question-select" name="language">
                <option value="" data-display-text="All">All</option>
                <option value="apples">English</option>
                <option value="bananas">French</option>
                <option value="oranges">German</option>
                <option value="oranges">Spanish</option>
                <option value="oranges">Italian</option>
                <option value="oranges">Portoguese</option>
                <option value="oranges">Russian</option>
                <option value="oranges">Chinese</option>
                <option value="oranges">Japanese</option>
            </select>
        </div>

        <div class="search-button">
            <button>Search</button>
        </div>

    </form>
</div>