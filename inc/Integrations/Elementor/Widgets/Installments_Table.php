<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use FredericoDeCastro\Custom_Installments\Core\Helpers;
use FredericoDeCastro\Custom_Installments\Integrations\Elementor;
use FredericoDeCastro\Custom_Installments\Views\Components;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Elementor widget for add payment methods popup on single product page
 * 
 * @since 5.0.0
 * @version 5.5.1
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Installments_Table extends Widget_Base {

	/**
	 * Get widget name
	 *
     * @since 5.0.0
	 * @return string Widget name
	 */
	public function get_name() {
		return 'wci_installments_table';
	}


	/**
	 * Get widget title
	 *
     * @since 5.0.0
	 * @return string Widget title
	 */
	public function get_title() {
		return esc_html__( 'Tabela de parcelamento', 'custom-installments-for-woocommerce' );
	}
    

	/**
	 * Get widget icon
	 *
     * @since 5.0.0
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'eicon-table';
	}


	/**
	 * Get widget categories
	 *
     * @since 5.0.0
	 * @return array Widget categories
	 */
	public function get_categories() {
		return array('custom-installments-for-woocommerce');
	}


    /**
     * Search widget by keywords
     * 
     * @since 5.0.0
     * @return array
     */
    public function get_keywords() {
        return [ 'installments', 'table', 'tabela', 'parcelas', 'parcelamento' ];
    }


    /**
	 * Show in panel
	 *
     * @since 5.0.0
     * @version 5.1.0
	 * @return bool Whether to show the widget in the panel or not
	 */
	public function show_in_panel() {
        return true;
    //    return Elementor::editing_single_product_page();
    }


	/**
	 * Register the widget controls
     * 
     * @since 5.0.0
     * @return void
	 */
	protected function register_controls() {
        $this->start_controls_section(
            'wci_installments_table_style_section',
            [
                'label' => esc_html__( 'Estilos da tabela de parcelamento', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wci_installments_table_border',
                'label' => esc_html__( 'Borda da tabela', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-table tr, {{WRAPPER}} .woo-custom-installments-table tr th',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wci_installments_table_typography',
                'label' => esc_html__( 'Tipografia da tabela', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-table th, {{WRAPPER}} .woo-custom-installments-table td',
            ]
        );
    
        $this->add_control(
            'wci_installments_table_text_color',
            [
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-table th' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woo-custom-installments-table td' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_control(
            'wci_installments_table_price_color',
            [
                'label' => esc_html__( 'Cor do preço', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-table .amount' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'wci_installments_table_padding',
            [
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'wci_installments_table_margin',
            [
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .woo-custom-installments-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'wci_hidden_installments_table',
			array(
				'label' => esc_html__( 'Ocultar título', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} h4.installments-title' => 'display: {{VALUE}}',
                ),
            ),
		);
    
        $this->end_controls_section();
    }    


    /**
	 * Render the widget output on the frontend
     * 
     * @since 5.0.0
     * @version 5.4.0
     * @return void
	 */
	protected function render() {
        $settings = wp_parse_args(
            $this->get_settings_for_display(), array(
                'product_id' => false,
            ),
        );

        $product_id = Helpers::get_product_id_from_post();
        $product = wc_get_product( $product_id );

        if ( $product === false ) {
            global $product;
        }

        // instance components class
        $components = new Components();

    	echo $components->render_installments_table( $product );
	}
}