<?php

/** 
 * The functions file for the Proto child theme
 */

/* Enqueue GK-Portfolio Style */
function proto_scripts() {
    if ( is_front_page() ) {
        wp_enqueue_style( 'proto_style', get_stylesheet_directory_uri() . '/css/front-page-style.css' );
        wp_enqueue_script( 'protoscripts', get_stylesheet_directory_uri() . '/js/protoscripts.js', array( 'jquery' ), '20150503', true ); 
        
        /* Slick Carousel */
        wp_enqueue_script( 'slick_carousel', get_stylesheet_directory_uri() . '/inc/slick/slick.min.js', array( 'jquery' ), '20150504', true ); 
        wp_enqueue_style( 'slick_style', get_stylesheet_directory_uri() . '/inc/slick/slick.css' );
        wp_enqueue_style( 'slick_theme_style', get_stylesheet_directory_uri() . '/inc/slick/slick-theme.css' );
    } 
    if (is_page_template( 'page-templates/page-collection.php') ) {
            wp_enqueue_style( 'proto_layout_style', get_stylesheet_directory_uri() . '/css/layout-collection.css' );
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


/**
 * Add options to Customizer if JetPack CPTs are enabled
 */
/* Add additional options to Theme Customizer */
function proto_theme_customizer( $wp_customize ) {
  
    if ( post_type_exists( 'jetpack-portfolio' ) ) {
        // Add Sections

        // Add Settings
	$wp_customize->add_setting(
	    'proto_show_jetpack_tags',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
        
        // Add Controls
        $wp_customize->add_control(
	    'proto_show_jetpack_tags',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Show tags on Jetpack portfolio', 'proto'),
	        'type'     => 'checkbox',
                'priority' => 100
	    )
	);
    }
}
add_action( 'customize_register', 'proto_theme_customizer' );


/**
 * New Paging Navigation (from TwentyFourteen)
 */
if (!function_exists('portfolio_paging_nav')) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 *
	 * @return void
	 */
	function portfolio_paging_nav() {
		global $wp_query, $wp_rewrite;

            // Don't print empty markup if there's only one page.
            if ( $wp_query->max_num_pages < 2 ) {
                    return;
            }

            $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $query_args   = array();
            $url_parts    = explode( '?', $pagenum_link );

            if ( isset( $url_parts[1] ) ) {
                    wp_parse_str( $url_parts[1], $query_args );
            }

            $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

            $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
            $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

            // Set up paginated links.
            $links = paginate_links( array(
                    'base'     => $pagenum_link,
                    'format'   => $format,
                    'total'    => $wp_query->max_num_pages,
                    'current'  => $paged,
                    'mid_size' => 2,
                    'add_args' => array_map( 'urlencode', $query_args ),
                    'prev_text' => __( '&larr; Previous', 'portfolio' ),
                    'next_text' => __( 'Next &rarr;', 'portfolio' ),
                    'type'      => 'list',
            ) );

            if ( $links ) :

            ?>
            <nav class="navigation paging-navigation" role="navigation">
                    <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'portfolio' ); ?></h1>
                            <?php echo $links; ?>
            </nav><!-- .navigation -->
            <?php
            endif;
	}
}