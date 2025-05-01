<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://www.linkedin.com/in/agustya-pratama-173aa31b9/
 * @since      1.0.0
 *
 * @package    Meja_Booking_Plugin
 * @subpackage Meja_Booking_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Meja_Booking_Plugin
 * @subpackage Meja_Booking_Plugin/public
 * @author     agustya pratama <agustyapratama76@gmail.com>
 */
class Meja_Booking_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('wp_ajax_nopriv_meja_booking_route', [$this, 'ajax_router']);
     	add_action('wp_ajax_meja_booking_route', [$this, 'ajax_router']);
		add_shortcode('meja_booking_app', [$this, 'render_booking_shortcode']);

	 	// Start session if not already
	 	add_action('init', [$this, 'start_session']);
	}

   
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/meja-booking-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meja-booking-plugin-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script(
			'meja-booking',
			plugin_dir_url(__FILE__) . 'js/meja-booking.js',
			['jquery'],
			'1.0',
			true
		);
	
		wp_localize_script('meja-booking', 'MejaBookingData', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce('meja_booking_ajax'),
		]);
	}

	public function start_session() {
        if (!session_id()) {
            session_start();
        }
    }

	public function ajax_router() {
		check_ajax_referer('meja_booking_ajax', 'nonce');
	
		$step = isset($_POST['step']) ? sanitize_text_field($_POST['step']) : 'form';
	
		// Handle form input saving
        $this->handle_form_submission($step);

		ob_start();
		switch ($step) {
			case 'form':
				include plugin_dir_path(__FILE__) . 'views/form-nama-meja.php';
				break;
			case 'menu':
				include plugin_dir_path(__FILE__) . 'views/menu-pilihan.php';
				break;
			case 'cart':
				include plugin_dir_path(__FILE__) . 'views/keranjang.php';
				break;
			default:
				echo '<p>Halaman tidak ditemukan</p>';
		}
	
		wp_send_json_success([
			'html' => ob_get_clean(),
		]);
	}

	private function handle_form_submission($step) {
		switch ($step) {
			case 'menu':
				// Step 1 submitted → simpan nama & nomor meja
				if (!empty($_POST['customer_name']) && !empty($_POST['meja_id'])) {
					$_SESSION['meja_booking']['customer_name'] = sanitize_text_field($_POST['customer_name']);
					$_SESSION['meja_booking']['meja_id'] = intval($_POST['meja_id']);
				}
				break;
	
			case 'cart':
				// Step 2 submitted → simpan daftar menu (dalam bentuk array atau string)
				if (!empty($_POST['menu_ids'])) {
					$_SESSION['meja_booking']['menu_ids'] = sanitize_text_field($_POST['menu_ids']);
				}
				break;
	
			case 'checkout':
				// Simulasi checkout → bersihkan session
				unset($_SESSION['meja_booking']);
				break;
		}
	}
 	
	public function render_booking_shortcode($atts) {
		return '<div id="meja-booking-app"></div>';
	}
	
	
}
