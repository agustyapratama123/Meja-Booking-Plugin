<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://www.linkedin.com/in/agustya-pratama-173aa31b9/
 * @since             1.0.0
 * @package           Meja_Booking_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Meja Booking Plugin
 * Plugin URI:        https://https://www.linkedin.com/in/agustya-pratama-173aa31b9/
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            agustya pratama
 * Author URI:        https://https://www.linkedin.com/in/agustya-pratama-173aa31b9//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       meja-booking-plugin
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
define( 'MEJA_BOOKING_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-meja-booking-plugin-activator.php
 */
function activate_meja_booking_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-meja-booking-plugin-activator.php';
	Meja_Booking_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-meja-booking-plugin-deactivator.php
 */
function deactivate_meja_booking_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-meja-booking-plugin-deactivator.php';
	Meja_Booking_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_meja_booking_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_meja_booking_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-meja-booking-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_meja_booking_plugin() {

	$plugin = new Meja_Booking_Plugin();
	$plugin->run();

}
run_meja_booking_plugin();
