<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<div id="general" class="nav-content">
   <table class="form-table">
		<tr>
			<th>
				<?php esc_html_e( 'Ativar parcelas customizadas', 'custom-installments-for-woocommerce' ) ?>
				<span class="woo-custom-installments-description"><?php esc_html_e('Ative esta opção para que o plugin será inicializado.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_installments_all_products" name="enable_installments_all_products" value="yes" <?php checked( Admin_Options::get_setting('enable_installments_all_products') == 'yes' ); ?> />
				</div>
			</td>
      </tr>

		<tr>
			<th>
				<?php esc_html_e( 'Remover faixa de preço em produtos variáveis', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e('Se ativo, irá remover a faixa de preço em produtos variáveis e o preço será alterado dinâmicamente ao selecionar uma variação.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="remove_price_range" name="remove_price_range" value="yes" <?php checked( Admin_Options::get_setting('remove_price_range') == 'yes' ); ?> />
					
					<button id="remove_price_range_settings_trigger" class="btn btn-outline-primary ms-3 require-remove-price-range"><?php esc_html_e( 'Configurar', 'custom-installments-for-woocommerce' ) ?></button>
					
					<div id="remove_price_range_settings_container" class="popup-container">
						<div class="popup-content">
							<div class="popup-header">
								<h5 class="popup-title"><?php esc_html_e( 'Configurar remoção da faixa de preço', 'custom-installments-for-woocommerce' ); ?></h5>
								<button id="remove_price_range_settings_close" class="btn-close fs-lg" aria-label="<?php esc_html_e( 'Fechar', 'custom-installments-for-woocommerce' ) ?>"></button>
							</div>

							<div class="popup-body">
								<table class="popup-table">
									<tbody>
										<tr class="require-dynamic-method">
											<th>
												<?php esc_html_e( 'Gatilho para atualização', 'custom-installments-for-woocommerce' ) ?>
												<span class="woo-custom-installments-description"><?php esc_html_e('Permite definir elementos que ao serem clicados acionam a atualização do preço. Informe a classe ou ID separado por vírgulas: .elemento-1, .elemento-2', 'custom-installments-for-woocommerce' ) ?></span>
											</th>
											<td>
												<input type="text" id="update_range_price_triggers" class="form-control" name="update_range_price_triggers" value="<?php echo Admin_Options::get_setting('update_range_price_triggers') ?>" placeholder=".elemento-1, .elemento-2"/>
											</td>
										</tr>

										<tr class="starting-from">
											<th>
												<?php esc_html_e( 'Texto inicial em produtos variáveis (A partir de)', 'custom-installments-for-woocommerce' ) ?>
												<span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
											</th>
											<td>
												<input type="text" class="form-control input-control-wd-20" name="text_initial_variables" value="<?php echo Admin_Options::get_setting( 'text_initial_variables' ) ?>"/>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>

		<tr>
			<th>
				<?php esc_html_e( 'Atualizar preço do produto a partir da quantidade', 'custom-installments-for-woocommerce' ); ?>

				<span class="woo-custom-installments-description"><?php esc_html_e('Ative esta opção para atualizar o preço do produto e seus derivados a partir do seletor de quantidade.', 'custom-installments-for-woocommerce' ) ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="update_price_with_quantity" name="update_price_with_quantity" value="yes" <?php checked( Admin_Options::get_setting('update_price_with_quantity') === 'yes' ); ?> />
				</div>
			</td>
		</tr>

      <tr>
         <th>
            <?php esc_html_e( 'Mostrar informação de economia no Pix', 'custom-installments-for-woocommerce' ); ?>

            <span class="woo-custom-installments-description"><?php esc_html_e('Ative esta opção para mostrar o valor que o usuário economizará ao pagar no Pix.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td>
            <div class="form-check form-switch">
               <input type="checkbox" class="toggle-switch" id="enable_economy_pix_badge" name="enable_economy_pix_badge" value="yes" <?php checked( Admin_Options::get_setting('enable_economy_pix_badge') == 'yes' ); ?> />
            </div>
         </td>
      </tr>

      <tr>
         <th>
            <?php esc_html_e( 'Personalizar preço do produto', 'custom-installments-for-woocommerce' ) ?>
            <span class="woo-custom-installments-description"><?php esc_html_e('Ative essa opção para personalizar o preço principal do produto, sem afetar o preço cadastrado. Recomendado para servir o preço com desconto. Por exemplo: R$100,00 no Pix', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td class="d-flex align-items-center">
            <div class="form-check form-switch">
               <input type="checkbox" class="toggle-switch" id="custom_text_after_price" name="custom_text_after_price" value="yes" <?php checked( Admin_Options::get_setting( 'custom_text_after_price') === 'yes' ); ?> />
            </div>
            
            <button id="custom_product_price_trigger" class="btn btn-outline-primary ms-3 require-custom-product-price"><?php esc_html_e( 'Configurar', 'custom-installments-for-woocommerce' ) ?></button>
            
            <div id="custom_product_price_container" class="popup-container">
               <div class="popup-content">
                  <div class="popup-header">
                     <h5 class="popup-title"><?php esc_html_e( 'Configure o preço do produto', 'custom-installments-for-woocommerce' ); ?></h5>
                     <button id="custom_product_price_close" class="btn-close fs-lg" aria-label="<?php esc_html_e( 'Fechar', 'custom-installments-for-woocommerce' ) ?>"></button>
                  </div>

                  <div class="popup-body">
                     <table class="popup-table">
                        <tbody>
                           <tr>
                              <th>
                                 <?php esc_html_e( 'Adicionar um desconto no preço do produto', 'custom-installments-for-woocommerce' ); ?>
                                 <span class="woo-custom-installments-description"><?php esc_html_e('Ative esta opção para mostrar o valor que o usuário economizará ao pagar no Pix.', 'custom-installments-for-woocommerce' ) ?></span>
                              </th>
                              <td class="d-flex">
                                 <div class="form-check form-switch">
                                    <input type="checkbox" class="toggle-switch" id="add_discount_custom_product_price" name="add_discount_custom_product_price" value="yes" <?php checked( Admin_Options::get_setting('add_discount_custom_product_price') === 'yes' ); ?> />
                                 </div>
                              </td>
                           </tr>

                           <tr class="require-add-discount-custom-product-price">
                              <th>
                                 <?php esc_html_e( 'Valor de desconto', 'custom-installments-for-woocommerce' ) ?>
                                 <span class="woo-custom-installments-description"><?php esc_html_e( 'Defina um desconto a ser aplicado no preço do produto, use ponto para definir um número flutuante.', 'custom-installments-for-woocommerce' ) ?></span>
                              </th>
                              <td>
                                 <input type="text" class="form-control input-control-wd-20 allow-number-and-dots" name="discount_value_custom_product_price" value="<?php echo Admin_Options::get_setting('discount_value_custom_product_price') ?>"/>
                              </td>
                           </tr>

                           <tr class="tr-custom-text-after-price">
                              <th>
                                 <?php esc_html_e( 'Texto depois do preço do produto', 'custom-installments-for-woocommerce' ) ?>
                                 <span class="woo-custom-installments-description"><?php esc_html_e( 'Deixe em branco para não exibir.', 'custom-installments-for-woocommerce' ) ?></span>
                              </th>
                              <td>
                                 <input type="text" class="form-control input-control-wd-20" name="custom_text_after_price_front" value="<?php echo Admin_Options::get_setting( 'custom_text_after_price_front' ) ?>"/>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </td>
      </tr>

      <tr>
         <th>
            <?php esc_html_e( 'Ativar emblema de percentual de desconto', 'custom-installments-for-woocommerce' ); ?>
            
            <span class="woo-custom-installments-description"><?php esc_html_e('Ative essa opção exibir o percentual de desconto ao lado do preço.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td class="d-flex align-items-center">
            <div class="form-check form-switch">
               <input type="checkbox" class="toggle-switch" id="enable_sale_badge" name="enable_sale_badge" value="yes" <?php checked( Admin_Options::get_setting('enable_sale_badge') === 'yes' ); ?> />
            </div>
         </td>
      </tr>

      <tr class="container-separator"></tr>

      <tr id="fee-global-settings">
        <th>
           <?php esc_html_e( 'Taxa de juros padrão', 'custom-installments-for-woocommerce' ) ?>
           <span class="woo-custom-installments-description"><?php esc_html_e( 'Percentual para cálculo de juros das parcelas de forma progressiva.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
        <td>
           <div class="input-group">
              <span id="method_result_default_fee" class="input-group-text">%</span>
              <input type="text" id="fee_installments_global" class="form-control input-control-wd-5 allow-number-and-dots" name="fee_installments_global" value="<?php echo Admin_Options::get_setting( 'fee_installments_global' ) ?>" placeholder="2.0"/>
           </div>
        </td>
      </tr>

      <tr>
        <th>
           <?php esc_html_e( 'Quantidade máxima de parcelas', 'custom-installments-for-woocommerce' ) ?>
           <span class="woo-custom-installments-description"><?php esc_html_e( 'Define a quantidade máxima de parcelas que será exibida.' ) ?></span>
        </th>
        <td>
           <input type="number" id="max_qtd_installments" class="form-control allow-numbers-be-1 input-control-wd-7-7rem" name="max_qtd_installments" value="<?php echo Admin_Options::get_setting( 'max_qtd_installments' ) ?>"/>
        </td>
      </tr>

      <tr>
        <th>
           <?php esc_html_e( 'Quantidade máxima de parcelas sem juros', 'custom-installments-for-woocommerce' ) ?>
           <span class="woo-custom-installments-description"><?php esc_html_e( 'Define a quantidade máxima de parcelas sem juros que será exibida.' ) ?></span>
        </th>
        <td>
           <input type="number" id="max_qtd_installments_without_fee" class="form-control allow-numbers-be-0 input-control-wd-7-7rem" name="max_qtd_installments_without_fee" value="<?php echo Admin_Options::get_setting( 'max_qtd_installments_without_fee' ) ?>"/>
        </td>
      </tr>

      <tr>
        <th>
           <?php esc_html_e( 'Valor mínimo da parcela', 'custom-installments-for-woocommerce' ) ?>
           <span class="woo-custom-installments-description"><?php esc_html_e( 'Define qual será o valor mínimo da parcela que o cliente pagará.', 'custom-installments-for-woocommerce' ) ?></span>
        </th>
        <td>
           <div class="input-group input-control-wd-5">
              <span id="method_result" class="input-group-text"><?php echo get_woocommerce_currency_symbol(); ?></span>
              <input type="number" id="min_value_installments" class="form-control input-control-wd-5 allow-numbers-be-1 input-control-wd-7-7rem" name="min_value_installments" placeholder="20" value="<?php echo Admin_Options::get_setting( 'min_value_installments' ) ?>">
           </div>
        </td>
      </tr>

      <tr>
         <th>
            <?php esc_html_e( 'Definir taxa de juros por parcela', 'custom-installments-for-woocommerce' ); ?>

            <span class="woo-custom-installments-description"><?php esc_html_e( 'Se ativo, permite informar uma taxa de juros personalizada para cada parcela.', 'custom-installments-for-woocommerce' ) ?></span>
            </th>
         <td class="d-flex align-items-center">
            <div class="form-check form-switch">
               <input type="checkbox" class="toggle-switch" id="set_fee_per_installment" name="set_fee_per_installment" value="yes" <?php checked( Admin_Options::get_setting( 'set_fee_per_installment') == 'yes' ); ?> />
            </div>

            <button id="set_custom_fee_trigger" class="btn btn-outline-primary ms-3 set-custom-fee-per-installment"><?php esc_html_e( 'Configurar', 'custom-installments-for-woocommerce' ) ?></button>
            
            <div id="set_custom_fee_container" class="popup-container">
               <div class="popup-content">
                  <div class="popup-header">
                     <h5 class="popup-title"><?php esc_html_e( 'Configure o juros por parcela', 'custom-installments-for-woocommerce' ); ?></h5>
                     <button id="set_custom_fee_close" class="btn-close fs-lg" aria-label="<?php esc_html_e( 'Fechar', 'custom-installments-for-woocommerce' ) ?>"></button>
                  </div>

                  <div class="popup-body">
                     <table class="popup-table">
                        <tr class="">
                           	<td>
                              	<fieldset id="custom-installments-fieldset-custom-installments">
                                    <?php
                                    $custom_fee_installments = maybe_unserialize( get_option('woo_custom_installments_custom_fee_installments', array()) );
                                    $limit_installments = Admin_Options::get_setting('max_qtd_installments');
                                    $init_loop = ! empty ( Admin_Options::get_setting('max_qtd_installments_without_fee') ) ? Admin_Options::get_setting('max_qtd_installments_without_fee') : 0 + 1;
                                    
                                    for ( $i = $init_loop; $i <= $limit_installments; $i++ ) :
                                       $current_custom_fee = isset( $custom_fee_installments[$i]['amount'] ) ? floatval( $custom_fee_installments[$i]['amount'] ) : 0; ?>

                                       <div class="input-group mb-2" data-installment="<?php echo $i; ?>">
                                          <input class="custom-installment-first small-input form-control" type="text" disabled value="<?php echo $i; ?>"/>
                                          <input class="custom-installment-secondary small-input form-control allow-number-and-dots" type="text" placeholder="1.0" name="custom_fee_installments[<?php echo $i; ?>][amount]" id="custom_fee_installments[<?php echo $i; ?>]" value="<?php echo esc_attr( $current_custom_fee ); ?>" />
                                       </div>
                                    <?php endfor; ?>
                              	</fieldset>
                           	</td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </td>
      </tr>

      <tr class="container-separator"></tr>

      <tr>
        <th>
           <?php esc_html_e( 'Local de exibição do preço com desconto no Pix', 'custom-installments-for-woocommerce' ); ?>

           <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione onde o preço com desconto no Pix será exibido.', 'custom-installments-for-woocommerce' ) ?></span>
        </th>
        <td>
           <select name="display_discount_price_hook" class="form-select">
              <option value="display_loop_and_single_product" <?php echo ( Admin_Options::get_setting('display_discount_price_hook') === 'display_loop_and_single_product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Mostrar em todo o site (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="only_single_product" <?php echo ( Admin_Options::get_setting('display_discount_price_hook') === 'only_single_product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas página do produto individual', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="only_loop_products" <?php echo ( Admin_Options::get_setting('display_discount_price_hook') === 'only_loop_products' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas arquivos de produtos', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="hide" <?php echo ( Admin_Options::get_setting('display_discount_price_hook') === 'hide' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Ocultar', 'custom-installments-for-woocommerce' ) ?></option>
           </select>
        </td>
      </tr>

      <tr class="economy-pix-dependency">
        <th>
           <?php esc_html_e( 'Local de exibição da informação de economia no Pix', 'custom-installments-for-woocommerce' ); ?>

           <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione onde o preço com desconto será exibido.', 'custom-installments-for-woocommerce' ) ?></span>
        </th>
        <td>
           <select name="display_economy_pix_hook" class="form-select">
               <option value="only_single_product" <?php echo (Admin_Options::get_setting( 'display_economy_pix_hook' ) === 'only_single_product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas página do produto individual (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="global" <?php echo (Admin_Options::get_setting( 'display_economy_pix_hook' ) === 'global' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Mostrar em todo o site', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="only_loop_products" <?php echo (Admin_Options::get_setting( 'display_economy_pix_hook' ) === 'only_loop_products' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas arquivos de produtos', 'custom-installments-for-woocommerce' ) ?></option>
           </select>
        </td>
      </tr>

      <tr class="admin-discount-ticket-option">
         <th>
            <?php esc_html_e( 'Local de exibição desconto no boleto bancário', 'custom-installments-for-woocommerce' ); ?>

            <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione onde o preço com desconto será exibido.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td>
            <select name="display_discount_ticket_hook" class="form-select">
				<option value="global" <?php echo (Admin_Options::get_setting( 'display_discount_ticket_hook' ) === 'global' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Mostrar em todo o site (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
				<option value="only_single_product" <?php echo (Admin_Options::get_setting( 'display_discount_ticket_hook' ) === 'only_single_product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas página do produto individual', 'custom-installments-for-woocommerce' ) ?></option>
				<option value="only_loop_products" <?php echo (Admin_Options::get_setting( 'display_discount_ticket_hook' ) === 'only_loop_products' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas arquivos de produtos', 'custom-installments-for-woocommerce' ) ?></option>
            </select>
         </td>
      </tr>

      <tr>
         <th>
            <?php esc_html_e( 'Local de exibição das melhores parcelas', 'custom-installments-for-woocommerce' ); ?>

            <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione o local para exibir a informação das melhores parcelas.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td>
            <select name="hook_display_best_installments" class="form-select">
               <option value="display_loop_and_single_product" <?php echo ( Admin_Options::get_setting( 'hook_display_best_installments' ) === 'display_loop_and_single_product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Mostrar em todo o site (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
               <option value="only_single_product" <?php echo ( Admin_Options::get_setting( 'hook_display_best_installments' ) === 'only_single_product' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas página do produto individual', 'custom-installments-for-woocommerce' ) ?></option>
               <option value="only_loop_products" <?php echo ( Admin_Options::get_setting( 'hook_display_best_installments' ) === 'only_loop_products' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Apenas arquivos de produtos', 'custom-installments-for-woocommerce' ) ?></option>
            </select>
         </td>
      </tr>

      <tr class="container-separator"></tr>

      <tr>
         <th>
            <?php esc_html_e( 'Exibir melhor parcela', 'custom-installments-for-woocommerce' ) ?>
            <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione o tipo de exibição da melhor parcela.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td>
           <select name="get_type_best_installments" class="form-select">
              <option value="hide" <?php echo ( Admin_Options::get_setting( 'get_type_best_installments' ) == 'hide' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Ocultar', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="best_installment_without_fee" <?php echo ( Admin_Options::get_setting( 'get_type_best_installments' ) == 'best_installment_without_fee' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Melhor parcela sem juros', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="best_installment_with_fee" <?php echo ( Admin_Options::get_setting( 'get_type_best_installments' ) == 'best_installment_with_fee' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Melhor parcela com juros', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="both" <?php echo ( Admin_Options::get_setting( 'get_type_best_installments' ) == 'both' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Melhor parcela com e sem juros', 'custom-installments-for-woocommerce' ) ?></option>
           </select>
         </td>
      </tr>

      <tr>
         <th>
            <?php esc_html_e( 'Tipo de exibição das formas de pagamento', 'custom-installments-for-woocommerce' ) ?>
            <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione o tipo de exibição das formas de pagamento na página de produto individual.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
        <td>
           <select id="display_installment_type" name="display_installment_type" class="form-select">
              <option value="popup" <?php echo ( Admin_Options::get_setting( 'display_installment_type' ) == 'popup' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Popup (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="accordion" <?php echo ( Admin_Options::get_setting( 'display_installment_type' ) == 'accordion' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Sanfona', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="hide" <?php echo ( Admin_Options::get_setting( 'display_installment_type' ) == 'hide' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Ocultar', 'custom-installments-for-woocommerce' ) ?></option>
           </select>
        </td>
     </tr>

     <tr class="tr-position-installment-type-button">
         <th>
           <?php esc_html_e( 'Posição das formas de pagamento e parcelas na página de produto individual', 'custom-installments-for-woocommerce' ); ?>

            <span class="woo-custom-installments-description"><?php esc_html_e( 'Selecione onde o gancho que será exibido as formas de pagamento na página de produto individual.', 'custom-installments-for-woocommerce' ) ?></span>
            <span id="display-shortcode-info" class="woo-custom-installments-description mt-2 <?php echo ( Admin_Options::get_setting( 'hook_payment_form_single_product' ) != 'shortcode' ) ?"d-none" : ""; ?>"><?php esc_html_e( 'Shortcode: ', 'custom-installments-for-woocommerce' ) ?><code>[woo_custom_installments_modal]</code></span>
         </th>
         <td>
           <select id="hook_payment_form_single_product" name="hook_payment_form_single_product" class="form-select">
              <option value="before_cart" <?php echo ( Admin_Options::get_setting( 'hook_payment_form_single_product' ) === 'before_cart' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Antes do carrinho (Padrão)', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="after_cart" <?php echo ( Admin_Options::get_setting( 'hook_payment_form_single_product' ) === 'after_cart' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Depois do carrinho', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="custom_hook" <?php echo ( Admin_Options::get_setting( 'hook_payment_form_single_product' ) === 'custom_hook' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Gancho personalizado', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="shortcode" <?php echo ( Admin_Options::get_setting( 'hook_payment_form_single_product' ) === 'shortcode' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Shortcode', 'custom-installments-for-woocommerce' ) ?></option>
              <option value="widget" <?php echo ( Admin_Options::get_setting( 'hook_payment_form_single_product' ) === 'widget' ) ? "selected=selected" : ""; ?>><?php esc_html_e( 'Widget para Elementor', 'custom-installments-for-woocommerce' ) ?></option>
           </select>
         </td>
      </tr>

      <tr class="requires-custom-hook">
         <th>
            <?php esc_html_e( 'Gancho personalizado das formas de pagamento', 'custom-installments-for-woocommerce' ); ?>

            <span class="woo-custom-installments-description"><?php esc_html_e( 'Informe o gancho que deve ser exibido o botão ou sanfona de formas de pagamento.', 'custom-installments-for-woocommerce' ) ?></span>
         </th>
         <td>
            <input type="text" class="form-control input-control-wd-20" name="set_custom_hook_payment_form" value="<?php echo Admin_Options::get_setting('set_custom_hook_payment_form') ?>"/>
         </td>
      </tr>
  </table>
</div>