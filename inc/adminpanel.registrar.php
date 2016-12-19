<?php
/**
 * By: farsad
 * Date: 12/2/2016
 * Time: 5:42 PM
 */
$admin_ltr_panel_instance = new admin_ltr_panel();

function admin_ltr_generate_page() {
    global $admin_ltr_panel_instance;
    echo $admin_ltr_panel_instance->generatePage();
}

function admin_ltr_finalize()
{
    global $admin_ltr_panel_instance;

    $admin_ltr_panel_instance->setPageAddressBase('tools.php');
    $admin_ltr_panel_instance->setPageAddress('admin-ltr');
    $admin_ltr_panel_instance->setPageId('admin-ltr-panel');

    $admin_ltr_panel_instance->setPageTitle( __( 'WP Admin LTR', 'admin-ltr' ) );
    $admin_ltr_panel_instance->setPageTabs(
        array(
            array(
                'id' => 'about_page',
                'title' => __('About Admin LTR', 'admin-ltr'),
                'content' => '
                <strong>' . __('With all of my love to the Persian community', 'admin-ltr') . '</strong>
                <p>' . sprintf( __( 'Coded with %1$s to help the RTL community.', 'admin-ltr' ), '<img src="'.admin_ltr_get_asset_dir('imgs/heart_icon.png').'" class="made-by-love" />' ) . '</p>
                <p>
                    ' . __( 'Please note, this plugin is completely free and open-source.', 'admin-ltr' ) . '
                    <br>
                    ' . sprintf( __( 'Fork it on %1$s at <a href="http://github.com/wphelper/wp-admin-ltr">http://github.com/wphelper/wp-admin-ltr</a>' , 'admin-ltr'),  '<img src="' . admin_ltr_get_asset_dir('imgs/github_icon.png') . '" class="made-by-love github"/>') . '
                </p>
            ',
                'default' => true
            ),
            array(
                'id' => 'usage_page',
                'title' => __('How to use?', 'admin-ltr'),
                'content' => '
                <p>' . __('This plugin add a button called "Force LTR" to top of your WordPress dashboard. By clicking on it you\'ll notice that page changes a little bit after a while whole page become LTR', 'admin-ltr') . '</p>
                <p>' . __('<strong>Note:</strong> to deactivate "Force LTR" you must refresh the page.', 'admin-ltr') .'</p>
            ',
            )
        )
    );

    add_submenu_page($admin_ltr_panel_instance->getPageAddressBase(), $admin_ltr_panel_instance->getPageTitle(), $admin_ltr_panel_instance->getPageTitle(), 'read', $admin_ltr_panel_instance->getPageAddress(), 'admin_ltr_generate_page');
}
add_action('admin_menu', 'admin_ltr_finalize');