<?php
/**
 * Template Name: Client Page
 *
 */

get_header(); ?>

	<div id="primary-left" class="content-area<?php if (!(have_comments() || comments_open())) : ?> no-comments-area<?php endif; ?>">
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
        
        <div class="primary-right">
            <?php 
            $client = get_post_meta( $post->ID, 'client', true );
            echo $client;
            $args = array (
                'order_by'  => 'desc',
                'tax_query' => array(
                    'taxonomy'  => 'jetpack-portfolio-tag',
                    'field'     => 'slug',
                    'terms'     => $client,
                    )
            );
            
            $query = new WP_Query( $args );
            
            // The Loop
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    echo "in the loop";
                    $query->the_post();
                    get_template_part( 'content-archive', get_post_format() );
                }
            }
            // Restore original Post Data
            wp_reset_postdata();
            ?>
            
        </div>
	
	<?php /*comments_template();*/ ?>

<?php get_footer(); ?>