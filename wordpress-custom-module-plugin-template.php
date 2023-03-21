<?php
/*
 * Plugin Name: WordPress Custom Module Plugin Template
 * Plugin URI: https://quayle-applications.com/contact
 * Author: Jim @ Quayle Applications
 * Author URI: https://quayle-applications.com/
 * Description: A custom shortcode module template that utilizes customizer for the settings
 * Version: 1.0.0
 * Requires at least: 6.1.1
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: qcmpt
 */

defined('ABSPATH') or die();
define('QCMPT_PLUGIN_NAME', 'WordPress Custom Module Plugin Template');
define('QCMPT_TEXT_DOMAIN', 'qcmpt');

//Enqueue Scripts
function qcmptLoadScripts() {
    //The version of the .js file is made from the time of it’s last update.
    $js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'assets/js/app.js' ));
    $css_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/styles.css' ));

    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '5.2.3', true );
    wp_enqueue_script( 'qcmpt-js', plugins_url( 'assets/js/app.js', __FILE__ ), array('jquery', 'bootstrap-js'), $js_ver, true );
   
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(), '5.2.3', 'all' );
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css', array(), '6.3.0', 'all' );
    wp_enqueue_style( 'qcmpt-style', plugins_url( 'assets/css/styles.css', __FILE__ ), array('bootstrap-css', 'font-awesome'), $css_ver, 'all' );

    wp_localize_script( 'qcmpt-js', 'qcmpt_ajax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'qcmpt-nonce' ),
        'is_user_logged_in' => is_user_logged_in(),
        'is_single' => is_single()
    ));
}
add_action( 'wp_enqueue_scripts', 'qcmptLoadScripts' );

//Allow for modular JavaScript
add_filter('script_loader_tag', 'qcmptAddTypeAttribute' , 10, 3); 
function qcmptAddTypeAttribute($tag, $handle, $src) {
    
    if ( 'qcmpt-js' !== $handle ) {
        return $tag;
    }
    
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

include 'includes/utils/helpers.php';
include 'includes/customizer.php';
include 'includes/modules.php';
include 'includes/ajax.php';