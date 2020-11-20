jQuery(document).ready(function($) {
  //console.log('HUIIIIIIIIIIII');
  $('.owl-carousel').owlCarousel({
    loop:true,
    //stagePadding: 25,
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
  });

});