<?php
	/*
		Template for Jetpack Testimonials to be shown on Jetpack Portfolio pages and Client pages
         *      (Uses Custom Fields -> proto_testimonial_project = per project, proto_testimonial_client = per client)
	*/
?>
<?php
// Figure out how to get JUST the Testimonial(s) related to THIS particular Client
                        $testimonial = get_the_title();

                        $args = array (
                            'post_type'     => 'jetpack-testimonial',
                            'meta_key'  => 'proto_testimonial_project',
                            'meta_value'=> $testimonial,
                        );
                        
                        $query = new WP_Query( $args );
                        
                        // The Loop (load the Testimonial with a Custom Field tag for this particular Jetpack-Portfolio-Tag)
                        if ( $query->have_posts() ) {
                            echo '<aside id="client-testimonial-container" class="clear">';
                            echo '<div id="client-testimonial" class="entry-content">';
                            echo '<h3 class="page-title">Client Feedback</h3>';
                                while ( $query->have_posts() ) {
                                    $query->the_post();
                                    /*$more = 0;*/
                                    
                                    echo '<div class="testimonial clear">';
                                    echo '<figure class="testimonial-thumb">';
                                    the_post_thumbnail( 'thumbnail' );
                                    echo '</figure>';
                                    echo '<aside class="testimonial-text">';
                                    
                                        if ( is_singular( 'jetpack-portfolio' ) ) {
                                            echo '<a href="' . get_the_permalink() . '">';
                                            echo '<h3 class="testimonial-name">' . get_the_title() . '</h3>';
                                            echo '</a>';
                                            echo '<div class="testimonial-excerpt">';
                                            the_content();
                                            echo '</div>';
                                            
                                        } else {
                                            echo '<div class="testimonial-excerpt">';
                                            the_excerpt();
                                            echo '</div>';
                                            echo '<a href="' . get_the_permalink() . '">';
                                            echo '<h3 class="testimonial-name">' . get_the_title() . '</h3>';
                                            echo '</a>';
                                        }
                                    echo '</aside>';
                                    echo '</div>';
                                }
                                echo '</div>';
                                echo '</aside>';
                        }
                        // Restore original Post Data
                        wp_reset_postdata();