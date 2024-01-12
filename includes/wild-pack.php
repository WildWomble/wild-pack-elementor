<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WildPack {

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
    const MIN_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \EL_Daily_Menu\WildPack The single instance of the class.
	 */
    private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \EL_Daily_Menu\WildPack An instance of the class.
	 */
    public static function instance() {
        
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function __construct() {

        if( $this->is_compatible() ) {
            add_action( 'elementor/init', [ $this, 'init' ] );
        }

    }

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
    public function is_compatible() {
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

		// Check if Elementor installed and activated
		if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

        // Check if WooCommerce is activated
		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) && ! function_exists( 'WC' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_woocommerce' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MIN_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-custom-pack' ),
			'<strong>' . esc_html__( 'Elementor Daily Menu Addon', 'elementor-custom-pack' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-custom-pack' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have WooCommerce installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_woocommerce() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-custom-pack' ),
			'<strong>' . esc_html__( 'Elementor Daily Menu Addon', 'elementor-custom-pack' ) . '</strong>',
			'<strong>' . esc_html__( 'Woocommerce', 'elementor-custom-pack' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-custom-pack' ),
			'<strong>' . esc_html__( 'Elementor Daily Menu Addon', 'elementor-custom-pack' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-custom-pack' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Filters the array of row meta for each/specific plugin in the Plugins list table.
	 * Appends additional links below each/specific plugin on the plugins page.
	 *
	 * @access  public
	 * @param   array       $links_array            An array of the plugin's metadata
	 * @param   string      $plugin_file_name       Path to the plugin file
	 * @param   array       $plugin_data            An array of plugin data
	 * @param   string      $status                 Status of the plugin
	 * @return  array       $links_array
	*/
	public function plugin_row_meta( $links_array, $plugin_file_name, $plugin_data, $status ) {
		if ( strpos( $plugin_file_name, basename(__FILE__) ) ) {
	
			$links_array[] = '<a href="https://www.buymeacoffee.com/mwomble/">Get me a coffee</a>';
		}
	 
		return $links_array;
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Initialize the Widget
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Add translate file
		load_plugin_textdomain( 'elementor-custom-pack', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

		add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 4 );
	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		// Custom Bundle Widget
		require_once( __DIR__ . '/widgets/custom-bundle.php' );

		// Restaurant Menu without add to cart
		require_once( __DIR__ . '/widgets/restaurant-menu.php');

		// Restaurant Menu with add to cart
		require_once( __DIR__ . '/widgets/restaurant-menu-woo.php');

		$widgets_manager->register( new Widget_CustomBundle() );
		$widgets_manager->register( new Widget_RestaurantMenu() );
		$widgets_manager->register( new Widget_RestaurantMenuWoo() );

	}
    
}

WildPack::instance();