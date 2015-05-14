<?php
/**
 * Template Name: Client List Page
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
                        * Loop from Front Page to get individual Client Pages
                        */

                       // Get the children of the clients page
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
                           echo '<ul class="clients-list-main">';
                           while ( $query->have_posts() ) {
                               $query->the_post();
                               $more = 0;
                               echo '<li class="clear">';
                               echo '<a class="clients-link" href="' . get_permalink() . '" title="See all Projects for ' . get_the_title() . '">';
                               echo '<figure class="client-figure">';
                               the_post_thumbnail( 'medium', array( 'class' => 'desaturate' ) );
                               echo '</figure>';
                               echo '<h3 class="clients-title">' . get_the_title() . '</h3>';
                               echo '</a>';
                               echo the_content('Read more &rarr;');
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
                                                    
                                                    
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'portfolio' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div><!-- .entry-content -->
	
						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'portfolio' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
					</div>
				</article><!-- #post -->
			<?php endwhile; ?>
                                                      
		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php comments_template(); ?>

<?php get_footer(); ?>