<?php

/**
 * The custom template for the one-page style front page. Kicks in automatically
 *
 */

get_header(); ?>

<?php
global $more;
?>

	<div id="primary" class="content-area front-page<?php if (!(have_comments() || comments_open())) : ?> no-comments-area<?php endif; ?>">
		<div id="content" class="site-content" role="main">
                    
                     <section id="call-to-action">
                        <div class="indent clear">

                            <?php
                            $query = new WP_Query( 'pagename=call-to-action' );

                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    /* echo '<h2 class="entry-header">' .get_the_title() . '</h2>'; */
                                    echo '<div class="front-page-left">';
                                    echo '<div class="entry-content">';
                                    the_content();
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="front-page-right">';
                                    the_post_thumbnail( 'large' );
                                    echo '</div>';
                                }
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>

                        </div><!-- .indent -->
                    </section><!-- #call-to-action -->
                    
                    <section id="latest-work">
                        <div class="indent clear">
                            
                            <?php 
                            $args = array(
                                'posts_per_page'    => 10,
                                'orderby'           => 'desc',
                                'post_type'         => 'jetpack-portfolio'
                            );
                            
                            $query = new WP_Query( $args );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                echo '<ul class="front-page-projects">I have posts';
                                while( $query->have_posts() ) {
                                    $query->the_post();
                                    $more = 0;
                                    echo '<li class="clear">';
                                    echo '<figure class="project-thumb">';
                                    the_post_thumbnail( 'gk-portfolio-size' );
                                    echo '</figure>';
                                    echo '<aside class="project-text">';
                                    echo '<h3 class="project-name">' . get_the_title() . '</h3>';
                                    echo '<div class="project-excerpt">';
                                    the_excerpt('');
                                    echo '</div>';
                                    echo '</aside>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #latest-work -->
                    
                    <section id="testimonials">
                        <div class="indent clear">
                            
                            <?php 
                            $args = array(
                                'posts_per_page'    => 3,
                                'orderby'           => 'rand',
                                'post_type'         => 'jetpack-testimonial'
                            );
                            
                            $query = new WP_Query( $args );
                            
                            //The Loop
                            if ( $query->have_posts() ) {
                                echo '<ul class="testimonials">';
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    $more = 0;
                                    echo '<li class="clear">';
                                    echo '<figure class="testimonial-thumb">';
                                    the_post_thumbnail( 'testimonial-mug' );
                                    echo '</figure>';
                                    echo '<aside class="testimonial-text">';
                                    echo '<h3 class="testimonial-name">' . get_the_title() . '</h3>';
                                    echo '<div class="testimonial-excerpt">';
                                    the_content('');
                                    echo '</div>';
                                    echo '</aside>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #testimonials -->
                    
                    <section id="services">
                        <div class="indent clear">
                            
                            <?php
                            $query = new WP_Query( 'pagename=services' );
                            $services_id = $query->queried_object->ID;
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    $more = 0;      // Set (inside the loop) to display content above the more tag
                                    echo '<h2 class="entry-header">' . get_the_title() . '</h2>';
                                    echo '<div class="entry-content">';
                                    the_content('');
                                    echo '</div>';
                                }
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            
                            // Get the children of the services page
                            $args = array(
                                'post_type'     => 'page',
                                'post_parent'   => $services_id
                            );
                            $services_query = new WP_Query( $args );
                            
                            // The Loop
                            if ( $services_query->have_posts() ) {
                                echo '<ul class="services-list">';
                                while ( $services_query->have_posts() ) {
                                    $services_query->the_post();
                                    $more = 0;
                                    echo '<li class="clear">';
                                    echo '<a class="services-link" href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
                                    echo '<h3 class="services-title">' . get_the_title() . '</h3>';
                                    the_post_thumbnail( 'thumb' );
                                    echo '</a>';
                                    echo '<div class="services-lede">';
                                    the_content( 'Read more...' );
                                    echo '</div>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #services -->
                    
                    <section id="about">
                        <div class="indent clear">
                            
                            <?php 
                            $query = new WP_Query( 'pagename=about' );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    echo '<h2 class="entry-header">' . get_the_title(). '</h2>';
                                    echo '<div class="entry-content">';
                                    the_content();
                                    echo '</div>';
                                }
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #about -->
                    
                    <section id="contact">
                        <div class="indent clear">
                            
                            <?php
                            $query = new WP_Query( 'pagename=contact' );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    echo '<h2 class="entry-header">' . get_the_title() . '</h2>';
                                    echo '<div class="entry-content">';
                                    the_content();
                                    echo '</div>';
                                }
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #contact -->
                    
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>