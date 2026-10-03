<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use FredericoDeCastro\Custom_Installments\Core\Helpers;
use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;
use FredericoDeCastro\Custom_Installments\Views\Components;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Elementor widget for add discount per quantity message
 * 
 * @since 5.2.0
 * @version 5.5.1
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Discount_Per_Quantity extends Widget_Base {

	/**
	 * Get widget name
	 *
     * @since 5.2.0
	 * @return string Widget name
	 */
	public function get_name() {
		return 'wci_discount_per_quantity_message';
	}


	/**
	 * Get widget title
	 *
     * @since 5.2.0
	 * @return string Widget title
	 */
	public function get_title() {
		return esc_html__( 'Mensagem de desconto por quantidade', 'custom-installments-for-woocommerce' );
	}
    

	/**
	 * Get widget icon
	 *
     * @since 5.2.0
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'eicon-product-info';
	}

	/**
	 * Get widget categories
	 *
     * @since 5.2.0
	 * @return array Widget categories
	 */
	public function get_categories() {
		return array('custom-installments-for-woocommerce');
	}


    /**
     * Search widget by keywords
     * 
     * @since 5.2.0
     * @return array
     */
    public function get_keywords() {
        return [ 'discount', 'desconto', 'quantidade', 'desconto por quantidade', 'discount per quantity' ];
    }


    /**
	 * Show in panel
	 *
     * @since 5.2.0
	 * @return bool Whether to show the widget in the panel or not
	 */
	public function show_in_panel() {
        return true;
    }


	/**
     * Register the widget controls
     * 
     * @since 5.2.0
     * @return void
     */
    protected function register_controls() {
        $this->start_controls_section(
            'wci_discount_message_style_section',
            [
                'label' => esc_html__( 'Estilos - Mensagem de desconto por quantidade', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wci_discount_message_text_color',
            [
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wci_discount_message_background_color',
            [
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wci_discount_message_typography',
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message span',
            ]
        );

        $this->add_control(
            'wci_discount_message_icon_color',
            [
                'label' => esc_html__( 'Cor do ícone', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'wci_discount_message_icon_size',
            [
                'label' => esc_html__( 'Tamanho do ícone', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wci_discount_message_margin',
            [
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wci_discount_message_padding',
            [
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-discount-per-quantity-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    /**
	 * Render the widget output on the frontend
     * 
     * @since 5.2.0
     * @version 5.4.0
     * @return void
	 */
	protected function render() {
        if ( Admin_Options::get_setting('discount_per_qtd_message_method') === 'widget' ) {
            $settings = wp_parse_args(
                $this->get_settings_for_display(), array(
                    'product_id' => false,
                ),
            );

            $product_id = Helpers::get_product_id_from_post();
            $product = wc_get_product( $product_id );

            // instance of components class
            $components = new Components();

            echo $components->message_for_discount_per_quantity( $product );
        }
	}
}