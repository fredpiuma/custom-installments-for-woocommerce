<?php

namespace FredericoDeCastro\Custom_Installments\Core;

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;
use FredericoDeCastro\Custom_Installments\Admin\Default_Options;
use FredericoDeCastro\Custom_Installments\Core\Logger;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class for handle AJAX callbacks
 * 
 * @since 4.5.0
 * @version 5.5.4
 * @package FredericoDeCastro\Custom_Installments\Core
 * @author Frederico de Castro
 */
class Ajax {

    /**
     * Plugin file constant
     * 
     * @since 5.4.0
     * @return string
     */
    public $plugin_file = WOO_CUSTOM_INSTALLMENTS_FILE;

	/**
	 * Construct function
	 * 
	 * @since 4.5.0
     * @version 5.5.0
	 * @return void
	 */
	public function __construct() {
        // save admin options
		add_action( 'wp_ajax_wci_save_options', array( $this, 'save_options_callback' ) );

        // reset plugin to default
        add_action( 'wp_ajax_reset_plugin_action', array( $this, 'reset_plugin_callback' ) );
	}


    /**
     * Save options in AJAX
     * 
     * @since 3.0.0
     * @version 5.5.4
     * @return void
     */
    public function save_options_callback() {
        // check security nonce
        check_ajax_referer( 'wci_save_options_nonce', 'security' );
        
        if ( isset( $_POST['action'] ) && $_POST['action'] === 'wci_save_options' ) {
            // convert serialized form data on a array
            parse_str( $_POST['form_data'], $form_data );

            // get current options
            $options = get_option( 'woo-custom-installments-setting', array() );

            $switchs_without_license = array(
                'enable_installments_all_products',
                'custom_text_after_price',
                'enable_all_discount_options',
                'display_installments_cart',
                'include_shipping_value_in_discounts',
                'display_tag_discount_price_checkout',
                'enable_discount_per_unit_discount_per_quantity',
                'message_discount_per_quantity',
                'enable_all_interest_options',
                'display_tag_interest_checkout',
                'enable_pix_method_payment_form',
                'enable_instant_approval_badge',
                'enable_ticket_method_payment_form',
                'enable_ticket_discount_main_price',
                'enable_credit_card_method_payment_form',
                'enable_debit_card_method_payment_form',
                'center_group_elements_loop',
                'enable_elementor_widgets',
                'enable_price_grid_in_widgets',
                'add_discount_custom_product_price',
                'enable_auto_updates',
                'enable_update_notices',
            );

            $switchs_with_license = array(
                'remove_price_range',
                'set_fee_per_installment',
                'display_discount_price_schema',
                'enable_functions_discount_per_quantity',
                'enable_economy_pix_badge',
                'enable_post_meta_feed_xml_price',
                'enable_sale_badge',
                'update_price_with_quantity',
            );
    
            // update switch options without license
            foreach ( $switchs_without_license as $field ) {
                $options[$field] = isset( $form_data[$field] ) ? 'yes' : 'no';
            }
    
            // update switch options with license
            foreach ( $switchs_with_license as $field ) {
                $options[$field] = ( isset( $form_data[$field] ) ) ? 'yes' : 'no';
            }

            $fields_with_license = array(
                'text_display_installments_payment_forms',
                'text_display_installments_loop',
                'text_display_installments_single_product',
            );

            // get default options
            $default_options = Default_Options::set_default_data_options();

            // update switch options with license
            foreach ( $fields_with_license as $field ) {
                $options[$field] = ( isset( $form_data[$field] ) ) ? $form_data[$field] : $default_options[$field];
            }
    
            // Update discount payments methods settings
            if ( isset( $form_data['woo_custom_installments_discounts'] ) ) {
                update_option( 'woo_custom_installments_discounts_setting', maybe_serialize( $form_data['woo_custom_installments_discounts'] ) );
            }
    
            // Update interests settings
            if ( isset( $form_data['woo_custom_installments_interests'] ) ) {
                update_option( 'woo_custom_installments_interests_setting', maybe_serialize( $form_data['woo_custom_installments_interests'] ) );
            }
    
            // Update fee per installments
            if ( isset( $form_data['custom_fee_installments'] ) && is_array( $form_data['custom_fee_installments'] ) ) {
                update_option( 'woo_custom_installments_custom_fee_installments', maybe_serialize( $form_data['custom_fee_installments'] ) );
            }

            // merge current data with form data
            $updated_options = Helpers::merge_options( $options, $form_data );

            // Save the updated options
            $saved_options = update_option( 'woo-custom-installments-setting', $updated_options );

            if ( $saved_options ) {
                $response = array(
                    'status' => 'success',
                    'toast_header_title' => esc_html__( 'Salvo com sucesso', 'custom-installments-for-woocommerce' ),
                    'toast_body_title' => esc_html__( 'As configurações foram atualizadas!', 'custom-installments-for-woocommerce' ),
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'toast_header_title' => esc_html__( 'Ops! Ocorreu um erro.', 'custom-installments-for-woocommerce' ),
                    'toast_body_title' => esc_html__( 'Não foi possível salvar as configurações', 'custom-installments-for-woocommerce' ),
                );
            }

            // debug mode
            if ( WOO_CUSTOM_INSTALLMENTS_DEBUG_MODE ) {
                $response['debug'] = array(
                    'options' => get_option('woo-custom-installments-setting'),
                );
            }

            // send JSON response to frontend
            wp_send_json( $response );
        }
    }


    /**
     * Reset plugin options to default on AJAX callback
     * 
     * @since 4.5.0
     * @version 5.5.4
     * @return void
     */
    public function reset_plugin_callback() {
        if ( isset( $_POST['action'] ) && $_POST['action'] === 'reset_plugin_action' ) {
            $delete_option = delete_option('woo-custom-installments-setting');

            if ( $delete_option ) {
                delete_option('woo_custom_installments_discounts_setting');
                delete_option('woo_custom_installments_interests_setting');
                delete_option('woo_custom_installments_custom_fee_installments');
                delete_option('woo_custom_installments_alternative_license');
                delete_option('woo_custom_installments_alternative_license_activation');
                delete_option('woo_custom_installments_license_info');

                $response = array(
                    'status' => 'success',
                    'toast_header_title' => esc_html__( 'As opções foram redefinidas', 'custom-installments-for-woocommerce' ),
                    'toast_body_title' => esc_html__( 'As opções foram redefinidas com sucesso!', 'custom-installments-for-woocommerce' ),
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'toast_header_title' => esc_html__( 'Ops! Ocorreu um erro.', 'custom-installments-for-woocommerce' ),
                    'toast_body_title' => esc_html__( 'Ocorreu um erro ao redefinir as configurações.', 'custom-installments-for-woocommerce' ),
                );
            }

            wp_send_json( $response );
        }
    }
}