<?php

/**
 * Plugin Name: 				Custom Installments for WooCommerce
 * Description: 				Extensão que permite exibir o parcelamento, desconto e juros por forma de pagamento para lojas WooCommerce.
 * Plugin URI: 					https://github.com/fredpiuma/custom-installments-for-woocommerce
 * Requires Plugins: 			woocommerce
 * Author: 						Frederico de Castro
 * Author URI: 					https://www.fredericodecastro.com.br/links
 * Version: 					6.0.0
 * Requires at least: 			6.0
 * WC requires at least: 		9.0
 * WC tested up to: 			11.0
 * Requires PHP: 				7.4
 * Tested up to:      			7.1
 * Text Domain: 				custom-installments-for-woocommerce
 * Domain Path: 				/languages
 * License: 					GPL-2.0-or-later
 * License URI: 				https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: 					https://github.com/fredpiuma/custom-installments-for-woocommerce
 *
 * @package						Custom Installments for WooCommerce
 * @author						Frederico de Castro
 * @copyright 					Original work Copyright (C) MeuMouse.com
 * @copyright 					Modifications Copyright (C) 2026 Frederico de Castro
 * @license 					GPL-2.0-or-later
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

use FredericoDeCastro\Custom_Installments\Core\Init;

defined('ABSPATH') || exit;

// Both plugins share options, hooks and constants: never run alongside the original one.
if ( in_array( 'woo-custom-installments/woo-custom-installments.php', (array) get_option( 'active_plugins', array() ), true ) ) {
	add_action( 'admin_notices', function() {
		printf(
			'<div class="notice notice-error"><p>%s</p></div>',
			wp_kses_post( __( '<strong>Custom Installments for WooCommerce</strong> não foi carregado porque o plugin <strong>Parcelas Customizadas para WooCommerce</strong> está ativo. Desative-o para usar esta versão; suas configurações serão mantidas.', 'custom-installments-for-woocommerce' ) )
		);
	} );

	return;
}

// Load Composer autoloader if available.
$autoload = plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

if ( file_exists( $autoload ) ) {
	require_once $autoload;
}

$plugin_version = '6.0.0';

// Initialize the plugin.
new Init( __FILE__, $plugin_version );
