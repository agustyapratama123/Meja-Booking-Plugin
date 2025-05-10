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
		add_shortcode('resto_dashboard', [$this, 'render_resto_dashboard']);
		add_action('template_redirect', array($this, 'override_page_template'));

		

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

		if (is_page('resto-dashboard')) {
			wp_enqueue_script(
				'meja-dashboard-router',
				plugin_dir_url(__FILE__) . 'js/dashboard-router.js',
				['jquery'],
				$this->version,
				true
			);
		}
		
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

	public function restrict_admin_for_resto() {
		if (
			is_user_logged_in() &&
			current_user_can('admin_resto') &&
			!current_user_can('administrator') &&
			is_admin() &&
			!defined('DOING_AJAX')
		) {
			wp_redirect(home_url('/resto-dashboard'));
			exit;
		}
	}
	

	public function login_redirect($redirect_to, $request, $user) {
		if (isset($user->roles) && in_array('admin_resto', $user->roles)) {
			return home_url('/resto-dashboard');
		}
		return $redirect_to;
	}
	
	// public function register_shortcodes() {
	// 	add_shortcode('resto_dashboard', [$this, 'render_resto_dashboard']);
	// }

	public function render_resto_dashboard() {
		if (!current_user_can('admin_resto')) {
			return '<p>Akses ditolak.</p>';
		}
	
		ob_start();
		include plugin_dir_path(__FILE__) . 'views/dashboard-resto.php';
		return ob_get_clean();
	}

	function meja_booking_force_template($template) {
		if (is_page('resto-dashboard')) {
			return plugin_dir_path(__FILE__) . 'templates/resto-dashboard-template.php';
		}
		return $template;
	}
	
	public function ajax_dashboard_router() {
		check_ajax_referer('meja_booking_ajax', 'nonce');
	
		if (!current_user_can('admin_resto')) {
			wp_send_json_error(['message' => 'Akses ditolak.']);
		}
	
		$page = isset($_POST['page']) ? sanitize_text_field($_POST['page']) : 'home';
	
		ob_start();
	
		switch ($page) {
			case 'home':
				include plugin_dir_path(__FILE__) . 'views/dashboard/home.php';
				break;
			case 'orders':
				include plugin_dir_path(__FILE__) . 'views/dashboard/orders.php';
				break;
			case 'profile':
				include plugin_dir_path(__FILE__) . 'views/dashboard/profile.php';
				break;
			default:
				echo '<p>Halaman dashboard tidak ditemukan.</p>';
		}
	
		wp_send_json_success([
			'html' => ob_get_clean(),
		]);
	}
	

	public function override_page_template() {
		// JANGAN override di wp-admin, wp-login.php, AJAX, REST API
		if (is_admin() || defined('DOING_AJAX') || defined('REST_REQUEST')) {
			return;
		}
	
		// Hindari gangguan terhadap wp-login.php langsung
		if (strpos($_SERVER['REQUEST_URI'], 'wp-login.php') !== false) {
			return;
		}
	
		global $post;
	
		if (!is_page() || !$post) return;
	
		$slug = $post->post_name;
	
		if ($slug === 'login-resto') {
			$this->render_clean_login();
			exit;
		}
	
		if ($slug === 'dashboard-resto') {
			if (!is_user_logged_in()) {
				wp_redirect(home_url('/login-resto'));
				exit;
			}
	
			if (!current_user_can('admin_resto')) {
				// Jika bukan admin_outlet, arahkan ke wp-admin
				wp_redirect(admin_url());
				exit;
			}
	
			$this->render_clean_dashboard();
			exit;
		}
	}
	


	// page login

	public function render_clean_login() {
	$error = '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$creds = [
			'user_login'    => sanitize_user($_POST['log']),
			'user_password' => $_POST['pwd'],
			'remember'      => isset($_POST['rememberme']),
		];

		$user = wp_signon($creds, false);

		if (is_wp_error($user)) {
			$error = 'Login gagal. Silakan periksa kembali username dan password.';
		} else {
			wp_set_current_user($user->ID); // Pastikan user diatur
			wp_set_auth_cookie($user->ID);  // Set cookie manual (penting untuk custom login)

			$roles = (array) $user->roles;

			if (in_array('admin_resto', $roles)) {
				wp_redirect(home_url('/dashboard-resto'));
				exit;
			} elseif (in_array('administrator', $roles)) {
				wp_redirect(admin_url());
				exit;
			} else {
				// Tetap di halaman login dengan error
				wp_logout();
				$error = 'Role Anda tidak diizinkan mengakses halaman ini.';
			}
		}
	}

	// Include file tampilan login
	include plugin_dir_path(__FILE__) . 'views/login-view.php';
}

	
	// page dashboard

	public function render_clean_dashboard() {
		wp_enqueue_script(
			'meja-dashboard-js',
			plugin_dir_url(__FILE__) . 'js/frontend-dashboard.js',
			['jquery'],
			null,
			true
		);
		wp_print_scripts(['jquery', 'meja-dashboard-js']);

	// Include file tampilan dashboard resto
	include plugin_dir_path(__FILE__) . 'views/dashboard-resto-view.php';
		
	}
	
	
}
