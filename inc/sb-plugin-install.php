<?php
function sb_plugin_default_check_core() {
    $activated_plugins = get_option( 'active_plugins' );
    $sb_core_installed = in_array( 'sb-core/sb-core.php', $activated_plugins );
    return (bool) $sb_core_installed;
}

function sb_plugin_default_get_plugin_data( $path ) {
    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $data = get_plugin_data( $path );
    return $data;
}

function sb_plugin_default_get_plugin_sb_core_data() {
    $data = sb_plugin_default_get_plugin_data( ABSPATH . 'wp-content/plugins/sb-core/sb-core.php' );
    return (array) $data;
}

function sb_plugin_default_is_core_valid() {
    $data = sb_plugin_default_get_plugin_sb_core_data();
    $current_core_version = isset( $data['Version'] ) ? $data['Version'] : '';
    if ( version_compare( $current_core_version, SB_PLUGIN_DEFAULT_USE_CORE_VERSION, '>=' ) ) {
        return true;
    }
    return false;
}

function sb_plugin_default_not_valid_core_message() {
    return sprintf( '<div class="error"><p><strong>' . __( 'Error', 'sb-plugin-default' ) . ':</strong> ' . __( 'SB Plugin Default only run with %1$s, please update it via updates page or download it manually.', 'sb-plugin-default' ) . '.</p></div>', sprintf( '<a target="_blank" href="%1$s" style="text-decoration: none">SB Core version %2$s</a>', 'https://wordpress.org/plugins/sb-core/', SB_PLUGIN_DEFAULT_USE_CORE_VERSION ) );
}

function sb_plugin_default_activation() {
    if(!current_user_can('activate_plugins')) {
        return;
    }
    do_action( 'sb_plugin_default_activation' );
}
register_activation_hook( SB_PLUGIN_DEFAULT_FILE, 'sb_plugin_default_activation' );

function sb_plugin_default_deactivation() {
    do_action( 'sb_plugin_default_deactivation' );
}
register_deactivation_hook( SB_PLUGIN_DEFAULT_FILE, 'sb_plugin_default_deactivation' );

function sb_plugin_default_check_admin_notices() {
    if ( ! empty( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] ) {
        if ( ! sb_plugin_default_check_core() ) {
            unset( $_GET['activate'] );
            printf( '<div class="error"><p><strong>' . __( 'Error', 'sb-plugin-default' ) . ':</strong> ' . __( 'The plugin with name %1$s has been deactivated because of missing %2$s plugin', 'sb-plugin-default' ) . '.</p></div>', '<strong>SB Plugin Default</strong>', sprintf( '<a target="_blank" href="%s" style="text-decoration: none">SB Core</a>', 'https://wordpress.org/plugins/sb-core/' ) );
            deactivate_plugins( SB_PLUGIN_DEFAULT_BASENAME );
        }
    }
    if ( ! sb_plugin_default_is_core_valid() ) {
        echo sb_plugin_default_not_valid_core_message();
    }
}
add_action( 'admin_notices', 'sb_plugin_default_check_admin_notices', 0 );

function sb_plugin_default_settings_link( $links ) {
    if ( sb_plugin_default_check_core() ) {
        $settings_link = sprintf( '<a href="admin.php?page=sb_plugin_default">%s</a>', __( 'Settings', 'sb-plugin-default' ) );
        array_unshift( $links, $settings_link );
    }
    return $links;
}
add_filter( 'plugin_action_links_' . SB_PLUGIN_DEFAULT_BASENAME, 'sb_plugin_default_settings_link' );

function sb_plugin_default_textdomain() {
    load_plugin_textdomain( 'sb-plugin-default', false, SB_PLUGIN_DEFAULT_DIRNAME . '/languages/' );
}
add_action( 'plugins_loaded', 'sb_plugin_default_textdomain' );