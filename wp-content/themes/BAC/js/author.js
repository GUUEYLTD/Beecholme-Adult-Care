jQuery(function($) {
    var modal = document.getElementById("formRating");
    var modalSuccess = document.getElementById("modalSuccess");
    var modalNotfound = document.getElementById("modalNotfound");
    var btn = document.getElementById("btnRating");
    var span = document.getElementsByClassName("rating-close")[0];
    var spanSuccess = document.getElementsByClassName("rating-close")[1];
    var spanNotfound = document.getElementsByClassName("rating-close")[2];
    $(btn).click(function(){
        modal.style.display = "block";
    });
    $(span).click(function(){
        modal.style.display = "none";
    });
    $(spanSuccess).click(function(){
        modalSuccess.style.display = "none";
    });
    $(spanNotfound).click(function(){
        modalNotfound.style.display = "none";
    });

});


jQuery(function($){

    document.addEventListener( 'wpcf7mailsent', function( event ) {
        $('.popup').css('display','none');
    }, false );

    //var wpcf7Elm = document.querySelector( '#wpcf7-f2705-o1' );
    var wpcf7Elm = document.querySelector( '#wpcf7-f2621-o1' );

    wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
        var revid = $('#revId').val();
        var remail = $('input[name=your-email]').val();
        var rfirstname = $('input[name=first-name]').val();
        var rlastname = $('input[name=last-name]').val();
        var rstars = $('input[name=radio-review]:checked').val();
        var rreview = $('.wpcf7-textarea').val();

        ajaxAddReview(revid, remail, rfirstname, rlastname, rstars, rreview);

    }, false );




    function ajaxAddReview(revid, remail, rfirstname, rlastname, rstars, rreview) {

        $.ajax({
            url: ajaxurl,
            type: 'GET',
            data: {
                action: 'add_review_callback',
                revid: revid,
                remail: remail,
                rfirstname: rfirstname,
                rlastname: rlastname,
                rstars: rstars,
                rreview: rreview
            },
            success: function( data ) {
                if( data ) {
                    if (data == 'add'){
                        document.getElementById("formRating").style.display = "none";
                        document.getElementById("modalSuccess").style.display = "block";
                        setTimeout( function(){
                            document.getElementById("modalSuccess").style.display = "none";
                        } , 6000);
                    } else {
                        document.getElementById("formRating").style.display = "none";
                        document.getElementById("modalNotfound").style.display = "block";
                        setTimeout( function(){
                            document.getElementById("modalNotfound").style.display = "none";
                        } , 15000);
                    }
                } else {
                    console.log('no data');
                }
            }
        });
    }

});



jQuery(function($){
    $('.wpcf7-list-item-label').html('');

    var ratingClassList = $('.stars-top .rating-upper')[0].classList;
    var ratingAdditionalClass;
    if(ratingClassList.contains('rating-upper-red')){
        ratingAdditionalClass = 'rating-upper-red';
    }
    if(ratingClassList.contains('rating-upper-yellow')){
        ratingAdditionalClass = 'rating-upper-yellow';
    }

    $('.rating-hover .one').hover(function() {
        $('.stars-top .rating-upper').css('width', '20%');
        ratingClassList.remove(ratingAdditionalClass);
    });
    $('.rating-hover .two').hover(function() {
        $('.stars-top .rating-upper').css('width', '40%');
        ratingClassList.remove(ratingAdditionalClass);
    });
    $('.rating-hover .three').hover(function() {
        $('.stars-top .rating-upper').css('width', '60%');
        ratingClassList.remove(ratingAdditionalClass);
    });
    $('.rating-hover .four').hover(function() {
        $('.stars-top .rating-upper').css('width', '80%');
        ratingClassList.remove(ratingAdditionalClass);
    });
    $('.rating-hover .five').hover(function() {
        $('.stars-top .rating-upper').css('width', '100%');
        ratingClassList.remove(ratingAdditionalClass);
    });
    $('.rating-hover').mouseout(function() {
        ratingClassList.add(ratingAdditionalClass);
    });
    //template bottom insert php value

    var rad = $('input[name=radio-review]');
    var prev = null;
    for (var i = 0; i < rad.length; i++) {
        rad[i].addEventListener('change', function() {

            if(this.value == 1){
                $('.wpcf7-list-item .wpcf7-list-item-label').removeClass('list-item-active');
            }
            if(this.value == 2){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label').addClass('list-item-active');
                $('.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label, .wpcf7-list-item:nth-child(4) .wpcf7-list-item-label, .wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-active');
            }
            if(this.value == 3){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label, .wpcf7-list-item:nth-child(2) .wpcf7-list-item-label').addClass('list-item-active');
                $('.wpcf7-list-item:nth-child(4) .wpcf7-list-item-label, .wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-active');
            }
            if(this.value == 4){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label, .wpcf7-list-item:nth-child(2) .wpcf7-list-item-label,.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label').addClass('list-item-active');
                $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-active');
            }
            if(this.value == 5){
                $('.wpcf7-list-item .wpcf7-list-item-label').addClass('list-item-active');
            }
        });


        rad[i].addEventListener('mouseleave', function() {
            $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label').removeClass('list-item-hover');
            $('.wpcf7-list-item:nth-child(2) .wpcf7-list-item-label').removeClass('list-item-hover');
            $('.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label').removeClass('list-item-hover');
            $('.wpcf7-list-item:nth-child(4) .wpcf7-list-item-label').removeClass('list-item-hover');
            $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-hover');
        })
        rad[i].addEventListener('mouseover', function() {
            if(this.value == 1){
                $('.wpcf7-list-item:nth-child(2) .wpcf7-list-item-label').removeClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label').removeClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(4) .wpcf7-list-item-label').removeClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-hover');
            }
            if(this.value == 2){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label').removeClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(4) .wpcf7-list-item-label').removeClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-hover');
            }
            if(this.value == 3){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(2) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(4) .wpcf7-list-item-label').removeClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-hover');
            }
            if(this.value == 4){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(2) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').removeClass('list-item-hover');
            }
            if(this.value == 5){
                $('.wpcf7-list-item:nth-child(1) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(2) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(3) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(4) .wpcf7-list-item-label').addClass('list-item-hover');
                $('.wpcf7-list-item:nth-child(5) .wpcf7-list-item-label').addClass('list-item-hover');
            }
        });
    }
});