<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_RestaurantMenuWoo extends \Elementor\Widget_Base {

	public function get_name() {
		return 'elementor_restaurant_menu_woo';
	}

	public function get_title() {
		return esc_html__( '[WW] Restaurant Menu (Woo)', 'elementor-wild-pack' );
	}

	public function get_icon() {
		return 'eicon-cart';
	}

	public function get_custom_help_url() {
		return 'https://github.com/WildWomble';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_keywords() {
		return [ 'menu', 'restaurant', 'catering', 'food' ];
	}

	public function get_script_depends() {
		return [ 'ww-rmwoo-js' ];
	}

	public function get_style_depends() {
		return [ 'ww-rmwoo-css' ];
	}
	
	/**
	 * Get the products from the site
	 */
	public function get_products() {

		$args = array(

			'limit' 		=> -1,
			'orderby' 		=> 'name'
		
		);
		
		// Perform Query
		$query = new WC_Product_Query( $args );
		
		// Collect Product Object
		$products = $query->get_products();
		
		// Loop through products
		if ( ! empty( $products ) ) {
			foreach ( $products as $product ) {
				$woo_products[$product->get_id()] = $product->get_name();
			}
		}

		return $woo_products;

	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'content_section',
			[
				'label' 		=> esc_html__( 'Content', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'rmw_repeater_type',
			[
				'label' 		=> esc_html__( 'Type', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'item',
				'options' 		=> [
					'item' 		=> esc_html__( 'Item', 'elementor-wild-pack' ),
					'heading' 	=> esc_html__( 'Heading', 'elementor-wild-pack' ),
				]
			]
		);

		$repeater->add_control(
			'rmw_repeater_show',
			[
				'label' 		=> esc_html__( 'Show this item?', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$repeater->add_control(
			'rmw_repeater_title', 
			[
				'label'			=> esc_html__( 'Section Title', 'elementor-wild-pack' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Section Title', 'elementor-wild-pack' ),
				'ai'			=> [ 'active' => false ],
			]
		);

		$repeater->add_control(
			'rmw_repeater_product',
			[
				'label'         => esc_html__( 'Select Product to show', 'elementor-wild-pack' ),
				'type'          => \Elementor\Controls_Manager::SELECT,
				'label_block'   => true,
				'options'       => self::get_products(),
				'default'       => 'none',
				'condition'		=> [ 'rmw_repeater_type' => 'item' ],
			]
		);

		$this->add_control(
			'rmw_items',
			[
				'label' 		=> esc_html__( 'Products', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{rmw_title}}',
			]
		);

		$this->end_controls_section();

	}

}