<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use FredericoDeCastro\Custom_Installments\Core\Helpers;
use FredericoDeCastro\Custom_Installments\Integrations\Elementor;
use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Elementor widget for add product price on single product page
 * 
 * @since 5.0.0
 * @version 5.5.2
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Single_Product_Price extends Widget_Base {

	/**
	 * Get widget name
	 *
     * @since 5.0.0
	 * @return string Widget name
	 */
	public function get_name() {
		return 'wci_single_product_price';
	}


	/**
	 * Get widget title
	 *
     * @since 5.0.0
	 * @return string Widget title
	 */
	public function get_title() {
		return esc_html__( 'Preço do produto', 'custom-installments-for-woocommerce' );
	}
    

	/**
	 * Get widget icon
	 *
     * @since 5.0.0
	 * @return string Widget icon
	 */
	public function get_icon() {
		return 'eicon-product-price';
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
        return [ 'price', 'preço', 'produto', 'product', 'installments', 'parcelas', 'boleto', 'economia', 'economy', 'ticket', 'bank slip' ];
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
	//	return Elementor::editing_single_product_page();
	}


	/**
	 * Register the widget controls
     * 
     * @since 5.0.0
     * @version 5.5.2
     * @return void
	 */
	protected function register_controls() {
        $this->start_controls_section(
            'general_style_section',
            array(
                'label' => esc_html__( 'Configurações gerais', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $this->add_control(
            'alignment',
            array(
                'label' => esc_html__( 'Alinhamento do grupo de preços', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => array(
                    'left' => array(
                        'title' => esc_html__( 'Esquerda', 'custom-installments-for-woocommerce' ),
                        'icon' => 'eicon-text-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Centralizado', 'custom-installments-for-woocommerce' ),
                        'icon' => 'eicon-text-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Direita', 'custom-installments-for-woocommerce' ),
                        'icon' => 'eicon-text-align-right',
                    ),
                ),
                'default' => 'left',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-group' => 'justify-items: {{VALUE}};',
                ),
            )
        );
    
        $this->end_controls_section();
    
        $this->start_controls_section(
            'price_style_section',
            array(
                'label' => esc_html__( 'Estilos do preço', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('price_settings_tabs');

		$this->start_controls_tab(
			'main_price_tab',
			array(
				'label' => esc_html__( 'Preço', 'custom-installments-for-woocommerce' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
				'name' => 'main_price_typography',
				'selector' => '{{WRAPPER}} .woo-custom-installments-price, {{WRAPPER}} .woo-custom-installments-price .amount',
			)
		);

		$this->add_control(
			'main_price_text_color',
			array(
				'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woo-custom-installments-price, {{WRAPPER}} .woo-custom-installments-price .amount, {{WRAPPER}} .woo-custom-installments-price.has-discount' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'old_price_tab',
			array(
				'label' => esc_html__( 'Preço antigo', 'custom-installments-for-woocommerce' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
				'name' => 'old_price_typography',
				'selector' => '{{WRAPPER}} .woo-custom-installments-price.has-discount, {{WRAPPER}} .woo-custom-installments-price.has-discount .amount',
			)
		);

		$this->add_control(
			'old_price_text_color',
			array(
				'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woo-custom-installments-price.has-discount, {{WRAPPER}} .woo-custom-installments-price.has-discount .amount' => 'color: {{VALUE}}',
				),
			),
		);

        $this->add_control(
			'wci_hidden_old_product_price',
			array(
				'label' => esc_html__( 'Ocultar preço antigo', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-price.has-discount' => 'display: {{VALUE}} !important;',
                ),
            ),
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'prefix_and_suffix_tab',
			array(
				'label' => esc_html__( 'Prefixo e sufixo', 'custom-installments-for-woocommerce' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
				'name' => 'prefix_and_suffix_typography',
				'selector' => '{{WRAPPER}} .woocommerce-price-suffix, {{WRAPPER}} .woo-custom-installments-group.variable-range-price .woo-custom-installments-starting-from',
			)
		);

		$this->add_control(
			'prefix_and_suffix_text_color',
			array(
				'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-price-suffix, {{WRAPPER}} .woo-custom-installments-group.variable-range-price .woo-custom-installments-starting-from' => 'color: {{VALUE}} !important;',
				),
			)
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        if ( Admin_Options::get_setting('enable_price_grid_in_widgets') === 'yes' ) {
            $this->add_control(
                'enable_grid_display',
                array(
                    'label' => esc_html__( 'Ativar empilhamento de preços', 'custom-installments-for-woocommerce' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Ativo', 'custom-installments-for-woocommerce' ),
                    'label_off' => esc_html__( 'Inativo', 'custom-installments-for-woocommerce' ),
                    'return_value' => 'yes',
                    'default' => apply_filters( 'Woo_Custom_Installments/Widgets/Enable_Grid_Price', 'yes' ),
                    'selectors' => array(
                        '{{WRAPPER}} .woo-custom-installments-group .woo-custom-installments-group-main-price' => 'flex-direction: column; align-items: flex-start;',
                    ),
                    'selectors_off' => array(
                        '{{WRAPPER}} .woo-custom-installments-group .woo-custom-installments-group-main-price' => 'flex-direction: row;',
                    ),
                )
            );
        }
    
        $this->add_responsive_control(
            'price_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'price_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
			'wci_hidden_product_price',
			array(
				'label' => esc_html__( 'Ocultar preço do produto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'flex',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-group-main-price' => 'display: {{VALUE}};',
                ),
            ),
		);
    
        $this->end_controls_section();
    
        $this->start_controls_section(
            'pix_discount_style_section',
            array(
                'label' => esc_html__( 'Preço com desconto no Pix', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'pix_discount_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-offer, {{WRAPPER}} .woo-custom-installments-offer .amount',
            )
        );
    
        $this->add_control(
            'pix_discount_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer, {{WRAPPER}} .woo-custom-installments-offer .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_control(
            'pix_discount_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'pix_discount_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-offer',
            )
        );
    
        $this->add_control(
            'pix_discount_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'pix_discount_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'pix_discount_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
			'wci_hidden_pix_discount',
			array(
				'label' => esc_html__( 'Ocultar desconto no Pix', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'display: {{VALUE}}',
                ),
            ),
		);
    
        $this->end_controls_section();
    
        $this->start_controls_section(
            'ticket_discount_style_section',
            array(
                'label' => esc_html__( 'Preço com desconto no Boleto', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'ticket_discount_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-ticket-discount, {{WRAPPER}} .woo-custom-installments-ticket-discount .amount',
            )
        );
    
        $this->add_control(
            'ticket_discount_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount, {{WRAPPER}} .woo-custom-installments-ticket-discount .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_control(
            'ticket_discount_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'ticket_discount_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-ticket-discount',
            )
        );
    
        $this->add_control(
            'ticket_discount_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'ticket_discount_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'ticket_discount_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
			'wci_hidden_ticket_discount',
			array(
				'label' => esc_html__( 'Ocultar desconto no boleto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'display: {{VALUE}}',
                ),
            ),
		);
    
        $this->end_controls_section();

        $this->start_controls_section(
            'best_installments_style_section',
            array(
                'label' => esc_html__( 'Melhores parcelas', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'best_installments_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-card-container, {{WRAPPER}} .woo-custom-installments-card-container .amount',
            )
        );
    
        $this->add_control(
            'best_installments_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container, {{WRAPPER}} .woo-custom-installments-card-container .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_control(
            'best_installments_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'best_installments_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-card-container',
            )
        );
    
        $this->add_control(
            'best_installments_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'best_installments_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'best_installments_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
			'wci_hidden_best_installments',
			array(
				'label' => esc_html__( 'Ocultar melhores parcelas', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'display: {{VALUE}}',
                ),
            ),
		);
    
        $this->end_controls_section();
    
        $this->start_controls_section(
            'pix_economy_style_section',
            array(
                'label' => esc_html__( 'Economia no Pix', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'pix_economy_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-economy-pix-badge, {{WRAPPER}} .woo-custom-installments-economy-pix-badge .amount',
            )
        );
    
        $this->add_control(
            'pix_economy_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge, {{WRAPPER}} .woo-custom-installments-economy-pix-badge .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_control(
            'pix_economy_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'pix_economy_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-economy-pix-badge',
            )
        );
    
        $this->add_control(
            'pix_economy_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'pix_economy_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $this->add_responsive_control(
            'pix_economy_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            ),
        );

        $this->add_control(
			'wci_hidden_pix_economy',
			array(
				'label' => esc_html__( 'Ocultar economia no Pix', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'display: {{VALUE}}',
                ),
            ),
		);
    
        $this->end_controls_section();

        // start badge sale controller
        $this->start_controls_section(
            'wci_sale_badge_style_section',
            array(
                'label' => esc_html__( 'Emblema de desconto', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_sale_badge_typography',
                'selector' => '{{WRAPPER}} .wci-sale-badge',
            )
        );

        $this->add_control(
            'wci_sale_badge_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'wci_sale_badge_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_sale_badge_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .wci-sale-badge',
            )
        );

        $this->add_control(
            'wci_sale_badge_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'wci_sale_badge_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors'  => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'wci_sale_badge_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->add_control(
            'wci_hidden_sale_badge',
            array(
                'label' => esc_html__( 'Ocultar emblema de desconto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
                'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
                'return_value' => 'none',
                'default' => 'block',
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'display: {{VALUE}}',
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

        $product_id = Helpers::get_product_id_from_post();
        $template_name = 'single-product/price.php';
        $args = array(
            'product' => wc_get_product( $product_id ),
        );
        
        wc_get_template( $template_name, $args );
	}
}