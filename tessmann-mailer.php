<?php
/*
Plugin Name: Tessmann mailer Plugin
Plugin URI:
Version: 1.0.0
Author: Vinícius Schlee Tessmann
Author URI: github.com/viniciustessmann
*/

define('TESSMANN_MAILER_MODULE_VERSION', '1.0.0');
define('TESSMANN_MAILER_MODULE_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('TESSMANN_MAILER_MODULE_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('TESSMANN_MAILER_MODULE_ROOT_FILE',  __FILE__);
define('TESSMANN_MAILER_MODULE_PLUGIN_DOMAIN', 'tessmann-mailer');
define('TESSMANN_MAILER_MODULE_PLUGIN_TITLE', 'Tessmann mailer plugin');
define('TESSMANN_MAILER_MODULE_SHORTCODE', 'tessmann-mailer');

require_once(__DIR__ . '/autoload.php');
