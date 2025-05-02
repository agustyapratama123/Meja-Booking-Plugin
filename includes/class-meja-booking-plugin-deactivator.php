<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://https://www.linkedin.com/in/agustya-pratama-173aa31b9/
 * @since      1.0.0
 *
 * @package    Meja_Booking_Plugin
 * @subpackage Meja_Booking_Plugin/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Meja_Booking_Plugin
 * @subpackage Meja_Booking_Plugin/includes
 * @author     agustya pratama <agustyapratama76@gmail.com>
 */
class Meja_Booking_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		remove_role('admin_resto');
		remove_role('pembeli');
	}

}
