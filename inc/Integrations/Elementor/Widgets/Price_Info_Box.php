<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

use FredericoDeCastro\Custom_Installments\Core\Helpers;
use FredericoDeCastro\Custom_Installments\Core\Calculate_Values;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Elementor widget for price info box on single product page
 * 
 * @since 5.0.0
 * @version 5.5.1
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Price_Info_Box extends Widget_Base {

    /**
     * Get widget name
     *
     * @return string Widget name
     */
    public function get_name() {
        return 'wci_price_info_box';
    }


    /**
     * Get widget title
     *
     * @return string Widget title
     */
    public function get_title() {
        return esc_html__('Caixa de informação de preço', 'custom-installments-for-woocommerce');
    }
    

    /**
     * Get widget icon
     *
     * @return string Widget icon
     */
    public function get_icon() {
        return 'eicon-product-info';
    }


    /**
     * Get widget categories
     *
     * @return array Widget categories
     */
    public function get_categories() {
        return ['custom-installments-for-woocommerce'];
    }


    /**
     * Register the widget controls
     * 
     * @since 5.0.0
     * @return void
     */
    protected function register_controls() {
        $this->start_controls_section(
            'wci_price_info_box_content',
            [
                'label' => esc_html__('Configurações', 'custom-installments-for-woocommerce'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wci_price_info_box_price_type',
            [
                'label' => esc_html__('Escolha o preço', 'custom-installments-for-woocommerce'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'pix' => esc_html__('Preço no Pix', 'custom-installments-for-woocommerce'),
                    'ticket' => esc_html__('Preço no Boleto', 'custom-installments-for-woocommerce'),
                    'economy_pix' => esc_html__('Economia no Pix', 'custom-installments-for-woocommerce'),
                ],
                'default' => 'pix',
            ]
        );

        $this->add_control(
            'wci_price_info_box_text_before',
            [
                'label' => esc_html__('Texto antes do preço', 'custom-installments-for-woocommerce'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Preço com desconto:', 'custom-installments-for-woocommerce'),
            ]
        );

        $this->add_control(
            'wci_price_info_box_text_after',
            [
                'label' => esc_html__('Texto depois do preço', 'custom-installments-for-woocommerce'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('à vista', 'custom-installments-for-woocommerce'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wci_price_info_box_style',
            [
                'label' => esc_html__('Estilo', 'custom-installments-for-woocommerce'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wci_price_info_box_typography',
                'selector' => '{{WRAPPER}} .wci-price-info-text, {{WRAPPER}} .wci-price-info-text .amount',
            ]
        );

        $this->add_control(
            'wci_price_info_box_text_color',
            [
                'label' => esc_html__('Cor do texto', 'custom-installments-for-woocommerce'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wci-price-info-text, {{WRAPPER}} .wci-price-info-text .amount' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wci_price_info_box_background',
                'label' => esc_html__('Cor de fundo', 'custom-installments-for-woocommerce'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .wci-price-info-box',
            ]
        );

        $this->add_responsive_control(
            'wci_price_info_box_padding',
            [
                'label' => esc_html__('Margem interna', 'custom-installments-for-woocommerce'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .wci-price-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wci_price_info_box_margin',
            [
                'label' => esc_html__('Margem externa', 'custom-installments-for-woocommerce'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .wci-price-info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wci_price_info_box_border',
                'selector' => '{{WRAPPER}} .wci-price-info-box',
            ]
        );

        $this->add_control(
            'wci_price_info_box_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => array(
                    '{{WRAPPER}} .wci-price-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();
    }


    /**
     * Render widget output on the frontend
     * 
     * @since 5.0.0
     * @return void
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $price_type = $settings['wci_price_info_box_price_type'];
        $text_before = $settings['wci_price_info_box_text_before'];
        $text_after = $settings['wci_price_info_box_text_after'];
        $price = '';
        $product_id = Helpers::get_product_id_from_post();
        $product = wc_get_product( $product_id );

        switch ( $price_type ) {
            case 'pix':
                $price = wc_price( Calculate_Values::get_discounted_price( $product, 'main' ) );
                break;
            case 'ticket':
                $price = wc_price( Calculate_Values::get_discounted_price( $product, 'ticket' ) );
                break;
            case 'economy_pix':
                $price = wc_price( Calculate_Values::get_pix_economy( $product ) );
                break;
        }

        echo '<div class="wci-price-info-box">';
            echo '<span class="wci-price-info-text">' . sprintf( __( '%s %s %s' ), esc_html( $text_before ), $price, esc_html( $text_after ) ). '</span>';
        echo '</div>';
    }
}