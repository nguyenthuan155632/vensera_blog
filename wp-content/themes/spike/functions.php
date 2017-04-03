<?php
/*-----------------------------------------------------------------------------------*/
/*	Do not remove these lines, sky will fall on your head.
/*-----------------------------------------------------------------------------------*/
define( 'MTS_THEME_NAME', 'spike' );
require_once( dirname( __FILE__ ) . '/theme-options.php' );
if ( ! isset( $content_width ) ) $content_width = 960;

/*-----------------------------------------------------------------------------------*/
/*	Load Options
/*-----------------------------------------------------------------------------------*/
$mts_options = get_option('spike');

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'mythemeshop', get_template_directory().'/lang' );

/*-----------------------------------------------------------------------------------*/
/*	Custom translations
/*-----------------------------------------------------------------------------------*/
if (!empty($mts_options['translate'])) {
    $mts_translations = get_option('mts_translations_'.'spike');//$mts_options['translations'];
    function mts_custom_translate( $translated_text, $text, $domain ) {
        if ($domain == 'mythemeshop' || $domain == 'nhp-opts') {
        	// get options['translations'][$text] and return value
            global $mts_translations;
            
            if (!empty($mts_translations[$text])) {
                $translated_text = $mts_translations[$text];
            }
        }
    	return $translated_text;
        
    }
    add_filter( 'gettext', 'mts_custom_translate', 20, 3 );
}

if ( function_exists('add_theme_support') ) add_theme_support('automatic-feed-links');

/*-----------------------------------------------------------------------------------*/
/*	Post Thumbnail Support
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 298, 248, true );
	add_image_size( 'featured', 298, 248, true ); //featured
	add_image_size( 'featured1', 792, 320, true ); //featured1
	add_image_size( 'featured2', 384, 320, true ); //featured2
	add_image_size( 'featured3', 272, 226, true ); //featured3
	add_image_size( 'related', 140, 100, true ); //related
	add_image_size( 'widgetthumb', 65, 50, true ); //widget
	add_image_size( 'widgetbigthumb', 300, 180, true ); //widget Big Thumb
	add_image_size( 'slider', 850, 350, true ); //slider
	add_image_size( 'slider1', 1200, 490, true ); //slider1
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Menu Support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'primary-menu' => 'Primary Menu'
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/*	Enable Widgetized sidebar and Footer
/*-----------------------------------------------------------------------------------*/
function mts_register_sidebars(){
	$mts_options = get_option('spike');
	if ( function_exists('register_sidebar') ){
		register_sidebar(array(
			'name' => 'Sidebar',
			'description'   => __( 'Appears in Sidebar.', 'mythemeshop' ),
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
		if ($mts_options['mts_footer_widget'] != '0') {
			register_sidebar(array(
				'name' => 'Footer Widget 1',
				'description'   => __( 'Appears as first widget of footer.', 'mythemeshop' ),
				'id' => 'footer-1',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
			register_sidebar(array(
				'name' => 'Footer Widget 2',
				'description'   => __( 'Appears as second widget of footer.', 'mythemeshop' ),
				'id' => 'footer-2',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
			register_sidebar(array(
				'name' => 'Footer Widget 3',
				'description'   => __( 'Appears as third widget of footer.', 'mythemeshop' ),
				'id' => 'footer-3',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
		if ($mts_options['mts_footer_widget_columns'] == '4') {
			register_sidebar(array(
				'name' => 'Footer Widget 4',
				'description'   => __( 'Appears as fourth widget of footer.', 'mythemeshop' ),
				'id' => 'footer-4',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
		// Custom sidebars
        if (!empty($mts_options['mts_custom_sidebars']) && is_array($mts_options['mts_custom_sidebars'])) {
			foreach($mts_options['mts_custom_sidebars'] as $sidebar) {
				if (!empty($sidebar['mts_custom_sidebar_id']) && !empty($sidebar['mts_custom_sidebar_id']) && $sidebar['mts_custom_sidebar_id'] != 'sidebar-') {
					register_sidebar(array('name' => ''.$sidebar['mts_custom_sidebar_name'].'','id' => ''.sanitize_title(strtolower($sidebar['mts_custom_sidebar_id'])).'','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
				}
			}
		}
	}
}
add_action( 'widgets_init', 'mts_register_sidebars' );

function mts_custom_sidebar() {
    $mts_options = get_option('spike');
    
	// Default sidebar
	$sidebar = 'Sidebar';

	if (is_home() && !empty($mts_options['mts_sidebar_for_home'])) $sidebar = $mts_options['mts_sidebar_for_home'];	
    if (is_single() && !empty($mts_options['mts_sidebar_for_post'])) $sidebar = $mts_options['mts_sidebar_for_post'];
    if (is_page() && !empty($mts_options['mts_sidebar_for_page'])) $sidebar = $mts_options['mts_sidebar_for_page'];
    
    // Archives
	if (is_archive() && !empty($mts_options['mts_sidebar_for_archive'])) $sidebar = $mts_options['mts_sidebar_for_archive'];
	if (is_category() && !empty($mts_options['mts_sidebar_for_category'])) $sidebar = $mts_options['mts_sidebar_for_category'];
    if (is_tag() && !empty($mts_options['mts_sidebar_for_tag'])) $sidebar = $mts_options['mts_sidebar_for_tag'];
    if (is_date() && !empty($mts_options['mts_sidebar_for_date'])) $sidebar = $mts_options['mts_sidebar_for_date'];
	if (is_author() && !empty($mts_options['mts_sidebar_for_author'])) $sidebar = $mts_options['mts_sidebar_for_author'];
    
    // Other
    if (is_search() && !empty($mts_options['mts_sidebar_for_search'])) $sidebar = $mts_options['mts_sidebar_for_search'];
	if (is_404() && !empty($mts_options['mts_sidebar_for_notfound'])) $sidebar = $mts_options['mts_sidebar_for_notfound'];
	
	// Page/post specific custom sidebar
	if (is_page() || is_single()) {
		wp_reset_postdata();
		global $post;
        $custom = get_post_meta($post->ID,'_mts_custom_sidebar',true);
		if (!empty($custom)) $sidebar = $custom;
	}

	return $sidebar;
}

/*-----------------------------------------------------------------------------------*/
/*  Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/
// Add the 125x125 Ad Block Custom Widget
include("functions/widget-ad125.php");

// Add the 300x250 Ad Block Custom Widget
include("functions/widget-ad300.php");

// Add the Tabbed Custom Widget v2
include("functions/widget-tabs2.php");

// Add the Latest Tweets Custom Widget
include("functions/widget-tweets.php");

// Add Recent Posts Widget
include("functions/widget-recentposts.php");

// Add Related Posts Widget
include("functions/widget-relatedposts.php");

// Add Author Posts Widget
include("functions/widget-authorposts.php");

// Add Popular Posts Widget
include("functions/widget-popular.php");

// Add Facebook Like box Widget
include("functions/widget-fblikebox.php");

// Add Google Plus box Widget
include("functions/widget-googleplus.php");

// Add Subscribe Widget
include("functions/widget-subscribe.php");

// Add Social Profile Widget
include("functions/widget-social.php");

// Add Category Posts Widget
include("functions/widget-catposts.php");

// Add Welcome message
include("functions/welcome-message.php");

// Theme Functions
include("functions/theme-actions.php");

// Plugin Activation
include("functions/class-tgm-plugin-activation.php");


/*-----------------------------------------------------------------------------------*/
/*	Filters customize wp_title
/*-----------------------------------------------------------------------------------*/
function mts_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mythemeshop' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mts_wp_title', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/
function mts_add_scripts() {
	$mts_options = get_option('spike');

	wp_enqueue_script('jquery');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
	
	wp_register_script('customscript', get_template_directory_uri() . '/js/customscript.js', true);
	wp_enqueue_script ('customscript');

	//Slider
	if($mts_options['mts_featured_slider'] == '1' && !is_singular()) {
		wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.imagesloaded.js');
		wp_enqueue_script ('flexslider');
	}

	//lightbox
	if($mts_options['mts_lightbox'] == '1') {
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'style');
		wp_enqueue_script('prettyPhoto');
	}

	global $is_IE;
    if ($is_IE) {
        wp_register_script ('html5shim', "http://html5shim.googlecode.com/svn/trunk/html5.js");
        wp_enqueue_script ('html5shim');
	}
}
add_action('wp_enqueue_scripts','mts_add_scripts');
   
function mts_load_footer_scripts() {  
	$mts_options = get_option('spike');

	//Sticky Nav
	if($mts_options['mts_sticky_nav'] == '1') {
		wp_register_script('StickyNav', get_template_directory_uri() . '/js/sticky.js', true);
		wp_enqueue_script('StickyNav');
	}

	// Ajax Load More and Search Results
    wp_register_script('mts_ajax', get_template_directory_uri() . '/js/ajax.js', true);
	if($mts_options['mts_pagenavigation_type'] != '' && $mts_options['mts_pagenavigation_type'] >= 2 && !is_singular()) {
		wp_enqueue_script('mts_ajax');
		wp_register_script('historyjs', get_template_directory_uri() . '/js/history.js', true);
        wp_enqueue_script('historyjs');
        
        // Add parameters for the JS
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        $autoload = ($mts_options['mts_pagenavigation_type'] == 3);
        wp_localize_script(
        	'mts_ajax',
        	'mts_ajax_loadposts',
        	array(
        		'startPage' => $paged,
        		'maxPages' => $max,
        		'nextLink' => next_posts($max, false),
                'autoLoad' => $autoload,
                'i18n_loadmore' => __('Load More Stories +', 'mythemeshop'),
                'i18n_nomore' => __('No More Posts', 'mythemeshop')
        	)
        );
	}
	if(!empty($mts_options['mts_ajax_search']) && $mts_options['mts_ajax_search'] == '1') {
        wp_enqueue_script('mts_ajax');
        wp_localize_script(
        	'mts_ajax',
        	'mts_ajax_search',
        	array(
				'url' => admin_url('admin-ajax.php')
        	)
        );
        
    }
}  
add_action('wp_footer', 'mts_load_footer_scripts');  

if(!empty($mts_options['mts_ajax_search'])) {
    add_action('wp_ajax_mts_search', 'ajax_mts_search');
    add_action('wp_ajax_nopriv_mts_search', 'ajax_mts_search');
}

function mts_nojs_js_class() {
    echo '<script type="text/javascript">document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/,\'js\');</script>';
}
add_action('wp_head', 'mts_nojs_js_class');

/*-----------------------------------------------------------------------------------*/
/* Enqueue CSS
/*-----------------------------------------------------------------------------------*/
function mts_enqueue_css() {
	$mts_options = get_option('spike');
	
	//slider
	if($mts_options['mts_featured_slider'] == '1' && !is_singular()) {
		wp_register_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', 'style');
		wp_enqueue_style('flexslider');
	}
	
	//lightbox
	if($mts_options['mts_lightbox'] == '1') {
		wp_register_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');
		wp_enqueue_style('prettyPhoto');
	}
	
	//Font Awesome
	wp_register_style('fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', 'style');
	wp_enqueue_style('fontawesome');
	global $is_IE;
    if ($is_IE) {
       wp_register_style('ie7-fontawesome', get_template_directory_uri() . '/css/font-awesome-ie7.min.css', 'style');
	   wp_enqueue_style('ie7-fontawesome');
	}
	
	wp_enqueue_style('stylesheet', get_stylesheet_directory_uri() . '/style.css', 'style');
	
	//Responsive
	if($mts_options['mts_responsive'] == '1') {
        wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', 'style');
	}
	if ($mts_options['mts_header_bg_pattern_upload'] != '') {
		$mts_header_bg = $mts_options['mts_header_bg_pattern_upload'];
	} else {
		if($mts_options['mts_header_bg_pattern'] != '') {
			$mts_header_bg = get_template_directory_uri().'/images/'.$mts_options['mts_header_bg_pattern'].'.png';
		}
	}
	if ($mts_options['mts_bg_pattern_upload'] != '') {
		$mts_bg = $mts_options['mts_bg_pattern_upload'];
	} else {
		if($mts_options['mts_bg_pattern'] != '') {
			$mts_bg = get_template_directory_uri().'/images/'.$mts_options['mts_bg_pattern'].'.png';
		} 
	}
	if ($mts_options['mts_footer_bg_pattern_upload'] != '') {
		$mts_footer_bg = $mts_options['mts_footer_bg_pattern_upload'];
	} else {
		if($mts_options['mts_footer_bg_pattern'] != '') {
			$mts_footer_bg = get_template_directory_uri().'/images/'.$mts_options['mts_footer_bg_pattern'].'.png';
		}
	}
	
	$mts_hex = $mts_options['mts_color_scheme'];
	list($mts_r, $mts_g, $mts_b) = sscanf($mts_hex, "#%02x%02x%02x");
	
	$mts_gridlayout = '';
	$mts_gridslayout = '';
	$mts_biglayout = '';
	$mts_sclayout = '';
	$mts_rclayout = '';
	$mts_clayout = '';
	$mts_shareit_left = '';
	$mts_shareit_right = '';
	$mts_author = '';
	$mts_header_section = '';
	if ($mts_options['mts_layout'] == 'gridlayout') {
		$mts_gridlayout = '.home .article, .archive .article, .search-results .article { padding: 0; width: 100%; }
			.latestPost { margin: 0 2% 20px 0; width: 32%; }
			#featured-thumbnail { margin: 0 0 10px; width: 100%; }
			.featured-thumbnail { width: 100%; }';
	}
	if ($mts_options['mts_layout'] == 'gridslayout' || $mts_options['mts_layout'] == 'gridslayoutleft') {
		$mts_gridslayout = '.latestPost { margin: 0 2% 20px 0; width: 32%; }
			#featured-thumbnail { margin: 0 0 10px; width: 100%; }
			.featured-thumbnail { width: 100%; }';
	}
	if ($mts_options['mts_layout'] == 'biglayout') {
		$mts_biglayout = '.home .article, .archive .article, .search-results .article { padding: 0; width: 100%; }
			.latestPost { margin: 0 2% 20px 0; width: 32%; }
			.latestBigPost { width: 66%; }
			#featured-thumbnail { margin: 0 0 10px; width: 100%; }
			.featured-thumbnail { width: 100%; }';
	}
	if ($mts_options['mts_layout'] == 'thumblayout') {
		$mts_biglayout = '.home .article, .archive .article, .search-results .article { padding: 0; width: 100%; }
			.latestPost { margin: 0 2% 20px 0; width: 32%; }
			.latestBigPost { width: 64%; }
			#featured-thumbnail { margin: 0 0 10px; width: 100%; position: relative; }
			.featured-thumbnail { width: 100%; }
			.thumb-hover { display: none; position: absolute; bottom: 0; background: rgba(0,0,0,0.5); padding: 10px 2%; width: 96% }
			.thumb-hover .post-info { border: 0; padding: 0; }
			.thumb-hover .title { color: #fff; font-size: 18px; }
			#featured-thumbnail:hover .thumb-hover { display: block; }';
	}
	if ($mts_options['mts_layout'] == 'thumbslayout' || $mts_options['mts_layout'] == 'thumbslayoutleft') {
		$mts_gridslayout = '.latestPost { margin: 0 2% 20px 0; width: 32%; }
			#featured-thumbnail { margin: 0 0 10px; width: 100%; position: relative; }
			.featured-thumbnail { width: 100%; }
			.thumb-hover { display: none; position: absolute; bottom: 0; background: rgba(0,0,0,0.5); padding: 10px 2%; width: 96% }
			.thumb-hover .post-info { border: 0; padding: 0; }
			.thumb-hover .title { color: #fff; font-size: 18px; }
			#featured-thumbnail:hover .thumb-hover { display: block; }';
	}
	if (is_page() || is_single()) {
        $mts_sidebar_location = get_post_meta( get_the_ID(), '_mts_sidebar_location', true );
    } else {
        $mts_sidebar_location = '';
    }
	if ($mts_sidebar_location != 'right' && ($mts_options['mts_layout'] == 'sclayout' || $mts_sidebar_location == 'left' || $mts_options['mts_layout'] == 'thumbslayoutleft' || $mts_options['mts_layout'] == 'gridslayoutleft')) {
		$mts_sclayout = '.article { float: right; padding: 0; }
		.sidebar.c-4-12 { float: left; padding-right: 2%; padding-left: 0; }';
		if($mts_options['mts_social_button_position'] == '3') {
			$mts_shareit_right = '.shareit { margin: 0 760px 0; border-left: 0; }';
		}
	}
	if ($mts_options['mts_single_post_layout'] == 'rclayout') {
		$mts_rclayout = '.post-single-content { float: right; } .single_post_right { float: left; }';
	}
	if ($mts_options['mts_single_post_layout'] == 'clayout' || $mts_options['mts_single_post_layout'] == 'cbrlayout') {
		$mts_clayout = '.single_post_below { float: left; width: 100%; margin-top: 27px; }
		.single_post_below .related-posts li { margin: 0 2% 0 0; width: 23.5%; } .relatedthumb { float: left; width: 100% }
		.post-single-content, .single_post_below .rthumb, .relatedthumb img { width: 100% }
		.post-single-content { max-width: 850px; }
		.single_post_below .related-posts h3 { font-weight: 700 }';
	}
	if ($mts_options['mts_header_section2'] == '0') {
		$mts_header_section = '.logo-wrap, .widget-header { display: none; }
		.secondary-navigation { float: left; margin-left: 2%; padding-bottom: 5px; width: 96%; }
		#navigation > ul > .menu-item-has-children > a { padding-bottom: 15px;}
		#navigation > ul > li > a:hover { margin-bottom: 0; }
		#navigation { border-top: 0; margin-top: 15px; }
		#header { min-height: 47px; }';
	}
	if($mts_options['mts_social_button_position'] == '3') {
		$mts_shareit_left = '.shareit { top: 282px; left: auto; z-index: 0; margin: 0 0 0 -123px; width: 90px; position: fixed; overflow: hidden; padding: 5px; border:none; border-right: 0;}
		.share-item {margin: 2px;}';
	}
	if($mts_options['mts_author_comment'] == '1') {
		$mts_author = '.bypostauthor .commentmetadata {background: rgba(0, 0, 0, 0.02);border: 1px solid rgba(0, 0, 0, 0.06);}
		.bypostauthor .commentmetadata:after { font-size: 12px; content: "'.__('Author','mythemeshop').'"; position: absolute; right: 0; top: 0; padding: 1px 10px; background: rgba(0, 0, 0, 0.2); color: #FFF; }';
	}
	$custom_css = "
		body {background-color:{$mts_options['mts_bg_color']}; }
		body {background-image: url({$mts_bg});}
		.main-header { background-color: {$mts_options['mts_header_bg_color']}; background-image: url({$mts_header_bg});}
		footer {background-color:{$mts_options['mts_footer_bg_color']}; background-image: url({$mts_footer_bg});}
		#navigation ul .current-menu-item a, #navigation ul li:hover > a, #navigation ul .current-menu-item:before, #navigation ul li:hover:before, #navigation ul li:hover:after, .postauthor h5, .single_post a, .textwidget a, .pnavigation2 a, .sidebar.c-4-12 a:hover, .copyrights a:hover, footer .widget li a:hover, .sidebar.c-4-12 a:hover, .related-posts a:hover, .title a:hover, .post-info a:hover,.comm, #tabber .inside li a:hover, .readMore a:hover, a, a:hover { color:{$mts_options['mts_color_scheme']}; }	
			.reply a, .flex-control-paging li a.flex-active, .currenttext, .pagination a:hover, .single .pagination a:hover .currenttext, .sbutton, #searchsubmit, #commentform input#submit, .contactform #submit, .mts-subscribe input[type='submit'], #move-to-top:hover, #searchform .icon-search, .tagcloud a, a#pull, .secondary-navigation.mobile, .mobile #navigation, #load-posts > a, .pace .pace-progress, .widget_tabs2 .pagination a, .pagination .nav-previous a:hover, .pagination .nav-next a:hover, .flex-control-paging li a:hover, #featured-thumbnail .review-total-only { background-color:{$mts_options['mts_color_scheme']}; color: #fff!important; }
		.flex-control-thumbs .flex-active { border-top:3px solid {$mts_options['mts_color_scheme']};}
		#navigation ul .current-menu-item a, #navigation > ul > li > a:hover { border-bottom: 1px solid {$mts_options['mts_color_scheme']}; }
		.tagcloud a .tab_count, .flex-control-paging li a, #logo, #load-posts > a:hover, #searchform .sbutton:hover, .mts-subscribe input[type='submit']:hover { background-color:{$mts_options['mts_color_scheme2']}; }
		.pagination a {color:{$mts_options['mts_color_scheme2']}; }
		.pagination a, .pagination2 { border: 1px solid {$mts_options['mts_color_scheme2']}; }
		.currenttext, .pagination a:hover, .pagination2:hover, .widget_tabs2 .pagination a { border: 1px solid {$mts_options['mts_color_scheme']}; }
		#navigation ul ul { border-top: 1px solid {$mts_options['mts_color_scheme']}; }
		.slidertitle, .slidertext { background: rgba({$mts_r},{$mts_g},{$mts_b}, 0.7) }
		#wpmm-megamenu { border-top: 1px solid {$mts_options['mts_color_scheme']};}
		#navigation > ul > li.menu-item-wpmm-megamenu > a:hover, #navigation > ul > li.wpmm-megamenu-showing > a { border: none; color: {$mts_options['mts_color_scheme']} !important; }
		{$mts_gridlayout}
		{$mts_gridslayout}
		{$mts_biglayout}
		{$mts_sclayout}
		{$mts_rclayout}
		{$mts_clayout}
		{$mts_shareit_left}
		{$mts_shareit_right}
		{$mts_author}
		{$mts_header_section}
		{$mts_options['mts_custom_css']}
			";
	wp_add_inline_style( 'stylesheet', $custom_css );
}
add_action('wp_enqueue_scripts', 'mts_enqueue_css', 99);

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
add_filter('the_content_rss', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Custom Comments template
/*-----------------------------------------------------------------------------------*/
function mts_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" style="position:relative;">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment->comment_author_email, 68 ); ?>
				<?php $mts_options = get_option('spike'); if($mts_options['mts_comment_date'] == '1') { ?>
					<span class="ago"><?php comment_date(get_option( 'date_format' )); ?></span>
				<?php } ?>
				<span class="comment-meta">
					<?php edit_comment_link(__('(Edit)', 'mythemeshop'),'  ','') ?>
				</span>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.', 'mythemeshop') ?></em>
				<br />
			<?php endif; ?>
			<div class="commentmetadata">
				<?php printf(__('<span class="fn">%s</span>', 'mythemeshop'), get_comment_author_link()) ?> 
				<?php comment_text() ?>
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</div>
	</li>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Content Excerpts
/*-----------------------------------------------------------------------------------*/
function new_excerpt_length($length) {
	return 100;
}
add_filter('excerpt_length', 'new_excerpt_length');

function mts_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/*-----------------------------------------------------------------------------------*/
/* nofollow to next/previous links
/*-----------------------------------------------------------------------------------*/
function mts_pagination_add_nofollow($content) {
    return 'rel="nofollow"';
}
add_filter('next_posts_link_attributes', 'mts_pagination_add_nofollow' );
add_filter('previous_posts_link_attributes', 'mts_pagination_add_nofollow' );

/*-----------------------------------------------------------------------------------*/
/* Nofollow to category links
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_category', 'mts_add_nofollow_cat' ); 
function mts_add_nofollow_cat( $text ) {
$text = str_replace('rel="category tag"', 'rel="nofollow"', $text); return $text;
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow post author link
/*-----------------------------------------------------------------------------------*/
add_filter('the_author_posts_link', 'mts_nofollow_the_author_posts_link');
function mts_nofollow_the_author_posts_link ($link) {
return str_replace('<a href=', '<a rel="nofollow" href=',$link); 
}

/*-----------------------------------------------------------------------------------*/	
/* nofollow to reply links
/*-----------------------------------------------------------------------------------*/
function mts_add_nofollow_to_reply_link( $link ) {
return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
}
add_filter( 'comment_reply_link', 'mts_add_nofollow_to_reply_link' );

/*-----------------------------------------------------------------------------------*/
/* removes the WordPress version from your header for security
/*-----------------------------------------------------------------------------------*/
function wb_remove_version() {
	return '<!--Theme by MyThemeShop.com-->';
}
add_filter('the_generator', 'wb_remove_version');
	
/*-----------------------------------------------------------------------------------*/
/* Removes Trackbacks from the comment count
/*-----------------------------------------------------------------------------------*/
add_filter('get_comments_number', 'mts_comment_count', 0);
function mts_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments = get_comments('status=approve&post_id=' . $id);
		$comments_by_type = separate_comments($comments);
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* adds a class to the post if there is a thumbnail
/*-----------------------------------------------------------------------------------*/
function has_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter('post_class', 'has_thumb_class');
	
/*-----------------------------------------------------------------------------------*/	
/* Breadcrumb
/*-----------------------------------------------------------------------------------*/
function mts_the_breadcrumb() {
	echo '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="';
	echo home_url();
	echo '" rel="nofollow"><i class="icon-home"></i>&nbsp;'.__('Home','mythemeshop');
	echo "</a></span>&nbsp;>&nbsp;";
	if (is_category() || is_single()) {
		$categories = get_the_category();
		$output = '';
		if($categories){
			foreach($categories as $category) {
				echo '<span typeof="v:Breadcrumb"><a href="'.get_category_link( $category->term_id ).'" rel="v:url" property="v:title">'.$category->cat_name.'</a></span>&nbsp;>&nbsp;';
			}
		}
		if (is_single()) {
			echo "<span typeof='v:Breadcrumb'><span property='v:title'>";
			the_title();
			echo "</span></span>";
		}
	} elseif (is_page()) {
		echo "<span typeof='v:Breadcrumb'><span property='v:title'>";
		the_title();
		echo "</span></span>";
	}
}

/*-----------------------------------------------------------------------------------*/	
/* Pagination
/*-----------------------------------------------------------------------------------*/
function mts_pagination($pages = '', $range = 3) { 
	$showitems = ($range * 3)+1;
	global $paged; if(empty($paged)) $paged = 1;
	if($pages == '') {
		global $wp_query; $pages = $wp_query->max_num_pages; 
		if(!$pages){ $pages = 1; } 
	}
	if(1 != $pages) { 
		echo "<div class='pagination'><ul>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
			echo "<li><a rel='nofollow' href='".get_pagenum_link(1)."'>&laquo; ".__('First','mythemeshop')."</a></li>";
		if($paged > 1 && $showitems < $pages) 
			echo "<li><a rel='nofollow' href='".get_pagenum_link($paged - 1)."' class='inactive'>&lsaquo; ".__('Previous','mythemeshop')."</a></li>";
		for ($i=1; $i <= $pages; $i++){ 
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) { 
				echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a rel='nofollow' href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
			} 
		} 
		if ($paged < $pages && $showitems < $pages) 
			echo "<li><a rel='nofollow' href='".get_pagenum_link($paged + 1)."' class='inactive'>".__('Next','mythemeshop')." &rsaquo;</a></li>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
			echo "<li><a rel='nofollow' class='inactive' href='".get_pagenum_link($pages)."'>".__('Last','mythemeshop')." &raquo;</a></li>";
			echo "</ul></div>"; 
	}
}

/*-----------------------------------------------------------------------------------*/	
/* AJAX Search results
/*-----------------------------------------------------------------------------------*/
function ajax_mts_search() {
    $query = $_REQUEST['q'];//esc_html($_REQUEST['q']);
    // No need to esc as WP_Query escapes data before performing the database query
    $search_query = new WP_Query(array('s' => $query, 'posts_per_page' => 3));
    $search_count = new WP_Query(array('s' => $query, 'posts_per_page' => -1));
    $search_count = $search_count->post_count;
    if (!empty($query) && $search_query->have_posts()) : 
        //echo '<h5>Results for: '. $query.'</h5>';
        echo '<ul class="ajax-search-results">';
        while ($search_query->have_posts()) : $search_query->the_post();
            ?><li>
    			<a href="<?php the_permalink(); ?>">
					<?php if(has_post_thumbnail()): ?>
						<?php the_post_thumbnail('widgetthumb',array('title' => '')); ?>
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/images/smallthumb.png" alt="<?php the_title(); ?>" class="wp-post-image" />
					<?php endif; ?>
                    
    				<?php the_title(); ?>	
    			</a>
    			<div class="meta">
    					<span class="thetime"><?php the_time('F j, Y'); ?></span>
    			</div> <!-- / .meta -->

    		</li>	
    		<?php
        endwhile;
        echo '</ul>';
        echo '<div class="ajax-search-meta"><span class="results-count">'.$search_count.' '.__('Results', 'mythemeshop').'</span><a href="'.get_search_link($query).'" class="results-link">Show all results</a></div>';
    else:
        echo '<div class="no-results">'.__('No results found.', 'mythemeshop').'</div>';
    endif;
        
    exit; // required for AJAX in WP
}

/*-----------------------------------------------------------------------------------*/
/* Redirect feed to feedburner
/*-----------------------------------------------------------------------------------*/
$mts_options = get_option('spike');
if ( $mts_options['mts_feedburner'] != '') {
	function mts_rss_feed_redirect() {
	    $mts_options = get_option('spike');
	    global $feed;
	    $new_feed = $mts_options['mts_feedburner'];
	    if (!is_feed()) {
	            return;
	    }
	    if (preg_match('/feedburner/i', $_SERVER['HTTP_USER_AGENT'])){
	            return;
	    }
	    if ($feed != 'comments-rss2') {
	            if (function_exists('status_header')) status_header( 302 );
	            header("Location:" . $new_feed);
	            header("HTTP/1.1 302 Temporary Redirect");
	            exit();
	    }
}
add_action('template_redirect', 'mts_rss_feed_redirect');
}

/*-----------------------------------------------------------------------------------*/
/* Single Post Pagination
/*-----------------------------------------------------------------------------------*/
function mts_wp_link_pages_args_prevnext_add($args)
{
    global $page, $numpages, $more, $pagenow;
    if (!$args['next_or_number'] == 'next_and_number')
        return $args; 
    $args['next_or_number'] = 'number'; 
    if (!$more)
        return $args; 
    if($page-1) 
        $args['before'] .= _wp_link_page($page-1)
        . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
    ;
    if ($page<$numpages) 
    
        $args['after'] = _wp_link_page($page+1)
        . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
        . $args['after']
    ;
    return $args;
}
add_filter('wp_link_pages_args', 'mts_wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------*/
/* add <!-- next-page --> button to tinymce
/*-----------------------------------------------------------------------------------*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
   $pos = array_search('wp_more',$mce_buttons,true);
   if ($pos !== false) {
       $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
       $tmp_buttons[] = 'wp_page';
       $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
   }
   return $mce_buttons;
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'mts_custom_gravatar' ) ) {
    function mts_custom_gravatar( $avatar_defaults ) {
        $mts_avatar = get_bloginfo('template_directory') . '/images/gravatar.png';
        $avatar_defaults[$mts_avatar] = 'Custom Gravatar (/images/gravatar.png)';
        return $avatar_defaults;
    }
    add_filter( 'avatar_defaults', 'mts_custom_gravatar' );
}

/*-----------------------------------------------------------------------------------*/
/* Tag Widget
/*-----------------------------------------------------------------------------------*/
function mts_tag_cloud() {
	$tags = get_tags( array('orderby' => 'count', 'order' => 'DESC') );
	foreach ( (array) $tags as $tag ) {
	echo '<a href="'.get_tag_link ($tag->term_id).'"><span class="tab_count">'.$tag->count.'</span><span class="tab_name">'.$tag->name.'</span></a>';
	}
}
add_filter('wp_tag_cloud', 'mts_tag_cloud');

/*-----------------------------------------------------------------------------------*/
/*	Sidebar Selection meta box
/*-----------------------------------------------------------------------------------*/
function mts_add_sidebar_metabox() {

    $screens = array('post', 'page');

    foreach ($screens as $screen) {
        add_meta_box(
            'mts_sidebar_metabox',                  // id
            __('Sidebar', 'mythemeshop'),    // title
            'mts_inner_sidebar_metabox',            // callback
            $screen,                                // post_type
            'side',                                 // context (normal, advanced, side)
            'high'                               // priority (high, core, default, low)
        );
    }
}
add_action('add_meta_boxes', 'mts_add_sidebar_metabox');

/*-----------------------------------------------------------------------------------*/
/*  TGM plugin activation
/*-----------------------------------------------------------------------------------*/
function mts_plugins() {
	// Add the following plugins
	$plugins = array(
        array(
            'name'      => 'WP Shortcode by MyThemeShop',
            'slug'      => 'wp-shortcode',
            'required'  => false,
        ),
        array(
            'name'      => 'WP Review by MyThemeShop',
            'slug'      => 'wp-review',
            'required'  => false,
        ),
        array(
            'name'      => 'MyThemeShop Connect',
            'slug'      => 'mythemeshop-connect',
            'required'  => false,
        ),
	);
	// Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'mythemeshop';
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'mythemeshop-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'mythemeshop' ),
				'menu_title'                       			=> __( 'Theme Plugins', 'mythemeshop' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'mythemeshop' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'mythemeshop' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme requires the following plugin to enable extra features: %1$s.', 'This theme requires the following plugin to enable extra features: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'mythemeshop' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'mythemeshop' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'mythemeshop' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa($plugins, $config);
	}
add_action( 'tgmpa_register', 'mts_plugins' );

/*-----------------------------------------------------------------------------------*/
/* Print the box content.
/* 
/* @param WP_Post $post The object for the current post/page.
/*-----------------------------------------------------------------------------------*/
function mts_inner_sidebar_metabox($post) {
    global $wp_registered_sidebars;
    
    // Add an nonce field so we can check for it later.
    wp_nonce_field('mts_inner_sidebar_metabox', 'mts_inner_sidebar_metabox_nonce');
    
    /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
    $custom_sidebar = get_post_meta( $post->ID, '_mts_custom_sidebar', true );
    $sidebar_location = get_post_meta( $post->ID, '_mts_sidebar_location', true );

    // Select custom sidebar from dropdown
    echo '<select name="mts_custom_sidebar" style="margin-bottom: 10px;">';
    echo '<option value="" '.selected('', $custom_sidebar).'>Default</option>';
    
    // Exclude built-in sidebars
    $hidden_sidebars = array('sidebar', 'footer-1', 'footer-2', 'footer-3', 'footer-4', 'widget-header');    
    
    foreach ($wp_registered_sidebars as $sidebar) {
        if (!in_array($sidebar['id'], $hidden_sidebars)) {
            echo '<option value="'.esc_attr($sidebar['id']).'" '.selected($sidebar['id'], $custom_sidebar, false).'>'.$sidebar['name'].'</option>';
        }
    }
    echo '</select><br />';
    
    // Select single layout (left/right sidebar)
    echo '<label for="mts_sidebar_location_default" style="display: inline-block; margin-right: 20px;"><input type="radio" name="mts_sidebar_location" id="mts_sidebar_location_default" value=""'.checked('', $sidebar_location, false).'>Default side</label>';
    echo '<label for="mts_sidebar_location_left" style="display: inline-block; margin-right: 20px;"><input type="radio" name="mts_sidebar_location" id="mts_sidebar_location_left" value="left"'.checked('left', $sidebar_location, false).'>Left</label>';
    echo '<label for="mts_sidebar_location_right" style="display: inline-block; margin-right: 20px;"><input type="radio" name="mts_sidebar_location" id="mts_sidebar_location_right" value="right"'.checked('right', $sidebar_location, false).'>Right</label>';
     
    //debug
    global $wp_meta_boxes;
}

/*-----------------------------------------------------------------------------------*/
/* When the post is saved, saves our custom data.
/*
/* @param int $post_id The ID of the post being saved.
/*-----------------------------------------------------------------------------------*/
function mts_save_custom_sidebar( $post_id ) {
    
    /*
    * We need to verify this came from our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */
    
    // Check if our nonce is set.
    if ( ! isset( $_POST['mts_inner_sidebar_metabox_nonce'] ) )
    return $post_id;
    
    $nonce = $_POST['mts_inner_sidebar_metabox_nonce'];
    
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'mts_inner_sidebar_metabox' ) )
      return $post_id;
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;
    
    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {
    
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
    
    } else {
    
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    }
    
    /* OK, its safe for us to save the data now. */
    
    // Sanitize user input.
    $sidebar_name = sanitize_text_field( $_POST['mts_custom_sidebar'] );
    $sidebar_location = sanitize_text_field( $_POST['mts_sidebar_location'] );
    
    // Update the meta field in the database.
    update_post_meta( $post_id, '_mts_custom_sidebar', $sidebar_name );
    update_post_meta( $post_id, '_mts_sidebar_location', $sidebar_location );
}
add_action( 'save_post', 'mts_save_custom_sidebar' );

/*-----------------------------------------------------------------------------------*/
/* Return an ID of an attachment by searching the database with the file URL.
/*
/* @return {int} $attachment
/*-----------------------------------------------------------------------------------*/
function mts_get_attachment_id_by_url($url) {
 
	// Split the $url into two parts with the wp-content directory as the separator.
	$parse_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );
 
	// Get the host of the current site and the host of the $url, ignoring www.
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );
 
	// Return nothing if there aren't any $url parts or if the current host and $url host do not match.
	if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) )
		return;
 
	// Now we're going to quickly search the DB for any attachment GUID with a partial path match.
	// Example: /uploads/2013/05/test-image.jpg
	global $wpdb;
 
	$prefix     = $wpdb->prefix;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM " . $prefix . "posts WHERE guid RLIKE %s;", $parse_url[1] ) );
 
	// Returns null if no attachment is found.
	return $attachment[0];
}

function megamenu_parent_element( $selector ) {
	return '.secondary-navigation';
}
add_filter( 'wpmm_container_selector', 'megamenu_parent_element' );
?>