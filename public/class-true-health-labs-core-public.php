<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://github.com/nirav4491
 * @since      1.0.0
 *
 * @package    True_Health_Labs_Core
 * @subpackage True_Health_Labs_Core/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    True_Health_Labs_Core
 * @subpackage True_Health_Labs_Core/public
 * @author     Nirav Mehta <info@concatstring.com>
 */
class True_Health_Labs_Core_Public {

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

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in True_Health_Labs_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The True_Health_Labs_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/true-health-labs-core-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in True_Health_Labs_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The True_Health_Labs_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/true-health-labs-core-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			$this->plugin_name,
			'CustomCheckoutJsObj',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Ajax callback function for check email is exists or not on checkout page.
	 */
	public function cs_check_email_exists_ajax_callback() {
		$action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_STRING );
		if ( ! empty( $action ) && 'cs_check_email_exists_ajax' !== $action ) {
			echo esc_html( '0' );
			wp_die();
		}
		$email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
		if ( email_exists( $email ) ) {
			$code    = 'email-exists';
			$message = 'User with this email already exists. Please <a href="' . site_url() . '/my-account/?redirect_to=https://teststaging2023.com/checkout">login</a>';
		} else {
			$code    = 'email-not-exists';
			$message = 'Email does not exists!';
		}
		wp_send_json_success(
			array(
				'code'    => $code,
				'message' => $message,
			)
		);
		wp_die();
	}

}
