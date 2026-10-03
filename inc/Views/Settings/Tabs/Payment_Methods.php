<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<div id="payment_methods" class="nav-content">
    <table class="form-table">
		<tr>
			<th>
				<?php esc_html_e( 'Ativar forma de pagamento Pix', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a forma de pagamento Pix.', 'custom-installments-for-woocommerce' ) ?></span>
				<span class="woo-custom-installments-description mt-2"><?php esc_html_e( 'Shortcode: ', 'custom-installments-for-woocommerce' ) ?><code>[woo_custom_installments_pix_container]</code></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_pix_method_payment_form" name="enable_pix_method_payment_form" value="yes" <?php checked( Admin_Options::get_setting( 'enable_pix_method_payment_form') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="admin-immediate-aprove-badge">
			<th>
				<?php esc_html_e( 'Exibir emblema de aprovação imediata', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e('Se ativo, irá exibir o emblema de aprovação imediata no pix, cartão de crédito e débito.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
				<input type="checkbox" class="toggle-switch" id="enable_instant_approval_badge" name="enable_instant_approval_badge" value="yes" <?php checked( Admin_Options::get_setting( 'enable_instant_approval_badge') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr>
			<th>
				<?php esc_html_e( 'Ativar forma de pagamento boleto bancário', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a forma de pagamento boleto bancário.', 'custom-installments-for-woocommerce' ) ?></span>
				<span class="woo-custom-installments-description mt-2"><?php esc_html_e( 'Shortcode: ', 'custom-installments-for-woocommerce' ) ?><code>[woo_custom_installments_ticket_container]</code></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_ticket_method_payment_form" name="enable_ticket_method_payment_form" value="yes" <?php checked( Admin_Options::get_setting( 'enable_ticket_method_payment_form') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="admin-discount-ticket-option">
			<th>
				<?php esc_html_e( 'Mostrar desconto para boleto bancário', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e('Se ativo, irá ser adicionado uma nova informação de desconto no boleto bancário abaixo do desconto principal.', 'custom-installments-for-woocommerce' ) ?></span>
				<span class="woo-custom-installments-description mt-2"><?php esc_html_e( 'Shortcode: ', 'custom-installments-for-woocommerce' ) ?><code>[woo_custom_installments_ticket_discount_badge]</code></span>
			</th>
			<td>
				<div class="form-check form-switch">
				<input type="checkbox" class="toggle-switch" id="enable_ticket_discount_main_price" name="enable_ticket_discount_main_price" value="yes" <?php checked( Admin_Options::get_setting( 'enable_ticket_discount_main_price') == 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr>
			<th>
				<?php esc_html_e( 'Ativar forma de pagamento cartão de crédito', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a forma de pagamento cartão de crédito.', 'custom-installments-for-woocommerce' ) ?></span>
				<span class="woo-custom-installments-description mt-2"><?php esc_html_e( 'Shortcode: ', 'custom-installments-for-woocommerce' ) ?><code>[woo_custom_installments_credit_card_container]</code></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_credit_card_method_payment_form" name="enable_credit_card_method_payment_form" value="yes" <?php checked( Admin_Options::get_setting( 'enable_credit_card_method_payment_form') == 'yes' ); ?> />
					
					<button class="manage-credit-card-trigger btn btn-outline-primary ms-3"><?php esc_html_e( 'Configurar bandeiras', 'custom-installments-for-woocommerce' ) ?></button>
					
					<div class="manage-credit-card-container popup-container">
						<div class="manage-credit-card-content">
							<div class="popup-header">
								<h5 class="popup-title"><?php esc_html_e( 'Gerenciar bandeiras para cartão de crédito', 'custom-installments-for-woocommerce' ); ?></h5>
								<button class="close-manage-credit-card btn-close fs-lg" aria-label="Fechar"></button>
							</div>
							<div class="popup-body">
								<table class="popup-table">
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Mastercard', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Mastercard nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_mastercard_flag_credit" name="enable_mastercard_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_mastercard_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Visa', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Visa nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_visa_flag_credit" name="enable_visa_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_visa_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Elo', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Elo nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_elo_flag_credit" name="enable_elo_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_elo_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Hipercard', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Hipercard nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_hipercard_flag_credit" name="enable_hipercard_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_hipercard_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Diners Club', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Diners Club nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_diners_club_flag_credit" name="enable_diners_club_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_diners_club_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Discover', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Discover nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_discover_flag_credit" name="enable_discover_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_discover_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira American Express', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira American Express nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_american_express_flag_credit" name="enable_american_express_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_american_express_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira PayPal', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira PayPal nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_paypal_flag_credit" name="enable_paypal_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_paypal_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Stripe', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Stripe nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_stripe_flag_credit" name="enable_stripe_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_stripe_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Mercado Pago', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Mercado Pago nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_mercado_pago_flag_credit" name="enable_mercado_pago_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_mercado_pago_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira PagSeguro', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira PagSeguro nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_pagseguro_flag_credit" name="enable_pagseguro_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_pagseguro_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Pagar.me', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Pagar.me nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_pagarme_flag_credit" name="enable_pagarme_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_pagarme_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								<tr>
									<th>
										<?php esc_html_e( 'Ativar bandeira Cielo', 'custom-installments-for-woocommerce' ); ?>
										<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Cielo nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
									</th>
									<td>
										<div class="form-check form-switch">
											<input type="checkbox" class="toggle-switch" id="enable_cielo_flag_credit" name="enable_cielo_flag_credit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_cielo_flag_credit') == 'yes' ); ?> />
										</div>
									</td>
								</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<th>
				<?php esc_html_e( 'Ativar forma de pagamento cartão de débito', 'custom-installments-for-woocommerce' ); ?>
				
				<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a forma de pagamento cartão de débito.', 'custom-installments-for-woocommerce' ) ?></span>
				<span class="woo-custom-installments-description mt-2"><?php esc_html_e( 'Shortcode: ', 'custom-installments-for-woocommerce' ) ?><code>[woo_custom_installments_debit_card_container]</code></span>
			</th>
			<td>
				<div class="form-check form-switch">
				<input type="checkbox" class="toggle-switch" id="enable_debit_card_method_payment_form" name="enable_debit_card_method_payment_form" value="yes" <?php checked( Admin_Options::get_setting( 'enable_debit_card_method_payment_form') == 'yes' ); ?> />
				
				<button class="manage-debit-card-trigger btn btn-outline-primary ms-3"><?php esc_html_e( 'Configurar bandeiras', 'custom-installments-for-woocommerce' ) ?></button>
				
				<div class="manage-debit-card-container popup-container">
					<div class="manage-debit-card-content">
						<div class="popup-header">
							<h5 class="popup-title"><?php esc_html_e( 'Gerenciar bandeiras para cartão de débito', 'custom-installments-for-woocommerce' ); ?></h5>
							<button class="close-manage-debit-card btn-close fs-lg" aria-label="Fechar"></button>
						</div>
						<div class="popup-body">
							<table class="popup-table">
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Mastercard', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Mastercard nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_mastercard_flag_debit" name="enable_mastercard_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_mastercard_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Visa', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Visa nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_visa_flag_debit" name="enable_visa_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_visa_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Elo', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Elo nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_elo_flag_debit" name="enable_elo_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_elo_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Hipercard', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Hipercard nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_hipercard_flag_debit" name="enable_hipercard_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_hipercard_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Diners Club', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Diners Club nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_diners_club_flag_debit" name="enable_diners_club_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_diners_club_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Discover', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Discover nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_discover_flag_debit" name="enable_discover_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_discover_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira American Express', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira American Express nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_american_express_flag_debit" name="enable_american_express_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_american_express_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira PayPal', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira PayPal nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_paypal_flag_debit" name="enable_paypal_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_paypal_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Stripe', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Stripe nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_stripe_flag_debit" name="enable_stripe_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_stripe_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Mercado Pago', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Mercado Pago nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_mercado_pago_flag_debit" name="enable_mercado_pago_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_mercado_pago_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira PagSeguro', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira PagSeguro nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_pagseguro_flag_debit" name="enable_pagseguro_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_pagseguro_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Pagar.me', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Pagar.me nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_pagarme_flag_debit" name="enable_pagarme_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_pagarme_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							<tr>
								<th>
									<?php esc_html_e( 'Ativar bandeira Cielo', 'custom-installments-for-woocommerce' ); ?>
									<span class="woo-custom-installments-description"><?php esc_html_e('Ative para exibir a bandeira Cielo nas formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
								</th>
								<td>
									<div class="form-check form-switch">
										<input type="checkbox" class="toggle-switch" id="enable_cielo_flag_debit" name="enable_cielo_flag_debit" value="yes" <?php checked( Admin_Options::get_setting( 'enable_cielo_flag_debit') == 'yes' ); ?> />
									</div>
								</td>
							</tr>
							</table>
						</div>
					</div>
				</div>
				</div>
			</td>
		</tr>
	</table>
</div>