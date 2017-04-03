<?php
/**
 * The template for adding Custom Sidebars and Widgets
 *
 * @package Studio
 * @subpackage Studio Pro
 * @since Studio 1.0
 */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function studio_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (left)', 'studio' ),
		'id'            => 'footer-widget-left',
		'description'   => 'Left footer widget',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget (right)', 'studio' ),
		'id'            => 'footer-widget-right',
		'description'   => 'Right footer widget',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	//Primary Sidebar
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'studio' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'studio_widgets_init' );