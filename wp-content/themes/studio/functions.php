<?php
/**
 * Studio functions and definitions
 *
 * @package Studio
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 924; /* pixels */
}

if ( ! function_exists( 'studio_content_width' ) ) :
	/**
	 * Change the content width based on the Theme Settings and Page/Post Settings
	 */
	function studio_content_width() {
		global $post, $wp_query, $content_width;

		//Getting Ready to load options data
		$themeoption_layout 	= get_theme_mod( 'theme_layout', studio_get_default_theme_options( 'theme_layout' ) );

		// Front page displays in Reading Settings
		$page_on_front = get_option('page_on_front') ;
		$page_for_posts = get_option('page_for_posts');

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $layout  = get_post_meta( $page_id,'studio-layout-option', true );
	    }
    	elseif ( is_singular() ) {
	 		if ( is_attachment() ) {
				$parent = $post->post_parent;

				$layout = get_post_meta( $parent,'studio-layout-option', true );
			}
			else {
				$layout = get_post_meta( $post->ID,'studio-layout-option', true );
			}
		}
		else {
			$layout = 'default';
		}

		//check empty and load default
		if( empty( $layout ) ) {
			$layout = 'default';
		}

		//Two Column: Left and Right Sidebar
		if ( 'right-sidebar' == $layout  || 'left-sidebar' == $layout  || ( $layout=='default' && ( 'right-sidebar' == $themeoption_layout  || 'left-sidebar' == $themeoption_layout  ) ) ) {
			$content_width = 860;
		}

	}
endif;
add_action( 'template_redirect', 'studio_content_width' );

if ( ! function_exists( 'studio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function studio_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Studio, use a find and replace
	 * to change 'studio' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'studio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add tyles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', studio_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	//@remove Remove check when WordPress 4.8 is released
	if ( function_exists( 'has_custom_logo' ) ) {
		/**
		* Setup Custom Logo Support for theme
		* Supported from WordPress version 4.5 onwards
		* More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		*/
		add_theme_support( 'custom-logo' );
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 924, 520, true );

	// Used as Featured Image Ratio / No Sidebar 16:9
	add_image_size( 'studio-single', 924, 520, true );

	// Used For Featured Content With Sidebar Ratio 16:9
	add_image_size( 'studio-single-sidebar', 830, 467, true ); // Featured Image

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'studio' ),
		'social'  => esc_html__( 'Social Menu', 'studio' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'studio_custom_background_args', array(
	    'default-attachment'	=> 'fixed',
		'default-color'			=> '',
		'default-image'			=> get_template_directory_uri() . '/images/default-image.jpg',
		'default-position-x'	=> 'center',
	) ) );
}
endif; // studio_setup
add_action( 'after_setup_theme', 'studio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function studio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'studio_content_width', 800 );
}
add_action( 'after_setup_theme', 'studio_content_width', 0 );

/**
 * Google fonts.
 */
function studio_fonts_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'studio' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Montserrat|Bowlby One|Quattrocento Sans:400,400italic,700italic,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function studio_admin_fonts() {
	wp_enqueue_style( 'studio-font', studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'studio_admin_fonts' );

/**
 * Enqueue scripts and styles.
 */
function studio_scripts() {    
    wp_enqueue_style( 'studio-bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7' );
    
	wp_enqueue_style( 'studio-style', get_stylesheet_uri(), array(), '1.0.0' );

	wp_enqueue_style( 'studio-fonts', studio_fonts_url(), array(), '1.0.0' );

	wp_enqueue_style( 'studio-icons', get_template_directory_uri() . '/css/typicons.css', array(), '1.0.0' );

	wp_enqueue_script( 'studio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );

	wp_enqueue_script( 'studio-helpers', get_template_directory_uri() . '/js/helpers.js', array( 'jquery' ), '1.0.0', true );
    
    wp_enqueue_script( 'studio-bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );

	wp_enqueue_script( 'studio-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	// Localize script (only few lines in helpers.js)
    wp_localize_script( 'studio-helpers', 'placeholder', array(
 	    'author'   => __( 'Name', 'studio' ),
 	    'email'    => __( 'Email', 'studio' ),
		'url'      => __( 'URL', 'studio' ),
		'comment'  => __( 'Comment', 'studio' )
 	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'studio_scripts' );

/**
 * Include Default Options for Studio
 */
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

/**
 * Implement the Custom Header feature.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

/**
 * Include Structure for Studio
 */
require trailingslashit( get_template_directory() ) . 'inc/structure.php';

/**
 * Load sidebars and widgets
 */
require trailingslashit( get_template_directory() ) . 'inc/widgets.php';

/**
 * Migrate Logo to New WordPress core Custom Logo
 *
 *
 * Runs if version number saved in theme_mod "logo_version" doesn't match current theme version.
 */
function studio_logo_migrate() {
	$ver = get_theme_mod( 'logo_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '1.1' ) >= 0 ) {
		return;
	}

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5
	if ( function_exists( 'the_custom_logo' ) ) {
		/**
		 * Get Logo from Theme Mod
		 */
		$logo = get_theme_mod( 'logo', studio_get_default_theme_options( 'logo' ) );
		if( '' != $logo ) {
			// Since previous logo was stored a URL, convert it to an attachment ID
			$logo = attachment_url_to_postid( $logo );

			if ( is_int( $logo ) ) {
				set_theme_mod( 'custom_logo', $logo );
			}
		}

  		// Update to match logo_version so that script is not executed continously
		set_theme_mod( 'logo_version', '1.1' );
	}

}
add_action( 'after_setup_theme', 'studio_logo_migrate' );


/**
 * Migrate Custom CSS to WordPress core Custom CSS
 *
 * Runs if version number saved in theme_mod "custom_css_version" doesn't match current theme version.
 */
function studio_custom_css_migrate() {
	$ver = get_theme_mod( 'custom_css_version', false );

	// Return if update has already been run
	if ( version_compare( $ver, '4.7' ) >= 0 ) {
		return;
	}
	
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
	    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
	    
	    /**
		 * Get Theme Options Values
		 */
	    $custom_css = get_theme_mod( 'custom_css', studio_get_default_theme_options( 'custom_css' ) );

	    if ( '' != $custom_css ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return   = wp_update_custom_css_post( $core_css . $custom_css );
	        if ( ! is_wp_error( $return ) ) {
	            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
	            remove_theme_mod( 'custom_css' );

	            // Update to match custom_css_version so that script is not executed continously
				set_theme_mod( 'custom_css_version', '4.7' );
	        }
	    }
	}
}
add_action( 'after_setup_theme', 'studio_custom_css_migrate' );