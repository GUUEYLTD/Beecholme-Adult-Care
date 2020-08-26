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

        <style>
            .page-template-our-counsellors-paginated .our-counsellors .content{
                position: relative;
            }

            .counsellors-preloader-active-absolute{
                position: absolute;
            }
           .counsellors-preloader-active{
               top: 0;
               left: 0;
               right: 0;
               background-color: rgb(255 255 255 / 0.98);
               bottom: 0;
               display: flex;
               justify-content: center;
               align-items: flex-start;
           }

            .counsellors-preloader-noactive{
                display:none
            }

            .spinner {
                width: 80px;
                height: 80px;
                border: 2px solid #f3f3f3;
                border-top: 4px solid #5AB9AC;
                border-radius: 100%;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;
                animation: spin 1s infinite ease;
            }

            @keyframes spin {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }
        </style>

        
        <div class="button-wrapper" style="position: relative; margin-bottom:100px">
            <button id="more_button" style="max-width: 200px;display: block;margin: 20px auto 70px;">Load more</button>

            <div class="counsellors-preloader-more counsellors-preloader-active counsellors-preloader-active-absolute">
                <div class="" style="position: relative; width:100%; padding-top: 50px">
                    <div class="spinner"></div>
                </div>
            </div>
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
                                if( jQuery('.counsellors-list > .single-item').length < 12 ){
                                    jQuery('#more_button').css('display', 'none');
                                }else {
                                    jQuery('#more_button').css('display', 'block');
                                }

                                setTimeout( function(){
                                    jQuery('.counsellors-preloader-more').addClass('counsellors-preloader-noactive');
                                } , 1500);

                            } else {
                                $('.results-amount .results-now').html('0');
                                jQuery('#more_button').css('display', 'none');
                                jQuery('.counsellors-preloader-more').addClass('counsellors-preloader-noactive');
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

                                setTimeout( function(){
                                  if ( jQuery('.counsellors-list > .single-item').length >= data ) {
                                      jQuery('#more_button').css('display', 'none');
                                  } else {
                                      jQuery('#more_button').css('display', 'block');
                                  }
                                } , 1000);
                            }
                        }
                    });
                }
                ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);

                $('#more_button').click(function(){

                    jQuery('.counsellors-preloader-more').removeClass('counsellors-preloader-noactive');

                    var type = $( "input[type=radio][name=type]:checked" ).val() ;
                    var specialization = $( ".question-filter.active select.question-select"  ).val();
                    var languages = $( ".languages-select" ).val() ;
                    var sortBy = $( ".sort-bar .sort .sort-filter .question-select .current" ).html();
                    var sortOrder = $( ".sort-bar .sort .order-filter" ).hasClass("ascending") ? 'ASC' :  'DESC';
                    limit = limit + 12;
                    ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);

                    setTimeout( function(){
                        var nScroll = $('.counsellors-list > .single-item:nth-child('+(limit-8)+')');
                        $('html, body').animate({
                            scrollTop: nScroll.offset().top - 100
                        }, 1000);
                    } , 1000);

                });

                $('.search-button button').on('click', function(e){

                    jQuery('#more_button').css('display', 'none');
                    jQuery('.counsellors-preloader-more').removeClass('counsellors-preloader-noactive');

                    e.preventDefault();
                    limit = 12;
                    jQuery('.counsellors-list > .single-item').remove();
                    var type = $( "input[type=radio][name=type]:checked" ).val() ;
                    var specialization = $( ".question-filter.active select.question-select"  ).val();
                    var languages = $( ".languages-select" ).val() ;
                    var sortBy = $( ".sort-bar .sort .sort-filter .question-select .current" ).html();
                    var sortOrder = $( ".sort-bar .sort .order-filter" ).hasClass("ascending") ? 'ASC' :  'DESC';
                    ajaxQuery(type, specialization, languages, sortBy, sortOrder, limit);

                    setTimeout( function(){
                        var nScroll = $('.counsellors-list > .single-item:nth-child(1)');
                        $('html, body').animate({
                            scrollTop: nScroll.offset().top - 100
                        }, 1000);
                    } , 500);

                });

            });
        </script>


    </div>
</div>

<?php get_footer(); ?>