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
		return [ 'wild-pack-category' ];
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

				$product_sku = empty( $product->get_sku() ) ? '' : ' (' . $product->get_sku(). ')';

				$woo_products[$product->get_id()] = $product->get_name() . $product_sku;

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
			'rmw_shop_bag_icon',
			[
				'label'			=> esc_html__( 'Add to Cart Icon', 'textdomain' ),
				'type' 			=> \Elementor\Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'fas fa-shopping-cart',
					'library' 		=> 'fa-solid',
				],
			]
		);
		$this->add_control(
			'hr_9',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'rmw_display_add_to_cart',
			[
				'label' => esc_html__( 'Disable Add to Cart button?', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementor-wild-pack' ),
				'label_off' => esc_html__( 'No', 'elementor-wild-pack' ),
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'rmw_display_click_popup',
			[
				'label' => esc_html__( 'Disable click popup globally?', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementor-wild-pack' ),
				'label_off' => esc_html__( 'No', 'elementor-wild-pack' ),
				'default' => 'no',
			]
		);

		$this->add_control(
			'hr_8',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
			'rmw_repeater_popup',
			[
				'label' => esc_html__( 'Disable click popup for this item?', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'elementor-wild-pack' ),
				'label_off' => esc_html__( 'No', 'elementor-wild-pack' ),
				'default' => 'no',
			]
		);

		$repeater->add_control(
			'rmw_repeater_hr_0',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
				'type'          => \Elementor\Controls_Manager::SELECT2,
				'label_block'   => true,
				'multiple'		=> false,
				'options'       => self::get_products(),
				'default'       => 'none',
				'condition'		=> [ 'rmw_repeater_type' => 'item' ],
			]
		);

		$repeater->add_control(
			'rmw_repeater_hr_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
			'rmw_repeater_weight', 
			[
				'label'			=> esc_html__( 'Weight', 'elementor-wild-pack' ),
				'type'			=> \Elementor\Controls_Manager::TEXT,
				'default'		=> esc_html__( '250g', 'elementor-wild-pack' ),
				'ai'			=> [ 'active' => false ],
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
			'rmw_repeater_allergies',
			[
				'label' 		=> esc_html__( 'Allergies', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'N/A' , 'elementor-wild-pack' ),
				'label_block'   => true,
				'condition'		=> [ 'rmw_repeater_type' => 'item' ],
				'ai' 			=> [ 'active' => false ],
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

		$this->add_control(
			'rmw_allergy_title',
			[
				'label' 		=> esc_html__( '"Allergies" string', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Alergii' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' 			=> [ 'active' => false ],
			]
		);
		
		$this->end_controls_section();

		/* STYLING */

		$this->start_controls_section(
			'heading_style',
			[
				'label' 		=> esc_html__( 'Headers', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'heading_typography',
				'selector' 		=> '{{WRAPPER}} .item-section-heading',
			]
		);

		$this->add_control(
			'heading_text_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#ffd400',
				'selectors' 	=> [
					'{{WRAPPER}} .item-section-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_background_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#605c5c',
				'selectors' 	=> [
					'{{WRAPPER}} .item-section-heading' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'heading_border',
				'selector' => '{{WRAPPER}} .item-section-heading',
			]
		);
		
		$this->add_control(
			'heading_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .item-section-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'items_style',
			[
				'label' 		=> esc_html__( 'Items', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_style_hover_group',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Hover', 'elementor-wild-pack' ),
				'content_classes' => 'fw-bold',
			]
		);

		$this->add_control(
			'item_hover_bg',
			[
				'label' 		=> esc_html__( 'Background Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#eee',
				'selectors' 	=> [
					'{{WRAPPER}} .restaurant-items-woo .restaurant-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr-0',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'items_style_name_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Names', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_name_typography',
				'selector' 		=> '{{WRAPPER}} .item-details h2',
			]
		);

		$this->add_control(
			'item_name_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#242424',
				'selectors' 	=> [
					'{{WRAPPER}} .item-details h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr-1',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'items_style_weight_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw'				=> esc_html__( 'Weight', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_weight_typography',
				'selector' 		=> '{{WRAPPER}} .info-weight',
			]
		);

		$this->add_control(
			'item_weight_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#242424',
				'selectors' 	=> [
					'{{WRAPPER}} .info-weight' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr-2',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'items_style_price_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Prices', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_price_typography',
				'selector' 		=> '{{WRAPPER}} .info-price',
			]
		);

		$this->add_control(
			'item_price_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#242424',
				'selectors' 	=> [
					'{{WRAPPER}} .info-price' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'hr-3',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'items_style_subtitle_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Subtitle', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_subtitle_typography',
				'selector' 		=> '{{WRAPPER}} .item-subtitle',
			]
		);

		$this->add_control(
			'item_subtitle_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#242424',
				'selectors' 	=> [
					'{{WRAPPER}} .item-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'hr-4',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'items_style_alergies_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Alergies', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_alergy_typography',
				'selector' 		=> '{{WRAPPER}} .item-alergies',
			]
		);

		$this->add_control(
			'item_alergy_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#5e5e5e',
				'selectors' 	=> [
					'{{WRAPPER}} .item-alergies' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'items_atc_style',
			[
				'label' 		=> esc_html__( 'Buttons', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_atc_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#242424',
				'selectors' 	=> [
					'{{WRAPPER}} .info-price .add-to-cart span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_atc_bg_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#fff',
				'selectors' 	=> [
					'{{WRAPPER}} .info-price .add-to-cart' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_atc_icon_color',
			[
				'label' 		=> esc_html__( 'Icon Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#242424',
				'selectors' 	=> [
					'{{WRAPPER}} .info-price .add-to-cart i' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'hr-7',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'item_atc_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' 		=> [
					'top' 			=> 0,
					'right' 		=> 0,
					'bottom' 		=> 0,
					'left' 			=> 0,
					'unit' 			=> 'px',
					'isLinked' 		=> false,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .add-to-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_atc_border-radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' 		=> [
					'top' 			=> 0,
					'right' 		=> 0,
					'bottom' 		=> 0,
					'left' 			=> 0,
					'unit' 			=> '%',
					'isLinked' 		=> false,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'hr-6',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'item_show_atc_string',
			[
				'label' 		=> esc_html__( 'Show "Add to Cart" text?', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Yes', 'elementor-wild-pack' ),
				'label_off' 	=> esc_html__( 'No', 'elementor-wild-pack' ),
				'default' 		=> 'no',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'AtC_typography',
				'selector' 		=> '{{WRAPPER}} .add-to-cart',
				'condition'		=> [ 'item_show_atc_string' => 'yes' ],
			]
		);
		
		$this->add_control(
			'item_atc_origin',
			[
				'label'			=> esc_html__( 'Change "Add to Cart" text', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::CHOOSE,
				'options' 		=> [
					'default' 		=> [
						'title' 		=> esc_html__( 'Leave default (woocommerce)', 'elementor-wild-pack' ),
						'icon' 			=> 'eicon-woo-settings',
					],
					'custom' 			=> [
						'title' 		=> esc_html__( 'Custom text', 'elementor-wild-pack' ),
						'icon' 			=> 'eicon-wrench',
					],
				],
				'default' 		=> 'default',
				'toggle' 		=> false,
				'condition'		=> [ 'item_show_atc_string' => 'yes' ],
			]
		);

		$this->add_control(
			'item_atc_custom_text',
			[
				'label'			=> esc_html__( 'Custom Text', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Add to Cart', 'elementor-wild-pack' ),
				'condition'		=> [ 'item_atc_origin' => 'custom' ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'items_on_click_style',
			[
				'label' 		=> esc_html__( 'On item click text settings', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_style_ingr_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw'				=> esc_html__( 'Ingredients', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_ingr_typography',
				'selector' 		=> '{{WRAPPER}} .item-ingredients',
			]
		);

		$this->add_control(
			'item_ingr_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#5e5e5e',
				'selectors' 	=> [
					'{{WRAPPER}} .item-ingredients' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr-5',
			[
				'type' 			=> \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'items_style_nutr_group',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw' 				=> esc_html__( 'Nutrition Facts', 'elementor-wild-pack' ),
				'content_classes' 	=> 'fw-bold',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'item_nutr_typography',
				'selector' 		=> '{{WRAPPER}} .item-nutr-facts',
			]
		);

		$this->add_control(
			'item_nutr_color',
			[
				'label' 		=> esc_html__( 'Text Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#5e5e5e',
				'selectors' 	=> [
					'{{WRAPPER}} .item-nutr-facts' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$add_to_cart_STRING = null;

		if( $settings['rmw_items'] ) {

			$add_to_cart_SHOW = $settings['item_show_atc_string'];

			echo '<div class="restaurant-items-woo">';

			foreach( $settings['rmw_items'] as $item ) {
				$is_hidden = ( $item['rmw_repeater_show'] === 'yes' ) ? true : false;
				
				/**
				 * Get our product info by ID
				 */
				$product = wc_get_product( $item['rmw_repeater_product'] );

				if( $is_hidden ) {

					/**
					 * Display heading or item according to the chosen value
					 */
					if( $item['rmw_repeater_type'] === 'item' ) {

						/**
						 * Check if the user wants to display or hide the click popup GLOBALLY
						 */
						if( $settings['rmw_display_click_popup'] === 'yes' ) {

							$item_facts = null;

						} else {

							/**
							 * Check if the user wants to display or hide the click popup PER ITEM
							 * but the global setting has priority
							 */
							if( $item['rmw_repeater_popup'] === 'yes' ) {

								$item_facts = null;

							} else {

								$item_facts = '
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
								</div>';

							}
						}

						/**
						 * Check if user wants to hide the Add to Cart button
						 */
						if( $settings['rmw_display_add_to_cart'] === 'yes' ) {

							$add_to_cart_HTML = null;

						} else {

							/**
							 * Check if we want to display the default Add to Cart text or a custom text
							 */
							if( $add_to_cart_SHOW === 'yes' ) {
								$add_to_cart_ORIGIN = $settings['item_atc_origin'];
				
								if( $add_to_cart_ORIGIN === 'default' ) {
									$add_to_cart_STRING = '<span>' . esc_html( $product->add_to_cart_text() ) . '</span>';
								} else {
									$add_to_cart_STRING = '<span>' . $settings['item_atc_custom_text'] . '</span>';
								}
							}

							$add_to_cart_HTML = '<a class="add-to-cart" href="' . get_site_url() . '/?add-to-cart=' . $item['rmw_repeater_product'] . '"><i class="' . $settings['rmw_shop_bag_icon']['value'] . '"></i> ' . $add_to_cart_STRING . '</a>';
						}

						echo '
						<div class="restaurant-item item-' . esc_attr( $item['_id'] ) . '">
							<div class="item-image">' . $product->get_image() . '</div>
							<div class="item-details">
								<div class="item-title">
									<h2>' . $product->get_name() . '</h2>
								</div>
								<div class="item-info">
									<div class="info-weight">' . $item['rmw_repeater_weight'] . '</div>
									<div class="info-price">' . $product->get_price_html() . ' ' . $add_to_cart_HTML . '</div>
								</div>
								' . $item_facts . '
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
	}

}