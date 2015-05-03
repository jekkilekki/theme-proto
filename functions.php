<?php

/** 
 * The functions file for the Proto child theme
 */

/* Enqueue GK-Portfolio Style */
function proto_scripts() {
    if ( is_front_page() ) {
        wp_enqueue_style( 'proto_style', get_stylesheet_directory_uri() . '/protostyle.css' );
        wp_enqueue_script( 'protoscripts', get_template_directory_uri() . '/js/protoscripts.js', array( 'jquery' ), '20150503', true ); 
    } 
}
add_action( 'wp_enqueue_scripts', 'proto_scripts' );

/* Add Testimonial Image size */
add_image_size( 'testimonial-mug', 253, 253, true );

/* Add JetPack Testimonial Excerpts */
function proto_add_testimonial_excerpts() {
    add_post_type_support( 'jetpack-testimonial', 'excerpt' );
}
add_action( 'init', 'proto_add_testimonial_excerpts' );

/* Exclude Posts from Category Testimonials (may be redundant unless I allow both) */
function proto_exclude_testimonial_posts( $query ) {
    if ( !$query->is_category( 'testimonials' ) && $query->is_main_query() ) {
        $query->set( 'cat', '' ); /* In second '', type '-5' or minus whatever category ID num it is */
    }
}
add_action( 'pre_get_posts', 'proto_exclude_testimonial_posts' );