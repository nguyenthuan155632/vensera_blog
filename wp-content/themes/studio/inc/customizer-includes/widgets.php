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

	//Header Right
	register_sidebar( array(
		'name'          => __( 'Header Right', 'studio' ),
		'id'            => 'header-right',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- #widget-default-search -->',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		'description'	=> __( 'This is the header right widget area. It typically appears on the right of the site title or logo. This widget area is not equipped to display any widget, and works best with a custom menu assigned as header right menu, a search form, social icons widget or possibly a text widget.', 'studio' ),
	) );

	//Featured Widget Content
	register_sidebar( array(
		'name'          => __( 'Featured Widget Content', 'studio' ),
		'id'            => 'featured-widget-content',
		'before_widget' => '<section id="%1$s" class="hentry widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- #widget-default-search -->',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
		'description'	=> __( 'This is the Featured Widget Content. Enable it by going to Appearance => Customize => Featured Widget Content Options => Enable Featured content Widget Content on', 'studio' ),
	) );

	//Promotion Headline Left
	register_sidebar( array(
		'name'          => __( 'Promotion Headline Left', 'studio' ),
		'id'            => 'promotion-headline-left',
		'before_widget' => '<div id="%1$s" class="section left">',
		'after_widget'  => '</div><!-- .section .left -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> __( 'This is the Promotion Headline Left. Enable it by going to Appearance => Customize => Theme Options => Promotion Headline Options.', 'studio' ),
	) );

	//Promotion Headline Right
	register_sidebar( array(
		'name'          => __( 'Promotion Headline Right', 'studio' ),
		'id'            => 'promotion-headline-right',
		'before_widget' => '<div id="%1$s" class="section right">',
		'after_widget'  => '</div><!-- .section .right -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> __( 'This is the Promotion Headline Right. Enable it by going to Appearance => Customize => Theme Options => Promotion Headline Options.', 'studio' ),
	) );

	//Optional Sidebar for Hompeage instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Homepage Sidebar', 'studio' ),
		'id' 				=> 'sidebar-optional-homepage',
		'description'		=> __( 'This is Optional Sidebar for Homepage', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	//Optional Sidebar for Archive instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Archive Sidebar', 'studio' ),
		'id' 				=> 'sidebar-optional-archive',
		'description'		=> __( 'This is Optional Sidebar for Archive', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	//Optional Sidebar for Page instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Page Sidebar', 'studio' ),
		'id' 				=> 'sidebar-optional-page',
		'description'		=> __( 'This is Optional Sidebar for Page', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	//Optional Sidebar for Post instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Post Sidebar', 'studio' ),
		'id' 				=> 'sidebar-optional-post',
		'description'		=> __( 'This is Optional Sidebar for Post', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	//Optional Sidebar one for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar One', 'studio' ),
		'id' 				=> 'sidebar-optional-one',
		'description'		=> __( 'This is Optional Sidebar One', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	//Optional Sidebar two for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar Two', 'studio' ),
		'id' 				=> 'sidebar-optional-two',
		'description'		=> __( 'This is Optional Sidebar Two', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	//Optional Sidebar Three for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar Three', 'studio' ),
		'id' 				=> 'sidebar-optional-three',
		'description'		=> __( 'This is Optional Sidebar Three', 'studio' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );

	// Registering 404 Error Page Content
	register_sidebar( array(
		'name'					=> __( '404 Page Not Found Content', 'studio' ),
		'id' 					=> 'sidebar-notfound',
		'description'			=> __( 'Replaces the default 404 Page Not Found Content', 'studio' ),
		'before_widget'			=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'			=> '</aside>',
		'before_title'			=> '<h2 class="widget-title">',
		'after_title'			=> '</h2>',
	) );

	// $footer_sidebar_number = 4; //Number of footer sidebars

	// for( $i=1; $i <= $footer_sidebar_number; $i++ ) {
	// 	register_sidebar( array(
	// 		'name'          => sprintf( __( 'Footer Area %d', 'studio' ), $i ),
	// 		'id'            => sprintf( 'footer-%d', $i ),
	// 		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-wrap">',
	// 		'after_widget'  => '</div><!-- .widget-wrap --></aside>',
	// 		'before_title'  => '<h4 class="widget-title">',
	// 		'after_title'   => '</h4>',
	// 		'description'	=> sprintf( __( 'Footer %d widget area.', 'studio' ), $i ),
	// 	) );
	// }
}
add_action( 'widgets_init', 'studio_widgets_init' );

/**
 * Adds studioSocialIcons widget.
 *
 * @since Studio 1.0
 */
class Studio_social_icons_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'studio_social_icons', // Base ID
			'CT: Social Icons', // Name
			array( 'description' => __( 'Use this widget to add Social Icons Menu as a widget. ', 'studio' ) ) // Args
		);
	}

	public function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$nav_menu_args = array(
			'fallback_cb'		=> '',
			'container_class'	=> 'social-menu',
			'depth'				=> '1',
		    'link_before'		=> '<span class="screen-reader-text">',
		    'link_after'		=> '</span>',
			'menu'        		=> $nav_menu
		);

		/**
		 * Filter the arguments for the Custom Menu widget.
		 *
		 * @since 4.2.0
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
		 *
		 *     @type callback|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param stdClass $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args ) );

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'studio' ), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'studio' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e( 'Select Menu:', 'studio' ); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 'studio' ); ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}


/**
 * Widget that shows selected page content and the title.
 * Construct the widget.
 * i.e. Name, description and control options.
 * Has form to ask the title, select page
 * In the display function we show the title and selected page's content.
 * If the title is not set, it shows the page title as the title.
 *
 */
 class Studio_get_page_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'studio_page_widget', // Base ID
			'CT: Featured Page', // Name
			array( 'description' => __( 'Display Featured Page. Suitable for Home Top Area and Home Left Area', 'studio' ) ) // Args
		);
	}

 	function form( $instance ) {
 		//Defaults
 		$instance = wp_parse_args( (array) $instance, array(
 															'title' 					=> '',
															'page_id' 					=> '',
															'disable_featured_image'	=> 0,
															'image_position' 			=> 'above',
															'show_content' 				=> 'excerpt',
															'excerpt_length' 			=> 200
														) );

 		$page_id 				= absint( $instance['page_id'] );
		$title 					= esc_attr( $instance['title'] );
		$disable_featured_image = $instance['disable_featured_image'] ? 'checked="checked"' : '';
		$image_position 		= $instance['image_position'];
		$show_content			= $instance['show_content'];
		$excerpt_length			= absint( $instance['excerpt_length'] );
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'studio' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

        <p class="description">
			<?php _e( 'Displays the title of the Page if title input is empty.', 'studio' ); ?>
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'studio' ); ?>:</label>
			<?php
				wp_dropdown_pages( array(
										'name' 		=> $this->get_field_name( 'page_id' ),
										'selected' 	=> $instance['page_id']
									) );
			?>
		</p>

        <p>
			<input class="checkbox" type="checkbox" <?php echo $disable_featured_image; ?> id="<?php echo $this->get_field_id( 'disable_featured_image' ); ?>" name="<?php echo $this->get_field_name( 'disable_featured_image' ); ?>" /> <label for="<?php echo $this->get_field_id( 'disable_featured_image' ); ?>"><?php _e( 'Remove Featured image', 'studio' ); ?></label>
		</p>

	    <?php if( 'above' == $image_position  ) { ?>
            <p>
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" checked /><?php _e( 'Show Image Before Title', 'studio' );?><br />
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" /><?php _e( 'Show Image After Title', 'studio' );?><br />
            </p>
		<?php } else { ?>
            <p>
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" /><?php _e( 'Show Image Before Title', 'studio' );?><br />
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" checked /><?php _e( 'Show Image After Title', 'studio' );?><br />
            </p>
		<?php } ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Show Content', 'studio' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>">
				<option value="excerpt" <?php selected( 'excerpt', $instance['show_content'] ); ?>><?php _e( 'Excerpt', 'studio' ); ?></option>
				<option value="fullcontent" <?php selected( 'fullcontent', $instance['show_content'] ); ?>><?php _e( 'Full Content', 'studio' ); ?></option>
				<option value="hide" <?php selected( 'hide', $instance['show_content'] ); ?>><?php _e( 'Hide', 'studio' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Content Character Limit for Excerpt Only', 'studio' ); ?>: </label>
			<input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $excerpt_length; ?>" type="number" min="5" />
       	</p>

	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance 							= $old_instance;

		$instance['title'] 					= sanitize_text_field( $new_instance['title'] );

		$instance['page_id'] 				= absint( $new_instance['page_id'] );

		$instance['disable_featured_image'] = isset( $new_instance['disable_featured_image'] ) ? 1 : 0;

		$instance['image_position'] 		= $new_instance['image_position'];

		$instance['show_content']			= $new_instance['show_content'];

		$instance['excerpt_length']			= absint( $new_instance['excerpt_length'] );

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );

		extract( $instance );

		global $post;

		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		$page_id = isset( $instance['page_id'] ) ? $instance['page_id'] : '';

		$disable_featured_image = !empty( $instance['disable_featured_image'] ) ? 'true' : 'false';

		$image_position = isset( $instance['image_position'] ) ? $instance['image_position'] : 'above' ;

		$show_content 	= isset( $instance['show_content'] ) ? $instance['show_content'] : 'excerpt' ;

		$excerpt_length	= isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 200;

 		$more_tag_text 	=  get_theme_mod( 'excerpt_more_text', studio_get_default_theme_options( 'excerpt_more_text' ) );

		if( $page_id ) {
 			$the_query = new WP_Query( 'page_id='.$page_id );

			while( $the_query->have_posts() ) :
				$the_query->the_post();

				$page_name = the_title( '', '', false );

				$output = $before_widget;

				$output .= '<article class="post-'. $page_id . ' page type-page entry">';

					//Image position set below
					if( $image_position == "below" ) {
						// Wiget title replace the page title is added
						if( $title ) {

							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $title .'">'. $title .'</a></h2></header>';
						}
						else {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $page_name .'">'. $page_name .'</a></h2></header>';
						}
					}

					if( has_post_thumbnail() && $disable_featured_image != "true" ) {
						$output.= '<figure class="featured-image excerpt-landscape-featured-image"><a href="' . get_permalink() . '" title="' . $page_name . '">' . get_the_post_thumbnail( $post->ID, 'studio-featured-landscape', array( 'title' => esc_attr( $page_name ), 'alt' => esc_attr( $page_name ) ) ).'</a></figure>';
					}

					//Image position set above
					if( $image_position == "above" ) {
						// Wiget title replace the page title is added
						if( $title ) {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $title .'">'. $title .'</a></h2></header>';
						}
						else {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $page_name .'">'. $page_name .'</a></h2></header>';
						}
					}

					if ( 'excerpt' == $show_content ) {
						$output .= '<div class="entry-summery">';
						$output .= studio_get_the_content_limit( (int) $excerpt_length, esc_html( $more_tag_text ) );
						$output .= '</div><!-- .entry-summery -->';
					}
					elseif ( 'fullcontent' == $show_content ) {
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}

				$output .= '</article><!-- .type-page -->';

				$output .= $after_widget;

			endwhile;

			// Reset Post Data
	 		wp_reset_postdata();

			echo $output;
 		}
 	}
}


/**
 * Featured post widget
 *
 * @since Studio 1.0
 */
class Studio_featured_post_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'studio_post_widget', // Base ID
			'CT: Featured Post', // Name
			array( 'description' => __( 'Display Featured Post. Suitable for Home Top Area and Home Left Area', 'studio' ) ) // Args
		);
	}

	function form( $instance ) {
		global $valid_id;

		//Defaults
 		$instance = wp_parse_args( (array) $instance, array(
 															'title' 					=> '',
															'post_id' 					=> '',
															'disable_featured_image'	=> 0,
															'image_position' 			=> 'above',
															'show_content' 				=> 'excerpt',
															'excerpt_length' 			=> 200
														) );

		$post_id 				= absint( $instance['post_id'] );
		$title 					= esc_attr( $instance['title'] );
		$disable_featured_image = $instance['disable_featured_image'] ? 'checked="checked"' : '';
		$image_position 		= $instance['image_position'];
		$show_content			= $instance['show_content'];
		$excerpt_length			= absint( $instance['excerpt_length'] );
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'studio' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

        <p>
			<?php _e( 'Displays the title of the Post if title input is empty.', 'studio' ); ?>
        </p>

        <p>
        	<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'ID of the Post:', 'studio'); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" type="text" value="<?php echo $post_id; ?>" size="5" /> <br />
			<?php
			if(!empty( $valid_id ) ) {
				if( $valid_id=='not_valid') {
					echo '<strong>'. __( 'This Post ID is Not Valid', 'studio' ) .'</strong>';
				}
			}
			?>
        </p>

        <p>
        	<input class="checkbox" type="checkbox" <?php checked($instance['disable_featured_image'], true) ?> id="<?php echo $this->get_field_id( 'disable_featured_image' ); ?>" name="<?php echo $this->get_field_name( 'disable_featured_image' ); ?>" />
        	<label for="<?php echo $this->get_field_id('disable_featured_image'); ?>"><?php _e( 'Remove Featured image', 'studio' ); ?></label><br />
        </p>

	    <?php if( 'above' == $image_position  ) { ?>
            <p>
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" checked /><?php _e( 'Show Image Before Title', 'studio' );?><br />
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" /><?php _e( 'Show Image After Title', 'studio' );?><br />
            </p>
		<?php } else { ?>
            <p>
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" /><?php _e( 'Show Image Before Title', 'studio' );?><br />
                <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" checked /><?php _e( 'Show Image After Title', 'studio' );?><br />
            </p>
		<?php } ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Show Content', 'studio' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>">
				<option value="excerpt" <?php selected( 'excerpt', $instance['show_content'] ); ?>><?php _e( 'Excerpt', 'studio' ); ?></option>
				<option value="fullcontent" <?php selected( 'fullcontent', $instance['show_content'] ); ?>><?php _e( 'Full Content', 'studio' ); ?></option>
				<option value="hide" <?php selected( 'hide', $instance['show_content'] ); ?>><?php _e( 'Hide', 'studio' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Content Character Limit', 'studio' ); ?>: </label>
			<input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" value="<?php echo $excerpt_length; ?>" type="number" min="5" />
       	</p>

       	<?php
	}

	function update( $new_instance, $old_instance ) {
		global $valid_id;

		$instance 		= $old_instance;

		$instance['title'] 					= sanitize_text_field( $new_instance['title'] );

		$instance['disable_featured_image'] = isset( $new_instance['disable_featured_image'] ) ? 1 : 0;

		$instance['image_position'] 		= $new_instance['image_position'];

		$instance['show_content']			= $new_instance['show_content'];

		$instance['excerpt_length']			= absint( $new_instance['excerpt_length'] );

		$instance['v']						= 'valid';

		$instance['post_id'] 				= absint( $new_instance['post_id'] );

		$post_id 							= (string) $instance['post_id'];

		$valid_id							= 'not_valid';

		if( !empty( $post_id ) ){
			//check if post is valid or not
	   		if( get_post_status( $post_id ) ) {
				$valid_id			= 'valid';

				$instance['valid']	= 'valid';

				return $instance;
			}
		}
	}

	function widget( $args, $instance ) {
		global $valid_id, $post;

		extract( $args );

		if ( !empty( $instance ) ) {
			extract( $instance );
		}


		$title = isset( $instance['title'] ) ? $instance['title'] : '';

		$disable_featured_image = !empty( $instance['disable_featured_image'] ) ? 'true' : 'false';

		$image_position = isset( $instance['image_position'] ) ? $instance['image_position'] : 'above' ;

		$show_content   = isset( $instance['show_content'] ) ? $instance['show_content'] : 'excerpt' ;

		$excerpt_length	= isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 200;

		$more_tag_text	= get_theme_mod( 'excerpt_more_text', studio_get_default_theme_options( 'excerpt_more_text' ) );

		if ( empty( $instance['post_id'] ) || ! $post_id = absint( $instance['post_id'] ) )
			$post_id = NULL;

		// The Query
		if( $instance['valid'] =='valid' ):
			$the_query = new WP_Query( 'p='.$post_id );

			// The Loop
			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				$post_name = the_title( '', '', false );

				$output = $before_widget;

				$output .= '<article class="post-'. $post_id . ' page type-post entry">';

					//Image position set below
					if( $image_position == "below" ) {
						// Wiget title replace the page title is added
						if( $title ) {

							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $title .'">'. $title .'</a></h2></header>';
						}
						else {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $post_name .'">'. $post_name .'</a></h2></header>';
						}
					}

					if( has_post_thumbnail() && $disable_featured_image != "true" ) {
						$output.= '<figure class="featured-image excerpt-landscape-featured-image"><a href="' . get_permalink() . '" title="' . $post_name . '">' . get_the_post_thumbnail( $post->ID, 'studio-featured-landscape', array( 'title' => esc_attr( $post_name ), 'alt' => esc_attr( $post_name ) ) ).'</a></figure>';
					}

					//Image position set above
					if( $image_position == "above" ) {
						// Wiget title replace the page title is added
						if( $title ) {

							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $title .'">'. $title .'</a></h2></header>';
						}
						else {
							$output .= '<header class="entry-header"><h2 class="entry-title"><a href="' . get_permalink() . '" title="'. $post_name .'">'. $post_name .'</a></h2></header>';
						}
					}

					if ( 'excerpt' == $show_content ) {
						$output .= '<div class="entry-summery">';
						$output .= studio_get_the_content_limit( (int) $excerpt_length, esc_html( $more_tag_text ) );
						$output .= '</div><!-- .entry-summery -->';
					}
					elseif ( 'fullcontent' == $show_content ) {
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ']]>', ']]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}

				$output .= '</article><!-- .type-post -->';

				$output .= $after_widget;

			endwhile;

			// Reset Post Data
			wp_reset_postdata();

			echo $output;

		endif;

	}

}


/**
 * Makes a custom Widget for Displaying Ads
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Catch Themes
 * @subpackage Studio
 * @since Studio 2.1
 */
class Studio_adspace_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'widget_studio_adspace_widget', // Base ID
			__( 'CT: Advertisement', 'studio' ), // Name
			array( 'description' => __( 'Use this widget to add any type of Advertisement as a widget', 'studio' ) ) // Args
		);
	}


	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form($instance) {
		$instance 	= wp_parse_args(
						(array) $instance,

						array(
							'title' => '',
							'adcode' => '',
							'image' => '',
							'href' => '',
							'target' => '0',
							'alt' => ''
							)
					);
		$title 		= esc_attr( $instance[ 'title' ] );
		$adcode 	= esc_textarea( $instance[ 'adcode' ] );
		$image 		= esc_url( $instance[ 'image' ] );
		$href 		= esc_url( $instance[ 'href' ] );
		$target 	= $instance['target'] ? 'checked="checked"' : '';
		$alt 		= esc_attr( $instance[ 'alt' ] );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','studio'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <?php if ( current_user_can( 'unfiltered_html' ) ) : // Only show it to users who can edit it ?>
            <p>
                <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Advertisement Code:','studio'); ?></label>
                <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
            </p>
            <p><strong>or</strong></p>
        <?php endif; ?>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','studio'); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','studio'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_url( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $target; ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" /> <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Open Link in New Window', 'studio' ); ?></label>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','studio'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}

	/**
	 * update the particular instant
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['adcode'] 	= wp_kses_stripslashes($new_instance['adcode']);
		$instance['image'] 		= esc_url_raw($new_instance['image']);
		$instance['href'] 		= esc_url_raw($new_instance['href']);
		$instance[ 'target' ] 	= isset( $new_instance[ 'target' ] ) ? 1 : 0;
		$instance['alt'] 		= sanitize_text_field($new_instance['alt']);

		return $instance;
	}

	/**
	 * Displays the Widget in the front-end.
	 *
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title 	= !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
		$adcode = !empty( $instance['adcode'] ) ? $instance[ 'adcode' ] : '';
		$image 	= !empty( $instance['image'] ) ? $instance[ 'image' ] : '';
		$href 	= !empty( $instance['href'] ) ? $instance[ 'href' ] : '';
		$target = !empty( $instance[ 'target' ] ) ? 'true' : 'false';
		$alt 	= !empty( $instance['alt'] ) ? $instance[ 'alt' ] : '';

		if ( $target == "true" ) :
			$base = '_blank';
		else:
			$base = '_self';
		endif;

		echo $before_widget;
		if ( '' != $title  ) {
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		}

		if ( '' != $adcode  ) {
			echo $adcode;
		}
		elseif ( '' != $image  ) {
        	if( '' != $href  ) {
        		echo '<a href="'.$href.'" target="'.$base.'"><img src="'. $image.'" alt="'.$alt.'" /></a>';
        	}
        	else {
        		echo '<img src="'. $image.'" alt="'.$alt.'" />';
        	}
		}
		else {
			_e( 'Add Advertisement Code or Image URL', 'studio' );
		}
		echo $after_widget;
	}

}


/**
 * Register Widgets
 *
 * @since Studio 1.0
 */
function studio_register_widgets() {
    register_widget( 'Studio_social_icons_widget' );

	register_widget( 'Studio_get_page_widget' );

	register_widget( 'Studio_featured_post_widget' );

	register_widget( 'Studio_adspace_widget' );
}
add_action( 'widgets_init', 'studio_register_widgets' );