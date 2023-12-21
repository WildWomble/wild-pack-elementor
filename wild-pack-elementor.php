<?php
/**
 * Plugin Name:                 Wild Pack - Elementor Addons
 * Description:                 Some addons to make the work easier. Includes a few addons i made for myself to ease the work.
 * Version:                     1.2.0
 * Author:                      WildWomble
 * Author URI:                  https://github.com/WildWomble
 * Text Domain:                 elementor-wild-pack
 * Domain Path:					/lang
 * Elementor tested up to:      3.18.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WW__FILE__', __FILE__ );
define( 'WW_PLUGIN_BASE', plugin_basename( WW__FILE__ ) );
define( 'WW_URL', plugins_url( '/', WW__FILE__ ) );
define( 'WW_PATH', plugin_dir_path( WW__FILE__ ) );

require_once( WW_PATH . 'includes/wild-pack.php' );

/**
 * Registering the needed CSS and JS
 */

function widget_scripts() {

	/* Styles */
	wp_register_style( 'ww-custom-bundle-css', plugins_url( 'assets/css/custom-bundle.css', __FILE__ ), array(), '1.0.0', 'all' );
	wp_register_style( 'ww-restaurant-menu-css', plugins_url( 'assets/css/restaurant-menu.css', __FILE__ ), array(), '1.0.0', 'all' );
	
	/* Scripts */
	wp_register_script( 'ww-custom-bundle-js', plugins_url( 'assets/js/custom-bundle.js', __FILE__ ), array('jquery'), '1.0.0', true );
	wp_register_script( 'ww-restaurant-menu-js', plugins_url( 'assets/js/restaurant-menu.js', __FILE__ ), array('jquery'), '1.0.0', true );

	wp_localize_script( 'ww-custom-bundle-js', 'localize',
    	array(
    	    '_ajax_url' => admin_url( 'admin-ajax.php' ),
    	    '_ajax_nonce' => wp_create_nonce( '_ajax_nonce' ),
    	)
	);

}

add_action( 'wp_enqueue_scripts', 'widget_scripts' );

/**
 * Making a custom action for the form submission, check that the nonce is valid and sending back feedback in case of error.
 */

add_action( 'wp_ajax_custom_bundle_submit', 'custom_bundle_submit_form' );
add_action( 'wp_ajax_nopriv_custom_bundle_submit', 'custom_bundle_submit_form' );

function custom_bundle_submit_form() {

	if ( ! wp_verify_nonce( $_POST['_ajax_nonce'], '_ajax_nonce' ) ) {
		die( __( 'Error', 'elementor-wild-pack' ) );
	}

	$variations = ( empty( $_POST['edm_variations'] ) ) ? null : $_POST['edm_variations'];
	$variations_count = count( $variations );

	global $woocommerce;

	$product_id = sanitize_text_field( $_POST['edm_product_id'] );
	$steps 		= sanitize_text_field( $_POST['edm_steps'] ) - 1;

	$message_error = array(
		esc_html__( 'Please choose all the required products from the list', 'elementor-wild-pack' ),
		esc_html__( '[Error] The product could not be added to cart.', 'elementor-wild-pack' ),
		esc_html__( '[Error - Dev] A product must be selected.', 'elementor-wild-pack' )
	);
	
	if( !empty( $product_id ) ) {

		if( !empty($variations) && $variations_count == $steps ) {
			
			for( $i = 0; $i < $variations_count; $i++ ) {
				$custom_variations['option_' . $i] = sanitize_text_field( $variations[$i]['value'] );
			}
	
			if( $woocommerce->cart->add_to_cart( $product_id, 1, 0, $custom_variations ) ) {
	
				WC_AJAX::get_refreshed_fragments();
	
			} else {
	
				$res = [ 'code' => '0', 'message' => $message_error[1] ];
	
			}
		
		} else {
		
			$res = [ 'code' => '-1', 'message' => $message_error[0] ];
			
		}

	} else {
		
		$res = [ 'code' => '-1', 'message' => $message_error[2] ];

	}
	
	wp_send_json( $res );

	wp_die();
}