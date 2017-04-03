<?php
/**
 * Plugin Name: Syntax Highlighter for WP Editor
 * Plugin URI: https://github.com/ArthurGareginyan/syntax-highlighter-for-wp-editor
 * Description: Replaces the defaults WordPress Theme and Plugin Editor with an enhanced editor with syntax highlighting and line numbering.
 * Author: Arthur Gareginyan
 * Author URI: http://www.arthurgareginyan.com
 * Version: 3.2
 * License: GPL3
 * Text Domain: syntax-highlighter-for-wp-editor
 * Domain Path: /languages/
 *
 * Copyright 2016 Arthur Gareginyan (email : arthurgareginyan@gmail.com)
 *
 * This file is part of "Syntax Highlighter for WP Editor".
 *
 * "Syntax Highlighter for WP Editor" is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * "Syntax Highlighter for WP Editor" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with "Syntax Highlighter for WP Editor".  If not, see <http://www.gnu.org/licenses/>.
 *
 */


/**
 * Prevent Direct Access
 *
 * @since 0.1
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Define global constants
 *
 * @since 3.2
 */
defined('SHWPE_DIR') or define('SHWPE_DIR', dirname(plugin_basename(__FILE__)));
defined('SHWPE_BASE') or define('SHWPE_BASE', plugin_basename(__FILE__));
defined('SHWPE_URL') or define('SHWPE_URL', plugin_dir_url(__FILE__));
defined('SHWPE_PATH') or define('SHWPE_PATH', plugin_dir_path(__FILE__));
defined('SHWPE_TEXT') or define('SHWPE_TEXT', 'syntax-highlighter-for-wp-editor');
defined('SHWPE_VERSION') or define('SHWPE_VERSION', '3.2');

/**
 * Register text domain
 *
 * @since 3.2
 */
function SHighlighterForWPE_textdomain() {
	load_plugin_textdomain( SHWPE_TEXT, false, SHWPE_DIR . '/languages/' );
}
add_action( 'init', 'SHighlighterForWPE_textdomain' );

/**
 * Print direct link to Syntax Highlighter for WP Editor admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the Syntax Highlighter for WP Editor admin page
 *
 * @since  3.2
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function SHighlighterForWPE_settings_link( $links ) {
	$settings_page = '<a href="' . admin_url( 'options-general.php?page=syntax-highlighter-for-wp-editor.php' ) .'">' . __( 'Settings', SHWPE_TEXT ) . '</a>';
	array_unshift( $links, $settings_page );
	return $links;
}
add_filter( 'plugin_action_links_'.SHWPE_BASE, 'SHighlighterForWPE_settings_link' );

/**
 * Register "Syntax Highlighter" submenu in "Settings" Admin Menu
 *
 * @since 3.2
 */
function SHighlighterForWPE_register_submenu_page() {
	add_options_page( __( 'Syntax Highlighter for WP Editor', SHWPE_TEXT ), __( 'Syntax Highlighter for WP Editor', SHWPE_TEXT ), 'manage_options', basename( __FILE__ ), 'SHighlighterForWPE_render_submenu_page' );
}
add_action( 'admin_menu', 'SHighlighterForWPE_register_submenu_page' );

/**
 * Attach Settings Page
 *
 * @since 3.0
 */
require_once( SHWPE_PATH . 'inc/php/settings_page.php' );

/**
 * Register settings
 *
 * @since 0.1
 */
function SHighlighterForWPE_register_settings() {
	register_setting( 'SHighlighterForWPE_settings_group', 'SHighlighterForWPE_settings' );
}
add_action( 'admin_init', 'SHighlighterForWPE_register_settings' );

/**
 * Create a content for the _load_scripts hook
 *
 * @since 3.1
 */
function SHighlighterForWPE_prepare() {

    // Read options from BD
    $options = get_option( 'SHighlighterForWPE_settings' );

    // CodeMirror library
    wp_enqueue_script( 'SHighlighterForWPE-codemirror-js', SHWPE_URL . 'inc/lib/codemirror/codemirror-compressed.js' );
    wp_enqueue_style( 'SHighlighterForWPE-codemirror-css', SHWPE_URL . 'inc/lib/codemirror/codemirror.css' );
    wp_enqueue_script( 'SHighlighterForWPE-codemirror-setting', SHWPE_URL . 'inc/js/codemirror-settings.js', array(), false, true );
    if ( $options['theme'] != "default" ) {
        wp_enqueue_style( 'SHighlighterForWPE-codemirror-theme', SHWPE_URL . 'inc/lib/codemirror/theme/' . $options['theme'] . '.css' );
    }

    // Check the extension of loaded file and change the Mode of CodeMirror
    global $file;
    if ( !empty( $file )) {
        $ext = substr( $file, strrpos( $file, '.' ) + 1 );
        
        switch ( $ext ) {
            case 'css':
                $mode = 'text/css';
                break;
                
            case 'html':
                $mode = 'text/html';
                break;

            case 'xml':
                $mode = 'text/xml';
                break;
                
            case 'js':
                $mode = 'text/javascript';
                break;
                
            case 'php':
                $mode = 'application/x-httpd-php';
                break;

            case 'txt':
                $mode = 'text/x-markdown';
                break;
        }

        $readonly = '';

    } else {
        $mode = 'application/x-httpd-php';
        $readonly = 'true';
    }

    // Create js object and injected it into the js file
    if ( !empty( $options['theme'] ) ) { $theme = $options['theme']; } else { $theme = "default"; };
    if ( !empty( $options['line_numbers'] ) && ( $options['line_numbers'] == "on" ) ) { $line_numbers = "true"; } else { $line_numbers = "false"; };
    if ( !empty( $options['first_line_number'] ) ) { $first_line_number = $options['first_line_number']; } else { $first_line_number = "0"; };
    if ( !empty( $options['tab_size'] ) ) { $tab_size = $options['tab_size']; } else { $tab_size = "4"; };
    $script_params = array(
                           'theme' => $theme,
                           'line_numbers' => $line_numbers,
                           'first_line_number' => $first_line_number,
                           'tab_size' => $tab_size,
                           'mode' => $mode,
                           'readonly' => $readonly,
                           );
    wp_localize_script( 'SHighlighterForWPE-codemirror-setting', 'scriptParams', $script_params );
}

/**
 * Load scripts and style sheet for settings page
 *
 * @since 3.1
 */
function SHighlighterForWPE_load_scripts($hook) {

    // If is a Plugin/Theme Editors page
    if ( 'plugin-editor.php' == $hook || 'theme-editor.php' == $hook )  {

        // Style sheet
        wp_enqueue_style( 'SHighlighterForWPE-editor-css', SHWPE_URL . 'inc/css/editor.css' );
            
        SHighlighterForWPE_prepare();
    }

    // If is a settings page of this plugin
    if ( 'settings_page_syntax-highlighter-for-wp-editor' == $hook ) {

        // Style sheet
        wp_enqueue_style( 'SHighlighterForWPE-admin-css', SHWPE_URL . 'inc/css/admin.css' );
        wp_enqueue_style( 'SHighlighterForWPE-bootstrap', SMEDIABT_URL . 'inc/css/bootstrap.css' );
        wp_enqueue_style( 'SHighlighterForWPE-bootstrap-theme', SMEDIABT_URL . 'inc/css/bootstrap-theme.css' );

        // JavaScript
        wp_enqueue_script( 'SHighlighterForWPE-admin-js', SMEDIABT_URL . 'inc/js/admin.js', array(), false, true );
        wp_enqueue_script( 'SHighlighterForWPE-bootstrap-checkbox', SMEDIABT_URL . 'inc/js/bootstrap-checkbox.min.js' );

        SHighlighterForWPE_prepare();
    }
}
add_action( 'admin_enqueue_scripts', 'SHighlighterForWPE_load_scripts' );

/**
 * Delete options on uninstall
 *
 * @since 0.1
 */
function SHighlighterForWPE_uninstall() {
	delete_option( 'SHighlighterForWPE_settings' );
}
register_uninstall_hook( __FILE__, 'SHighlighterForWPE_uninstall' );

?>