<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://www.linkedin.com/in/agustya-pratama-173aa31b9/
 * @since      1.0.0
 *
 * @package    Meja_Booking_Plugin
 * @subpackage Meja_Booking_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Meja_Booking_Plugin
 * @subpackage Meja_Booking_Plugin/includes
 * @author     agustya pratama <agustyapratama76@gmail.com>
 */
class Meja_Booking_Plugin_Activator {

	public static function activate() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		// Nama tabel (otomatis prefiksinya, misal wp_)
		$table_meja   = $wpdb->prefix . 'meja_tables';
		$table_menu   = $wpdb->prefix . 'meja_menus';
		$table_order  = $wpdb->prefix . 'meja_orders';

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		// SQL buat meja
		$sql_meja = "CREATE TABLE $table_meja (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			number VARCHAR(50) NOT NULL,
			qr_code_url TEXT,
			status ENUM('available', 'occupied') DEFAULT 'available',
			PRIMARY KEY (id)
		) $charset_collate;";

		// SQL buat menu
		$sql_menu = "CREATE TABLE $table_menu (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			name VARCHAR(255) NOT NULL,
			description TEXT,
			price DECIMAL(10,2) NOT NULL,
			image_url TEXT,
			category VARCHAR(100),
			status ENUM('available', 'sold_out') DEFAULT 'available',
			PRIMARY KEY (id)
		) $charset_collate;";

		// SQL buat order
		$sql_order = "CREATE TABLE $table_order (
			id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			table_id BIGINT(20) UNSIGNED NOT NULL,
			order_details LONGTEXT NOT NULL, -- JSON
			total_price DECIMAL(10,2) NOT NULL,
			status ENUM('pending', 'preparing', 'served', 'completed', 'cancelled') DEFAULT 'pending',
			order_time DATETIME DEFAULT CURRENT_TIMESTAMP,
			FOREIGN KEY (table_id) REFERENCES $table_meja(id) ON DELETE CASCADE,
			PRIMARY KEY (id)
		) $charset_collate;";

		// Jalankan pembuatan tabel
		dbDelta($sql_meja);
		dbDelta($sql_menu);
		dbDelta($sql_order);


		// Membuat custom role
		add_role('admin_resto', 'Admin Resto', [
			'read'           => true,
			'edit_posts'     => false,
			'manage_options' => true, // bisa akses wp-admin
			'meja_manage'    => true, // custom capability untuk fitur plugin
		]);
	
		// Role: Pembeli
		add_role('pembeli', 'Pembeli', [
			'read'       => true,
			'meja_order' => true, // custom capability untuk melakukan order
		]);
	}
}

