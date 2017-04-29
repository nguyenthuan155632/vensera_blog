<?php
/**
 * The Header for marlin-lite
 *
 * @package marlin-lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>
    <div id="wrapper">
        <div class="topbar">
            <div class="container">
                <?php
                    wp_nav_menu( array (
                        'container'         => false,
                        'theme_location'    => 'topbar',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'depth'             => 2,
                        'walker'            => new wp_bootstrap_navwalker(),
                        'menu_class'        => 'topbar-menu pull-left'
                    ) );
                ?>
                <div class="social pull-right">
                    <?php if(get_theme_mod('marlin_lite_facebook')) : ?><a href="<?php echo esc_url( get_theme_mod('marlin_lite_facebook') ); ?>" target="_blank" title="<?php _e( 'Facebook', 'marlin-lite' ); ?>"><i class="fa fa-facebook"></i></a><?php endif; ?>
    				<?php if(get_theme_mod('marlin_lite_twitter')) : ?><a href="<?php echo esc_url( get_theme_mod('marlin_lite_twitter') ); ?>" target="_blank" title="<?php _e( 'Twitter', 'marlin-lite' ); ?>"><i class="fa fa-twitter"></i></a><?php endif; ?>
					<?php if(get_theme_mod('marlin_lite_google')) : ?><a href="<?php echo esc_url( get_theme_mod('marlin_lite_google') ); ?>" target="_blank" title="<?php _e( 'Google Plus', 'marlin-lite' ); ?>"><i class="fa fa-google-plus"></i></a><?php endif; ?>
    				<?php if(get_theme_mod('marlin_lite_linkedin')) : ?><a href="<?php echo esc_url( get_theme_mod('marlin_lite_linkedin') ); ?>" target="_blank" title="<?php _e( 'LinkedIn', 'marlin-lite' ); ?>"><i class="fa fa-linkedin"></i></a><?php endif; ?>
					<?php if(get_theme_mod('marlin_lite_youtube')) : ?><a href="<?php echo esc_url( get_theme_mod('marlin_lite_youtube') ); ?>" target="_blank" title="<?php _e( 'YouTube', 'marlin-lite' ); ?>"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
     				<?php if(get_theme_mod('marlin_lite_instagram')) : ?><a href="<?php echo esc_url( get_theme_mod('marlin_lite_instagram') ); ?>" target="_blank" title="<?php _e( 'Instagram', 'marlin-lite' ); ?>"><i class="fa fa-instagram"></i></a><?php endif; ?>
                </div>
            </div>
        </div><!-- topbar -->
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				<?php if ( get_header_image() ) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
				<?php }else{
					if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){ the_custom_logo(); } ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php } //if ( get_header_image() ) ?>
			</div>
			<nav id="nav-wrapper">
				<div class="container">                
					<a href="javascript:void(0)" class="toggle-menu"><i class="fa fa-bars"></i></a>
					<?php
						wp_nav_menu( array (
							'container' => false,
							'theme_location' => 'primary',
							'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
							'depth' => 10,
							'walker' => new wp_bootstrap_navwalker(),
							'menu_class' => 'vtmenu'
						) );
					?>          
				</div>
			</nav><!-- #navigation -->
        </header><!-- #masthead -->

		<div id="content" class="container">
			<div class="row">