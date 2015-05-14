jQuery( document ).ready( function($) {
   
    /* Stick navigation to the top of the page */
    var stickyNavTop = $( 'body' ).offset().top;
    
    $( window ).scroll(function() {
       var scrollTop = $( window ).scrollTop();
       
       if ( scrollTop > stickyNavTop ) {
           $( '.site-header' ).addClass( 'sticky-header' );
           $( '.site-title' ).addClass( 'sticky-header' );
           $( '.site-description' ).addClass( 'sticky-header' );
           $( '.site-header' ).addClass( 'shifted' );
       } else {
           $( '.site-header' ).removeClass( 'sticky-header' );
           $( '.site-title' ).removeClass( 'sticky-header' );
           $( '.site-description' ).removeClass( 'sticky-header' );
           $( '.site-header' ).removeClass( 'shifted' );
       }
    });
    
    $( 'a' ).click(function() {
       $( 'a.active' ).removeClass( 'active' );
       $(this).addClass( 'active' );
    });
    
    /* Smooth Scroll from CSS Tricks - specific to front page */
    /* @link: https://css-tricks.com/snippets/jquery/smooth-scrolling/ */
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top-55
                    }, 1000);
                    return false;
                } else {
                    $('html,body').animate({
                        scrollTop: 0
                    }, 1000);
                    return false;
                }
            }
        });
    });
    
    /* Turn on active state on the correct link when scrolling */
    /* @link:  http://codetheory.in/change-active-state-links-sticky-navigation-scroll/ */
    var sections = $( 'section' ),
        nav = $( 'nav' ),
        nav_height = nav.outerHeight();
        
    $(window).on( 'scroll', function() {
       var cur_pos = $(this).scrollTop();
       
       sections.each(function() {
          var top = $(this).offset().top  - nav_height -15,
              bottom = top + $(this).outerHeight();
              
          if ( cur_pos >= top && cur_pos <= bottom ) {
              nav.find( 'a' ).removeClass( 'active' );
              sections.removeClass( 'active' );
              
              //$(this).addClass( 'active' );
              nav.find( 'a[href="#' + $(this).attr('id') + '"]').addClass( 'active' );
          }
       });
    });
    
    
    /* Modify the width at which the Front Page nav compresses */
    var main_menu = $(".main-navigation");
    var main_menu_container = main_menu.find('.menu-main-menu-container').first();
    var submenu = $('#menu-main-menu');

    main_menu.click(function() {
            if($(window).outerWidth() <= 1040) {
                    if(main_menu.hasClass("opened")) {
                            main_menu_container.animate({
                                    'height': 0
                            }, 500, function() {
                                    main_menu.removeClass("opened");
                            });
                    } else {
                            main_menu.addClass("opened");
                            var h = submenu.outerHeight();
                            main_menu_container.css('height', '0');
                            main_menu_container.animate({
                                    'height': h + "px"
                            }, 500);
                    }
            }
    });
    
//    nav.find( 'a' ).on( 'click', function() {
//       var $el = $(this),
//           id = $el.attr( 'href' );
//           
//       $( 'html, body' ).animate({
//           scrollTop: $(id).offset().top - nav_height
//       }, 500 );
//    });
    
    /* Slick Slider */
    $('.front-page-projects').slick({
       // All the defaults
//       accessibility: true,
//       adaptiveHeight: true,
         //autoplay: true,
//       autoplaySpeed: 3000,
        arrows: true,
//       asNavFor: null,
//       appendArrows: $(element),
       prevArrow: '<button type="button" class="slick-prev">Previous</button>',
       nextArrow: '<button type="button" class="slick-next">Next</button>',
//       centerMode: false,
//       centerPadding: '50px',
        cssEase: 'ease',
//       customPaging: '',
       dots: true,
//       draggable: true,
//       fade: false,
//       focusOnSelect: false,
//       easing: 'linear',
//       edgeFriction: 0.15,
        infinite: true,
//       initialSlide: 0,
//       lazyLoad: 'ondemand',
//       mobileFirst: false,
//       pauseOnHover: true,
//       pauseOnDotsHover: false,
//       respondTo: 'window',
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }
        ],
//       slide: '',
        slidesToShow: 4,
        slidesToScroll: 4,
//       speed: 300,
//       swipe: true,
//       swipeToSlide: false,
//       touchMove: true,
//       touchThreshold: 5,
//       useCSS: true,
//       variableWidth: false,
//       vertical: false,
//       rtl: false,
   });
   
       /* Slick Slider */
    $('.testimonials').slick({
       // All the defaults
//       accessibility: true,
//       adaptiveHeight: true,
         autoplay: true,
       autoplaySpeed: 5000,
        arrows: true,
//       asNavFor: null,
//       appendArrows: $(element),
       prevArrow: '<button type="button" class="slick-prev">Previous</button>',
       nextArrow: '<button type="button" class="slick-next">Next</button>',
//       centerMode: true,
//       centerPadding: '50px',
        cssEase: 'ease',
//       customPaging: '',
//       dots: true,
//       draggable: true,
//       fade: false,
//      focusOnSelect: true,
//       easing: 'linear',
//       edgeFriction: 0.15,
        infinite: true,
//       initialSlide: 0,
//       lazyLoad: 'ondemand',
//       mobileFirst: false,
//       pauseOnHover: true,
//       pauseOnDotsHover: false,
//       respondTo: 'window',
//       responsive: none,
//       slide: '',
        slidesToShow: 2,
        slidesToScroll: 2,
//       speed: 300,
//       swipe: true,
//       swipeToSlide: false,
//       touchMove: true,
//       touchThreshold: 5,
//       useCSS: true,
//       variableWidth: false,
//       vertical: false,
//       rtl: false,
   });
   
       /* Slick Slider */
    $('.clients-list').slick({
       // All the defaults
//       accessibility: true,
//       adaptiveHeight: true,
         //autoplay: true,
//       autoplaySpeed: 3000,
        arrows: false,
//       asNavFor: null,
//       appendArrows: $(element),
//       prevArrow: '<button type="button" class="slick-prev">Previous</button>',
//       nextArrow: '<button type="button" class="slick-next">Next</button>',
//       centerMode: false,
//       centerPadding: '50px',
//        cssEase: 'ease',
//       customPaging: '',
       dots: false,
//       draggable: true,
//       fade: false,
//       focusOnSelect: false,
//       easing: 'linear',
//       edgeFriction: 0.15,
        infinite: false,
//       initialSlide: 0,
//       lazyLoad: 'ondemand',
//       mobileFirst: false,
//       pauseOnHover: true,
//       pauseOnDotsHover: false,
//       respondTo: 'window',
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                    arrows: true,
                }
            },
        ],
//       slide: '',
        slidesToShow: 6,
        slidesToScroll: 0,
//       speed: 300,
//       swipe: true,
//       swipeToSlide: false,
//       touchMove: true,
//       touchThreshold: 5,
//       useCSS: true,
//       variableWidth: false,
//       vertical: false,
//       rtl: false,
   });

});