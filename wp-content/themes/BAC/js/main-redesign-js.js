jQuery(document).ready(function($) {

    jQuery(function($) {

        var $win = $(window),
            // winH = $win.height();
            winH = 200;

        $(document).on('click', '.toggle', function(){
            if( $win.scrollTop() < winH ){
                $('#header').toggleClass('header-white');
                $('.logo-black-letters').toggleClass("logo-display-block" );
                $('.logo-white-letters').toggleClass("logo-display-none" );
            }
            $('body').toggleClass("body-overflow-hidden");
        });

        $win.on("scroll", function () {
            $('#header').toggleClass("header-white", $(this).scrollTop() > winH );
            $('.logo-black-letters').toggleClass("logo-display-block", $(this).scrollTop() > winH );
            $('.logo-white-letters').toggleClass("logo-display-none", $(this).scrollTop() > winH );
        }).on("resize", function(){
            winH = $(this).height();
        });

    });

    $(document).on('click', '.toggle', function(){
        //$('.toggle').toggleClass('active');
        $('.mobile-menu-container').toggleClass('logo-display-block');
    });

    setTimeout(function(){ $('.home-top-banner-mobile-text').fadeIn() }, 1500);
    setTimeout(function(){ $('.home-top-banner-mobile-buttons .cta-button-wrapper').fadeIn() }, 2500);

    $('.owl-carousel').owlCarousel({
        loop:true,
        stagePadding: 25,
        nav:true,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            800:{
                items:3
            },
            1000:{
                items:3
            }
        }
    })

});