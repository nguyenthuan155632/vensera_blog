<?php
/**
 * Marlin functions and definitions
 *
 * @package marlin-lite
 */
$theme = wp_get_theme();
define('MARLIN_LITE_VERSION', $theme -> get('Version'));
define('MARLIN_LITE_AUTHOR_URI', $theme -> get('AuthorURI'));
define('MARLIN_LIBS_URI', get_template_directory_uri() . '/libs/');
define('MARLIN_CORE_PATH', get_template_directory() . '/core/');
define('MARLIN_CORE_URI', get_template_directory_uri() . '/core/');
define('MARLIN_CORE_CLASSES', MARLIN_CORE_PATH . 'classes/');
define('MARLIN_CORE_FUNCTIONS', MARLIN_CORE_PATH . 'functions/');
define('MARLIN_CORE_WIDGETS', MARLIN_CORE_PATH . 'widgets/');

// Set Content Width
if ( ! isset( $content_width ) ) { $content_width = 1170; }

// Theme setup
add_action('after_setup_theme', 'marlin_lite_setup');
function marlin_lite_setup() {
	
	// Translations can be filed in the /languages/ directory.
    load_theme_textdomain( 'marlin-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
	
	/* Enable support for Post Thumbnails on posts and pages */
	add_theme_support('post-thumbnails');
	add_image_size( 'marlin_lite_latest_post', 100, 100, true);
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__('Primary menu', 'marlin-lite'),
		'topbar' => esc_html__('Topbar Menu', 'marlin-lite')
    ));
	
	/* Add callback for custom TinyMCE editor stylesheets. (editor-style.css) */
	add_editor_style('editor-style.css');

	// Enable support for Post Formats.
	add_theme_support('post-formats', array('image', 'video', 'audio', 'gallery'));
	
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'marlin_lite_custom_background_args', array(
		'default-color' => 'f9f9f9',
		'default-image' => '',
	) ) );
	
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
	
	// Custom logo
	add_theme_support( 'custom-logo', array(
	   'height'      => 175,
	   'width'       => 400,
	   'flex-width' => true,
	   'header-text' => array( 'site-title', 'site-description' ),
	) );
	
}

// Register & Enqueue Styles / Scripts
add_action('wp_enqueue_scripts', 'marlin_lite_load_scripts');
function marlin_lite_load_scripts() {
    // CSS
    wp_enqueue_style('bootstrap', MARLIN_LIBS_URI . 'bootstrap/css/bootstrap.min.css', array(), '3.3.5' );
    wp_enqueue_style('font-awesome', MARLIN_LIBS_URI . 'font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
    wp_enqueue_style('chosen', MARLIN_LIBS_URI . 'chosen/chosen.min.css', array(), '1.6.2' );
    wp_enqueue_style('marlin-lite-style', get_stylesheet_uri(), '', MARLIN_LITE_VERSION );

    // JS
	wp_enqueue_script('fitvids', MARLIN_LIBS_URI . 'fitvids/fitvids.js', array(), false, true);
    wp_enqueue_script('chosen', MARLIN_LIBS_URI . 'chosen/chosen.jquery.min.js', array(), false, true);
    wp_enqueue_script('marlin-scripts', get_template_directory_uri() . '/assets/js/marlin-scripts.js', array(), false, true);
    
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script('comment-reply');
    }
}

// Load Google fonts
function marlin_lite_google_fonts_url() {
    $fonts_url = '';
    $Lato = _x( 'on', 'Lato font: on or off', 'marlin-lite' );
    $Montserrat = _x( 'on', 'Roboto font: on or off', 'marlin-lite' );
    $Dancing = _x( 'on', 'Dancing Script font: on or off', 'marlin-lite' );    

    if ( 'off' !== $Dancing || 'off' !== $Montserrat || 'off' !== $Lato )
    {
        $font_families = array();

        if ('off' !== $Dancing) {
            $font_families[] = 'Dancing Script:700';
        }
        
        if ('off' !== $Montserrat) {
            $font_families[] = 'Montserrat:400,700';
        }
        
        if ('off' !== $Lato) {
            $font_families[] = 'Lato';
        }

        $query_args = array(
            'family' => urlencode(implode('|', $font_families )),
            'subset' => urlencode('latin,latin-ext')
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

// Google fonts
function marlin_lite_enqueue_googlefonts() {
    wp_enqueue_style( 'marlin-lite-googlefonts', marlin_lite_google_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'marlin_lite_enqueue_googlefonts');

/* Add Admin stylesheet to the admin page */
function marlin_lite_selectively_enqueue_admin_script( $hook ) {
	if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'marlin-lite-adminstyle', get_template_directory_uri() . '/assets/css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'marlin_lite_selectively_enqueue_admin_script' );

// Sidebar Widgets
function marlin_lite_widgets_init() {
	register_sidebar(array(
		'name'          => __( 'Sidebar', 'marlin-lite' ),
		'id'              => 'sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
}
add_action( 'widgets_init', 'marlin_lite_widgets_init' );

function marlin_lite_require_file( $path ) {
    if ( file_exists($path) ) {
        require $path;
    }
}

// Require core files
marlin_lite_require_file( get_template_directory() . '/core/init.php' );