jQuery( document ).ready( function($) {
   
    /* Stick navigation to the top of the page */
    var stickyNavTop = $( '.site-header' ).offset().top;
    
    $( window ).scroll(function() {
       var scrollTop = $( window ).scrollTop();
       
       if ( scrollTop > stickyNavTop ) {
           $( '.site-header' ).addClass( 'sticky-header' );
           $( '.site-front' ).addClass( 'shifted' );
       } else {
           $( '.site-header' ).removeClass( 'sticky-header' );
           $( '.site-front' ).removeClass( 'shifted' );
       }
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
});