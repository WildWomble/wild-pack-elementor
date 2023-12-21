<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_CustomBundle extends \Elementor\Widget_Base {

	public function get_name() {
		return 'elementor_custom_bundle';
	}

	public function get_title() {
		return esc_html__('[WW] Custom Bundle (Woo)', 'elementor-wild-pack');
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
		return [ 'menu', 'restaurant', 'catering', 'daily', 'food', 'custom', 'package', 'pack', 'variation' ];
	}

	/**
	 * Load the JS only on the page where the widget is used
	 */
	public function get_script_depends() {
		return [ 'ww-custom-bundle-js' ];
	}

	/**
	 * Load the CSS only on the page where the widget is used
	 */
	public function get_style_depends() {
		return [ 'ww-custom-bundle-css' ];
	}

	/**
	 * Get the products from the site
	 */
	public function get_products() {

		$args = array(

			'limit' => -1,
			'orderby' => 'name'
		
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

		/**
		 * CONTENT TAB
		 */
		$this->start_controls_section(
			'section_categories',
			[
				'label'    		=>  esc_html__( 'WooCommerce Categories', 'elementor-wild-pack' ),
				'tab'      		=>  \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'edm_main_product',
			[
				'label' 		=> esc_html__( 'Main Product', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT2,
				'description'	=> esc_html__( 'A WooCommerce Product must be created and chosen. TIP: You can set the product to hidden Visibility preventing customers from finding it.', 'elementor-wild-pack' ),
				'options'		=> self::get_products(),
				'label_block'   => true,
				'multiple'		=> false,
			]
		);

		$this->add_control(
			'edm_subtitle',
			[
				'label' 		=> esc_html__( 'Subtitle', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Items available only today!' , 'elementor-wild-pack' ),
				'label_block'   => true,
				'ai' 			=> [
					'active' 		=> false,
				],
			]
		);

		$this->add_control(
			'edm_adddedtocart',
			[
				'label' 		=> esc_html__( '"Added to Cart" Text', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Product added to cart' , 'elementor-wild-pack' ),
				'label_block'   => true,
				'ai' 			=> [
					'active' 		=> false,
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'edm_title',
			[
				'label' 		=> esc_html__( 'Item Title (Backend Only)', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Product Category' , 'elementor-wild-pack' ),
				'ai' 			=> [
					'active' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'edm_item_title',
			[
				'label' 		=> esc_html__( 'Item Title (Frontend)', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Pick this today!' , 'elementor-wild-pack' ),
				'ai' 			=> [
					'active' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'edm_products',
			[
				'label'         => esc_html__( 'Select Products to show', 'elementor-wild-pack' ),
				'type'          => \Elementor\Controls_Manager::SELECT2,
				'label_block'   => true,
				'multiple'		=> true,
				'options'       => self::get_products(),
				'default'       => 'none'

			]
		);

		$this->add_control(
			'edm_items_note',
			[
				'type' 				=> \Elementor\Controls_Manager::RAW_HTML,
				'raw'				=> esc_html__( 'For each tab below, you can choose as many products as you like, one of each section will be added as a chosen variation to the Main Product once added to cart.', 'elementor-wild-pack' ),
				'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-warning',
				'separator'			=> 'before',
			]
		);

		$this->add_control(
			'edm_items',
			[
				'label' 		=> esc_html__( 'Bundles - Woo Products', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{edm_title}}',
			]
		);

		$this->end_controls_section();

		/**
		 * STYLE TAB
		 */
		 
		$this->start_controls_section(
			'style_overall',
			[
				'label'     => esc_html__('Overall settings', 'elementor-wild-pack'),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'style_edm_columns',
			[
				'label' 		=> esc_html__( 'Columns to show', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> '5',
				'options'		=> [
					'1'		=>	esc_html__( '1 column', 'elementor-wild-pack' ),
					'2'		=>	esc_html__( '2 columns', 'elementor-wild-pack' ),
					'3'		=>	esc_html__( '3 columns', 'elementor-wild-pack' ),
					'4'		=>	esc_html__( '4 columns', 'elementor-wild-pack' ),
					'5'		=>	esc_html__( '5 columns - Default', 'elementor-wild-pack' ),
					'6'		=>	esc_html__( '6 columns', 'elementor-wild-pack' ),
				],
				'selectors'		=>	[
					'{{WRAPPER}} .products li'	=>	'flex: 0 1 calc( (100% / {{VALUE}}) - 10px );'
				],
				'separator'		=> 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'style_subtitle',
				'label'     	=> esc_html__( 'Subtitle', 'elementor-wild-pack' ),
				'selector' 		=> '{{WRAPPER}} .edm-subtitle h4',
			]
		);

		$this->add_control(
			'style_subtitle_color',
			[
				'label' 		=> esc_html__( 'Subtitle Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-subtitle h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_checkmark_bg',
			[
				'label' 		=> esc_html__( 'Checkmark Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input:checked + label .product-image::after' => 'background-color: {{VALUE}}',
				],
				'separator'		=> 'before',
			]
		);

		$this->add_control(
			'style_checkmark_color',
			[
				'label' 		=> esc_html__( 'Checkmark Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input:checked + label .product-image::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_sections',
			[
				'label'     => esc_html__( 'Product Sections', 'elementor-wild-pack' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'style_section_heading',
				'label'     	=> esc_html__( 'Section Heading', 'elementor-wild-pack' ),
				'selector' 		=> '{{WRAPPER}} .edm-product-list h3',
			]
		);

		$this->start_controls_tabs(
			'style_tabs_product_sections'
		);
		
		$this->start_controls_tab(
			'style_ps_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'elementor-wild-pack' ),
			]
		);

		$this->add_control(
			'style_product_bg_n',
			[
				'label' 		=> esc_html__( 'Product Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input + label' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_product_heading_color_n',
			[
				'label' 		=> esc_html__( 'Product Title Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li .product-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'style_product_heading_n',
				'label'     	=> esc_html__( 'Product Title', 'elementor-wild-pack' ),
				'selector' 		=> '{{WRAPPER}} .product-name',
				'separator'		=> 'before'
			]
		);

		$this->add_control(
			'hr-1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'style_product_box_shadow_n',
				'selector' 		=> '{{WRAPPER}} .edm-product-list li input + label',
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'style_ps_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'elementor-wild-pack' ),
			]
		);

		$this->add_control(
			'style_product_bg_h',
			[
				'label' 		=> esc_html__( 'Product Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input:hover + label' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_product_heading_color_h',
			[
				'label' 		=> esc_html__( 'Product Title Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input:hover + label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr-2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'style_product_box_shadow_h',
				'selector' 		=> '{{WRAPPER}} .edm-product-list li input:hover + label',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_ps_active_tab',
			[
				'label' => esc_html__( 'Selected', 'elementor-wild-pack' ),
			]
		);

		$this->add_control(
			'style_product_bg_a',
			[
				'label' 		=> esc_html__( 'Product Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input:checked + label' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_product_heading_color_a',
			[
				'label'			=> esc_html__( 'Product Title Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .edm-product-list li input:checked + label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hr-3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'style_product_box_shadow_a',
				'selector' 		=> '{{WRAPPER}} .edm-product-list li input:checked + label',
			]
		);
		
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'style_product_border_radius',
			[
				'label' 		=> esc_html__( 'Border Radius', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'default'		=> [
					'top'			=> 10,
					'right'			=> 10,
					'bottom'		=> 10,
					'left'			=> 10,
					'unit'			=> 'px',
					'isLinked'		=> true
				],
				'selectors' => [
					'{{WRAPPER}} .edm-product-list li input + label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'		=> 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_images',
			[
				'label'     	=> esc_html__( 'Product Images', 'elementor-wild-pack' ),
				'tab'       	=> \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'style_product_image',
			[
				'label' 		=> esc_html__( 'Image Height', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'			=> [
					'px'	=> [
						'min' 	=> 0,
						'max'	=> 500,
						'step' 	=> 1,
					],
					'%'		=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 		=> [
					'unit' 	=> 'px',
					'size'	=> 160,
				],
				'selectors'		=>	[
					'{{WRAPPER}} .product-image img'	=>	'height: {{SIZE}}{{UNIT}}'
				],
				'separator'		=> 'after'
			]
		);

		$this->add_responsive_control(
			'style_product_image_br',
			[
				'label' 		=> esc_html__( 'Image Border Radius', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				'default'		=> [
					'top'			=> 5,
					'right'			=> 5,
					'bottom'		=> 5,
					'left'			=> 5,
					'unit'			=> 'px',
					'isLinked'		=> true
				],
				'selectors' 	=> [
					'{{WRAPPER}} .product-image' 		=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .product-image img' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_buttons',
			[
				'label'     => esc_html__( 'Buttons', 'elementor-wild-pack' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'style_atc_bg',
			[
				'label' 		=> esc_html__( 'Add to Cart - Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #edm-add-to-cart' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_atc_color',
			[
				'label'			=> esc_html__( 'Add to Cart - Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #edm-add-to-cart' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'style_atc_text',
				'label'     	=> esc_html__( 'Add to Cart - Text Settings', 'elementor-wild-pack' ),
				'selector' 		=> '{{WRAPPER}} #edm-add-to-cart'
			]
		);

		$this->add_control(
			'hr-4',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'style_add_another_bg',
			[
				'label' 		=> esc_html__( 'Add Another - Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #buy-another' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_add_another_color',
			[
				'label'			=> esc_html__( 'Add Another - Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #buy-another' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'style_add_another_text',
				'label'     	=> esc_html__( 'Add Another - Text Settings', 'elementor-wild-pack' ),
				'selector' 		=> '{{WRAPPER}} #buy-another'
			]
		);

		$this->add_control(
			'hr-5',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'style_checkout_bg',
			[
				'label' 		=> esc_html__( 'Checkout - Background', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #edm-checkout' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'style_checkout_color',
			[
				'label'			=> esc_html__( 'Checkout - Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #edm-checkout' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'style_checkout_text',
				'label'     	=> esc_html__( 'Checkout - Text Settings', 'elementor-wild-pack' ),
				'selector' 		=> '{{WRAPPER}} #edm-checkout',
				'separator'		=> 'after'
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$custom_product_id = $settings['edm_main_product'];
		$EDM_Items = $settings['edm_items'];

		$output = $EDM_products = null;

		$step = 1;

		if( $EDM_Items ) {

			foreach( $EDM_Items as $item ) {

				$products = null;

				foreach( $item['edm_products'] as $subitem ) {

					$product = wc_get_product( $subitem );

					$products .= "
					<li class='edm-product'>
						<input type='radio' id='product-s{$step}-{$product->get_id()}' name='edm_variations[step-{$step}]' class='form-control product-name' value='{$product->get_name()}'>
						<label for='product-s{$step}-{$product->get_id()}'>
							<div class='product-image'>{$product->get_image()}</div>
							<div class='product-name'>{$product->get_name()}</div>
						</label>
					</li>
					";

				}

				$EDM_products .= "
					<div class='edm-product-list'>
						<h3>{$item['edm_item_title']}</h3>
						<ul class='products'>
							{$products}
						</ul>
					</div>
				";

				$step++;

			}

			$button_messages = array(
				esc_html( $product->add_to_cart_text() ), // add to cart button from the product (in case the user changes it)
				esc_html__( 'Proceed to checkout', 'woocommerce' ), // using WooCommerce's translation for a simpler and faster use
				esc_html__( 'Add Another', 'elementor-wild-pack' ) 
			);

			$cart_url = wc_get_cart_url();

			$output = "
				<div class='edm-subtitle'>
					<h4>{$settings['edm_subtitle']}</h4>
				</div>
				<div id='edm-products'>
					<form id='form_edm_addtocart'>
						<input hidden name='edm_product_id' value='{$custom_product_id}'>
						<input hidden name='edm_steps' value='{$step}'>
						{$EDM_products}
						<div class='form-actions'>
							<a href='#' class='edm-add-to-cart item-hidden' id='edm-add-to-cart'>{$button_messages[0]}</a>
						</div>
					</form>
				</div>
				<div id='edm-popup' class='item-hidden'>
					<div>
						<div id='edm-popup-message'>{$settings['edm_adddedtocart']}</div>
						<a href='#' class='button' id='buy-another'>{$button_messages[2]}</a>
						<a href='{$cart_url}' class='checkout-button button' id='edm-checkout' target='_blank'>{$button_messages[1]}</a>
					</div>
				</div>
			";

			echo $output;

		}

	}

}
