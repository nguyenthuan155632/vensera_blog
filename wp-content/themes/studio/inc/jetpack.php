<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Studio
 */

/**
 * Jetpack support
 */
function studio_jetpack_setup() {
   	/**
     * Setup Infinite Scroll using JetPack if navigation type is set
     */
    $pagination_type    = get_theme_mod( 'pagination_type', studio_get_default_theme_options( 'pagination_type' ) );


    if( 'infinite-scroll-click' == $pagination_type ) {
        add_theme_support( 'infinite-scroll', array(
            'type'      => 'click',
            'container' => 'main',
            'render'    => 'studio_infinite_scroll_render',
            'footer'    => 'page',
        ) );
    }
    else if ( 'infinite-scroll-scroll' == $pagination_type ) {
        //Override infinite scroll disable scroll option
        update_option('infinite_scroll', true);

        add_theme_support( 'infinite-scroll', array(
            'type'      => 'scroll',
            'container' => 'main',
            'render'    => 'studio_infinite_scroll_render',
            'footer'    => 'page',
        ) );
    }

    /**
     * Add theme support for responsive videos.
     */
    add_theme_support( 'jetpack-responsive-videos' );
} // end function studio_jetpack_setup
add_action( 'after_setup_theme', 'studio_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function studio_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function studio_infinite_scroll_render