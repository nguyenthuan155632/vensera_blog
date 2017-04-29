<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeGrill
 * @subpackage SingleApp
 * @since SingleApp 1.0
 */
?>
<!-- sidebar left -->

<div id="secondary">

   <?php do_action( 'singleapp_before_sidebar' ); ?>

      <?php if ( ! dynamic_sidebar( 'singleapp-sidebar-left' ) ) :

         the_widget( 'WP_Widget_Text',
            array(
               'title'  => __( 'Example Widget', 'singleapp' ),
               'text'   => sprintf( __( 'This is an example widget to show how the Left Sidebar looks by default. You can add custom widgets from the %swidgets screen%s in the admin. If custom widgets is added than this will be replaced by those widgets.', 'singleapp' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . admin_url( 'widgets.php' ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
               'filter' => true,
            ),
            array(
               'before_widget' => '<aside class="widget widget_text clearfix">',
               'after_widget'  => '</aside>',
               'before_title'  => '<h3 class="widget-title"><span>',
               'after_title'   => '</span></h3>'
            )
         );

      endif; ?>

   <?php do_action( 'singleapp_after_sidebar' ); ?>

</div><!--#secondary-->