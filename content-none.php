<?php
/**
 * The template for displaying a "No posts found" message
 */
?>

<header class="page-header">
	<h1 class="page-title"><?php _e('Nothing Found', 'portfolio'); ?></h1>
</header>

<div class="page-content">
	<?php if (is_home() && current_user_can('publish_posts')) : ?>

	<p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'portfolio' ), admin_url( 'post-new.php')); ?></p>

	<?php elseif (is_search()) : ?>

	<p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'portfolio'); ?></p>
	<?php get_search_form(); ?>
        
        <?php elseif (is_page_template( 'page-templates/page-client.php' ) ) : ?>
        
        <p><?php _e( 'To get Projects to show up on this Client Page, you need to declare a <code>proto_client</code> Custom Field value.<br>', 'proto' ); 
                printf(__('%1$s or <a href="%2$s">learn how to here.</a>', 'proto' ), edit_post_link(__('Do so here', 'portfolio') ), admin_url( 'post-new.php')); ?>
        </p>
        <p><?php _e( 'To get Testimonials to show up on this Client Page, you need to declare a <code>proto_testimonial</code> Custom Field value.<br>', 'proto' ); 
                printf(__('%1$s or <a href="%2$s">learn how to here.</a>', 'proto' ), edit_post_link(__('Do so here', 'portfolio') ), admin_url( 'post-new.php')); ?>
        </p>

	<?php else : ?>

	<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'portfolio'); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .page-content -->
