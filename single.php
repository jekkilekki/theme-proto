<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php if(get_theme_mod('portfolio_show_post_navigation', '1') == '1') : ?>
	<?php previous_post_link( '<div id="prev-post">%link</div>', '<i class="fa fa-arrow-left"></i>', TRUE ); ?>
	<?php next_post_link( '<div id="next-post">%link</div>', '<i class="fa fa-arrow-right"></i>', TRUE ); ?>
	<?php endif; ?>
        
        <?php if(get_post_type() == 'jetpack-portfolio' ) : ?>
                <?php get_template_part( 'content', 'testimonial' ); ?>
        <?php endif; ?>
	
	<?php get_template_part( 'content', 'footer' ); ?>
	<?php comments_template(); ?>

<?php get_footer(); ?>