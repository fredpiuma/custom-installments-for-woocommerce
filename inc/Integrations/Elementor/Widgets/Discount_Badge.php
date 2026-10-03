<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use FredericoDeCastro\Custom_Installments\Core\Helpers;
use FredericoDeCastro\Custom_Installments\Views\Components;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Elementor widget for add discount badge
 * 
 * @since 5.4.0
 * @version 5.5.1
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Discount_Badge extends Widget_Base {

    /**
     * Widget slug
     * 
     * @since 5.4.0
     * @return string
     */
    public function get_name() {
        return 'wci_sale_badge';
    }


    /**
     * Widget title
     * 
     * @since 5.4.0
     * @return string
     */
    public function get_title() {
        return esc_html__( 'Emblema de desconto', 'custom-installments-for-woocommerce' );
    }


    /**
     * Widget icon
     * 
     * @since 5.4.0
     * @return string
     */
    public function get_icon() {
        return 'eicon-info-circle-o';
    }


    /**
     * Widget categories
     * 
     * @since 5.4.0
     * @return array
     */
    public function get_categories() {
        return array('custom-installments-for-woocommerce');
    }

    /**
     * Search widget by keywords
     * 
     * @since 5.4.0
     * @return array
     */
    public function get_keywords() {
        return array( 'desconto', 'badge', 'emblema', 'oferta', 'promoção', 'parcelas' );
    }


    /**
	 * Show in panel
	 *
     * @since 5.4.0
	 * @return bool Whether to show the widget in the panel or not
	 */
	public function show_in_panel() {
        return true;
    }


    /**
     * Register the widget controls
     * 
     * @since 5.4.0
     * @return void
     */
    protected function register_controls() {
        $this->start_controls_section(
            'wci_sale_badge_style_section',
            [
                'label' => esc_html__( 'Estilo do emblema', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .wci-sale-badge',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wci-sale-badge' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wci-sale-badge' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .wci-sale-badge',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wci-sale-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wci-sale-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .wci-sale-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'hidden',
            [
                'label' => esc_html__( 'Ocultar emblema de desconto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
                'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
                'return_value' => 'none',
                'default' => 'block',
                'selectors' => [
                    '{{WRAPPER}} .wci-sale-badge' => 'display: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }


    /**
     * Render widget output on the frontend
     * 
     * @since 5.4.0
     * @return void
     */
    protected function render() {
        $product_id = Helpers::get_product_id_from_post();
        $product = wc_get_product( $product_id );

        // instance of components class
		$components = new Components();

		echo $components->sale_badge( $product );
    }
}