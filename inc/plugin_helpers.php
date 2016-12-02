<?php
/**
 * Created by PhpStorm.
 * User: farsad
 * Date: 12/2/2016
 * Time: 1:47 AM
 */
function get_asset_dir($asset) {
    return plugin_dir_url( __FILE__ ) . '../assets/' . $asset;
}

function admin_ltr_enqueue_global() {
    // Enqueue the style.css
    wp_enqueue_style('ADMIN_LTR_PANEL_STYLE', get_asset_dir('css/style.css'));

    // Enqueue the engine.js file
    wp_enqueue_script('ADMIN_LTR_PANEL_ENGINE', get_asset_dir('js/engine.js'));
}

function admin_ltr_output() {
    echo '
        <div id="admin-ltr-wrap">
            <button type="button" id="admin-ltr" class="button top-screen-button">' . __('Force LTR', 'admin-ltr') . '</button>
        </div>
    ';
}

function admin_ltr_header_hook() {
    if($_GET['forceLTR'] && $_GET['forceLTR'] == true) {
        wp_styles()->text_direction = 'ltr';

        remove_action('admin_notices', 'admin_ltr_output');
        wp_enqueue_script('ADMIN_LTR_GENERATOR_SCRIPT', get_asset_dir('js/iframe.js'));
        wp_enqueue_style('ADMIN_LTR_GENERATOR_STYLE', get_asset_dir('css/iframe.css'));
    }
}