<?php
/**
 *
 * The Header template for our theme
 *
 **/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!--[if lte IE 8]>
	<div id="ie-toolbar"><div><?php _e('You\'re using an unsupported version of Internet Explorer. Please <a href="http://windows.microsoft.com/en-us/internet-explorer/products/ie/home">upgrade your browser</a> for the best user experience on our site. Thank you.', 'portfolio') ?></div></div>
	<![endif]-->
		<header id="masthead<?php if ( is_front_page() ) { echo '-front'; } ?>" class="site-header" role="banner">
                        
                        <?php if ( is_front_page() ) 
                        echo '<div class="indent">';
                        ?>
                                
                            <a class="home-link <?php if ( is_front_page() ) { echo 'front-left'; } ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if(get_theme_mod('portfolio_logo', '') !== '') : ?>
					<img src="<?php echo get_theme_mod('portfolio_logo', ''); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				<?php else: ?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<?php if(get_bloginfo('description') != '') : ?>
					<h2 class="site-description"><?php bloginfo('description'); ?></h2>
					<?php endif; ?>
				<?php endif; ?>
                            </a>
                        
                        <?php if ( is_front_page() ) : ?>
                            <nav id="site-navigation" class="main-navigation indent front-right" role="navigation">

                                    <!-- Custom Home Menu -->
                                    <?php wp_nav_menu( array( 'menu' => 'Front Page Menu', 'menu_class' => 'nav-menu' ) ); ?>                                                			

                            </nav><!-- #site-navigation --> 
                            </div>
                        <?php endif; ?>
                            
		</header><!-- #masthead -->
				
		<div id="main" class="<?php if( is_front_page() ) : echo "site-front"; else : echo "site-main"; endif; ?>">
			<div id="page" class="hfeed site">
		
                            <?php if ( !is_front_page() ) : ?>
				<nav id="site-navigation" class="main-navigation" role="navigation">
                                    
                                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                                 
                                </nav><!-- #site-navigation -->
                                      
                            <?php endif; ?>

