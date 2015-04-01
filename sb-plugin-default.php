<?php
/*
Plugin Name: SB Plugin Default
Plugin URI: http://hocwp.net/
Description: SB Plugin Default is created SB Team.
Author: SB Team
Version: 1.0.3
Author URI: http://hocwp.net/
Text Domain: sb-plugin-default
Domain Path: /languages/
*/

define( 'SB_PLUGIN_DEFAULT_USE_CORE_VERSION', '1.6.2' );

define( 'SB_PLUGIN_DEFAULT_FILE', __FILE__ );

define( 'SB_PLUGIN_DEFAULT_PATH', untrailingslashit( plugin_dir_path( SB_PLUGIN_DEFAULT_FILE ) ) );

define( 'SB_PLUGIN_DEFAULT_URL', plugins_url( '', SB_PLUGIN_DEFAULT_FILE ) );

define( 'SB_PLUGIN_DEFAULT_INC_PATH', SB_PLUGIN_DEFAULT_PATH . '/inc' );

define( 'SB_PLUGIN_DEFAULT_BASENAME', plugin_basename( SB_PLUGIN_DEFAULT_FILE ) );

define( 'SB_PLUGIN_DEFAULT_DIRNAME', dirname( SB_PLUGIN_DEFAULT_BASENAME ) );

require SB_PLUGIN_DEFAULT_INC_PATH . '/sb-plugin-load.php';
