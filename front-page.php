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
?>

	<div id="primary" class="content-area front-page<?php if (!(have_comments() || comments_open())) : ?> no-comments-area<?php endif; ?>">
		<div id="content" class="site-content" role="main">

                    <?php
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
                    }
                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
                    
                    
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
                                echo '<ul class="entry-content services-list">';
                                while ( $services_query->have_posts() ) {
                                    $services_query->the_post();
                                    $more = 0;
                                    echo '<li class="clear">';
                                    echo '<div class="services-title">';
                                    echo '<a class="services-link" href="' . get_permalink() . '" title="Learn more about ' . get_the_title() . '">';
                                    the_post_thumbnail( 'thumb' );
                                    echo '<h3>' . get_the_title() . '</h3>';
                                    echo '</a>';
                                    echo '</div>';
                                    echo '<div class="services-lede">';
                                    the_content( '<button>Read more...</button>' );
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
                    
                    <section id="latest-work">
                        <div class="indent clear">
                            
                            <?php 
                            $args = array(
                                'posts_per_page'    => 16,
                                'orderby'           => 'desc',
                                'post_type'         => 'jetpack-portfolio'
                            );
                            
                            $query = new WP_Query( $args );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                echo '<h2 class="entry-header">Latest Projects</h2>';
                                echo '<div class="front-page-projects">';
				
                                while( $query->have_posts() ) {
                                    
                                    $query->the_post();
                                    //get_template_part('content-archive', get_post_format());
                                    $more = 0;
                                    echo '<article class="clear">';
                                    echo '<div class="article-helper not loaded article-hover animated">';
                                    echo '<figure class="project-thumb">';
                                    the_post_thumbnail( 'gk-portfolio-size' );
                                    echo '</figure>';
                                    echo '<aside class="project-text">';
                                    echo '<a href="' . get_the_permalink() . '">';
                                    echo '<h3 class="project-name">' . get_the_title() . '</h3>';
                                    echo '</a>';
                                    echo '<div class="project-excerpt">';
                                    the_excerpt('');
                                    echo '</div>';
                                    echo '</aside>';
                                    echo '</div>';
                                    echo '</article>';
                                }
                                echo '</div>';
                                echo '<button href="/portfolio">View Full Portfolio &rarr;</button>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #latest-work -->
                    
                    <section id="testimonials">
                        <div class="indent clear">
                            
                            <?php
                            $query = new WP_Query( 'pagename=clients' );
                            
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
                            ?>
                            
                            <?php 
                            $args = array(
                                'posts_per_page'    => 12,
                                'orderby'           => 'rand',
                                'post_type'         => 'jetpack-testimonial',
                            );
                            
                            $query = new WP_Query( $args );
                            
                            //The Loop
                            if ( $query->have_posts() ) {
                                
                                echo '<div class="testimonials">';
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    $more = 0;
                                    echo '<div class="testimonial clear">';
                                    echo '<figure class="testimonial-thumb">';
                                    the_post_thumbnail( 'testimonial-mug' );
                                    echo '</figure>';
                                    echo '<aside class="testimonial-text">';
                                    echo '<div class="testimonial-excerpt">';
                                    the_content('');
                                    echo '<a href="' . get_the_permalink() . '">';
                                    echo '<h3 class="testimonial-name">' . get_the_title() . '</h3>';
                                    echo '</a>';
                                    echo '</div>';
                                    echo '</aside>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                            <?php
                            $query = new WP_Query( 'pagename=clients' );
                            $clients_id = $query->queried_object->ID;
                            /*
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
                            */
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
                                echo '<ul class="clients-list">';
                                while ( $clients_query->have_posts() ) {
                                    $clients_query->the_post();
                                    $more = 0;
                                    echo '<li class="clear">';
                                    echo '<a class="clients-link" href="' . get_permalink() . '" title="See all Projects for ' . get_the_title() . '">';
                                    the_post_thumbnail( 'gk-portfolio-size', array( 'class' => 'desaturate' ) );
                                    echo '<h3 class="clients-title">' . get_the_title() . '</h3>';
                                    echo '</a>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #testimonials -->
                    
                    <section id="about">
                        <div class="indent clear">
                            
                            <?php 
                            $query = new WP_Query( 'pagename=about' );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    echo '<h2 class="entry-header">' . get_the_title(). '</h2>';
                                    echo '<figure class="front-right">';
                                    the_post_thumbnail( 'large' );
                                    echo '</figure>';
                                    echo '<div class="entry-content front-left">';
                                    the_content();
                                    echo '</div>';
                                }
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div><!-- .indent -->
                    </section><!-- #about -->
                    
                    <section id="blog">
                        <div class="indent clear">
                            
                            <?php
                            $args = array(
                                'posts_per_page'    => 4,
                                'orderby'           => 'desc',
                                'post_type'         => 'post',
                            );
                            
                            $query = new WP_Query( $args );
                            
                            // The Loop
                            if ( $query->have_posts() ) {
                                echo '<h2 class="entry-header">Latest Articles</h2>';
                                echo '<div class="front-page-blog">';
				
                                while( $query->have_posts() ) {
                                    
                                    $query->the_post();
                                    //get_template_part('content-archive', get_post_format());
                                    $more = 0;
                                    echo '<article class="clear">';
                                    echo '<div class="article-helper not loaded article-hover animated">';
                                    echo '<figure class="project-thumb">';
                                    the_post_thumbnail( 'gk-portfolio-size' );
                                    echo '</figure>';
                                    echo '<aside class="project-text">';
                                    echo '<a href="' . get_the_permalink() . '">';
                                    echo '<h3 class="project-name">' . get_the_title() . '</h3>';
                                    echo '</a>';
                                    echo '<div class="project-excerpt">';
                                    the_excerpt('');
                                    echo '</div>';
                                    echo '</aside>';
                                    echo '</div>';
                                    echo '</article>';
                                }
                                echo '</div>';
                                echo '<button href="/portfolio">See More Articles &rarr;</button>';
                            }
                            // Restore original Post Data
                            wp_reset_postdata();
                            ?>
                            
                        </div>
                    </section>
                    
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