<?php

use FredericoDeCastro\Custom_Installments\Admin\Admin_Options;

// Exit if accessed directly.
defined('ABSPATH') || exit; ?>

<div id="about" class="nav-content">
	<table class="form-table">
		<tr>
			<th>
				<?php esc_html_e( 'Ativar atualizações automáticas', 'custom-installments-for-woocommerce' ); ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Ative essa opção para que o plugin Custom Installments for WooCommerce seja atualizado automaticamente sempre que possível.', 'custom-installments-for-woocommerce' ); ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_auto_updates" name="enable_auto_updates" value="yes" <?php checked( Admin_Options::get_setting('enable_auto_updates') === 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr>
			<th>
				<?php esc_html_e( 'Mostrar notificação de atualização disponível', 'custom-installments-for-woocommerce' ); ?>
				<span class="woo-custom-installments-description"><?php esc_html_e( 'Ative essa opção para que seja exibido uma notificação de atualização disponível.', 'custom-installments-for-woocommerce' ); ?></span>
			</th>
			<td>
				<div class="form-check form-switch">
					<input type="checkbox" class="toggle-switch" id="enable_update_notices" name="enable_update_notices" value="yes" <?php checked( Admin_Options::get_setting('enable_update_notices') === 'yes' ); ?> />
				</div>
			</td>
		</tr>

		<tr class="container-separator"></tr>
		
		<tr>
			<td class="d-grid">
				<h3 class="mb-3"><?php esc_html_e( 'Sobre o plugin:', 'custom-installments-for-woocommerce' ); ?></h3>

				<span class="mb-2"><?php esc_html_e( 'Custom Installments for WooCommerce é software livre, distribuído sob a licença GPL-2.0-or-later. Todos os recursos estão liberados.', 'custom-installments-for-woocommerce' ); ?></span>
				<span class="mb-2"><?php printf( esc_html__( 'Mantido por %s.', 'custom-installments-for-woocommerce' ), '<a class="fancy-link" href="https://www.fredericodecastro.com.br/links" target="_blank">Frederico de Castro</a>' ); ?></span>
				<span class="mb-2 text-muted"><?php esc_html_e( 'Baseado no plugin Parcelas Customizadas para WooCommerce, obra original de MeuMouse.com. Este é um fork independente, sem afiliação com o autor original.', 'custom-installments-for-woocommerce' ); ?></span>
				<a class="fancy-link mt-2" href="https://github.com/fredpiuma/custom-installments-for-woocommerce" target="_blank"><?php esc_html_e( 'Código-fonte no GitHub', 'custom-installments-for-woocommerce' ); ?></a>
			</td>
		</tr>

		<tr class="container-separator"></tr>

		<tr class="w-75 mt-5">
			<td>
				<h3 class="h2 mt-0"><?php esc_html_e( 'Status do sistema:', 'custom-installments-for-woocommerce' ); ?></h3>
				<h4 class="mt-4"><?php esc_html_e( 'WordPress', 'custom-installments-for-woocommerce' ); ?></h4>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Versão do WordPress:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2"><?php echo esc_html( get_bloginfo( 'version' ) ); ?></span>
				</div>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'WordPress Multisite:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2"><?php echo is_multisite() ? esc_html__( 'Sim', 'custom-installments-for-woocommerce' ) : esc_html__( 'Não', 'custom-installments-for-woocommerce' ); ?></span>
				</div>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Modo de depuração do WordPress:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2"><?php echo defined( 'WP_DEBUG' ) && WP_DEBUG ? esc_html__( 'Ativo', 'custom-installments-for-woocommerce' ) : esc_html__( 'Desativado', 'custom-installments-for-woocommerce' ); ?></span>
				</div>

				<h4 class="mt-4"><?php esc_html_e( 'WooCommerce', 'custom-installments-for-woocommerce' ); ?></h4>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Versão do WooCommerce:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2">
						<?php if( version_compare( WC_VERSION, '6.0', '<' ) ) : ?>
							<span class="badge bg-translucent-danger">
								<span>
									<?php echo esc_html( WC_VERSION ); ?>
								</span>
								<span>
									<?php esc_html_e( 'A versão mínima exigida do WooCommerce é 6.0', 'custom-installments-for-woocommerce' ); ?>
								</span>
							</span>
						<?php else : ?>
							<span class="badge bg-translucent-success">
								<?php echo esc_html( WC_VERSION ); ?>
							</span>
						<?php endif; ?>
					</span>
				</div>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Versão do Custom Installments for WooCommerce:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2">
						<span class="badge bg-translucent-success">
							<?php echo esc_html( WOO_CUSTOM_INSTALLMENTS_VERSION ); ?>
						</span>
					</span>
				</div>

				<h4 class="mt-4"><?php esc_html_e( 'Servidor', 'custom-installments-for-woocommerce' ); ?></h4>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Versão do PHP:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2">
						<?php if ( version_compare( PHP_VERSION, '7.2', '<' ) ) : ?>
							<span class="badge bg-translucent-danger">
								<span>
									<?php echo esc_html( PHP_VERSION ); ?>
								</span>
								<span>
									<?php esc_html_e( 'A versão mínima exigida do PHP é 7.2', 'custom-installments-for-woocommerce' ); ?>
								</span>
							</span>
						<?php else : ?>
							<span class="badge bg-translucent-success">
								<?php echo esc_html( PHP_VERSION ); ?>
							</span>
						<?php endif; ?>
					</span>
				</div>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'DOMDocument:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2">
						<span>
							<?php if ( ! class_exists( 'DOMDocument' ) ) : ?>
								<span class="badge bg-translucent-danger">
									<?php esc_html_e( 'Não', 'custom-installments-for-woocommerce' ); ?>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php esc_html_e( 'Sim', 'custom-installments-for-woocommerce' ); ?>
								</span>
							<?php endif; ?>
						</span>
					</span>
				</div>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Extensão cURL:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2">
						<span>
							<?php if ( !extension_loaded('curl') ) : ?>
								<span class="badge bg-translucent-danger">
									<?php esc_html_e( 'Não', 'custom-installments-for-woocommerce' ); ?>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php esc_html_e( 'Sim', 'custom-installments-for-woocommerce' ); ?>
								</span>
								<span>
									<?php echo sprintf( __( 'Versão %s', 'custom-installments-for-woocommerce' ), curl_version()['version'] ) ?>
								</span>
							<?php endif; ?>
						</span>
					</span>
				</div>
				<div class="d-flex align-items-center mb-2">
					<span><?php esc_html_e( 'Extensão OpenSSL:', 'custom-installments-for-woocommerce' ); ?></span>
					<span class="ms-2">
						<span>
							<?php if ( !extension_loaded('openssl') ) : ?>
								<span class="badge bg-translucent-danger">
									<?php esc_html_e( 'Não', 'custom-installments-for-woocommerce' ); ?>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php esc_html_e( 'Sim', 'custom-installments-for-woocommerce' ); ?>
								</span>
								<span>
									<?php echo OPENSSL_VERSION_TEXT ?>
								</span>
							<?php endif; ?>
						</span>
					</span>
				</div>
				<?php if ( function_exists( 'ini_get' ) ) : ?>
					<div class="d-flex align-items-center mb-2">
						<span>
							<?php $post_max_size = ini_get( 'post_max_size' ); ?>

							<?php esc_html_e( 'Tamanho máximo da postagem do PHP:', 'custom-installments-for-woocommerce' ); ?>
						</span>
						<span class="ms-2">
							<?php if ( wp_convert_hr_to_bytes( $post_max_size ) < 64000000 ) : ?>
								<span>
									<span class="badge bg-translucent-danger">
										<?php echo esc_html( $post_max_size ); ?>
									</span>
									<span>
										<?php esc_html_e( 'Valor mínimo recomendado é 64M', 'custom-installments-for-woocommerce' ); ?>
									</span>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php echo esc_html( $post_max_size ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
					<div class="d-flex align-items-center mb-2">
						<span>
							<?php $max_execution_time = ini_get( 'max_execution_time' ); ?>
							<?php esc_html_e( 'Limite de tempo do PHP:', 'custom-installments-for-woocommerce' ); ?>
						</span>
						<span class="ms-2">
							<?php if ( $max_execution_time < 180 ) : ?>
								<span>
									<span class="badge bg-translucent-danger">
										<?php echo esc_html( $max_execution_time ); ?>
									</span>
									<span>
										<?php esc_html_e( 'Valor mínimo recomendado é 180', 'custom-installments-for-woocommerce' ); ?>
									</span>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php echo esc_html( $max_execution_time ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
					<div class="d-flex align-items-center mb-2">
						<span>
							<?php $max_input_vars = ini_get( 'max_input_vars' ); ?>
							<?php esc_html_e( 'Variáveis máximas de entrada do PHP:', 'custom-installments-for-woocommerce' ); ?>
						</span>
						<span class="ms-2">
							<?php if ( $max_input_vars < 10000 ) : ?>
								<span>
									<span class="badge bg-translucent-danger">
										<?php echo esc_html( $max_input_vars ); ?>
									</span>
									<span>
										<?php esc_html_e( 'Valor mínimo recomendado é 10000', 'custom-installments-for-woocommerce' ); ?>
									</span>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php echo esc_html( $max_input_vars ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
					<div class="d-flex align-items-center mb-2">
						<span>
							<?php $memory_limit = ini_get( 'memory_limit' ); ?>
							<?php esc_html_e( 'Limite de memória do PHP:', 'custom-installments-for-woocommerce' ); ?>
						</span>
						<span class="ms-2">
							<?php if ( wp_convert_hr_to_bytes( $memory_limit ) < 128000000 ) : ?>
								<span>
									<span class="badge bg-translucent-danger">
										<?php echo esc_html( $memory_limit ); ?>
									</span>
									<span>
										<?php esc_html_e( 'Valor mínimo recomendado é 128M', 'custom-installments-for-woocommerce' ); ?>
									</span>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php echo esc_html( $memory_limit ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
					<div class="d-flex align-items-center mb-2">
						<span>
							<?php $upload_max_filesize = ini_get( 'upload_max_filesize' ); ?>
							<?php esc_html_e( 'Tamanho máximo de envio do PHP:', 'custom-installments-for-woocommerce' ); ?>
						</span>
						<span class="ms-2">
							<?php if ( wp_convert_hr_to_bytes( $upload_max_filesize ) < 64000000 ) : ?>
								<span>
									<span class="badge bg-translucent-danger">
										<?php echo esc_html( $upload_max_filesize ); ?>
									</span>
									<span>
										<?php esc_html_e( 'Valor mínimo recomendado é 64M', 'custom-installments-for-woocommerce' ); ?>
									</span>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php echo esc_html( $upload_max_filesize ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
					<div class="d-flex align-items-center mb-2">
						<span><?php esc_html_e( 'Função PHP "file_get_content":', 'custom-installments-for-woocommerce' ); ?></span>
						<span class="ms-2">
							<?php if ( ! ini_get( 'allow_url_fopen' ) ) : ?>
								<span class="badge bg-translucent-danger">
									<?php esc_html_e( 'Desligado', 'custom-installments-for-woocommerce' ); ?>
								</span>
							<?php else : ?>
								<span class="badge bg-translucent-success">
									<?php esc_html_e( 'Ligado', 'custom-installments-for-woocommerce' ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
				<?php endif; ?>
			</td>
		</tr>

		<tr class="container-separator"></tr>

		<tr>
			<td>
				<button id="wci_reset_settings_trigger" class="btn btn-sm btn-outline-warning d-flex align-items-center">
					<svg class="icon icon-lg icon-warning me-2" xmlns="http://www.w3.org/2000/svg"><path d="M12 16c1.671 0 3-1.331 3-3s-1.329-3-3-3-3 1.331-3 3 1.329 3 3 3z"></path><path d="M20.817 11.186a8.94 8.94 0 0 0-1.355-3.219 9.053 9.053 0 0 0-2.43-2.43 8.95 8.95 0 0 0-3.219-1.355 9.028 9.028 0 0 0-1.838-.18V2L8 5l3.975 3V6.002c.484-.002.968.044 1.435.14a6.961 6.961 0 0 1 2.502 1.053 7.005 7.005 0 0 1 1.892 1.892A6.967 6.967 0 0 1 19 13a7.032 7.032 0 0 1-.55 2.725 7.11 7.11 0 0 1-.644 1.188 7.2 7.2 0 0 1-.858 1.039 7.028 7.028 0 0 1-3.536 1.907 7.13 7.13 0 0 1-2.822 0 6.961 6.961 0 0 1-2.503-1.054 7.002 7.002 0 0 1-1.89-1.89A6.996 6.996 0 0 1 5 13H3a9.02 9.02 0 0 0 1.539 5.034 9.096 9.096 0 0 0 2.428 2.428A8.95 8.95 0 0 0 12 22a9.09 9.09 0 0 0 1.814-.183 9.014 9.014 0 0 0 3.218-1.355 8.886 8.886 0 0 0 1.331-1.099 9.228 9.228 0 0 0 1.1-1.332A8.952 8.952 0 0 0 21 13a9.09 9.09 0 0 0-.183-1.814z"></path></svg>
					<?php esc_html_e( 'Redefinir configurações', 'custom-installments-for-woocommerce' ); ?>
				</button>

				<div id="wci_reset_settings_container" class="popup-container">
					<div class="popup-content">
						<div class="popup-header border-bottom-0 justify-content-end">
							<button id="wci_close_reset" class="btn-close" aria-label="<?php esc_html( 'Fechar', 'custom-installments-for-woocommerce' ); ?>"></button>
						</div>
						<div class="popup-body">
							<div class="d-flex flex-column align-items-center p-4">
								<div class="btn-icon rounded-circle p-2 mb-3 bg-translucent-danger">
									<svg class="icon icon-xg icon-danger" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.953 2C6.465 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.493 2 11.953 2zM12 20c-4.411 0-8-3.589-8-8s3.567-8 7.953-8C16.391 4 20 7.589 20 12s-3.589 8-8 8z"></path><path d="M11 7h2v7h-2zm0 8h2v2h-2z"></path></svg>
								</div>
								
								<h5 class="popup-title text-center my-2"><?php esc_html_e('Atenção! Você realmente deseja redefinir as configurações?', 'custom-installments-for-woocommerce' ); ?></h5>
								<span class="title-hightlight bg-danger mt-2 mb-3"></span>
								<span class="text-muted fs-lg p-3"><?php esc_html_e( 'Ao redefinir as configurações do plugin, todas opções serão removidas, voltando ao estado original.', 'custom-installments-for-woocommerce' ) ?></span>
							</div>
							
							<div class="my-4 p-3">
								<button id="confirm_reset_settings" class="btn btn-lg btn-outline-secondary"><?php esc_html_e( 'Sim, desejo redefinir', 'custom-installments-for-woocommerce' ); ?></button>
							</div>
						</div>
					</div>
				</div>
			</td>

			<td class="d-flex">
				<a class="btn btn-sm btn-outline-danger d-flex align-items-center" target="_blank" href="https://github.com/fredpiuma/custom-installments-for-woocommerce/issues"><?php esc_html_e( 'Reportar problemas', 'custom-installments-for-woocommerce' ); ?></a>
			</td>
		</tr>
	</table>
</div>