<?php
/**
 * Autoload semua class database
 */

function meja_booking_load_database_classes() {
	$directory = plugin_dir_path( __FILE__ ) . 'Database/';

	foreach (glob($directory . '*.php') as $filename) {
		require_once $filename;
	}
}

// Jalankan autoload waktu plugin load
meja_booking_load_database_classes();
