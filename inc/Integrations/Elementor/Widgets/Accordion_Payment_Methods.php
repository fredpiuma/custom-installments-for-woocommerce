<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use FredericoDeCastro\Custom_Installments\Core\Helpers;
use FredericoDeCastro\Custom_Installments\Integrations\Elementor;
use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;
use FredericoDeCastro\Custom_Installments\Views\Components;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Elementor widget for add payment methods popup on single product page
 * 
 * @since 5.0.0
 * @version 5.5.2
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Accordion_Payment_Methods extends Widget_Base {

	/**
	 * Get widget name
	 *
     * @since 5.0.0
	 * @return string Widget name
	 */
	public function get_name() {
		return 'wci_accordion_payment_methods';
	}


	/**
	 * Get widget title
	 *
     * @since 5.0.0
	 * @return string Widget title
	 */
	public function get_title() {
		return esc_html__( 'Sanfona - Formas de pagamento', 'custom-installments-for-woocommerce' );
	}
    

	/**
	 * Get widget icon
	 *
     * @since 5.0.0
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'eicon-accordion';
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
        return [ 'accordion', 'sanfona', 'formas de pagamento', 'parcelas', 'installments', 'pix' ];
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
     * @version 5.4.8
     * @return void
	 */
	protected function register_controls() {
        $this->start_controls_section(
            'wci_accordion_payment_methods_style_section',
            array(
                'label' => esc_html__( 'Estilos - formas de pagamento', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('wci_accordion_tabs_button_style');

        $this->start_controls_tab(
            'wci_accordion_tab_button_normal',
            array(
                'label' => esc_html__('Normal', 'custom-installments-for-woocommerce'),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_accordion_payment_methods_typography',
                'selector' => '{{WRAPPER}} .wci-accordion-header',
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-header' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wci-accordion-header .wci-accordion-icon' => 'stroke: {{VALUE}};',
                ),
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-header' => 'background-color: {{VALUE}};',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_accordion_payment_methods_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .wci-accordion-item',
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
    
        $this->add_responsive_control(
            'wci_accordion_payment_methods_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} #wci-accordion-installments' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );
    
        $this->add_responsive_control(
            'wci_accordion_payment_methods_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
			'wci_accordion_payment_methods_height',
			[
				'label' => esc_html__( 'Altura do botão', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'rem' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .wci-accordion-header, {{WRAPPER}} .wci-accordion-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
    
        $this->end_controls_tab();
    
        $this->start_controls_tab(
            'tab_button_hover',
            array(
                'label' => esc_html__('Ao passar o mouse', 'custom-installments-for-woocommerce'),
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_hover_text_color',
            array(
                'label' => esc_html__( 'Cor do texto ao passar o mouse', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-header:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wci-accordion-header:hover .wci-accordion-icon' => 'stroke: {{VALUE}};',
                ),
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_hover_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo ao passar o mouse', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-header:hover' => 'background-color: {{VALUE}};',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_accordion_payment_methods_hover_border',
                'label' => esc_html__( 'Borda ao passar o mouse', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .wci-accordion-item:hover',
            )
        );
    
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_active',
            array(
                'label' => esc_html__('Ativo', 'custom-installments-for-woocommerce'),
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_active_text_color',
            array(
                'label' => esc_html__( 'Cor do texto do botão ativo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-item.active .wci-accordion-header' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_control(
            'wci_accordion_payment_methods_active_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo do botão ativo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-accordion-item.active .wci-accordion-header' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_accordion_payment_methods_active_border',
                'label' => esc_html__( 'Borda do botão ativo', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .wci-accordion-item.active .wci-accordion-item',
            )
        );
    
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }    


    /**
	 * Render the widget output on the frontend
     * 
     * @since 5.0.0
     * @return void
	 */
	protected function render() {
        if ( Admin_Options::get_setting('hook_payment_form_single_product') === 'widget' ) {
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
            
            echo $components->payment_methods_accordion( $product );
        }
	}
}