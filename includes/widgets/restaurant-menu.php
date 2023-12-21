<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_RestaurantMenu extends \Elementor\Widget_Base {

	public function get_name() {
		return 'elementor_restaurant_menu';
	}

	public function get_title() {
		return esc_html__( '[WW] Restaurant Menu', 'elementor-wild-pack' );
	}

	public function get_icon() {
		return 'eicon-code';
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
		return [ 'ww-restaurant-menu-js' ];
	}

	public function get_style_depends() {
		return [ 'ww-restaurant-menu-css' ];
	}
    
	protected function register_controls() {
		
		$this->start_controls_section(
			'lang_section',
			[
				'label' 		=> esc_html__( 'Languages', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'first_lang',
			[
				'label' 		=> esc_html__( 'First Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'none',
				'options' 		=> [
					'none' 			=> esc_html__( 'None', 'elementor-wild-pack' ),
					'romana' 		=> esc_html__( 'Romana', 'elementor-wild-pack' ),
					'english' 		=> esc_html__( 'English', 'elementor-wild-pack' ),
					'deutsch' 		=> esc_html__( 'Deutsch', 'elementor-wild-pack' ),
				]
			]
		);

		$this->add_control(
			'second_lang',
			[
				'label' 		=> esc_html__( 'Second Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'none',
				'options' 		=> [
					'none' 			=> esc_html__( 'None', 'elementor-wild-pack' ),
					'romana' 		=> esc_html__( 'Romana', 'elementor-wild-pack' ),
					'english' 		=> esc_html__( 'English', 'elementor-wild-pack' ),
					'deutsch' 		=> esc_html__( 'Deutsch', 'elementor-wild-pack' ),
				]
			]
		);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'string_section',
			[
				'label' 		=> esc_html__( 'Strings', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'subtitle_first_lang',
			[
				'label' 		=> esc_html__( 'Subtitle - First Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Click pentru valori nutritionale.' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'subtitle_second_lang',
			[
				'label' 		=> esc_html__( 'Subtitle - Second Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Click to show nutritional values.' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after',
			]
		);

		$this->add_control(
			'ingr_first_lang',
			[
				'label' 		=> esc_html__( 'Ingredients Title - First Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Ingrediente' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'ingr_second_lang',
			[
				'label' 		=> esc_html__( 'Ingredients Title - Second Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Ingredients' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after'
			]
		);

		$this->add_control(
			'nutr_first_lang',
			[
				'label' 		=> esc_html__( 'Nutrition Facts Title - First Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Informatii Nutritionale 100g' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'nutr_second_lang',
			[
				'label' 		=> esc_html__( 'Nutrition Facts Title - Second Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Nutrition Facts per 100g' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after'
			]
		);

		$this->add_control(
			'alergy_first_lang',
			[
				'label' 		=> esc_html__( 'Alergies Title - First Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Alergeni:' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
			]
		);

		$this->add_control(
			'alergy_second_lang',
			[
				'label' 		=> esc_html__( 'Alergies Title - Second Language', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Alergies:' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'items_section',
			[
				'label' 		=> esc_html__( 'Items & Settings', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'currency',
			[
				'label' 		=> esc_html__( 'Currency', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'RON',
				'options' 		=> [
					'€' 		=> esc_html__( '(€) Euro', 'elementor-wild-pack' ),
					'$' 		=> esc_html__( '($) Dollar', 'elementor-wild-pack' ),
					'RON' 		=> esc_html__( '(RON) Romanian Leu', 'elementor-wild-pack' ),
				]
			]
		);

		/*
		* The new method shown on the official docs does not have an id for each field 
		* as it should and it will throw an error in the console 'r[a] is not defined'
		* This method fixed the issue
		*/
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_item_type',
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
			'list_item_image',
			[
				'label' 		=> esc_html__( 'Choose Image', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'list_item_type' 	=> 'item',
				],
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'list_item_show',
			[
				'label' 		=> esc_html__( 'Show this item?', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$repeater->add_control(
			'list_item_second_lang',
			[
				'label' 		=> esc_html__( 'Show 2nd language?', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Yes', 'elementor-wild-pack' ),
				'label_off' 	=> esc_html__( 'No', 'elementor-wild-pack' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'list_item_name',
			[
				'label' 		=> esc_html__( 'Item Name', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Something delicious!' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
			'list_item_name_2nd',
			[
				'label' 		=> esc_html__( 'Item Name 2', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Something delicious!' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'list_item_ingredients',
			[
				'label' 		=> esc_html__( 'Item Ingredients', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__( 'Ingredients' , 'elementor-wild-pack' ),
				'condition' => [
					'list_item_type' => 'item',
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
			'list_item_ingredients_2nd',
			[
				'label' 		=> esc_html__( 'Item Ingredients 2', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__( 'Ingredients' , 'elementor-wild-pack' ),
				'condition' => [
					'list_item_type' 	=> 'item',
					'list_item_second_lang'	=> 'yes'
				],
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'list_item_nutrition_facts',
			[
				'label' 		=> esc_html__( 'Item Nutrition Facts', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__( 'Energy Values' , 'elementor-wild-pack' ),
				'condition' => [
					'list_item_type' => 'item',
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
			'list_item_nutrition_facts_2nd',
			[
				'label' 		=> esc_html__( 'Item Nutrition Facts 2', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'default' 		=> esc_html__( 'Energy Values' , 'elementor-wild-pack' ),
				'condition' => [
					'list_item_type' 	=> 'item',
					'list_item_second_lang'	=> 'yes'
				],
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'list_item_alergies',
			[
				'label' 		=> esc_html__( 'Item Alergies', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Peanuts, Milk' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'condition' => [
					'list_item_type' => 'item',
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$repeater->add_control(
			'list_item_alergies_2nd',
			[
				'label' 		=> esc_html__( 'Item Alergies 2', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Peanuts, Milk' , 'elementor-wild-pack' ),
				'label_block' 	=> true,
				'condition' => [
					'list_item_type' 	=> 'item',
					'list_item_second_lang'	=> 'yes'
				],
				'ai' => [
					'active' => false,
				],
				'separator' 	=> 'after',
			]
		);

		$repeater->add_control(
			'list_item_weight',
			[
				'label' 		=> esc_html__( 'Item Weight (g)', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( '250g' , 'elementor-wild-pack' ),
				'condition' 	=> [
					'list_item_type' => 'item',
				],
				'ai' 			=> [
					'active' 		=> false,
				],
			]
		);

		$repeater->add_control(
			'list_item_price',
			[
				'label' 		=> esc_html__( 'Item Price', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'default' 		=> esc_html__( '2.55' , 'elementor-wild-pack' ),
				'condition' 	=> [
					'list_item_type' => 'item',
				],
				'ai' 			=> [
					'active' 		=> false,
				],
			]
		);

		$this->add_control(
			'restaurant_items',
			[
				'label' 		=> esc_html__( 'Restaurant Items', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{list_item_name}} ({{list_item_type}})'
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'flag_style',
			[
				'label' 		=> esc_html__( 'Flag Style', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'flag_size',
			[
				'type' 			=> \Elementor\Controls_Manager::SLIDER,
				'label' 		=> esc_html__( 'Flag Size', 'elementor-wild-pack' ),
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%'	=> [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' 		=> [ 'desktop', 'tablet', 'mobile' ],
				'selectors' 	=> [
					'{{WRAPPER}} #language-switch img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'flag_margin',
			[
				'label' => esc_html__( 'Margins', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} #language-switch' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'elementor-wild-pack' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'flags_typography_normal',
				'selector' 		=> '{{WRAPPER}} #language-switch span',
			]
		);

		$this->add_control(
			'flags_background_color_normal',
			[
				'label' 		=> esc_html__( 'Background Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#fff',
				'selectors' 	=> [
					'{{WRAPPER}} #language-switch label' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'flags_border_radius_normal',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} #language-switch label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'elementor-wild-pack' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'flags_typography_hover',
				'selector' 		=> '{{WRAPPER}} #language-switch label:hover span',
			]
		);

		$this->add_control(
			'flags_background_color_hover',
			[
				'label' 		=> esc_html__( 'Background Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#eee',
				'selectors' 	=> [
					'{{WRAPPER}} #language-switch label:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'flags_border_radius_hover',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} #language-switch label:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_active_tab',
			[
				'label' => esc_html__( 'Active', 'elementor-wild-pack' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'flags_typography_active',
				'selector' 		=> '{{WRAPPER}} #language-switch .lang-active span',
			]
		);

		$this->add_control(
			'flags_background_color_active',
			[
				'label' 		=> esc_html__( 'Background Color', 'elementor-wild-pack' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'default' 		=> '#fff',
				'selectors' 	=> [
					'{{WRAPPER}} #language-switch .lang-active' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'flags_border_radius_active',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-wild-pack' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} #language-switch .lang-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

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
		
		/*
		*	Item Name Group
		*/
		$this->start_controls_section(
			'items_name_style',
			[
				'label' 		=> esc_html__( 'Item Name', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		/*
		*	Item Weight Group
		*/
		$this->start_controls_section(
			'items_weight_style',
			[
				'label' 		=> esc_html__( 'Item Weight', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		/*
		*	Item Price Group
		*/
		$this->start_controls_section(
			'items_price_style',
			[
				'label' 		=> esc_html__( 'Item Price', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		/*
		*	Item Subtitle Group
		*/
		$this->start_controls_section(
			'items_subtitle_style',
			[
				'label' 		=> esc_html__( 'Item Subtitle', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		/*
		*	Item Alergies Group
		*/
		$this->start_controls_section(
			'items_alergy_style',
			[
				'label' 		=> esc_html__( 'Item Alergies', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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

		/*
		*	Item Ingredients Group - Shown on item click
		*/
		$this->start_controls_section(
			'items_ingr_style',
			[
				'label' 		=> esc_html__( 'Item Ingredients - Shown on item click', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->end_controls_section();

		/*
		*	Item Nutrition Group - Shown on item click
		*/
		$this->start_controls_section(
			'items_nutr_style',
			[
				'label' 		=> esc_html__( 'Item Nutrition Facts - Shown on item click', 'elementor-wild-pack' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
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
		?>

		<?php
		if ( $settings['restaurant_items'] ) {
			if($settings['first_lang'] != 'none' && $settings['second_lang'] != 'none') {
				$flags = '
				<label for="language_' . $settings['first_lang'] . '">
					<input type="radio" id="language_' . $settings['first_lang'] . '" name="language_switch" value="first_lang">
					<img src="' . plugins_url( '../assets/img/flags/flag-' . $settings['first_lang'] . '.jpg', __FILE__ ) . '"> <span>' . $settings['first_lang'] . '</span>
				</label>
				<label for="language_' . $settings['second_lang'] . '">
					<input type="radio" id="language_' . $settings['second_lang'] . '" name="language_switch" value="second_lang">
					<img src="' . plugins_url( '../assets/img/flags/flag-' . $settings['second_lang'] . '.jpg', __FILE__ ) . '"> <span>' . $settings['second_lang'] . '</span>
				</label>';
			} else {
				$flags = '';
			}
			echo '<div id="language-switch">' . $flags . '</div>';

			echo '<div class="restaurant-items">';
			foreach (  $settings['restaurant_items'] as $item ) {
				$hidden = ($item['list_item_show'] === 'yes') ? 'item-show' : 'item-hidden';

				if($item['list_item_type'] == 'heading') {
					echo '
					<section class="list-item-' . esc_attr( $item['_id'] ) . ' ' . $hidden . '">
						<h2 class="item-section-heading first-lang">' . $item['list_item_name'] . '</h2>
						<h2 class="item-section-heading second-lang">' . $item['list_item_name_2nd'] . '</h2>
					</section>';
				} else {
					echo '
					<div class="item-' . esc_attr( $item['_id'] ) . ' restaurant-item ' . $hidden . '">
						<div class="item-image"><img src="' . $item['list_item_image']['url'] . '"></div>
						<div class="item-details">
							<div class="item-title">
								<div class="first-lang"><h2>' . $item['list_item_name'] . '</h2></div>
								<div class="second-lang"><h2>' . $item['list_item_name_2nd'] . '</h2></div>
							</div>
							<div class="item-info">
								<div class="info-weight">' . $item['list_item_weight'] . '</div>
								<div class="info-price">' . $item['list_item_price'] . ' ' . $settings['currency'] . '</div>
							</div>
							<div class="item-subtitle">
								<p class="first-lang">' . $settings['subtitle_first_lang'] . '</p>
								<p class="second-lang">' . $settings['subtitle_second_lang'] . '</p>
							</div>
							<div class="item-facts">
								<h4 class="first-lang">' . $settings['ingr_first_lang'] . '</h4>
								<h4 class="second-lang">' . $settings['ingr_first_lang'] . '</h4>
								<div class="item-ingredients">
									<p class="first-lang">' . $item['list_item_ingredients'] . '</p>
									<p class="second-lang">' . $item['list_item_ingredients_2nd'] . '</p>
								</div>
								<br>
								<h4 class="first-lang">' . $settings['nutr_first_lang'] . '</h4>
								<h4 class="second-lang">' . $settings['nutr_second_lang'] . '</h4>
								<div class="item-nutr-facts">
									<p class="first-lang">' . $item['list_item_nutrition_facts'] . '</p>
									<p class="second-lang">' . $item['list_item_nutrition_facts_2nd'] . '</p>
								</div>
							</div>
							<div class="item-alergies">
								<p class="first-lang">' . $settings['alergy_first_lang'] . ' ' . $item['list_item_alergies'] . '</p>
								<p class="second-lang">' . $settings['alergy_second_lang'] . ' ' . $item['list_item_alergies_2nd'] . '</p>
							</div>
						</div>
					</div>
					';
				}
			}
			echo '</div>';
		}
	}
}