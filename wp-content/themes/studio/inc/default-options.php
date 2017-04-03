<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Catch Themes
 * @subpackage Studio Pro
 * @since Studio 1.0
 */


/**
 * Returns the default options for studio.
 *
 * @since Studio 1.0
 */
function studio_get_default_theme_options( $parameter = null ) {
	
	$default_theme_options = array(
		//Logo
		'logo'												=> get_template_directory_uri() . '/images/logo.png',
		'logo_alt_text' 									=> '',
		'logo_disable'										=> 1,

		//Layout
		'theme_layout' 										=> 'no-sidebar',
		'content_layout'									=> 'excerpt-image-top',
		
		//Comment Options
		'comment_option'									=> 'use-wordpress-setting',
		'disable_website_field'								=> 0,

		//Custom CSS
		'custom_css'										=> '',

		//Excerpt Options
		'excerpt_length'									=> '30',
		'excerpt_more_text'									=> __( 'Read More ...', 'studio' ),
		
		//Homepage / Frontpage Settings
		'front_page_category'								=> array(),
		
		//Pagination Options
		'pagination_type'									=> 'default',

		//Search Options
		'search_text'										=> __( 'Search...', 'studio' ),
		
		//Reset all settings
		'reset_all_settings'								=> 0,
	);

	if ( null == $parameter ) {
		return apply_filters( 'studio_default_theme_options', $default_theme_options );
	}
	else {
		return $default_theme_options[ $parameter ];
	}
}

/**
 * Returns an array of layout options registered for studio.
 *
 * @since Studio 1.0
 */
function studio_layouts() {
	$layout_options = array(
		'left-sidebar' 	=> array(
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'studio' ),
		),
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'studio' ),
		),
		'no-sidebar' => array(
			'value' => 'no-sidebar',
			'label' => __( 'No Sidebar', 'studio' ),
		),
	);
	return apply_filters( 'studio_layouts', $layout_options );
}

/**
 * Returns an array of pagination schemes registered for studio.
 *
 * @since Studio 1.0
 */
function studio_get_pagination_types() {
	$pagination_types = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default(Older Posts/Newer Posts)', 'studio' ),
		),
		'numeric' => array(
			'value' => 'numeric',
			'label' => __( 'Numeric', 'studio' ),
		),
		'infinite-scroll-click' => array(
			'value' => 'infinite-scroll-click',
			'label' => __( 'Infinite Scroll (Click)', 'studio' ),
		),
		'infinite-scroll-scroll' => array(
			'value' => 'infinite-scroll-scroll',
			'label' => __( 'Infinite Scroll (Scroll)', 'studio' ),
		),
	);

	return apply_filters( 'studio_get_pagination_types', $pagination_types );
}


/**
 * Returns an array of comment options for studio.
 *
 * @since Studio 1.0
 */
function studio_comment_options() {
	$comment_options = array(
		'use-wordpress-setting' => array(
			'value' => 'use-wordpress-setting',
			'label' => __( 'Use WordPress Setting', 'studio' ),
		),
		'disable-in-pages' => array(
			'value' => 'disable-in-pages',
			'label' => __( 'Disable in Pages', 'studio' ),
		),
		'disable-completely' => array(
			'value' => 'disable-completely',
			'label' => __( 'Disable Completely', 'studio' ),
		),
	);

	return apply_filters( 'studio_comment_options', $comment_options );
}

/**
 * Returns an array of metabox layout options registered for studio.
 *
 * @since Studio 1.0
 */
function studio_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'studio-layout-option',
			'value' => 'default',
			'label' => __( 'Default', 'studio' ),
		),
		'left-sidebar' 	=> array(
			'id' 	=> 'studio-layout-option',
			'value' => 'left-sidebar',
			'label' => __( 'Primary Sidebar, Content', 'studio' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'studio-layout-option',
			'value' => 'right-sidebar',
			'label' => __( 'Content, Primary Sidebar', 'studio' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'studio-layout-option',
			'value' => 'no-sidebar',
			'label' => __( 'No Sidebar', 'studio' ),
		)
	);
	return apply_filters( 'studio_layouts', $layout_options );
}

/**
 * Returns an array of content layout options registered for studio.
 *
 * @since Studio 1.0
 */
function studio_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-top' => array(
			'value' => 'excerpt-image-top',
			'label' => __( 'Show Excerpt (Image Top)', 'studio' ),
		),	
		'full-content' => array(
			'value' => 'full-content',
			'label' => __( 'Show Full Content (No Featured Image)', 'studio' ),
		),
	);

	return apply_filters( 'studio_get_archive_content_layout', $layout_options );
}