<?php
/**
 * The template for adding additional theme options in Customizer
 *
 * @package Catch Themes
 * @subpackage Studio Pro
 * @since Studio 1.0
 */

	//Theme Options
	$wp_customize->add_panel( 'studio_theme_options', array(
	    'description'    => __( 'Basic theme Options', 'studio' ),
	    'capability'     => 'edit_theme_options',
	    'priority'       => 200,
	    'title'    		 => __( 'Theme Options', 'studio' ),
	) );

  	// Comment Option
	$wp_customize->add_section( 'studio_comment_option', array(
		'description'	=> __( 'Comments can also be disabled on a per post/page basis when creating/editing posts/pages.', 'studio' ),
		'panel' 		=> 'studio_theme_options',
		'priority'		=> 202,
		'title'   		=> __( 'Comment Options', 'studio' ),
	) );

	$wp_customize->add_setting( 'comment_option', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['comment_option'],
		'sanitize_callback' => 'studio_sanitize_select',
	) );


	$comment_option_types = studio_comment_options();
	$choices = array();
	foreach ( $comment_option_types as $comment_option_type ) {
		$choices[$comment_option_type['value']] = $comment_option_type['label'];
	}

	$wp_customize->add_control( 'comment_option', array(
			'choices'  	=> $choices,
			'label'		=> __( 'Comment Option', 'studio' ),
	        'priority'	=> 1,
			'section'   => 'studio_comment_option',
	        'settings'  => 'comment_option',
	        'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'disable_website_field', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['disable_website_field'],
		'sanitize_callback' => 'studio_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'disable_website_field', array(
		'label'		=> __( 'Check to Disable Website Field', 'studio' ),
		'section'   => 'studio_comment_option',
        'settings'  => 'disable_website_field',
		'type'		=> 'checkbox',
	) );
   	// Comment End

	/**
	 * Remove Custom CSS block from WordPress 4.7 onwards
	 */
	if ( !function_exists( 'wp_update_custom_css_post' ) ) {
   		// Custom CSS Option
		$wp_customize->add_section( 'studio_custom_css', array(
			'description'	=> __( 'Custom/Inline CSS', 'studio'),
			'panel'  		=> 'studio_theme_options',
			'priority' 		=> 203,
			'title'    		=> __( 'Custom CSS Options', 'studio' ),
		) );

		$wp_customize->add_setting( 'custom_css', array(
			'capability'		=> 'edit_theme_options',
			'default'			=> $defaults['custom_css'],
			'sanitize_callback' => 'studio_sanitize_custom_css',
		) );

		$wp_customize->add_control( 'custom_css', array(
				'label'		=> __( 'Enter Custom CSS', 'studio' ),
		        'priority'	=> 1,
				'section'   => 'studio_custom_css',
		        'settings'  => 'custom_css',
				'type'		=> 'textarea',
		) ) ;
	   	// Custom CSS End
	}

   	// Excerpt Options
	$wp_customize->add_section( 'studio_excerpt_options', array(
		'panel'  	=> 'studio_theme_options',
		'priority' 	=> 204,
		'title'    	=> __( 'Excerpt Options', 'studio' ),
	) );

	$wp_customize->add_setting( 'excerpt_length', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_length'],
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'excerpt_length', array(
		'description' => __('Excerpt length. Default is 40 words', 'studio'),
		'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'width: 60px;'
            ),
        'label'    => __( 'Excerpt Length (words)', 'studio' ),
		'section'  => 'studio_excerpt_options',
		'settings' => 'excerpt_length',
		'type'	   => 'number',
		)
	);

	$wp_customize->add_setting( 'excerpt_more_text', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['excerpt_more_text'],
		'sanitize_callback'	=> 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'excerpt_more_text', array(
		'label'    => __( 'Read More Text', 'studio' ),
		'section'  => 'studio_excerpt_options',
		'settings' => 'excerpt_more_text',
		'type'	   => 'text',
	) );
	// Excerpt Options End

	//Homepage / Frontpage Options
	$wp_customize->add_section( 'studio_homepage_options', array(
		'description'	=> __( 'Only posts that belong to the categories selected here will be displayed on the front page', 'studio' ),
		'panel'			=> 'studio_theme_options',
		'priority' 		=> 209,
		'title'   	 	=> __( 'Homepage / Frontpage Options', 'studio' ),
	) );

	$wp_customize->add_setting( 'front_page_category', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['front_page_category'],
		'sanitize_callback'	=> 'studio_sanitize_category_list',
	) );

	$wp_customize->add_control( new Studio_Customize_Dropdown_Categories_Control( $wp_customize, 'front_page_category', array(
        'label'   	=> __( 'Select Categories', 'studio' ),
        'name'	 	=> 'front_page_category',
		'priority'	=> '6',
        'section'  	=> 'studio_homepage_options',
        'settings' 	=> 'front_page_category',
        'type'     	=> 'dropdown-categories',
    ) ) );
	//Homepage / Frontpage Settings End

	// Layout Options
	$wp_customize->add_section( 'studio_layout', array(
		'capability'=> 'edit_theme_options',
		'panel'		=> 'studio_theme_options',
		'priority'	=> 211,
		'title'		=> __( 'Layout Options', 'studio' ),
	) );

	$wp_customize->add_setting( 'theme_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['theme_layout'],
		'sanitize_callback' => 'studio_sanitize_select',
	) );

	$layouts = studio_layouts();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'theme_layout', array(
		'choices'	=> $choices,
		'label'		=> __( 'Default Layout', 'studio' ),
		'section'	=> 'studio_layout',
		'settings'  => 'theme_layout',
		'type'		=> 'select',
	) );

	$wp_customize->add_setting( 'content_layout', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['content_layout'],
		'sanitize_callback' => 'studio_sanitize_select',
	) );

	$layouts = studio_get_archive_content_layout();
	$choices = array();
	foreach ( $layouts as $layout ) {
		$choices[ $layout['value'] ] = $layout['label'];
	}

	$wp_customize->add_control( 'content_layout', array(
		'choices'   => $choices,
		'label'		=> __( 'Archive Content Layout', 'studio' ),
		'section'   => 'studio_layout',
		'settings'  => 'content_layout',
		'type'      => 'select',
	) );
   	// Layout Options End

	// Pagination Options
	$pagination_type	= get_theme_mod( 'pagination_type' );

	$studio_navigation_description = sprintf( __( 'Numeric Option requires <a target="_blank" href="%s">WP-PageNavi Plugin</a>.<br/>Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'studio' ), esc_url( 'https://wordpress.org/plugins/wp-pagenavi' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ) );

	/**
	 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	 */
	if ( ( 'infinite-scroll-click' == $pagination_type || 'infinite-scroll-scroll' == $pagination_type ) ) {
		if ( ! (class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) ) {
			$studio_navigation_description = sprintf( __( 'Infinite Scroll Options requires <a target="_blank" href="%s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'studio' ), esc_url( 'https://wordpress.org/plugins/jetpack/' ) );
		}
		else {
			$studio_navigation_description = '';
		}
	}

	$wp_customize->add_section( 'studio_pagination_options', array(
		'description'	=> $studio_navigation_description,
		'panel'  		=> 'studio_theme_options',
		'priority'		=> 212,
		'title'    		=> __( 'Pagination Options', 'studio' ),
	) );

	$wp_customize->add_setting( 'pagination_type', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['pagination_type'],
		'sanitize_callback' => 'studio_sanitize_select',
	) );

	$pagination_types = studio_get_pagination_types();
	$choices = array();
	foreach ( $pagination_types as $pagination_type ) {
		$choices[$pagination_type['value']] = $pagination_type['label'];
	}

	$wp_customize->add_control( 'pagination_type', array(
		'choices'  => $choices,
		'label'    => __( 'Pagination type', 'studio' ),
		'section'  => 'studio_pagination_options',
		'settings' => 'pagination_type',
		'type'	   => 'select',
	) );
	// Pagination Options End

	// Search Options
	$wp_customize->add_section( 'studio_search_options', array(
		'description'=> __( 'Change default placeholder text in Search.', 'studio'),
		'panel'  => 'studio_theme_options',
		'priority' => 216,
		'title'    => __( 'Search Options', 'studio' ),
	) );

	$wp_customize->add_setting( 'search_text', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['search_text'],
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'search_text', array(
		'label'		=> __( 'Default Display Text in Search', 'studio' ),
		'section'   => 'studio_search_options',
        'settings'  => 'search_text',
		'type'		=> 'text',
	) );
	// Search Options End
//Theme Option End