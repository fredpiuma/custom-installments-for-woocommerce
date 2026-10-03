<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<div id="discounts" class="nav-content">
    <table class="form-table">
		<tr>
			<th>
				<?php esc_html_e( 'Ativar funções de descontos', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Ative esta opção para habilitar todas as opções relacionadas a desconto.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>

			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_all_discount_options" name="enable_all_discount_options" value="yes" <?php checked( Admin_Options::get_setting( 'enable_all_discount_options') == 'yes' ); ?> />
				</div>
			</td>
		</tr>
		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Exibir preço com desconto no carrinho', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá exibir o valor do preço com desconto também no carrinho. (Recomendado)', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="display_installments_cart" name="display_installments_cart" value="yes" <?php checked( Admin_Options::get_setting( 'display_installments_cart') == 'yes' ); ?> />
				</div>
			</td>
		</tr>
		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Incluir valor de frete no desconto do pedido', 'custom-installments-for-woocommerce' ); ?>
					
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá incluir o valor de frete no cálculo de desconto na finalização da compra. (Recomendado)', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="include_shipping_value_in_discounts" name="include_shipping_value_in_discounts" value="yes" <?php checked( Admin_Options::get_setting( 'include_shipping_value_in_discounts') == 'yes' ); ?> />
				</div>
			</td>
		</tr>
		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Exibir preço com desconto em dados estruturados (Schema.org)', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá exibir o preço com desconto em serviços que fazem a leitura de dados estruturados ou "Rich snippets", para ajudar o produto em SEO. (Recomendado)', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="display_discount_price_schema" name="display_discount_price_schema" value="yes" <?php checked( Admin_Options::get_setting( 'display_discount_price_schema') == 'yes' ); ?> />
				</div>
			</td>
		</tr>
		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Ativar preço com desconto no Pix em Post Meta para Feed XML', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, o post meta "_product_price_on_pix" será criado para adicionar em Feed XML, com plugins compatíveis com esse recurso.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_post_meta_feed_xml_price" name="enable_post_meta_feed_xml_price" value="yes" <?php checked( Admin_Options::get_setting( 'enable_post_meta_feed_xml_price') === 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-discount-options container-separator"></tr>

		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Desconto no preço do produto via Pix', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Define qual será o valor de desconto sobre o preço do produto, para . Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="input-group">
					<span id="symbol_discount_pix" class="input-group-text justify-content-center">
						<?php echo ( Admin_Options::get_setting('product_price_discount_method') === 'percentage' ) ? '%' : get_woocommerce_currency_symbol(); ?>
					</span>

					<input type="text" id="discount_main_price" class="form-control text-center input-control-wd-5 allow-number-and-dots" name="discount_main_price" placeholder="20" value="<?php echo Admin_Options::get_setting( 'discount_main_price' ) ?>">
					
					<select id="product_price_discount_method" class="form-select" name="product_price_discount_method">
						<option value="percentage" <?php echo ( Admin_Options::get_setting('product_price_discount_method') == 'percentage' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Percentual (%)', 'custom-installments-for-woocommerce' ) ?></option>
						<option value="fixed" <?php echo ( Admin_Options::get_setting('product_price_discount_method') == 'fixed' ) ? "selected=selected" : ""; ?>><?php echo sprintf( __( 'Valor fixo (%s)', 'custom-installments-for-woocommerce' ), get_woocommerce_currency_symbol() ) ?></option>
					</select>
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-discount-options admin-discount-ticket-option">
			<th>
				<?php esc_html_e( 'Desconto no boleto bancário', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Define qual será o valor de desconto sobre o preço do produto para boleto bancário. Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>

			<td>
				<div class="input-group">
					<span id="symbol_discount_slip_bank" class="input-group-text justify-content-center">
						<?php echo ( Admin_Options::get_setting('discount_method_ticket') === 'percentage' ) ? '%' : get_woocommerce_currency_symbol(); ?>
					</span>

					<input type="text" id="discount_ticket" class="form-control text-center input-control-wd-5 allow-number-and-dots" name="discount_ticket" placeholder="20" value="<?php echo Admin_Options::get_setting( 'discount_ticket' ) ?>">
					
					<select id="discount_method_ticket" class="form-select get-discount-method-ticket" name="discount_method_ticket">
						<option value="percentage" <?php echo ( Admin_Options::get_setting( 'discount_method_ticket' ) == 'percentage' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Percentual (%)', 'custom-installments-for-woocommerce' ) ?></option>
						<option value="fixed" <?php echo ( Admin_Options::get_setting( 'discount_method_ticket' ) == 'fixed' ) ? "selected=selected" : ""; ?>><?php echo sprintf( __( 'Valor fixo (%s)', 'custom-installments-for-woocommerce' ), get_woocommerce_currency_symbol() ) ?></option>
					</select>
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-discount-options container-separator"></tr>

		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Ativar funções de desconto por quantidade', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá ser adicionado um desconto a partir de uma quantidade mínima do produto no carrinho, para todos os produtos da loja.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>

			<td class="d-flex align-items-center">
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_functions_discount_per_quantity" name="enable_functions_discount_per_quantity" value="yes" <?php checked( Admin_Options::get_setting( 'enable_functions_discount_per_quantity') == 'yes' ); ?> />
				</div>
				
				<button id="discount_per_quantity_trigger" class="btn btn-outline-primary ms-3 discount-per-quantity-option"><?php esc_html_e( 'Configurar', 'custom-installments-for-woocommerce' ) ?></button>
				
				<div id="discount_per_quantity_container" class="popup-container">
					<div class="popup-content">
						<div class="popup-header">
							<h5 class="popup-title"><?php esc_html_e( 'Configure o desconto por quantidade', 'custom-installments-for-woocommerce' ); ?></h5>
							<button id="discount_per_quantity_close" class="btn-close fs-lg" aria-label="<?php esc_html_e( 'Fechar', 'custom-installments-for-woocommerce' ) ?>"></button>
						</div>
						
						<div class="popup-body">
							<table class="popup-table">
								<tr class=" disable-discount-per-product-global">
									<th>
										<?php esc_html_e( 'Método do desconto por quantidade', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá ser adicionado um desconto a partir de uma quantidade mínima do produto no carrinho, para todos os produtos da loja.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<select id="enable_discount_per_quantity_method" class="form-select get-discount-per-quantity-method" name="enable_discount_per_quantity_method">
											<option value="global" <?php echo ( Admin_Options::get_setting( 'enable_discount_per_quantity_method' ) == 'global' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Para todos os produtos', 'custom-installments-for-woocommerce' ) ?></option>
											<option value="product" <?php echo ( Admin_Options::get_setting( 'enable_discount_per_quantity_method' ) == 'product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Configurar para cada produto', 'custom-installments-for-woocommerce' ) ?></option>
										</select>
									</td>
								</tr>

								<tr class="">
									<th>
										<?php esc_html_e( 'Ativar cálculo de desconto para cada unidade do produto elegível', 'custom-installments-for-woocommerce' ) ?>
										<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá ser considerado o desconto para cada unidade do produto.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch d-flex">
											<input type="checkbox" class="toggle-switch" id="enable_discount_per_unit_discount_per_quantity" name="enable_discount_per_unit_discount_per_quantity" value="yes" <?php checked( Admin_Options::get_setting( 'enable_discount_per_unit_discount_per_quantity') == 'yes' ); ?> />
										</div>
									</td>
								</tr>

								<tr class="">
									<th>
										<?php esc_html_e( 'Ativar mensagem nos produtos elegíveis para desconto por quantidade', 'custom-installments-for-woocommerce' ) ?>
										<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, irá ser adicionado a mensagem informando o usuário que o produto é elegível para desconto por quantidade.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch d-flex">
											<input type="checkbox" class="toggle-switch" id="message_discount_per_quantity" name="message_discount_per_quantity" value="yes" <?php checked( Admin_Options::get_setting( 'message_discount_per_quantity') == 'yes' ); ?> />
										</div>
									</td>
								</tr>

								<tr class="">
									<th>
										<?php esc_html_e( 'Forma de exibição da mensagem de desconto', 'custom-installments-for-woocommerce' ) ?>
										<span class="woo-custom-installments-description"><?php esc_html_e( 'Permite definir o método de exibição da mensagem de desconto por quantidade.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<select id="discount_per_qtd_message_method" class="form-select" name="discount_per_qtd_message_method">
											<option value="hook" <?php echo ( Admin_Options::get_setting('discount_per_qtd_message_method') === 'hook' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Ganchos (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
											<option value="widget" <?php echo ( Admin_Options::get_setting('discount_per_qtd_message_method') === 'product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Widget para Elementor', 'custom-installments-for-woocommerce' ) ?></option>
										</select>
									</td>
								</tr>

								<tr class="global-discount-required">
									<th>
										<?php esc_html_e( 'Valor do desconto por quantidade', 'custom-installments-for-woocommerce' ) ?>
										<span class="woo-custom-installments-description"><?php esc_html_e( 'Define qual será o valor de desconto por quantidade do produto.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="input-group">
											<span id="symbol_discount_quantity" class="input-group-text justify-content-center">
												<?php echo ( Admin_Options::get_setting('discount_per_quantity_method') === 'percentage' ) ? '%' : get_woocommerce_currency_symbol(); ?>
											</span>
											<input type="text" id="value_for_discount_per_quantity" class="form-control input-control-wd-5 allow-number-and-dots" name="value_for_discount_per_quantity" placeholder="20" value="<?php echo Admin_Options::get_setting( 'value_for_discount_per_quantity' ) ?>">
											
											<select id="discount_per_quantity_method" class="form-select" name="discount_per_quantity_method">
												<option value="percentage" <?php echo ( Admin_Options::get_setting('discount_per_quantity_method') == 'percentage' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Percentual (%)', 'custom-installments-for-woocommerce' ) ?></option>
												<option value="fixed" <?php echo ( Admin_Options::get_setting('discount_per_quantity_method') == 'fixed' ) ? "selected=selected" : ""; ?>><?php echo sprintf( __( 'Valor fixo (%s)', 'custom-installments-for-woocommerce' ), get_woocommerce_currency_symbol() ) ?></option>
											</select>
										</div>
									</td>
								</tr>

								<tr class="global-discount-required">
									<th>
										<?php esc_html_e( 'Quantidade mínima para oferecer desconto', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e( 'Informe a quantidade mínima do produto para oferecer desconto no carrinho.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<input type="number" id="set_quantity_enable_discount" class="form-control allow-numbers-be-1 input-control-wd-7-7rem" name="set_quantity_enable_discount" value="<?php echo Admin_Options::get_setting( 'set_quantity_enable_discount' ) ?>"/>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-discount-options container-separator"></tr>

		<tr class="display-enable-all-discount-options">
			<th>
				<?php esc_html_e( 'Mostrar informação de desconto na forma de pagamento', 'custom-installments-for-woocommerce' ); ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, será exibido o emblema de desconto ao lado do título da forma de pagamento configurada.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
				<input type="checkbox" class="toggle-switch" id="display_tag_discount_price_checkout" name="display_tag_discount_price_checkout" value="yes" <?php checked( Admin_Options::get_setting( 'display_tag_discount_price_checkout') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="display-enable-all-discount-options">
			<th class="w-100">
				<?php esc_html_e( 'Desconto por método de pagamento', 'custom-installments-for-woocommerce' ); ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Informe um desconto por método de pagamento para ser adicionado na finalização da compra.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
		</tr>

		<tr id="wci-discount-header" class="display-enable-all-discount-options">
			<th>
				<?php echo __( 'Método de pagamento', 'custom-installments-for-woocommerce' ); ?>
			</th>
			<th class="w-50">
				<?php echo __( 'Valor', 'custom-installments-for-woocommerce' ); ?>
			</th>
			<th>
				<?php echo __( 'Método do desconto', 'custom-installments-for-woocommerce' ); ?>
			</th>
		</tr>

		<?php
		$payment_gateways = WC()->payment_gateways->payment_gateways();
		$discount_settings = maybe_unserialize( get_option('woo_custom_installments_discounts_setting', array()) );

		foreach ( $payment_gateways as $gateway ) :
			$current = isset( $discount_settings[$gateway->id]['amount'] ) ? $discount_settings[$gateway->id]['amount'] : '0'; ?>

			<tr id="wci-discount-methods-<?php echo esc_attr( $gateway->id ); ?>" class="display-enable-all-discount-options foreach-method-discount wci-discount-methods">
				<th class="wci-title-method-discount-header">
					<label for="woo_custom_installments_payment_discounts_<?php echo esc_attr( $gateway->id ); ?>"><?php echo esc_attr( $gateway->title ); ?></label>
				</th>
				<td class="wci-title-method-discount-div">
					<div class="input-group wci-method-discount-selector" id="foreach-payment-<?php echo esc_attr( $gateway->id ); ?>-method-discount" name="form-discount-<?php echo esc_attr( $gateway->id ); ?>-method">
						<span id="discount-method-result-payment-method-<?php echo esc_attr( $gateway->id ); ?>" class="input-group-text discount-method-result-payment-method" name="discount-method-result-payment-method[<?php echo esc_attr( $gateway->id ); ?>][type]">
							<?php echo ( isset( $discount_settings[$gateway->id]['type'] ) && $discount_settings[$gateway->id]['type'] === 'percentage' ) ? '%' : get_woocommerce_currency_symbol(); ?>
						</span>

						<input type="text" class="form-control allow-number-and-dots input-control-wd-5 text-center" value="<?php echo esc_attr( $current ); ?>" id="woo_custom_installments_payment_discounts_<?php echo esc_attr( $gateway->id ); ?>" name="woo_custom_installments_discounts[<?php echo esc_attr( $gateway->id ); ?>][amount]"/>
						
						<select class="form-select get-discount-method-payment-method" id="woo-custom-installments-payment-discounts-type-<?php echo esc_attr( $gateway->id ); ?>" name="woo_custom_installments_discounts[<?php echo esc_attr( $gateway->id ); ?>][type]">
							<option value="fixed" <?php echo ( isset( $discount_settings[$gateway->id]['type'] ) && $discount_settings[$gateway->id]['type'] === 'fixed' ) ? 'selected="selected"' : ''; ?> ><?php echo sprintf( __( 'Valor fixo (%s)', 'custom-installments-for-woocommerce' ), get_woocommerce_currency_symbol() ) ?></span></option>
							<option value="percentage" <?php echo ( isset( $discount_settings[$gateway->id]['type'] ) && $discount_settings[$gateway->id]['type'] === 'percentage' ) ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Percentual (%)', 'custom-installments-for-woocommerce' ) ?></span></option>
						</select>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
    </table>
</div>