<?php
/*
Plugin Name: WP Admin LTR
Description: LTR-ize Plugin for plugins that not support RTL by default
Version: 1.0
Author: Farsad Fakhim
Text Domain: admin-ltr
Domain Path: /languages/
*/
define('ADMIN_LTR_FILE', __FILE__);
define('ADMIN_LTR_PATH', plugin_dir_path(ADMIN_LTR_FILE));
define('ADMIN_LTR_BASENAME', plugin_basename(ADMIN_LTR_FILE));

define('INCLUDE_PATH', plugin_dir_path(__FILE__) . 'inc/');


require_once(INCLUDE_PATH . 'plugin_helpers.php');

require_once(INCLUDE_PATH . 'adminpanel.php');
require_once(INCLUDE_PATH . 'adminpanel.registrar.php');

function admin_ltr_textdomain() {
    load_plugin_textdomain( 'admin-ltr', false, dirname( ADMIN_LTR_BASENAME ) . '/languages/' );
}

/* ACTIONS */
// Register style.css and engine.js
add_action('admin_enqueue_scripts', 'admin_ltr_enqueue_global');
// Register ForceLTR Button
add_action('admin_notices', 'admin_ltr_output');
// Initialize admin ltr header hook (detecting Force or not)
add_action('admin_init', 'admin_ltr_header_hook');
// Text domain hook
add_action( 'plugins_loaded', 'admin_ltr_textdomain');