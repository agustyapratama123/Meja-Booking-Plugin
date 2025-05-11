<?php

class Meja_Booking_Dashboard_Admin_Resto {

    public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        add_shortcode('dashboard_admin_resto', [$this, 'render_dashboard']);
    }

    public function render_dashboard() {
        // Cek autentikasi dan role
        if (!is_user_logged_in()) {
            wp_redirect(home_url('/login-resto'));
            exit;
        }

        $user = wp_get_current_user();
        if (!in_array('admin_resto', (array)$user->roles)) {
            wp_redirect(home_url());
            exit;
        }

        // Path ke file tampilan dashboard
        include plugin_dir_path(__FILE__) . 'views/dashboard-resto-view.php';
    }
}
