jQuery( document ).ready( function($) {
   
    /* Stick navigation to the top of the page */
    var stickyNavTop = $( '.site-header' ).offset().top;
    
    $( window ).scroll(function() {
       var scrollTop = $( window ).scrollTop();
       
       if ( scrollTop > stickyNavTop ) {
           $( '.site-header' ).addClass( 'sticky-header' );
           $( '.site-description' ).addClass( 'sticky-header' );
           $( '.site-content' ).addClass( 'shifted' );
       } else {
           $( '.site-header' ).removeClass( 'sticky-header' );
           $( '.site-description' ).removeClass( 'sticky-header' );
           $( '.site-content' ).removeClass( 'shifted' );
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
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    
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
//       responsive: none,
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
       dots: true,
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
        slidesToShow: 1,
        slidesToScroll: 1,
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