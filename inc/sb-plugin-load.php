<?php
require SB_PLUGIN_DEFAULT_INC_PATH . '/sb-plugin-install.php';

if(!sb_plugin_default_check_core() || !sb_plugin_default_is_core_valid()) {
    return;
}

require SB_PLUGIN_DEFAULT_INC_PATH . '/sb-plugin-functions.php';

require SB_PLUGIN_DEFAULT_INC_PATH . '/sb-plugin-hook.php';

require SB_PLUGIN_DEFAULT_INC_PATH . '/sb-plugin-admin.php';

require SB_PLUGIN_DEFAULT_INC_PATH . '/sb-plugin-ajax.php';