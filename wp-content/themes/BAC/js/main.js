jQuery(document).ready(function($) {

	var owl = $("#review-carousel");
  	owl.owlCarousel({
      items : 1,
      nav: true,
      dots: false,
      loop: true,
      navText: ["<img src='/wp-content/themes/BAC/images/carousel-arrow-left.svg' alt='arrow-left'>","<img src='/wp-content/themes/BAC/images/carousel-arrow-right.svg' alt='arrow-right'>"]
  });

  var owl = $("#image-carousel");
    owl.owlCarousel({
      items : 1,
      nav: true,
      dots: false,
      loop: true,
      navText: ["<img src='/wp-content/themes/BAC/images/carousel-arrow-left.svg' alt='arrow-left'>","<img src='/wp-content/themes/BAC/images/carousel-arrow-right.svg' alt='arrow-right'>"]
  });

  $(document).on( "click", ".google-map-overlay", function() {
    $('.google-map-overlay').hide();
  });     
	
  document.addEventListener( 'wpcf7mailsent', function( event ) {
        $('.popup').css('display','flex');
        $('.form-addition').css('bottom', '116px');
  }, false );

  $(document).click(function(e){
    if($(e.target).closest('.popup_body').length != 0) return false;
    $('.popup').css('display','none');
  });

  $(document).on( 'click', '.switch-button', function(){
    $('.switch-button').removeClass('active');
    $(this).addClass('active');

    if($('.contact-us-button').hasClass('active')) {
      $('.contact-us-form').css('display','block');
      $('.book-visit-form').css('display','none');
    }
    if($('.book-visit-button').hasClass('active')) {
      $('.contact-us-form').css('display','none');
      $('.book-visit-form').css('display','block');
    }   

    if($('.patient-button').hasClass('active')) {
      $('.patient-form').css('display','block');
      $('.provider-form').css('display','none');
    }
    if($('.provider-button').hasClass('active')) {
      $('.patient-form').css('display','none');
      $('.provider-form').css('display','block');
    }       
  });

  $(document).on('click', '.toggle', function(){
    $('.toggle').toggleClass('active');

    $('.mobile-menu-container').slideToggle();
  });

  $(document).on('click', '#menu-menu1 .menu-item-type-custom', function(){
    $(this).toggleClass('active');
    $(this).find('.sub-menu').slideToggle();
  });

  $(document).on('click', '#menu-menu1-2 .menu-item-type-custom', function(){
    $('#menu-menu1-2 .sub-menu').css('display','none');
    $(this).find('.sub-menu').slideToggle();
  });

  $(document).on('click', '.bottom-boxes a:nth-child(2)',function(event){
    event.preventDefault();
    $('.brochures').toggleClass('active');
    if($('.brochures').hasClass('active')) {
          $('html, body').animate({
            scrollTop: $(".brochures").offset().top
          }, 500);
        }
  });

  $(document).on('click', '.single-brochure-link',function(event){
    event.preventDefault();
    $('.single-brochure').not(this).parent('single-brochure').removeClass('active');
    $(this).parent('.single-brochure').toggleClass('active');
  });

  setTimeout(function(){
    $('#footable_299 tbody tr td:not(:first-child)').append('<div class="book-button">Book</div>');
  }, 1000);

});

var html;

jQuery(document).on('click', '.book-button', function(){


  var hours = {};
  html = jQuery(this).parent('td').html();
  var book_button = '<div class="book-button">Book</div>';
  html = html.replace(book_button, '');
  jQuery('.booking-popup-title').html(html);

  jQuery('#footable_299 tbody tr td:not(:first-child)').each(function(){
    var temp = jQuery(this).html();
    if ( temp.indexOf(html) >= 0) {
      var day = jQuery(this).index();
      var time = jQuery(this).parent('tr').children(':first-child').html();
      hours[day] = time;
    }
  });

  var days = [];

  jQuery.each(hours, function(key, element) {
    days.push(key);
  });

  jQuery('#datepicker').datepicker('destroy');

  jQuery("#datepicker").datepicker({
    minDate: 0,
    beforeShowDay: function(date) {
      var day = date.getDay();
      if( day == 0) {
        day = 7;
      }
      return [day == days[0] || day == days[1], ''];
    },
    beforeShow: function (input, inst) {
        setTimeout(function(){
            inst.dpDiv.outerWidth(jQuery(input).outerWidth());
        },0);
    },     
    onSelect: function(dateText, inst) {
      var theDate = new Date(Date.parse(jQuery(this).datepicker('getDate')));
      var dateFormatted = jQuery.datepicker.formatDate('D', theDate);
      if (dateFormatted == 'Mon') {
        dateFormatted = 1;
      } else if (dateFormatted == 'Tue') {
        dateFormatted = 2;
      } else if (dateFormatted == 'Wed') {
        dateFormatted = 3;
      } else if (dateFormatted == 'Thu') {
        dateFormatted = 4;
      } else if (dateFormatted == 'Fri') {
        dateFormatted = 5;
      } else if (dateFormatted == 'Sat') {
        dateFormatted = 6;
      } else if (dateFormatted == 'Sun') {
        dateFormatted = 7;
      }
      jQuery('.time-select').find('option').remove();
      jQuery('.time-select').css('display','block');
      jQuery.each(hours, function(key, value) {
        if( key == dateFormatted) {
          jQuery('.time-select').append(jQuery("<option></option>").attr("value",value).text(value));
        }
      });      
    }       
  });

  jQuery('.booking-popup-wrapper').css('display','flex');
});

;

jQuery(document).on('click', '.popup-exit', function(){
  jQuery('.booking-popup-wrapper').css('display', 'none');
  jQuery('#datepicker').datepicker('destroy');
  jQuery('.time-select').css('display','none');
});

jQuery(document).ready(function($) {
  $("#booking-form").submit(function(event) {
    event.preventDefault();
    var activity = html;
    console.log(activity);
    var fname = jQuery('.fname-input').val();
    var lname = jQuery('.lname-input').val();
    var email = jQuery('.email-input').val();
    var phone = jQuery('.phone-input').val();
    var date = jQuery('#datepicker').val();
    var time = jQuery('.time-select').val();

    jQuery.ajax({
      type: 'POST',
      url: '/wp-admin/admin-ajax.php',
      data: {
          'activity': activity,
          'fname': fname,
          'lname': lname,
          'email': email,
          'phone': phone,
          'date': date,
          'time': time,
          'action': 'booking_mail',
      }, success: function (result) {
         jQuery('.booking-popup-wrapper').css('display', 'none');
         jQuery('#datepicker').datepicker('destroy');
         jQuery('.time-select').css('display','none');   
      },
        error: function(result) {
        }
    });  
  });
});

// Home page banner tabs

jQuery(document).ready(function($){
  $('.banner-content .tab').on('click',function(){
    $('.banner-content .tab, .banner-content .tab-content').removeClass('active');
    $(this).addClass('active');
    $('.' + $(this).attr('data-tab')).addClass('active');
  });
});