<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              alaindwight.com
 * @since             1.0.0
 * @package           Test_api
 *
 * @wordpress-plugin
 * Plugin Name:       Saucal/Dwight Test API
 * Plugin URI:        alaindwight.com
 * Description:       API plugin for Saucal test.
 * Version:           1.0.0
 * Author:            Alain Dwight
 * Author URI:        alaindwight.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       test_api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TEST_API_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-test_api-activator.php
 */
function activate_test_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-test_api-activator.php';
	Test_api_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-test_api-deactivator.php
 */
function deactivate_test_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-test_api-deactivator.php';
	Test_api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_test_api' );
register_deactivation_hook( __FILE__, 'deactivate_test_api' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-test_api.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_test_api() {

	$plugin = new Test_api();
	$plugin->run();

}
run_test_api();
