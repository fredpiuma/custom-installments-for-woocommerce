<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<div id="interests" class="nav-content">
    <table class="form-table">
		<tr>
			<th>
				<?php esc_html_e( 'Ativar funções de juros', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Ative esta opção para habilitar todas as opções relacionadas a juros.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_all_interest_options" name="enable_all_interest_options" value="yes" <?php checked( Admin_Options::get_setting( 'enable_all_interest_options') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-interest-options">
			<th>
				<?php esc_html_e( 'Mostrar emblema de juros na finalização da compra', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá exibir o emblema de juros na página de finalização de compra para a forma de desconto configurada.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="display_tag_interest_checkout" name="display_tag_interest_checkout" value="yes" <?php checked( Admin_Options::get_setting( 'display_tag_interest_checkout') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-interest-options mt-4">
			<th class="w-100">
				<?php esc_html_e( 'Juros por método de pagamento', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e( 'Informe uma taxa de juros por método de pagamento para ser adicionado na finalização da compra.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
		</tr>

		<tr id="wci-interest-header" class="display-enable-all-interest-options">
			<th>
				<?php echo __( 'Método de pagamento', 'custom-installments-for-woocommerce' ); ?>
			</th>
			<th class="w-50">
				<?php echo __( 'Valor', 'custom-installments-for-woocommerce' ); ?>
			</th>
			<th>
				<?php echo __( 'Método do juros', 'custom-installments-for-woocommerce' ); ?>
			</th>
		</tr>

		<?php
		$payment_gateways = WC()->payment_gateways->payment_gateways();
		$interest_settings = maybe_unserialize( get_option('woo_custom_installments_interests_setting', array()) );

		foreach ( $payment_gateways as $gateway ) :
			$current = isset( $interest_settings[$gateway->id]['amount'] ) ? $interest_settings[$gateway->id]['amount'] : '0'; ?>
			
			<tr id="wci-interest-methods-<?php echo esc_attr( $gateway->id ); ?>" class="display-enable-all-interest-options foreach-method-discount wci-interest-methods">
				<th class="wci-title-method-interest-header">
					<label for="woo_custom_installments_payment_discounts_<?php echo esc_attr( $gateway->id ); ?>"><?php echo esc_attr( $gateway->title ); ?></label>
				</th>

				<td class="wci-title-method-interest-div">
					<div class="input-group wci-method-interest-selector" id="foreach-payment-<?php echo esc_attr( $gateway->id ); ?>-method-discount" name="form-interest-<?php echo esc_attr( $gateway->id ); ?>-method">
						<span id="interest-method-result-payment-method-<?php echo esc_attr( $gateway->id ); ?>" class="input-group-text interest-method-result-payment-method" name="interest-method-result-payment-method[<?php echo esc_attr( $gateway->id ); ?>][type]">
							<?php echo ( isset( $interest_settings[$gateway->id]['type'] ) && $interest_settings[$gateway->id]['type'] === 'percentage' ) ? '%' : get_woocommerce_currency_symbol(); ?>
						</span>

						<input type="text" class="form-control allow-number-and-dots input-control-wd-5 text-center" value="<?php echo esc_attr( $current ); ?>" id="woo_custom_installments_payment_discounts_<?php echo esc_attr( $gateway->id ); ?>" name="woo_custom_installments_interests[<?php echo esc_attr( $gateway->id ); ?>][amount]"/>
						
						<select class="form-select get-interest-method-payment-method" id="woo-custom-installments-payment-discounts-type-<?php echo esc_attr( $gateway->id ); ?>" name="woo_custom_installments_interests[<?php echo esc_attr( $gateway->id ); ?>][type]">
							<option value="fixed" <?php if( isset( $interest_settings[$gateway->id]['type'] ) && $interest_settings[$gateway->id]['type'] == 'fixed' ) { echo 'selected="selected"'; } ?> ><?php esc_html_e( 'Valor fixo (R$)', 'custom-installments-for-woocommerce' ) ?></span></option>
							<option value="percentage" <?php if( isset( $interest_settings[$gateway->id]['type'] ) && $interest_settings[$gateway->id]['type'] == 'percentage' ) { echo 'selected="selected"'; } ?> ><?php esc_html_e( 'Percentual (%)', 'custom-installments-for-woocommerce' ) ?></span></option>
						</select>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
    </table>
</div>