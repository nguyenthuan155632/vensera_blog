<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: MyThemeShop Tabs Widget v2
	Description: Display popular posts, recent posts, comments and tags in tabbed format
	Version: 1.0

-----------------------------------------------------------------------------------*/
class mts_Widget_Tabs_2 extends WP_Widget {
    
    function __construct() {
        add_action('wp_enqueue_scripts', array(&$this, 'tabs_scripts'));
        
        // ajax
        add_action('wp_ajax_tab_widget_content', array(&$this, 'ajax_tab_widget_content'));
        add_action('wp_ajax_nopriv_tab_widget_content', array(&$this, 'ajax_tab_widget_content'));
        
        $widget_ops = array('classname' => 'widget_tabs2', 'description' => __('Display popular posts, recent posts, comments and tags in tabbed format', 'mythemeshop'));
		$control_ops = array('width' => 300, 'height' => 350);
		$this->WP_Widget('tabs2', __('MyThemeShop: Tab Widget v2', 'mythemeshop'), $widget_ops, $control_ops);
    }
	
	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'tabs' => array('recent' => 1, 'popular' => 1, 'comments' => 0, 'tags' => 0), 'allow_pagination' => 1, 'post_num' => '5', 'comment_num' => '5', 'show_thumb4' => 1, 'show_date' => 1, 'show_comment_num' => 1, 'show_avatar' => 1) );
        extract($instance);
//      $tabs = $instance['tabs'];
//		$post_num = $instance['post_num'];
//		$show_thumb4 = isset( $instance[ 'show_thumb4' ] ) ? esc_attr( $instance[ 'show_thumb4' ] ) : 1;
//		$show_date = isset( $instance[ 'show_date' ] ) ? esc_attr( $instance[ 'show_date' ] ) : 1;
//		$show_comment_num = isset( $instance[ 'show_comment_num' ] ) ? esc_attr( $instance[ 'show_comment_num' ] ) : 1;
//		$show_avatar = isset( $instance[ 'show_avatar' ] ) ? esc_attr( $instance[ 'show_avatar' ] ) : 1;
//		$comment_num = format_to_edit($instance['comment_num']);
	?>  
    
        <p>
			<label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_popular">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_popular" name="<?php echo $this->get_field_name("tabs"); ?>[popular]" value="1" <?php if (isset($instance['tabs']['popular'])) { checked( 1, $instance['tabs']['popular'], true ); } ?> />
				<?php _e( 'Popular Tab', 'mythemeshop'); ?>
			</label>
            <label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_recent">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_recent" name="<?php echo $this->get_field_name("tabs"); ?>[recent]" value="1" <?php if (isset($instance['tabs']['recent'])) { checked( 1, $instance['tabs']['recent'], true ); } ?> />
				<?php _e( 'Recent Tab', 'mythemeshop'); ?>
			</label>
            
            <label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_comments">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_comments" name="<?php echo $this->get_field_name("tabs"); ?>[comments]" value="1" <?php if (isset($instance['tabs']['comments'])) { checked( 1, $instance['tabs']['comments'], true ); } ?> />
				<?php _e( 'Comments Tab', 'mythemeshop'); ?>
			</label>
            <label class="alignleft" style="display: block; width: 50%;" for="<?php echo $this->get_field_id("tabs"); ?>_tags">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("tabs"); ?>_tags" name="<?php echo $this->get_field_name("tabs"); ?>[tags]" value="1" <?php if (isset($instance['tabs']['tags'])) { checked( 1, $instance['tabs']['tags'], true ); } ?> />
				<?php _e( 'Tags Tab', 'mythemeshop'); ?>
			</label>
		</p>
        
        <div class="clear" style="margin-bottom: 14px;"></div>
        
        <p>
			<label for="<?php echo $this->get_field_id("allow_pagination"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("allow_pagination"); ?>" name="<?php echo $this->get_field_name("allow_pagination"); ?>" value="1" <?php if (isset($instance['allow_pagination'])) { checked( 1, $instance['allow_pagination'], true ); } ?> />
				<?php _e( 'Allow pagination', 'mythemeshop'); ?>
			</label>
		</p>
        <hr />
        
		<p><label for="<?php echo $this->get_field_id('post_num'); ?>"><?php _e('Number of posts to show:', 'mythemeshop'); ?></label>
		<br /><input id="<?php echo $this->get_field_id('post_num'); ?>" name="<?php echo $this->get_field_name('post_num'); ?>" type="number" min="1" step="1" value="<?php echo $post_num; ?>" />
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id("show_thumb4"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_thumb4"); ?>" name="<?php echo $this->get_field_name("show_thumb4"); ?>" value="1" <?php if (isset($instance['show_thumb4'])) { checked( 1, $instance['show_thumb4'], true ); } ?> />
				<?php _e( 'Show post thumbnails', 'mythemeshop'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("show_date"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_date"); ?>" name="<?php echo $this->get_field_name("show_date"); ?>" value="1" <?php if (isset($instance['show_date'])) { checked( 1, $instance['show_date'], true ); } ?> />
				<?php _e( 'Show post date', 'mythemeshop'); ?>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id("show_comment_num"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_comment_num"); ?>" name="<?php echo $this->get_field_name("show_comment_num"); ?>" value="1" <?php if (isset($instance['show_comment_num'])) { checked( 1, $instance['show_comment_num'], true ); } ?> />
				<?php _e( 'Show number of comments', 'mythemeshop'); ?>
			</label>
		</p>
        
		<hr />
        
		<p><label for="<?php echo $this->get_field_id('comment_num'); ?>"><?php _e('Number of comments on Comments Tab:', 'mythemeshop'); ?></label>
		<br /><input type="number" min="1" step="1" id="<?php echo $this->get_field_id('comment_num'); ?>" name="<?php echo $this->get_field_name('comment_num'); ?>" value="<?php echo $comment_num; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id("show_avatar"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("show_avatar"); ?>" name="<?php echo $this->get_field_name("show_avatar"); ?>" value="1" <?php if (isset($instance['show_avatar'])) { checked( 1, $instance['show_avatar'], true ); } ?> />
				<?php _e( 'Show avatars on Comments Tab', 'mythemeshop'); ?>
			</label>
		</p>

	<?php }
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['tabs'] = $new_instance['tabs'];
        $instance['allow_pagination'] = $new_instance['allow_pagination'];
		$instance['post_num'] = $new_instance['post_num'];
		$instance['comment_num'] =  $new_instance['comment_num'];
		$instance['show_thumb4'] = $new_instance['show_thumb4'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_comment_num'] = $new_instance['show_comment_num'];
   		$instance['show_avatar'] = $new_instance['show_avatar'];
		return $instance;
	}
	
	function widget( $args, $instance ) {
		extract($args);
        extract($instance);
        
        wp_enqueue_script('tabswidgetv2'); wp_enqueue_style('tabswidgetv2');
        //echo '<!-- $args = '.print_r($args,1).' $instance = '.print_r($instance,1).' -->';
//        $tabs = $instance['tabs'];
//		$post_num = $instance['post_num'];
//		$comment_num = $instance['comment_num'];
//		$show_thumb4 = $instance['show_thumb4'];
//		$show_date = $instance['show_date'];
//		$show_comment_num = $instance['show_comment_num'];
//        $show_avatar = $instance['show_avatar'];
        if (empty($tabs)) $tabs = array('recent' => 1, 'popular' => 1);
        $tabs_count = count($tabs);
        if ($tabs_count <= 1) {
            $tabs_count = 1;
        } elseif($tabs_count > 3) {
            $tabs_count = 4;
        }
		?>
		
<?php echo $before_widget; ?>
	<div id="tabs2-wrapper">	
		<ul class="<?php echo "has-$tabs_count "; ?>tabs">
            <?php if (!empty($tabs['popular'])): ?>
            <li class="tab_title"><a href="#" id="popular-tab"><?php _e('Popular', 'mythemeshop'); ?></a></li>
			<?php endif; ?>
            <?php if (!empty($tabs['recent'])): ?>
			<li class="tab_title"><a href="#" id="recent-tab"><?php _e('Recent', 'mythemeshop'); ?></a></li>
            <?php endif; ?>
            <?php if (!empty($tabs['comments'])): ?>
            <li class="tab_title"><a href="#" id="comments-tab"><?php _e('Comments', 'mythemeshop'); ?></a></li>
            <?php endif; ?>
            <?php if (!empty($tabs['tags'])): ?>
            <li class="tab_title"><a href="#" id="tags-tab"><?php _e('Tags', 'mythemeshop'); ?></a></li>
            <?php endif; ?>
        </ul> <!--end .tabs-->
		<div class="clear"></div>
        
		<div class="inside">
            <?php if (!empty($tabs['popular'])): ?>
			<div id="popular-tab-content" class="tab-content">
							
		    </div> <!--end #popular-tab-content-->
            <?php endif; ?>
            
            <?php if (!empty($tabs['recent'])): ?>
		    <div id="recent-tab-content" class="tab-content"> 
		        	
		    </div> <!--end #recent-tab-content-->
			<?php endif; ?>
            
            <?php if (!empty($tabs['comments'])): ?>
            <div id="comments-tab-content" class="tab-content"> 
		        <ul>
                    
				</ul>	
		    </div> <!--end #comments-tab-content-->
            <?php endif; ?>
            
            <?php if (!empty($tabs['tags'])): ?>
            <div id="tags-tab-content" class="tab-content tagcloud"> 
		        <ul>
                    
				</ul>	
		    </div> <!--end #tags-tab-content-->
            <?php endif; ?>
			<div class="clear"></div>
		</div> <!--end .inside -->
		<div class="clear"></div>
	</div><!--end #tabber -->
    
    <?php 
    // inline script 
    // to support multiple instances per page with different settings 
    unset($instance['tabs']); // unset unneeded
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        $('#<?php echo $widget_id; ?>').data('args', <?php echo json_encode($instance); ?>);
    });
    </script>
    
<?php echo $after_widget; ?>

<?php }
    function tabs_scripts() {
        // JS
        wp_register_script('tabswidgetv2', get_template_directory_uri() . '/js/widget-tabs2.js', true);
        wp_localize_script( 'tabswidgetv2', 'tabswidget',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' )) ); // accessing it with tabswidget.ajax_url        
        // CSS
        wp_register_style('tabswidgetv2', get_template_directory_uri() . '/css/widget-tabs2.css', true);
    }

    
    function ajax_tab_widget_content() {
        $tab = $_POST['tab'];
        $args = $_POST['args'];
        $page = intval($_POST['page']);
        if ($page < 1)
            $page = 1;
        
        if (!is_array($args)) 
            return '';
            
        // args
		$post_num = (empty($args['post_num']) ? 5 : intval($args['post_num']));
        if ($post_num > 20 || $post_num < 1) {
            $post_num = 5;
        }
        $comment_num = (empty($args['comment_num']) ? 5 : intval($args['comment_num']));
        if ($comment_num > 20 || $comment_num < 1) {
            $comment_num = 5;
        }
        $show_thumb4 = !empty($args['show_thumb4']);
        $show_date = !empty($args['show_date']);
        $show_comment_num = !empty($args['show_comment_num']);
        $show_avatar = !empty($args['show_avatar']);
        $allow_pagination = !empty($args['allow_pagination']);

        
        $content = '';
        
        
        switch ($tab) {
            
            
            case "popular":
                ?>
                <ul>
					<?php 
                    $popular = new WP_Query( array('ignore_sticky_posts' => 1, 'showposts' => $post_num, 'orderby' => 'comment_count', 'order' => 'desc', 'paged' => $page)); 
                    $last_page = $popular->max_num_pages;
                    while ($popular->have_posts()) : $popular->the_post(); ?>
						<li>
							<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
								<?php if ( $show_thumb4 == 1 ) : ?>
									<div class="left">
										<?php if(has_post_thumbnail()): ?>
											<?php the_post_thumbnail('widgetthumb',array('title' => '')); ?>
										<?php else: ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/smallthumb.png" alt="<?php the_title(); ?>"  class="wp-post-image" />
										<?php endif; ?>
										<div class="clear"></div>
									</div>
								<?php endif; ?>
								<div class="entry-title">
									<?php the_title(); ?>
									<?php if ( $show_date == 1 || $show_comment_num == 1) : ?>
										<div class="meta">
											<?php if ( $show_date == 1 ) : ?>
												<?php the_time('F j, Y'); ?>
											<?php endif; ?>
											<?php if ( $show_date == 1 && $show_comment_num == 1) : ?>
												 &bull; 
											<?php endif; ?>
											<?php if ( $show_comment_num == 1 ) : ?>
												<?php echo comments_number(__('No Comment','mythemeshop'), __('One Comment','mythemeshop'), '<span class="comm">%</span> '.__('Comments','mythemeshop'));?>
											<?php endif; ?>
										</div> <!--end .entry-meta--> 
									<?php endif; ?>
								</div>
							</a>
							<div class="clear"></div>
						</li>
					<?php $post_num++; endwhile; wp_reset_query(); ?>
				</ul>
                <?php if ($allow_pagination) : ?>
                    <?php $this->tab_pagination($page, $last_page); ?>
                <?php endif; ?>
                
                <?php    
            break;
                
                
            case "recent":
                ?>
                <ul>
					<?php 
                    $recent = new WP_Query('showposts='. $post_num .'&orderby=post_date&order=desc&post_status= publish&paged='. $page); 
                    $last_page = $recent->max_num_pages;
                    while ($recent->have_posts()) : $recent->the_post(); ?>
                        <li>
							<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
								<?php if ( $show_thumb4 == 1 ) : ?>
									<div class="left">
										<?php if(has_post_thumbnail()): ?>
											<?php the_post_thumbnail('widgetthumb',array('title' => '')); ?>
										<?php else: ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/smallthumb.png" alt="<?php the_title(); ?>"  class="wp-post-image" />
										<?php endif; ?>
										<div class="clear"></div>
									</div>
								<?php endif; ?>
								<div class="entry-title">
									<?php the_title(); ?>
									<?php if ( $show_date == 1 || $show_comment_num == 1) : ?>
										<div class="meta">
											<?php if ( $show_date == 1 ) : ?>
												<?php the_time('F j, Y'); ?>
											<?php endif; ?>
											<?php if ( $show_date == 1 && $show_comment_num == 1) : ?>
												 &bull; 
											<?php endif; ?>
											<?php if ( $show_comment_num == 1 ) : ?>
												<?php echo comments_number(__('No Comment','mythemeshop'), __('One Comment','mythemeshop'), '<span class="comm">%</span> '.__('Comments','mythemeshop'));?>
											<?php endif; ?>
										</div> <!--end .entry-meta--> 
									<?php endif; ?>
								</div>
							</a>
							<div class="clear"></div>
						</li>
					<?php endwhile; wp_reset_query(); ?>
				</ul>
                <?php if ($allow_pagination) : ?>
                    <?php $this->tab_pagination($page, $last_page); ?>
                <?php endif; ?>
                
                <?php
                break;
                
                
            case "comments":
                ?>
                <ul>
                    <?php 
                    $no_comments = false;
                    
                    $default_avatar = get_template_directory_uri().'/images/gravatar.png';
                    $avatar_size = 96;
                    $comment_length = 90; // max length for comments
                    
                    $comments_total = new WP_Comment_Query();
                    $comments_total_number = $comments_total->query(array('count' => 1));
                    $last_page = ceil($comments_total_number / $comment_num);
                    
                    $comments_query = new WP_Comment_Query();
                    $offset = ($page-1) * $comment_num;
                	$comments = $comments_query->query( array( 'number' => $comment_num, 'offset' => $offset ) );
                	if ( $comments ) : foreach ( $comments as $comment ) : ?>
                        <li>
                            <a href="<?php echo get_comment_link($comment->comment_ID); ?>">
                                <?php if ($show_avatar) : ?>
                                    <div class="left">
                                        <?php echo get_avatar( $comment->comment_author_email, $avatar_size, $default_avatar ); ?>
                                        <div class="clear"></div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="comment-meta">
                                    <span class="comment-author"><?php echo get_comment_author( $comment->comment_ID ); ?> </span>
                                    <span class="comment-post"><?php echo get_the_title($comment->comment_post_ID); ?></span>
                                </div>
                                <p>
                                    <?php echo substr( strip_tags(apply_filters( 'get_comment_text', $comment->comment_content )), 0, $comment_length);?>
                                </p>
                            </a>
                            <div class="clear"></div>
                		</li>
                	<?php endforeach; else : ?>
                        <li>                    
                            <div class="no-comments"><?php _e('No comments yet.', 'mythemeshop'); ?></div>
                        </li>                        
                    <?php $no_comments = true; endif; ?>
                </ul>
                <?php if ($allow_pagination && !$no_comments) : ?>
                    <?php $this->tab_pagination($page, $last_page); ?>
                <?php endif; ?>
                
                <?php
                break;
                
                
            case "tags":
                ?>
                <ul>
                    <?php
                    $tags = get_tags();                    
                    if($tags) {
                        foreach ($tags as $tag): ?>
                            <?php echo '<a href="'.get_tag_link ($tag->term_id).'"><span class="tab_count">'.$tag->count.'</span><span class="tab_name">'.$tag->name.'</span></a>'; ?>
                            <?php 
                        endforeach;                        
                    } else {
                        _e('No tags created.', 'mythemeshop');
                    }
                    ?>
                </ul>
                <?php
                break;
            
        }
        
        
        die(); // required to return a proper result
    }
    
    function tab_pagination($page, $last_page) {
        ?>
        <div class="pagination tabs2-pagination">
                        <?php if ($page > 1) : ?>
                            <a href="#" class="previous"><i class="icon-chevron-left"></i></a>
                        <?php endif; ?>
                        <?php if ($page != $last_page) : ?>
                            <a href="#" class="next"><i class="icon-chevron-right"></i></a>
                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>
                    <input type="hidden" class="page_num" name="page_num" value="<?php echo $page; ?>" />
        <?php
    }
}
add_action( 'widgets_init', create_function( '', 'register_widget( "mts_Widget_Tabs_2" );' ) );
?>