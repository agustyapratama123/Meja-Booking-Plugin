<?php
/**
 * Autoload semua class Models
 */
function meja_booking_load_model_classes() {
	$directory = plugin_dir_path( __FILE__ ) . 'Models/';

	foreach (glob($directory . '*.php') as $filename) {
		require_once $filename;
	}
}

meja_booking_load_model_classes();
