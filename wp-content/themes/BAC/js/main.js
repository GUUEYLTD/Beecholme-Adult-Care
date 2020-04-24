jQuery(document).ready(function($) {

	var owl = $("#review-carousel");
  	owl.owlCarousel({
      items : 1,
      nav: true,
      dots: false,
      loop: true,
      navText: ["<img src='/wp-content/themes/BAC/images/carousel-arrow-left.svg' alt='arrow-left'>","<img src='/wp-content/themes/BAC/images/carousel-arrow-right.svg' alt='arrow-right'>"]
  });

  var owl = $("#review-carousel");
  owl.owlCarousel({
    items : 1,
    nav: true,
    dots: false,
    loop: true,
    navText: ["<img src='/wp-content/themes/BAC/images/carousel-arrow-left.svg' alt='arrow-left'>","<img src='/wp-content/themes/BAC/images/carousel-arrow-right.svg' alt='arrow-right'>"]
  });

  var owl = $("#coaches-slider");
    owl.owlCarousel({
      items : 4,
      margin: 24,
      nav: true,
      dots: false,
      loop: true,
      navText: ["<img src='/wp-content/themes/BAC/images/carousel-arrow-left.svg' alt='arrow-left'>","<img src='/wp-content/themes/BAC/images/carousel-arrow-right.svg' alt='arrow-right'>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2,
        },
        992: {
          items: 4,
        }
      }
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

jQuery(document).ready(function($){
  // Home page banner tabs
  $('.banner-content .tab').on('click',function(){
    $('.banner-content .tab, .banner-content .tab-content').removeClass('active');
    $(this).addClass('active');
    $('.' + $(this).attr('data-tab')).addClass('active');
  });

  // FAQ
  $('.faq .topic').on('click',function(){
    var opened = $(this).hasClass('open');

    $('.faq-content .questions-wrapper').slideUp();
    $('.faq .topic').removeClass('open');

    if(!opened) {
      $(this).addClass('open');
      $(this).parent('.single-topic').find('.questions-wrapper').slideToggle();
    }

    $('.faq .topic').removeClass('active');
    $(this).addClass('active');
  });

  /*Our Counsellors*/

  $('.single-tab').on('click', function(){
    $('.single-tab').removeClass('active');
    $(this).addClass('active');
    $('.question-filter').removeClass('active');
    $('.question-filter .option').removeClass('selected');
    $('.question-filter .current').html('All');
    $('.question-select option').removeAttr('selected');


    if($(this).hasClass('all')) {
      $('.empty-filter').addClass('active');
    }

    if($(this).hasClass('therapist')) {
      $('.therapist-question-filter').addClass('active');
    }

    if($(this).hasClass('coach')) {
      $('.coach-question-filter').addClass('active');
    }
  });



  $('.mobile-filter-bar-button').on('click', function(){
    if ($(window).width() <= 1200) {
      var opened = $('.filter-bar-wrapper').hasClass('open');

      if(!opened) {
        $('.filter-bar-wrapper').addClass('open');
        $('.filter-bar').stop().slideDown(500, function() {
          $(this).css('display', 'flex');
        });
      } else {
        $('.filter-bar-wrapper').removeClass('open');
        $('.filter-bar').stop().slideUp();
      }
    }
  });
});

// Custom select

jQuery(document).ready(function($){

  function create_custom_dropdowns() {
    $('.question-select').each(function(i, select) {
      if (!$(this).next().hasClass('dropdown')) {
        $(this).after('<div class="dropdown ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
        var dropdown = $(this).next();
        var options = $(select).find('option');
        var selected = $(this).find('option:selected');
        dropdown.find('.current').html(selected.data('display-text') || selected.text());
        options.each(function(j, o) {
          var display = $(o).data('display-text') || '';
          var id = $(o).data('id') || '';
          dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '" data-id="' + id + '">' + $(o).text() + '</li>');
        });
      }
    });
  }

  // Event listeners

  // Open/close
  $(document).on('click', '.dropdown', function(event) {
    $('.dropdown').not($(this)).removeClass('open');
    $(this).toggleClass('open');
    if ($(this).hasClass('open')) {
      $(this).find('.option').attr('tabindex', 0);
      $(this).find('.selected').focus();
    } else {
      $(this).find('.option').removeAttr('tabindex');
      $(this).focus();
    }
  });
  // Close when clicking outside
  $(document).on('click', function(event) {
    if ($(event.target).closest('.dropdown').length === 0) {
      $('.dropdown').removeClass('open');
      $('.dropdown .option').removeAttr('tabindex');
    }
    event.stopPropagation();
  });
  // Option click

  $(document).on('click', '.dropdown .option', function(event) {

    if($(this).parents('.language-filter').length) {
      $(this).toggleClass('selected');
      var text = '';

      if($(this).data('display-text') == 'All') {
        if($(this).hasClass('selected')) {
          $(this).closest('.list').find('.option').addClass('selected');
        } else {
          $(this).closest('.list').find('.option').removeClass('selected');
        }
      }

      var i = 0;
      console.log(text);
      $(this).closest('.list').find('.selected').each(function(){
        i++;
        if(!text) {
          text = $(this).data('value');
        } else {
          text += ', ' + $(this).data('value');
        }

        if(i > 3) {
          text = i + ' items picked';
        }
      });

      $(this).closest('.dropdown').find('.current').text(text);
      $(this).closest('.dropdown').prev('select').val($(this).data('value')).trigger('change');

    } else {
      $(this).closest('.list').find('.selected').removeClass('selected');
      $(this).addClass('selected');
      var text = $(this).data('display-text') || $(this).text();
      $(this).closest('.dropdown').find('.current').text(text);
      $(this).closest('.dropdown').prev('select').val($(this).data('value')).trigger('change');
    }

  });

  // Keyboard events
  $(document).on('keydown', '.dropdown', function(event) {
    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
    // Space or Enter
    if (event.keyCode == 32 || event.keyCode == 13) {
      if ($(this).hasClass('open')) {
        focused_option.trigger('click');
      } else {
        $(this).trigger('click');
      }
      return false;
      // Down
    } else if (event.keyCode == 40) {
      if (!$(this).hasClass('open')) {
        $(this).trigger('click');
      } else {
        focused_option.next().focus();
      }
      return false;
      // Up
    } else if (event.keyCode == 38) {
      if (!$(this).hasClass('open')) {
        $(this).trigger('click');
      } else {
        var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
        focused_option.prev().focus();
      }
      return false;
      // Esc
    } else if (event.keyCode == 27) {
      if ($(this).hasClass('open')) {
        $(this).trigger('click');
      }
      return false;
    }
  });

  $(document).ready(function() {
    create_custom_dropdowns();
  });

  $('.multiple-select').select2({
    placeholder: "All"
  });

  $('.our-counsellors .order-filter').on('click', function(){
    if($(this).hasClass('ascending')) {
      $(this).removeClass('ascending').addClass('descending');
    } else {
      $(this).removeClass('descending').addClass('ascending');
    }
    sortCounsellors();
  });

  $('.sort-by').change(function(e){
    sortCounsellors();
  });

  function sortCounsellors() {
    var sortBy = document.querySelector('.sort-by').value;
    var result = $('.single-item').sort(function (a, b) {
      var contentA =parseInt( $(a).data(sortBy));
      var contentB =parseInt( $(b).data(sortBy));
      return $('.order-filter').hasClass('ascending')
          ? ((contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0)
          : ((contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0);
    });

    $('.counsellors-list').html(result);
  }

  $('.payment-dialog-footer .paypal-button').on('click',function(e){
    e.preventDefault();
  });

  let timerId = setInterval(() => {
    $('.booking-form .am-custom-fields .el-checkbox-group .el-checkbox__label').html('I accept the <a href="/privacy-policy" class="privacy-button">terms & conditions</a>');
  }, 200);

});
