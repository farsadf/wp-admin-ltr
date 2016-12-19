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
define('ADMIN_LTR_BASENAME', plugin_basename(ADMIN_LTR_FILE));
define('ADMIN_LTR_PLUGINPATH', plugin_dir_path(__FILE__) . 'inc/');

require_once(ADMIN_LTR_PLUGINPATH . 'plugin_helpers.php');
require_once(ADMIN_LTR_PLUGINPATH . 'admin_ltr_panel.php');
require_once(ADMIN_LTR_PLUGINPATH . 'adminpanel.registrar.php');

add_action('admin_enqueue_scripts', 'admin_ltr_enqueue_global');
add_action('admin_notices', 'admin_ltr_output');
add_action('admin_init', 'admin_ltr_header_hook');
add_action('plugins_loaded', 'admin_ltr_textdomain');