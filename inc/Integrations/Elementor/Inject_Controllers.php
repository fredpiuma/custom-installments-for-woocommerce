<?php

namespace FredericoDeCastro\Custom_Installments\Integrations\Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Add controllers on Elementor widgets
 * 
 * @since 5.0.0
 * @version 5.5.2
 * @package FredericoDeCastro\Custom_Installments\Integrations\Elementor
 * @author Frederico de Castro
 */
class Inject_Controllers {

    /**
     * Construct function
     * 
     * @since 5.0.0
     * @return void
     */
    public function __construct() {
        add_action( 'elementor/element/after_section_end', array( $this, 'inject_controllers' ), 10, 3 );
    }


    /**
     * Add Woo Custom Installments element design controllers on Elementor Widgets in design section
     * 
     * @since 5.0.0
     * @version 5.5.1
     * @param \Elementor\Controls_Stack $element | The element type
     * @param string $section_id | Section ID
     * @param array $args | Section arguments
     * @return void
     */
    public function inject_controllers( $element, $section_id, $args ) {
        /**
         * Filter for enqueue widget ID and section ID for inject style controllers
         * 
         * woocommerce-products = widget ID
         * section_design_box = section ID
         * 
         * @since 5.0.0
         * @version 5.5.1
         * @param array
         */
        $widgets = apply_filters( 'Woo_Custom_Installments/Elementor/Inject_Controllers', array(
            'woocommerce-products' => 'section_design_box',
            'woocommerce-product-price' => 'section_price_style',
            'woocommerce-product-related' => 'section_design_box',
            'woocommerce-product-upsell' => 'section_design_box',
            'wc-archive-products' => 'section_design_box',
            'loop-carousel' => 'section_layout_style',
            'loop-grid' => 'section_layout_style',
        ));

        foreach ( $widgets as $widget_id => $section ) {
            if ( $widget_id === $element->get_name() && $section === $section_id ) {
                self::add_controllers( $element );
            }
        }
    }

    
    /**
     * Woo Custom Installments element design controllers
     * 
     * @since 5.0.0
     * @version 5.5.2
     * @param \Elementor\Controls_Stack $element | The element type
     * @return void
     */
    public static function add_controllers( $element ) {
        $element->start_controls_section(
            'wci_general_style_section',
            array(
                'label' => esc_html__( 'Configurações gerais', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $element->add_control(
            'wci_alignment_price_group',
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
                'default' => apply_filters( 'Woo_Custom_Installments/Widgets/Align_Price_Group', 'left' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-group' => 'justify-items: {{VALUE}};',
                ),
            )
        );
    
        $element->end_controls_section();
    
        $element->start_controls_section(
            'wci_price_style_section',
            array(
                'label' => esc_html__( 'Estilos do preço', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $element->start_controls_tabs('price_settings_tabs');

		$element->start_controls_tab(
			'wci_main_price_tab',
			array(
				'label' => esc_html__( 'Preço', 'custom-installments-for-woocommerce' ),
			)
		);

		$element->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
				'name' => 'wci_main_price_typography',
				'selector' => '{{WRAPPER}} .woo-custom-installments-price, {{WRAPPER}} .woo-custom-installments-price .amount',
			)
		);

		$element->add_control(
			'wci_main_price_text_color',
			array(
				'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woo-custom-installments-price, {{WRAPPER}} .woo-custom-installments-price .amount, {{WRAPPER}} .woo-custom-installments-price.has-discount' => 'color: {{VALUE}}',
				),
			)
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'wci_old_price_tab',
			array(
				'label' => esc_html__( 'Preço antigo', 'custom-installments-for-woocommerce' ),
			)
		);

		$element->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
				'name' => 'wci_old_price_typography',
				'selector' => '{{WRAPPER}} .woo-custom-installments-price.has-discount, {{WRAPPER}} .woo-custom-installments-price.has-discount .amount',
			)
		);

		$element->add_control(
			'wci_old_price_text_color',
			array(
				'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woo-custom-installments-price.has-discount, {{WRAPPER}} .woo-custom-installments-price.has-discount .amount' => 'color: {{VALUE}}',
				),
			),
		);

        $element->add_control(
			'wci_hidden_old_product_price',
			array(
				'label' => esc_html__( 'Ocultar preço antigo', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Ocultar', 'custom-installments-for-woocommerce' ),
				'label_off' => esc_html__( 'Mostrar', 'custom-installments-for-woocommerce' ),
				'return_value' => 'none',
				'default' => apply_filters( 'Woo_Custom_Installments/Widgets/Hidden_Old_Price', 'block' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-price.has-discount' => 'display: {{VALUE}} !important',
                ),
            ),
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'wci_prefix_and_suffix_tab',
			array(
				'label' => esc_html__( 'Prefixo e sufixo', 'custom-installments-for-woocommerce' ),
			)
		);

		$element->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
				'name' => 'wci_prefix_and_suffix_typography',
				'selector' => '{{WRAPPER}} .woocommerce-price-suffix, {{WRAPPER}} .woo-custom-installments-group.variable-range-price .woo-custom-installments-starting-from',
			)
		);

		$element->add_control(
			'wci_prefix_and_suffix_text_color',
			array(
				'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .woocommerce-price-suffix, {{WRAPPER}} .woo-custom-installments-group.variable-range-price .woo-custom-installments-starting-from' => 'color: {{VALUE}} !important;',
				),
			)
		);
        
		$element->end_controls_tab();
		$element->end_controls_tabs();

        if ( Admin_Options::get_setting('enable_price_grid_in_widgets') === 'yes' ) {
            $element->add_control(
                'wci_enable_grid_price',
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
    
        $element->add_responsive_control(
            'wci_price_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $element->add_responsive_control(
            'wci_price_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_control(
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
    
        $element->end_controls_section();
    
        $element->start_controls_section(
            'wci_pix_discount_style_section',
            array(
                'label' => esc_html__( 'Preço com desconto no Pix', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $element->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_pix_discount_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-offer, {{WRAPPER}} .woo-custom-installments-offer .amount',
            )
        );
    
        $element->add_control(
            'wci_pix_discount_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer, {{WRAPPER}} .woo-custom-installments-offer .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_control(
            'wci_pix_discount_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_pix_discount_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-offer',
            )
        );
    
        $element->add_control(
            'wci_pix_discount_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $element->add_responsive_control(
            'wci_pix_discount_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $element->add_responsive_control(
            'wci_pix_discount_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_control(
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
    
        $element->end_controls_section();
    
        $element->start_controls_section(
            'wci_ticket_discount_style_section',
            array(
                'label' => esc_html__( 'Preço com desconto no Boleto', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $element->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_ticket_discount_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-ticket-discount, {{WRAPPER}} .woo-custom-installments-ticket-discount .amount',
            )
        );
    
        $element->add_control(
            'wci_ticket_discount_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount, {{WRAPPER}} .woo-custom-installments-ticket-discount .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_control(
            'wci_ticket_discount_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_ticket_discount_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-ticket-discount',
            )
        );
    
        $element->add_control(
            'wci_ticket_discount_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_responsive_control(
            'wci_ticket_discount_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $element->add_responsive_control(
            'wci_ticket_discount_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-ticket-discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_control(
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
    
        $element->end_controls_section();

        $element->start_controls_section(
            'wci_best_installments_style_section',
            array(
                'label' => esc_html__( 'Melhores parcelas', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $element->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_best_installments_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-card-container, {{WRAPPER}} .woo-custom-installments-card-container .amount',
            )
        );
    
        $element->add_control(
            'wci_best_installments_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container, {{WRAPPER}} .woo-custom-installments-card-container .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_control(
            'wci_best_installments_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_best_installments_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-card-container',
            )
        );
    
        $element->add_control(
            'wci_best_installments_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_responsive_control(
            'wci_best_installments_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $element->add_responsive_control(
            'wci_best_installments_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-card-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_control(
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
    
        $element->end_controls_section();
    
        $element->start_controls_section(
            'wci_pix_economy_style_section',
            array(
                'label' => esc_html__( 'Economia no Pix', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
    
        $element->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_pix_economy_typography',
                'selector' => '{{WRAPPER}} .woo-custom-installments-economy-pix-badge, {{WRAPPER}} .woo-custom-installments-economy-pix-badge .amount',
            )
        );
    
        $element->add_control(
            'wci_pix_economy_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge, {{WRAPPER}} .woo-custom-installments-economy-pix-badge .amount' => 'color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_control(
            'wci_pix_economy_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );
    
        $element->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_pix_economy_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .woo-custom-installments-economy-pix-badge',
            )
        );
    
        $element->add_control(
            'wci_pix_economy_border_radius',
            array(
                'label' => esc_html__( 'Raio da borda', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_responsive_control(
            'wci_pix_economy_margin',
            array(
                'label' => esc_html__( 'Margem externa', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );
    
        $element->add_responsive_control(
            'wci_pix_economy_padding',
            array(
                'label' => esc_html__( 'Margem interna', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em', 'rem' ),
                'selectors' => array(
                    '{{WRAPPER}} .woo-custom-installments-economy-pix-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $element->add_control(
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
            )
		);
    
        $element->end_controls_section();

        // start badge sale controller
        $element->start_controls_section(
            'wci_sale_badge_style_section',
            array(
                'label' => esc_html__( 'Emblema de desconto', 'custom-installments-for-woocommerce' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $element->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'label' => esc_html__( 'Tipografia', 'custom-installments-for-woocommerce' ),
                'name' => 'wci_sale_badge_typography',
                'selector' => '{{WRAPPER}} .wci-sale-badge',
            )
        );

        $element->add_control(
            'wci_sale_badge_text_color',
            array(
                'label' => esc_html__( 'Cor do texto', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'color: {{VALUE}}',
                ),
            )
        );

        $element->add_control(
            'wci_sale_badge_background_color',
            array(
                'label' => esc_html__( 'Cor de fundo', 'custom-installments-for-woocommerce' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .wci-sale-badge' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name' => 'wci_sale_badge_border',
                'label' => esc_html__( 'Borda', 'custom-installments-for-woocommerce' ),
                'selector' => '{{WRAPPER}} .wci-sale-badge',
            )
        );

        $element->add_control(
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

        $element->add_responsive_control(
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

        $element->add_responsive_control(
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

        $element->add_control(
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

        $element->end_controls_section();
    }
}