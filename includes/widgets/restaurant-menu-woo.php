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

		$this->add_control(
			'rmw-shop-bag-icon',
			[
				'label'			=> esc_html__( 'Add to Cart Icon', 'textdomain' ),
				'type' 			=> \Elementor\Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'fas fa-shopping-cart',
					'library' 		=> 'fa-solid',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'rmw_repeater_type',
			[
				'label' 		=> esc_html__( 'Type', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT2,
				'multiple'		=> false,
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
				'label'			=> esc_html__( 'Heading', 'elementor-wild-pack' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> esc_html__( 'Food for everyone!', 'elementor-wild-pack' ),
				'label_block'   => true,
				'ai'			=> [ 'active' => false ],
				'condition'		=> [ 'rmw_repeater_type' => 'heading' ],
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

		$repeater->add_control(
			'rmw_repeater_ingredients',
			[
				'label' 		=> esc_html__( 'Ingredients', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__( 'N/A' , 'elementor-wild-pack' ),
				'condition'		=> [ 'rmw_repeater_type' => 'item' ],
				'ai' 			=> [ 'active' => false ],
			]
		);

		$repeater->add_control(
			'rmw_repeater_nfacts',
			[
				'label' 		=> esc_html__( 'Nutrition Facts', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__( 'N/A' , 'elementor-wild-pack' ),
				'condition'		=> [ 'rmw_repeater_type' => 'item' ],
				'ai' 			=> [ 'active' => false ],
			]
		);

		$repeater->add_control(
			'rmw_repeater_weight', 
			[
				'label'			=> esc_html__( 'Weight', 'elementor-wild-pack' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> esc_html__( '250g', 'elementor-wild-pack' ),
				'label_block'   => true,
				'ai'			=> [ 'active' => false ],
				'condition'		=> [ 'rmw_repeater_type' => 'item' ],
			]
		);

		$this->add_control(
			'rmw_items',
			[
				'label' 		=> esc_html__( 'Items to display', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{rmw_repeater_type}} {{rmw_repeater_product}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rmw_strings',
			[
				'label' 		=> esc_html__( 'Strings', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'rmw_subtitle',
			[
				'label' 		=> esc_html__( '"Click to show additional info" string', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Click pentru valori nutritionale.' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' 			=> [ 'active' => false ],
			]
		);

		$this->add_control(
			'rmw_ingredients_title',
			[
				'label' 		=> esc_html__( '"Ingredients" string', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Ingrediente' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' 			=> [ 'active' => false ],
			]
		);

		$this->add_control(
			'rmw_nfacts_title',
			[
				'label' 		=> esc_html__( '"Nutrition Facts" string', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Informatii Nutritionale 100g' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' 			=> [ 'active' => false ],
			]
		);
		
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if( $settings['rmw_items'] ) {

			echo '<div class="restaurant-items-woo">';

			foreach( $settings['rmw_items'] as $item ) {
				$is_hidden = ( $item['rmw_repeater_show'] === 'yes' ) ? true : false;
				
				$product = wc_get_product( $item['rmw_repeater_product'] );

				if( $is_hidden ) {

					if( $item['rmw_repeater_type'] === 'item' ) {
						echo '
						<div class="restaurant-item item-' . esc_attr( $item['_id'] ) . '">
							<div class="item-image">' . $product->get_image() . '</div>
							<div class="item-details">
								<div class="item-title">
									<h2>' . $product->get_name() . '</h2>
								</div>
								<div class="item-info">
									<div class="info-weight">' . $item['rmw_repeater_weight'] . '</div>
									<div class="info-price">' . $product->get_price_html() . ' <a href="' . get_site_url() . '/?add-to-cart=' . $item['rmw_repeater_product'] . '"><i class="' . $settings['rmw-shop-bag-icon']['value'] . '"></i></a></div>
								</div>
								<div class="item-subtitle">' . $settings['rmw_subtitle'] . '</div>
								<div class="item-facts">
									<h4>' . $settings['rmw_ingredients_title'] . '</h4>
									<div class="item-ingredients">
										<p>' . $item['rmw_repeater_ingredients'] . '</p>
									</div>
									<br>
									<h4>' . $settings['rmw_nfacts_title'] . '</h4>
									<div class="item-nfacts">
										<p>' . $item['rmw_repeater_nfacts'] . '</p>
									</div>
								</div>
								<div class="item-alergies">
									<p>' . $settings['rmw_allergy_title'] . ' ' . $item['rmw_repeater_allergies'] . '</p>
								</div>
							</div>
						</div>';

					} else {
						echo ' 
						<section class="list-item-' . esc_attr( $item['_id'] ) . '">
							<h2 class="item-section-heading">' . $item['rmw_repeater_title'] . '</h2>
						</section>';
					}

				}
			}

			echo '</div>';

		}

		// var_dump($settings);
	}

}