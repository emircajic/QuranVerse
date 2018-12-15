<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://istina.ba
 * @since             1.0.0
 * @package           Quranverse
 *
 * @wordpress-plugin
 * Plugin Name:       QuranVerse
 * Plugin URI:        https://istina.ba
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Emir Cajic
 * Author URI:        https://istina.ba
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       quranverse
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-quranverse-activator.php
 */
function activate_quranverse() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quranverse-activator.php';
	Quranverse_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-quranverse-deactivator.php
 */
function deactivate_quranverse() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quranverse-deactivator.php';
	Quranverse_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_quranverse' );
register_deactivation_hook( __FILE__, 'deactivate_quranverse' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-quranverse.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_quranverse() {

	$plugin = new Quranverse();
	$plugin->run();

}
run_quranverse();
