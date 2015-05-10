<?php

/**
 * The custom template for the one-page style front page. Kicks in automatically
 * @link: http://www.designwall.com/guide/dw-page/ (Good for design ideas)
 * 
 * @TODO: Add CONDITIONAL statements to test for the existence of each of the pages - OR add dummy content to tell people to fill those in
 */

get_header(); ?>

<?php
global $more;
$incomplete_sections = 0;
$incomplete_section_ids = array();
?>

	<div id="primary" class="content-area front-page<?php if (!(have_comments() || comments_open())) : ?> no-comments-area<?php endif; ?>">
		<div id="content" class="site-content" role="main">

                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * HOME SECTION ========================================================
         * /////////////////////////////////////////////////////////////////////
         */
                    $query = new WP_Query( 'pagename=home' );

                    // The Loop
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();

                            $url_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
                            if ( !empty( $url_image ) ) {
                                echo "<section id='home' style='background:url($url_image[0]) repeat fixed; background-size: cover;'>";
                            } else {
                                echo "<section id='home'>";
                            }
                            echo '<div class="indent clear">';

                            echo '<div class="entry-content">';
                            the_content();
                            echo '</div>';

                            echo '</div><!-- .indent -->';
                            echo '</section><!-- #home -->';
                        }    
                    } else { ?>
                    
                        <section id="home">
                            <div class="indent clear">
                                <div class="entry-content">
                                    <hgroup>
                                        <h1><?php bloginfo( 'name' ); ?></h1>
                                        <h2><?php bloginfo( 'description' ); ?></h2>
                                    </hgroup>
                                </div>
                            </div>
                        </section>
                    
                        <?php 
                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Page: Home</a>';
                    } 
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
                 
                    
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * SERVICES SECTION ====================================================
         * /////////////////////////////////////////////////////////////////////
         */
                    /*
                     * FIRST LOOP : Get Services Page
                     */
                    $query = new WP_Query( 'pagename=services' );
                    $services_id = $query->queried_object->ID;

                    // The Loop
                    if ( $query->have_posts() ) { ?>
                    
                        <section id="services">
                        <div class="indent clear">
                        
                        <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $more = 0;      // Set (inside the loop) to display content above the more tag
                            echo '<h2 class="entry-header">' . get_the_title() . '</h2>';
                            echo '<div class="entry-content">';
                            the_content('');
                            echo '</div>';
                        }
                        // Restore original Post Data (FIRST LOOP)
                        wp_reset_postdata();

                        /*
                         * SECOND LOOP : Get the Children of the Services page
                         */
                        $args = array(
                            'post_type'     => 'page',
                            'post_parent'   => $services_id
                        );
                        $services_query = new WP_Query( $args );

                        // The Loop
                        if ( $services_query->have_posts() ) {
                            echo '<ul class="entry-content services-list">';
                            while ( $services_query->have_posts() ) {
                                $services_query->the_post();
                                $more = 0;
                                echo '<li class="service clear">';
                                echo '<div class="services-title">';
                                echo '<a class="services-link" href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
                                the_post_thumbnail( 'thumb' );
                                echo '<h3>' . get_the_title() . '</h3>';
                                echo '</a>';
                                echo '</div>';
                                echo '<div class="services-lede">';
                                the_content( 'Read More &rarr;' );
                                echo '</div>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            
                        } else {
                            echo '<h4 class="warning-title">No Services Found</h4>';
                            echo '<p class="warning-message"><a href="#">Create some Service pages here</a> or <a href="#">learn how to here.</a></p>';
                        
                            $incomplete_sections++;
                            $incomplete_section_ids[] = '<a href="#">Pages: Individual Service Pages</a>';
                        } 
                        // Restore original Post Data (SECOND LOOP)
                        wp_reset_postdata();
                        ?>
                            
                        </div><!-- .indent -->
                        
                        <a class="button more-link" role="button" href="/services/">See all Services &rarr;</a>
                        </section><!-- #services -->
                    
                    <?php } else {
                        // get_template_part( 'content-none', 'front' );
                        
                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Page: Services</a>';
                    } 
                    // Restore original Post Data (FIRST LOOP)
                    wp_reset_postdata();
                    ?>
                            
                        
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * PROJECTS SECTION ====================================================
         * /////////////////////////////////////////////////////////////////////
         */
                    $args = array(
                        'posts_per_page'    => 16,
                        'orderby'           => 'desc',
                        'post_type'         => 'jetpack-portfolio'
                    );

                    $query = new WP_Query( $args );

                    // The Loop
                    if ( $query->have_posts() ) {
                        echo '<section id="latest-work">';
                        echo '<div class="indent clear">';
                        echo '<h2 class="entry-header">Latest Projects</h2>';
                        echo '<div class="front-page-projects">';

                        while( $query->have_posts() ) {

                            $query->the_post();                           
                            get_template_part( 'content-archive', get_post_format() );
                        
                        }
                        echo '</div>';
                        echo '</div><!-- .indent -->';
                        echo '<a class="button more-link" role="button" href="/portfolio/">View Full Portfolio &rarr;</a>';
                        echo '</section><!-- #latest-work -->';

                    } else {
                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Jetpack Portfolio Projects</a>';
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>

                            
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * CLIENTS + TESTIMONIALS SECTION ======================================
         * /////////////////////////////////////////////////////////////////////
         */        
                    $client_page = new WP_Query( 'pagename=clients' );
                    $clients_id = $client_page->queried_object->ID;

                    // Get the children of the clients page
                    $args = array(
                        'post_type'     => 'page',
                        'post_parent'   => $clients_id,
                        'posts_per_page'=> 6,
                        'order_by'      => 'rand'
                    );
                    $client_pages = new WP_Query( $args );
                    
                    $args = array(
                        'posts_per_page'    => 8,
                        'orderby'           => 'rand',
                        'post_type'         => 'jetpack-testimonial',
                    );

                    $testimonial_pages = new WP_Query( $args );
                    
                    if ( $client_page->have_posts() || $client_pages->have_posts() || $testimonial_pages->have_posts() ) :
                    
                    // @TODO: Fix this above section that should check if there is anything - on my site, there should be NOTHING
                    ?>
                        
                    <section id="testimonials">
                    <div class="indent clear">
                        
                    <?php
                    /**
                     * FIRST LOOP : Gets Clients page title + content
                     */
                    $query = new WP_Query( 'pagename=clients' );

                    // The Loop
                    if ( $query->have_posts() ) { ?>

                        <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $more = 0;      // Set (inside the loop) to display content above the more tag
                            echo '<h2 class="entry-header">' . get_the_title() . '</h2>';
                            echo '<div class="entry-content">';
                            the_content('');
                            echo '</div>';
                        }
                    } else {
                        
                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Page: Clients</a>';
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
                      
                    <?php
                    /*
                     * SECOND LOOP : Gets (up to) 8 individual testimonials
                     */
                    $args = array(
                        'posts_per_page'    => 8,
                        'orderby'           => 'rand',
                        'post_type'         => 'jetpack-testimonial',
                    );

                    $query = new WP_Query( $args );

                    //The Loop
                    if ( $query->have_posts() ) {

                        echo '<div class="testimonials entry-content">';
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $more = 0;
                            echo '<div class="testimonial clear">';
                            echo '<figure class="testimonial-thumb <!--losange-->">';
                            //echo '<div class="los1">';
                            the_post_thumbnail( 'thumbnail' );
                            //echo '</div>';
                            echo '</figure>';
                            echo '<aside class="testimonial-text">';
                            echo '<div class="testimonial-excerpt">';

                            if ( $post->post_excerpt ) {
                                the_excerpt();
                                echo '<a class="more-link" href="' . get_permalink() . '">Read More &rarr;</a>';
                            } else {
                                the_content();
                            }

                            echo '<a href="' . get_the_permalink() . '">';
                            echo '<h3 class="testimonial-name">' . get_the_title() . '</h3>';
                            echo '</a>';
                            echo '</div>';
                            echo '</aside>';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        
                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Jetpack Testimonials</a>';
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
                    
                    <?php
                    /*
                     * THIRD LOOP : Get (up to 6) individual Client Pages
                     */
                    $query = new WP_Query( 'pagename=clients' );
                    $clients_id = $query->queried_object->ID;
                    
                    // Get the children of the clients page
                    $args = array(
                        'post_type'     => 'page',
                        'post_parent'   => $clients_id,
                        'posts_per_page'=> 6,
                        'order_by'      => 'rand'
                    );
                    $clients_query = new WP_Query( $args );

                    // The Loop
                    if ( $clients_query->have_posts() ) {
                        echo '<ul class="clients-list entry-content">';
                        while ( $clients_query->have_posts() ) {
                            $clients_query->the_post();
                            $more = 0;
                            echo '<li class="clear">';
                            echo '<a class="clients-link" href="' . get_permalink() . '" title="See all Projects for ' . get_the_title() . '">';
                            the_post_thumbnail( 'thumbnail', array( 'class' => 'desaturate' ) );
                            echo '<h3 class="clients-title">' . get_the_title() . '</h3>';
                            echo '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';

                    } else {
                        
                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Pages: Individual Client Pages</a>';
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>

                    </div><!-- .indent -->

                    <a class="button more-link" role="button" href="/clients/">View full list of Clients &rarr;</a>
                    </section><!-- #testimonials -->
                    
                    <?php endif; ?>
                    
                    
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * ABOUT SECTION =======================================================
         * /////////////////////////////////////////////////////////////////////
         */                    
                    $query = new WP_Query( 'pagename=about' );

                    // The Loop
                    if ( $query->have_posts() ) {
                        ?>

                        <section id="about">
                        <div class="indent clear">            

                        <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            $more = 0;
                            echo '<h2 class="entry-header">' . get_the_title(). '</h2>';
                            echo '<figure class="front-right">';
                            the_post_thumbnail( 'large' );
                            echo '</figure>';
                            echo '<div class="entry-content front-left">';
                            the_content('Read more &rarr;');
                            echo '</div>';
                        }
                        ?>

                        </div><!-- .indent -->
                        </section><!-- #about -->

                    <?php 
                    } else {

                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Page: About</a>';
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
    
                        
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * BLOG SECTION ========================================================
         * /////////////////////////////////////////////////////////////////////
         */     
                    ?>
                    
                    <section id="blog">
                        <div class="indent clear">
                            
                            <?php
                            $sticky = get_option( 'sticky_posts' );
                            $sticky_num = count($sticky);
                            $pages_to_retrieve = 8 - $sticky_num;
                            
                            $args = array(
                                'posts_per_page'    => $pages_to_retrieve,
                                'orderby'           => 'rand',
                                'post_type'         => 'post',
                            );
                            
                            $query = new WP_Query( $args );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                echo '<h2 class="entry-header">Latest Articles</h2>';
                                echo '<div class="front-page-blog">';
				
                                while( $query->have_posts() ) {
                                    
                                    $query->the_post();
                                    get_template_part( 'content-archive', get_post_format() );

                                }
                                echo '</div>';
                                
                            } else {
                                get_template_part( 'content', 'none' );
                                
                                $incomplete_sections++;
                                $incomplete_section_ids[] = '<a href="#">Blog</a>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div>
                        
                        <a class="button more-link" role="button" href="/blog/">See More Articles &rarr;</a>
                    </section>
                        
                     
                    <?php
        /**
         * /////////////////////////////////////////////////////////////////////
         * BLOG SECTION ========================================================
         * /////////////////////////////////////////////////////////////////////
         */                
                    $query = new WP_Query( 'pagename=contact' );

                    // The Loop
                    if ( $query->have_posts() ) {

                        echo '<section id="contact">';
                        echo '<div class="indent clear">'
;                                
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            echo '<h2 class="entry-header">' . get_the_title() . '</h2>';
                            echo '<div class="entry-content">';
                            the_content();
                            echo '</div>';
                        }
                        
                        echo '</div><!-- .indent -->';
                        echo '</section><!-- #contact -->';
                        
                    } else {

                        $incomplete_sections++;
                        $incomplete_section_ids[] = '<a href="#">Page: Contact</a>';
                    }
                    // Restore original Post Data
                    wp_reset_postdata();

                    ?>
                        
                        
                    <?php                    
        /**
         * /////////////////////////////////////////////////////////////////////
         * WARNINGS SECTION ====================================================
         * /////////////////////////////////////////////////////////////////////
         */   
                    if ( $incomplete_sections > 0 ) {
                        echo '<section id="warnings">';
                        echo '<div class="indent clear">';
                        
                        echo '<h2 class="entry-header">Notifications</h2>';
                        echo '<div class="entry-content">';
                        echo "<p>You have <strong>$incomplete_sections incomplete Front Page sections</strong>. Click any of the links to <u>learn how to complete that section</u> OR <a href='#'>turn off notifications in the Theme Customizer</a>:";
                        echo '<ol>';
                        foreach( $incomplete_section_ids as $incomplete_section_id ) {
                            echo "<li>$incomplete_section_id</li>";
                        }
                        echo '</ol>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</section>';
                    } 
                    ?>
                    
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>