<?php /*Template Name: Our Counsellors Paginated*/
get_header();
?>

<div class="text-block-800 text-block-800-consellors">
    <?php the_content();?>
</div>

<div class="our-counsellors">
    <div class="content">
        <?php get_template_part('template-parts/counsellors/searchbar'); ?>
        <?php get_template_part('template-parts/counsellors/sorting'); ?>

        <div class="counsellors-list d-flex">

        </div>

        <div class="button-wrapper">
            <button id="more_button" style="max-width: 200px;display: block;margin: 20px auto 70px;">Load more</button>
        </div>

        <script>
            jQuery(function($){

                var type = $( "input[type=radio][name=type]:checked" ).val() ;
                var specialization = $( ".question-filter.active select.question-select"  ).val();
                var languages = $( ".languages-select" ).val() ;
                var sortBy = $( ".sort-bar .sort .sort-filter .question-select .current" ).html();
                var sortOrder = $( ".sort-bar .sort .order-filter" ).hasClass("ascending") ? 'ASC' :  'DESC';
                var limit = 12;


                function ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit) {
                    $.ajax({
                        url: ajaxurl,
                        type: 'GET',
                        data: {
                            action: 'filter_counsellors_paginated',
                            type: type,
                            specialization: specialization,
                            language: languages,
                            sortBy: sortBy,
                            sortOrder: sortOrder,
                            limit:limit
                        },
                        success: function( data ) {
                            if( data ) {
                                $('.counsellors-list').html(data);
                                $('.results-amount .results-now').html(jQuery('.counsellors-list > .single-item').length);
                                if(jQuery('.counsellors-list > .single-item').length < 12){
                                    jQuery('#more_button').css('display', 'none');
                                } else {
                                    jQuery('#more_button').css('display', 'block');
                                }
                            } else {
                                $('.results-amount .results-now').html('0');
                                jQuery('#more_button').css('display', 'none');
                                $('.counsellors-list').html('<h3 class="empty-results-heading">WE ARE SORRY!</h3><div class="empty-results-text">We couldn’t find any match. Please, try another search. Need assistance? Write us at <a href="mailto:online@beecholmeadultcare.co.uk">online@beecholmeadultcare.co.uk</a></div>');
                            }
                        }
                    });

                    $.ajax({
                        url: ajaxurl,
                        type: 'GET',
                        data: {
                            action: 'search_counsellors_total',
                            type: type,
                            specialization: specialization,
                            language: languages,
                            sortBy: sortBy,
                            sortOrder: sortOrder
                        },
                        success: function( data ) {
                            if( data ) {
                                $('.results-amount .results-number').html(data);
                            }
                        }
                    });
                }
                ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);

                $('#more_button').click(function(){
                    var type = $( "input[type=radio][name=type]:checked" ).val() ;
                    var specialization = $( ".question-filter.active .dropdown.question-select .current"  ).text() ;
                    var languages = $( ".languages-select" ).val() ;
                    var sortBy = $( ".sort-bar .sort .sort-filter .question-select .current" ).html();
                    var sortOrder = $( ".sort-bar .sort .order-filter" ).hasClass("ascending") ? 'ASC' :  'DESC';
                    limit = limit + 12;
                    ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);
                });

                $('.search-button button').on('click', function(e){
                    e.preventDefault();
                    jQuery('.counsellors-list > .single-item').remove();
                    var type = $( "input[type=radio][name=type]:checked" ).val() ;
                    var specialization = $( ".question-filter.active .dropdown.question-select .current"  ).text() ;
                    var languages = $( ".languages-select" ).val() ;
                    var sortBy = $( ".sort-bar .sort .sort-filter .question-select .current" ).html();
                    var sortOrder = $( ".sort-bar .sort .order-filter" ).hasClass("ascending") ? 'ASC' :  'DESC';
                    ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);

                });

                // $('.order-filter').on('click', function(e){
                //     e.preventDefault();
                //     var type = $( "input[type=radio][name=type]:checked" ).val() ;
                //     var specialization = $( ".question-filter.active .dropdown.question-select .current"  ).text() ;
                //     var languages = $( ".languages-select" ).val() ;
                //     var sortBy = $( ".sort-bar .sort .sort-filter .question-select .current" ).html();
                //     var sortOrder = $( ".sort-bar .sort .order-filter" ).hasClass("ascending") ? 'ASC' :  'DESC';
                //     ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);
                // });

            });
        </script>


    </div>
</div>

<?php get_footer(); ?>