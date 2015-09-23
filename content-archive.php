<?php
/**
 * The default template for displaying content
 * Used for index/archive/search.
 *
 */

$animation_type = '';
$animation_speed = '';

switch(get_theme_mod('portfolio_frontpage_animation_type', '1')) {
	case '2': $animation_type = ' flip-center-animation'; break;
	case '3': $animation_type = ' scale-animation'; break;
	case '4': $animation_type = ' scale-center-animation'; break;
	case '5': $animation_type = ' scale-top-animation'; break;
	case '6': $animation_type = ' opacity-animation'; break;
	default : $animation_type = ''; break;
}

switch(get_theme_mod('portfolio_frontpage_animation_speed', '500')) {
	case '250': $animation_speed = ' fast-animation'; break;
	case '750': $animation_speed = ' slow-animation'; break;
	default : $animation_speed = ''; break;
}

$post_css_classes = '';
$post_css_classes .= get_theme_mod('portfolio_frontpage_animation', '1') == '' ? ' no-animation' : '';
$post_css_classes .= get_theme_mod('portfolio_item_hover', '') == '1' ? ' hover-effect' : '';

$post_helper_css_classes = '';
$post_helper_css_classes .= get_theme_mod('portfolio_frontpage_animation_type', '1') !== ''  ? $animation_type : '';
$post_helper_css_classes .= get_theme_mod('portfolio_frontpage_animation_speed', '500') !== ''  ? $animation_speed : '';
$post_helper_css_classes .= (get_theme_mod('portfolio_show_excerpts', '1') == '0' && is_sticky()) ? ' sticky' : '';
$post_helper_css_classes .= ( is_sticky() && is_front_page() ? ' sticky' : '' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_css_classes); ?> data-cols="<?php echo get_theme_mod('portfolio_article_column', '4')?>">
	<div class="article-helper notloaded<?php echo $post_helper_css_classes; ?>">
		<?php if (is_front_page() || is_home() || is_search() || is_archive() || is_tag() || is_page_template('page-templates/page-client.php')) : // Only display Excerpts for Search ?>
			<?php if(get_theme_mod('portfolio_show_excerpts', '1') == '1') : ?>
			<div class="post-preview transition animation <?php echo $post_preview_animation; ?>">
				<?php get_template_part('content', 'header'); ?>
			
				
				<div class="entry-summary">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_excerpt(); ?></a>
				</div><!-- .entry-summary -->
			</div>
			<?php else : ?>
				<?php get_template_part('content', 'header-simple'); ?>
			<?php endif; ?>
		<?php
			if(get_theme_mod('portfolio_show_tags', '1') == '1') {
				$tag_list = get_the_tag_list('<ul class="tags-links"><li>',', </li><li>','</li></ul>');
				if ($tag_list) {
					echo $tag_list;
				}
			}
                        /* @ADD: Support for JetPack Portfolio Tags @TODO: Test for the CPT */
                                if ( 'jetpack-portfolio' == get_post_type() ) {
                                    if( get_theme_mod('proto_show_jetpack_tags', '1') == '1' ) {
                                        $project_tag_list = get_the_term_list( $post->ID, 'jetpack-portfolio-tag', '<ul class="tags-links"><li>', ', </li><li>', '</li></ul>' );
                                        if ($project_tag_list) {
                                                echo $project_tag_list;
                                        }
                                    }
                                }
		?>
		<?php else : ?>
		<div class="entry-content">
			<?php the_content(__('Read more', 'portfolio')); ?>
			<?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'portfolio') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
			
			<?php
				$tag_list = get_the_tag_list('<ul class="tags-links"><li>',', </li><li>','</li></ul>');
				if ($tag_list) {
					echo $tag_list;
				}
                                /* @ADD: Support for JetPack Portfolio Tags @TODO: Test for the CPT */
                                if ('jetpack-portfolio' == get_post_type() ) {
                                        $project_tag_list = get_the_term_list( $post->ID, 'jetpack-portfolio-tag', '<ul class="tags-links"><li>', ', </li><li>', '</li></ul>' );
                                        if ($project_tag_list) {
                                                echo $project_tag_list;
                                        }
                                }
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</div>
</article><!-- #post -->
