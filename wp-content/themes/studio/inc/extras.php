<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Studio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function studio_body_classes( $classes ) {
	global $post, $wp_query;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Front page displays in Reading Settings
    $page_on_front 	= get_option('page_on_front') ;
    $page_for_posts = get_option('page_for_posts');

	// Get Page ID outside Loop
    $page_id = $wp_query->get_queried_object_id();

	// Blog Page or Front Page setting in Reading Settings
	if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
        $layout 			= get_post_meta( $page_id,'studio-layout-option', true );
    }
	else if ( is_singular() ) {
 		if ( is_attachment() ) {
			$parent 			= $post->post_parent;
			$layout 			= get_post_meta( $parent,'studio-layout-option', true );
		}
		else {
			$layout 			= get_post_meta( $post->ID,'studio-layout-option', true );
		}
	}
	else {
		$layout 			= 'default';
	}

	//check empty and load default
	if( empty( $layout ) ) {
		$layout = 'default';
	}

	if( 'default' == $layout ) {
		$layout_selector = get_theme_mod( 'theme_layout', studio_get_default_theme_options( 'theme_layout' ) );
	}
	else {
		$layout_selector = $layout;
	}

	switch ( $layout_selector ) {
		case 'left-sidebar':
			$classes[] = 'two-columns content-right';
		break;

		case 'right-sidebar':
			$classes[] = 'two-columns content-left';
		break;

		case 'no-sidebar':
			$classes[] = 'no-sidebar';
		break;
	}

	$current_content_layout = get_theme_mod( 'content_layout', studio_get_default_theme_options( 'content_layout' ) );

	if( "" != $current_content_layout ) {
		$classes[] = $current_content_layout;
	}

	return $classes;
}
add_filter( 'body_class', 'studio_body_classes' );

if ( ! function_exists( 'studio_display_logo' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @since Studio 1.0
	 */
	function studio_display_logo() {
		$logo 		= get_theme_mod( 'logo', studio_get_default_theme_options( 'logo' ) );

		$logo_alt 	= get_theme_mod( 'logo_alt_text', studio_get_default_theme_options( 'logo_alt_text' ) );
		if ( '' != $logo_alt ) {
			$logo_alt_text = $logo_alt;
		}
		else {
			$logo_alt_text = get_bloginfo( 'name', 'display' );
		}

		//Checking Logo
		if ( '' != $logo ) {
			echo '
			<a rel="home" class="site-logo-link" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">
				<img data-size="studio-logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr(  $logo_alt_text ). '" class="site-logo attachment-studio-logo">
			</a><!-- #site-logo -->';
		}
	}
endif; // studio_display_logo

if ( ! function_exists( 'studio_get_logo' ) ) :
	/**
	 * Get the logo
	 *
	 * @get logo from options
	 *
	 * @since Studio 1.0
	 */
	function studio_get_logo() {
		$output = '';
		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				$output = '
				<div class="site-logo">'. get_custom_logo() . '</div><!-- #site-logo -->';
			}
		}
		else{
			$logo 		  	= get_theme_mod( 'logo', studio_get_default_theme_options( 'logo' ) );

			$logo_disable 	= get_theme_mod( 'logo_disable', studio_get_default_theme_options( 'logo_disable' ) );

			$logo_alt_text 	= get_theme_mod( 'logo_alt_text', studio_get_default_theme_options( 'logo_alt_text' ) );

			$output = '';

			//Checking Logo
			if ( '' != $logo && !$logo_disable ) {
				$output = '
				<div class="site-logo">
					<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">
						<img src="' . esc_url( $logo ) . '"';
						if ( '' != $logo_alt_text ) {
							$output .= ' alt="' . esc_attr(  $logo_alt_text ). '"';
						}
						$output .= '>
					</a>
				</div><!-- .site-logo -->';
			}
		}

		return $output;
	}
endif; // studio_get_logo

if ( ! function_exists( 'studio_custom_css' ) ) :
	/**
	 * Enqueue Custom CSS
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Studio 0.4
	 */
	function studio_custom_css() {
		if( $studio_custom_css = get_theme_mod( 'custom_css' ) ) {

			$header_image  = studio_featured_overall_image();

			if ( ( '' != $header_image ) || ( !empty( $studio_custom_css ) ) ) {

				echo '<!-- '.get_bloginfo('name').' inline CSS Styles -->' . "\n" . '<style type="text/css" media="screen">' . "\n";

					// Has a Custom Header been added?
					if ( ( '' != $header_image ) ) :
						echo '#masthead {
							background: url(' . esc_url( $header_image ) . ') no-repeat 50% 50%;
							-webkit-background-size: cover;
							-moz-background-size:    cover;
							-o-background-size:      cover;
							background-size:         cover;
						}' . "\n";
					endif;

					if ( !empty( $studio_custom_css ) ) :
				 		echo $studio_custom_css . "\n";
				 	endif;

				echo '</style>' . "\n";
			}
		}
	}
endif; //studio_custom_css
add_action( 'wp_head', 'studio_custom_css', 101 );

if ( ! function_exists( 'studio_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @get comment setting from theme options and display comments sections accordingly
	 * @display comments_template
	 * @action studio_comment_section
	 *
	 * @since Studio 0.4
	 */
	function studio_get_comment_section() {
		$comment_option = get_theme_mod( 'comment_option', studio_get_default_theme_options( 'comment_option' ) );

		if ( 'use-wordpress-setting' == $comment_option ) {
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		}
		else if ( 'disable-in-pages' == $comment_option ) {
			if( ! is_page() )
				if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		}
}
endif;
add_action( 'studio_comment_section', 'studio_get_comment_section', 10 );

if ( ! function_exists( 'studio_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since Studio 0.4
	 */
	function studio_comment_form_fields( $fields ) {
		// get data value from theme options
	    $disableurl = get_theme_mod( 'disable_website_field', studio_get_default_theme_options( 'disable_website_field' ) );
		if ( isset( $fields['url'] ) && '1' == $disableurl  ) {
			unset( $fields['url'] );
		}

		return $fields;

	}
endif; //studio_comment_form_fields
add_filter( 'comment_form_default_fields', 'studio_comment_form_fields' );

if ( ! function_exists( 'studio_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Studio 0.4
	 */
	function studio_excerpt_length( $length ) {
		// Getting data from Customizer Options
		$length	= get_theme_mod( 'excerpt_length', studio_get_default_theme_options( 'excerpt_length' ) );
		return $length;
	}
endif; //studio_excerpt_length
add_filter( 'excerpt_length', 'studio_excerpt_length', 999 );

if ( ! function_exists( 'studio_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Studio 0.4
	 */
	function studio_continue_reading() {
		// Getting data from Customizer Options
		$more_tag_text	= get_theme_mod( 'excerpt_more_text', studio_get_default_theme_options( 'excerpt_more_text' ) );

		return ' <a class="more-link" href="'. esc_url( get_permalink() ) . '">' .  sprintf( __( '%s', 'studio' ) , $more_tag_text ) . '</a>';
	}
endif; //studio_continue_reading
add_filter( 'excerpt_more', 'studio_continue_reading' );

/**
 * Alter the query for the main loop in homepage
 *
 * @action pre_get_posts
 *
 * @since Studio 1.0
 */
function studio_alter_home( $query ){
	if( $query->is_main_query() && $query->is_home() ) {
		$cats = get_theme_mod( 'front_page_category', studio_get_default_theme_options( 'front_page_category' ) );

	    if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] =  $cats;
		}
	}
}
add_action( 'pre_get_posts','studio_alter_home' );

if ( ! function_exists( 'studio_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply studio your own studio_archive_content_image(), and that function will be used instead.
	 *
	 * @since Studio 1.0
	 */
	function studio_archive_content_image() {
		$featured_image = get_theme_mod( 'content_layout', studio_get_default_theme_options( 'content_layout' ) );
		$theme_layout 	= get_theme_mod( 'theme_layout', studio_get_default_theme_options( 'theme_layout' ) );

		if ( has_post_thumbnail() && 'full-content' != $featured_image ) {
		?>
			<figure class="entry-thumbnail">
				<?php
					if ( 'excerpt-image-top' == $featured_image  ) {
	                    if ( 'left-sidebar' == $theme_layout || 'right-sidebar' == $theme_layout ) {
	                    	the_post_thumbnail( 'studio-single-sidebar' );
	                	}
	                	elseif ( 'no-sidebar-full-width' == $theme_layout ) {
		                    the_post_thumbnail( 'full' );
		                }
	                	else {
	                		the_post_thumbnail( 'studio-single' );
	                	}
	                }
				?>
	        </figure>
	   	<?php
		}
	}
endif; //studio_archive_content_image
add_action( 'studio_before_entry_container', 'studio_archive_content_image', 10 );