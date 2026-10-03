<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<div class="d-flex align-items-center mt-4 ms-2">
    <img class="woo-custom-installments-logo me-3" src="<?php echo esc_url( WOO_CUSTOM_INSTALLMENTS_ASSETS . 'admin/img/logo.webp' ); ?>" alt="Frederico de Castro" />
    
    <h1 class="woo-custom-installments-admin-section-tile"><?php esc_html_e( 'Custom Installments for WooCommerce', 'custom-installments-for-woocommerce' ) ?></h1>

</div>

<div class="woo-custom-installments-admin-title-description mt-3">
    <p><?php esc_html_e( 'Configure abaixo o parcelamento, descontos, juros, estilos e entre outras opções disponíveis. Se precisar de ajuda para configurar, acesse nossa', 'custom-installments-for-woocommerce' ) ?>
        <a class="fancy-link" href="<?php esc_attr_e( WOO_CUSTOM_INSTALLMENTS_DOCS_LINK ) ?>" target="_blank"><?php esc_html_e( 'Central de ajuda', 'custom-installments-for-woocommerce' ) ?></a>
    </p>

    <?php if ( class_exists('WC_PagSeguro') || class_exists('PagSeguro_Internacional__WooCommerce') || class_exists('WC_PagSeguro_Parceled') ) : ?>
        <span class="woo-custom-installments-description"><?php esc_html_e( 'O PagSeguro utiliza fator de multiplicação para calcular o juros.', 'custom-installments-for-woocommerce' ) ?></span>
        <a class="fancy-link" href="https://github.com/fredpiuma/custom-installments-for-woocommerce#fator-de-multiplicação-pagseguro" target="__blank"><?php esc_html_e( 'Como converter fator de multiplicação para juros.', 'custom-installments-for-woocommerce' ) ?></a>
    <?php endif; ?>
</div>

<?php
/**
 * Display custom content on header settings
 * 
 * @since 4.5.0
 * @version 5.4.0
 */
do_action('Woo_Custom_Installments/Admin/Header'); ?>

<div class="woo-custom-installments-wrapper">
    <div class="nav-tab-wrapper woo-custom-installments-tab-wrapper">
        <?php
        /**
         * Settings nav tabs hook
         * 
         * @since 5.4.0
         */
        do_action('Woo_Custom_Installments/Admin/Settings_Nav_Tabs'); ?>
    </div>

    <div class="woo-custom-installments-form-container">
        <form method="post" class="woo-custom-installments-form" name="woo-custom-installments">
            <?php $tabs = Admin_Options::register_settings_tabs();

            foreach ( $tabs as $tab ) :
                if ( ! empty( $tab['file'] ) ) {
                    include_once $tab['file'];
                }
            endforeach; ?>
        </form>

        <div class="wci-action-footer">
            <button id="woo_custom_installments_save_options" class="btn btn-primary d-flex align-items-center justify-content-center" disabled>
                <svg class="icon me-2 icon-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
                <?php esc_html_e( 'Salvar alterações', 'custom-installments-for-woocommerce' ) ?></a>
            </button>
        </div>
    </div>
</div>