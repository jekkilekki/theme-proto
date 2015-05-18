<?php
/**
 * Template Name: List Children Page
 *
 */
global $more;

get_header(); ?>

	<div id="primary" class="content-area<?php if (!(have_comments() || comments_open())) : ?> no-comments-area<?php endif; ?>">
		<div id="content" class="site-content" role="main">
                    
                    <?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div>
						<header class="entry-header">
							<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							<div class="entry-thumbnail">
								<?php the_post_thumbnail(); ?>
							</div>
							<?php endif; ?>
	
							<h1 class="entry-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
							</h1>
						</header><!-- .entry-header -->
	
						<div class="entry-content">
							<?php the_content(); ?>
                                                    
                                                    
                       <?php
                       /*
                        * Loop from Front Page to get individual Child Pages of this one
                        */

                       // Get the children of THIS Page
                       $args = array(
                           'post_type'     => 'page',
                           'post_parent'   => $post->ID,
                           'posts_per_page'=> -1,
                           'orderby'       => 'title',
                           'order'         => 'ASC'
                       );
                       $query = new WP_Query( $args );

                       // The Loop
                       if ( $query->have_posts() ) {
                           echo '<ul class="list-main">';
                           while ( $query->have_posts() ) {
                               $query->the_post();
                               $more = 0;
                               
                               $icon = '';
                               $icon = get_post_meta( get_the_ID(), 'proto_fa_icon', true );
                               
                               echo '<li class="clear">';
                               echo '<a class="list-link" href="' . get_permalink() . '" title="See more info about ' . get_the_title() . '">';
                               echo '<figure class="list-figure">';
                               if ( $icon != '' ) {
                                    echo "<span class='fa $icon'></span>";
                                } else {
                                    the_post_thumbnail( 'medium' );
                                }
                               echo '</figure>';
                               echo '<h3 class="list-title">' . get_the_title() . '</h3>';
                               echo '</a>';
                               echo '<div class="list-excerpt">';
                               echo the_content('Read more &rarr;');
                               echo '</div>';
                               echo '</li>';
                           }
                           echo '</ul>';

                       } else {

                           get_template_part('content', 'none');
                           
                       }
                       // Restore original Post Data
                       wp_reset_postdata();
                       ?>                            
                                                    
                                                    
							
						</div><!-- .entry-content -->
	
						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'portfolio' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
					</div>
				</article><!-- #post -->
			<?php endwhile; ?>
                                                      
		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php // comments_template(); ?>

<?php get_footer(); ?>