<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Catch Themes
 * @subpackage Studio Pro
 * @since Studio 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses studio_header_style()
 * @uses studio_admin_header_style()
 * @uses studio_admin_header_image()
 */
function studio_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'studio_custom_header_args', array(
	    'default-image'          => '',
		'default-text-color'     => '',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'wp-head-callback'       => 'studio_header_style',
		'admin-head-callback'    => 'studio_admin_header_style',
		'admin-preview-callback' => 'studio_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'studio_custom_header_setup' );

if ( ! function_exists( 'studio_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see studio_custom_header_setup().
 */
function studio_header_style() {
	$header_image  = get_header_image();

	// Has a Custom Header been added?
	if ( ! empty( $header_image ) ) :
		echo '<!-- Header Image CSS -->' . "\n";
		echo '<style>
		#masthead {
			background: url(' . esc_url( $header_image ) . ') no-repeat 50% 50%;
			-webkit-background-size: cover;
			-moz-background-size:    cover;
			-o-background-size:      cover;
			background-size:         cover;
		}
		</style>';
	endif;

	?>
	</style>
	<?php
}
endif; // studio_header_style

if ( ! function_exists( 'studio_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see studio_custom_header_setup().
 */
function studio_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // studio_admin_header_style

if ( ! function_exists( 'studio_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see studio_custom_header_setup().
 */
function studio_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // studio_admin_header_image


if ( ! function_exists( 'studio_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own studio_featured_pagepost_image(), and that function will be used instead.
	 *
	 * @since Studio 1.2
	 */
	function studio_featured_overall_image() {
		
		return esc_url( get_header_image() );
	} // studio_featured_overall_image
endif;