<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;
use FredericoDeCastro\Custom_Installments\Admin\Default_Options;

/**
 * Text settings tab
 * 
 * @since 2.0.0
 * @version 5.4.3
 * @package Custom Installments for WooCommerce
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$default_options = Default_Options::set_default_data_options(); ?>

<div id="texts" class="nav-content">
    <table class="form-table">
        <tr>
            <th>
                <?php esc_html_e( 'Texto antes do preço com desconto', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_before_price" value="<?php echo Admin_Options::get_setting('text_before_price') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto depois do preço com desconto', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_after_price" value="<?php echo Admin_Options::get_setting('text_after_price') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto informativo para economia no Pix', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será exibido no emblema de economia ao pagar com Pix. Obs.: É necessário que a variável %s esteja na frase para exibir o valor.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_economy_pix_badge" value="<?php echo Admin_Options::get_setting('text_economy_pix_badge') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto informativo para desconto por quantidade', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será exibido no emblema de desconto por quantidade. Obs.: É necessário que a variável %d (Quantidade) e %s (Desconto) estejam na frase para exibir o valor.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_discount_per_quantity_message" value="<?php echo Admin_Options::get_setting('text_discount_per_quantity_message') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Título do botão acionador de parcelas', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será exibido no botão do popup ou sanfona de parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_button_installments" value="<?php echo Admin_Options::get_setting('text_button_installments') ?>"/>
            </td>
        </tr>

        <tr>
            <td class="container-separator"></td>
        </tr>

        <tr class="admin-container-transfers">
            <th>
                <?php esc_html_e( 'Título do container de transferências', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será usado como título do container de transferências.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_pix_container" value="<?php echo Admin_Options::get_setting('text_pix_container') ?>"/>
            </td>
        </tr>

        <tr class="admin-container-ticket">
            <th>
                <?php esc_html_e( 'Título do container de boleto bancário', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será usado como título do container de boleto bancário.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_ticket_container" value="<?php echo Admin_Options::get_setting('text_ticket_container') ?>"/>
            </td>
        </tr>

        <tr class="admin-container-ticket">
            <th>
                <?php esc_html_e( 'Texto de instruções de boleto bancário', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto de instruções que será exibido no container de boleto bancário.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_instructions_ticket_container" value="<?php echo Admin_Options::get_setting('text_instructions_ticket_container') ?>"/>
            </td>
        </tr>

        <tr class="admin-container-ticket">
            <th>
                <?php esc_html_e( 'Texto antes do preço com desconto no boleto bancário', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_before_discount_ticket" value="<?php echo Admin_Options::get_setting('text_before_discount_ticket') ?>"/>
            </td>
        </tr>

        <tr class="admin-container-ticket">
            <th>
                <?php esc_html_e( 'Texto depois do preço com desconto no boleto bancário', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_after_discount_ticket" value="<?php echo Admin_Options::get_setting('text_after_discount_ticket') ?>"/>
            </td>
        </tr>

        <tr class="admin-container-credit-card">
            <th>
                <?php esc_html_e( 'Título do container de cartões de crédito', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será usado como título do container de cartões de crédito.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_credit_card_container" value="<?php echo Admin_Options::get_setting('text_credit_card_container') ?>"/>
            </td>
        </tr>

        <tr class="admin-container-debit-card">
            <th>
                <?php esc_html_e( 'Título do container de cartões de débito', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será usado como título do container de cartões de débito.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_debit_card_container" value="<?php echo Admin_Options::get_setting('text_debit_card_container') ?>"/>
            </td>
        </tr>

        <tr>
            <td class="container-separator payment-forms d-none"></td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Título da tabela de parcelas', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será exibido antes da tabela de parcelas no popup ou sanfona.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_table_installments" value="<?php echo Admin_Options::get_setting('text_table_installments') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto informativo de parcelas com juros', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será exibido depois da parcela.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_with_fee_installments" value="<?php echo Admin_Options::get_setting('text_with_fee_installments') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto informativo de parcelas sem juros', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Texto que será exibido depois da parcela.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_without_fee_installments" value="<?php echo Admin_Options::get_setting('text_without_fee_installments') ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Título do container das formas de pagamento', 'custom-installments-for-woocommerce' ) ?>
                <span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
            <td>
                <input type="text" class="form-control input-control-wd-20" id="text_container_payment_forms" name="text_container_payment_forms" value="<?php echo Admin_Options::get_setting('text_container_payment_forms'); ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto de exibição das parcelas (Formas de pagamento)', 'custom-installments-for-woocommerce' ); ?>
                
                <span class="woo-custom-installments-description mb-2"><?php esc_html_e( 'Utilize as variáveis:', 'custom-installments-for-woocommerce' ) ?></span>
                
                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ parcelas }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o número de parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ valor }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o valor da parcela.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ juros }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar se a parcela é com ou sem juros.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ total }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o valor total da soma das parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>
            </th>

            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_display_installments_payment_forms" value="<?php echo ( ! empty( Admin_Options::get_setting('text_display_installments_payment_forms') ) ? Admin_Options::get_setting('text_display_installments_payment_forms') : $default_options['text_display_installments_payment_forms'] ); ?>"/>
            </td>
        </tr>

        <tr>
            <th>
                <?php esc_html_e( 'Texto de exibição das parcelas (Arquivos de produtos)', 'custom-installments-for-woocommerce' ); ?>
                
                <span class="woo-custom-installments-description mb-2"><?php esc_html_e( 'Utilize as variáveis:', 'custom-installments-for-woocommerce' ) ?></span>
                
                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ parcelas }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o número de parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ valor }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o valor da parcela.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ juros }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar se a parcela é com ou sem juros.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ total }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o valor total da soma das parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>
            </th>

            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_display_installments_loop" value="<?php echo ( ! empty( Admin_Options::get_setting('text_display_installments_loop') ) ) ? Admin_Options::get_setting('text_display_installments_loop') : $default_options['text_display_installments_loop']; ?>"/>
            </td>
        </tr>
        
        <tr>
            <th>
                <?php esc_html_e( 'Texto de exibição das parcelas (Produto individual)', 'custom-installments-for-woocommerce' ); ?>

                <span class="woo-custom-installments-description mb-2"><?php esc_html_e( 'Utilize as variáveis:', 'custom-installments-for-woocommerce' ) ?></span>
                
                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ parcelas }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o número de parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ valor }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o valor da parcela.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ juros }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar se a parcela é com ou sem juros.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>

                <div class="d-flex">
                    <span class="woo-custom-installments-description"><code>{{ total }}</code>
                    </span><span class="woo-custom-installments-description ms-2"><?php esc_html_e( 'Para recuperar o valor total da soma das parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
                </div>
            </th>

            <td>
                <input type="text" class="form-control input-control-wd-20" name="text_display_installments_single_product" value="<?php echo ( ! empty( Admin_Options::get_setting('text_display_installments_single_product') ) ) ? Admin_Options::get_setting('text_display_installments_single_product') : $default_options['text_display_installments_single_product']; ?>"/>
            </td>
        </tr>
    </table>
</div>

