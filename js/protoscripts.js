alert("You made it!");

jQuery( document ).ready( function($) {
    alert("In jQuery");
   
    /* Stick navigation to the top of the page */
    var stickyNavTop = $( '.main-navigation' ).offset().top;
    
    $( window ).scroll(function() {
       var scrollTop = $( window ).scrollTop();
       
       if ( scrollTop > stickyNavTop ) {
           $( '.main-navigation' ).addClass( 'sticky-header' );
           $( '.site-header' ).addClass( 'shifted' );
       } else {
           $( '.main-navigation' ).removeClass( 'sticky-header' );
           $( '.site-header' ).removeClass( 'shifted' );
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