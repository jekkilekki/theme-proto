<?php

/** 
 * The functions file for the Proto child theme
 */

function proto_scripts() {
    if ( is_front_page() ) {
        wp_enqueue_style( 'proto_styles', get_stylesheet_directory_uri() . '/front-page-style.css' );
    } 
}
add_action( 'wp_enqueue_scripts', 'proto_scripts' );

add_image_size( 'testimonial-mug', 253, 253, true );