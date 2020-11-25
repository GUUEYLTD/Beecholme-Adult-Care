jQuery(document).ready(function($) {
  //console.log('HUIIIIIIIIIIII');
  $('.owl-carousel').owlCarousel({
    loop:true,
    //stagePadding: 25,
    nav:true,
    items:4,
    navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fas fa-arrow-right"></i>'],
    margin:10,
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