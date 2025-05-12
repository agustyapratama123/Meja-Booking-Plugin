<?php

class Meja_Booking_Dashboard_Admin_Resto {

    public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
   

    }

   public function load_dashboard_section() {
    if (!current_user_can('admin_resto')) {
        wp_send_json_error('Unauthorized', 403);
    }

    $section = sanitize_text_field($_POST['section']);
    $base_path = plugin_dir_path(__FILE__) . 'views/';

    switch ($section) {
        case 'dashboard':
        case 'tambah-menu':
        case 'pesanan':
            include $base_path . $section . '.php';
            break;
        default:
            echo '<p>Halaman tidak ditemukan.</p>';
            break;
    }

    wp_die();
}

}
