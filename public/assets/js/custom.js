// menu fixed js code
$(window).scroll(function () {
  var window_top = $(window).scrollTop() + 1;
  if (window_top > 50) {
    $('.main_menu').addClass('menu_fixed animated fadeInDown');
    $('.logo').attr('src','assets/img/logo_siyah.png');
  } else {
    $('.main_menu').removeClass('menu_fixed animated fadeInDown');
    $('.logo').attr('src','assets/img/logo.png');
  }
});

$('.basicAutoComplete').autoComplete({
  resolverSettings: {
    url: 'testdata/test-list.json'
  }
});

$(document).ready(function (){
  $('.carousel-testimony').owlCarousel({
    center: true,
    loop: true,
    items: 1,
    margin: 30,
    stagePadding: 0,
    nav: false,
    navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
    responsive:{
      0:{
        items: 1
      },
      600:{
        items: 2
      },
      1000:{
        items: 3
      }
    }
  });
});
