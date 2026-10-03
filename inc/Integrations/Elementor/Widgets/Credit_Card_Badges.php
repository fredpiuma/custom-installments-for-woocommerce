<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

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
class Credit_Card_Badges extends Widget_Base {

	/**
	 * Get widget name
	 *
     * @since 5.0.0
	 * @return string Widget name
	 */
	public function get_name() {
		return 'wci_credit_card_badges';
	}


	/**
	 * Get widget title
	 *
     * @since 5.0.0
	 * @return string Widget title
	 */
	public function get_title() {
		return esc_html__( 'Bandeiras de cartão de crédito', 'custom-installments-for-woocommerce' );
	}
    

	/**
	 * Get widget icon
	 *
     * @since 5.0.0
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'eicon-carousel';
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
        return [ 'badges', 'bandeiras', 'formas de pagamento', 'cartão de crédito', 'cartão', 'credit card' ];
    }


    /**
	 * Show in panel
	 *
     * @since 5.0.0
	 * @return bool Whether to show the widget in the panel or not
	 */
	public function show_in_panel() {
        return true;
    }


	/**
	 * Register the widget controls
     * 
     * @since 5.0.0
     * @return void
	 */
	protected function register_controls() {
        $this->start_controls_section(
            'wci_credit_card_badges_style_section',
            array(
                'label' => esc_html__( 'Estilos - bandeiras cartão de crédito', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
			'wci_credit_card_badges_width',
			[
				'label' => esc_html__( 'Tamanho da bandeira', 'custom-installments-for-woocommerce' ),
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
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .container-badge-icon.credit-card' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_responsive_control(
            'wci_credit_card_badges_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .credit-card-container-badges' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'wci_credit_card_badges_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .container-badge-icon.credit-card .size-badge-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
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

        echo '<div class="credit-card-container-badges">';
			// instance components class
			$components = new Components();

			echo $components->render_credit_card_flags();
        echo '</div>';
	}
}