<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Catch Themes
 * @subpackage Studio Pro
 * @since Studio 1.0
 */

if ( ! function_exists( 'studio_doctype' ) ) :
	/**
	 * Doctype Declaration
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_doctype() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'studio_doctype', 'studio_doctype', 10 );


if ( ! function_exists( 'studio_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
endif;
add_action( 'studio_before_wp_head', 'studio_head', 10 );


if ( ! function_exists( 'studio_page_start' ) ) :
	/**
	 * Start div id #page
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_page_start() {
		?>
		<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'studio' ); ?></a>
		<?php
	}
endif;
add_action( 'studio_before_header', 'studio_page_start', 10 );


if ( ! function_exists( 'studio_header_start' ) ) :
	/**
	 * Start Header id #masthead
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_header_start() {
		echo "\n";
		$header_image  = studio_featured_overall_image();
		?>
		<header id="masthead" class="site-header<?php echo ( '' != $header_image ) ? ' with-background':''; ?>" role="banner">
		<?php
	}
endif;
add_action( 'studio_header', 'studio_header_start', 10 );


if ( ! function_exists( 'studio_site_branding_start' ) ) :
	/**
	 * Start in header class .site-branding
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_site_branding_start() {
		?>
		<div class="site-branding">
			<div class="site-branding-wrap">
		<?php
	}
endif;
add_action( 'studio_header', 'studio_site_branding_start', 30 );


if ( ! function_exists( 'studio_logo' ) ) :
	/**
	 * Get logo output and display
	 *
	 * @get logo output
	 * @since Studio 1.0
	 *
	 */
	function studio_logo() {
		echo studio_get_logo();
	}
endif;
add_action( 'studio_header', 'studio_logo', 50 );


if ( ! function_exists( 'studio_site_title_description' ) ) :
	/**
	 * Get logo output and display
	 *
	 * @get logo output
	 * @since Studio 1.0
	 *
	 */
	function studio_site_title_description() {
		?>
		<div id="site-header">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
			<?php 
			//Display blog description / site tagline
			$blogdescription = get_bloginfo( 'description' );

			if ( '' != $blogdescription ) { ?>
				<h2 class="site-description">
					<?php echo $blogdescription; ?>
				</h2>
			<?php 	} ?>
		</div><!-- #site-header -->	
		<?php
	}
endif;
add_action( 'studio_header', 'studio_site_title_description', 60 );


if ( ! function_exists( 'studio_site_branding_end' ) ) :
	/**11
	 * End in header class .site-branding
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_site_branding_end() {
		?>
			</div><!-- .site-branding-wrap -->
		</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'studio_header', 'studio_site_branding_end', 70 );


if ( ! function_exists( 'studio_header_menu' ) ) :
	/**
	 * Header Menu
	 *
	 * @since Studio 1.0
	 */
	function studio_header_menu() { ?>
		<a href="#sidr-main" class="menu-toggle icon">
            
        </a>
	<?php
	}
endif;
add_action( 'studio_header', 'studio_header_menu', 80 );


if ( ! function_exists( 'studio_primary_menu' ) ) :
	/**
	 * Start in header primary menu
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_primary_menu() {
		?>
	    <nav id="site-navigation" class="main-navigation" role="navigation">
	    	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	   	</nav><!-- #site-navigation -->
	    <?php
	}
endif;
add_action( 'studio_header', 'studio_primary_menu', 110 );


if ( ! function_exists( 'studio_header_end' ) ) :
	/**
	 * End in header class .site-banner and class .wrapper
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_header_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'studio_header', 'studio_header_end', 200 );



if ( ! function_exists( 'studio_content_start' ) ) :
	/**
	 * Start div id #content and class .wrapper
	 *
	 * @since Studio 1.0
	 *
	 */
	function studio_content_start() {
		?>
		<div id="content" class="site-content">
	<?php
	}
endif;
add_action('studio_content', 'studio_content_start', 10 );


if ( ! function_exists( 'studio_content_end' ) ) :
	/**
	 * End div id #content and class .wrapper
	 *
	 * @since Studio 1.0
	 */
	function studio_content_end() {
		?>
	    </div><!-- #content -->
		<?php
	}
endif;
add_action( 'studio_after_content', 'studio_content_end', 10 );