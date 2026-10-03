<p align="center">
  <a href="https://www.fredericodecastro.com.br/links"><img src="assets/admin/img/logo.webp" alt="Frederico de Castro" width="360"></a>
</p>

# Custom Installments for WooCommerce

Plugin WordPress que exibe parcelamento, descontos e juros por forma de pagamento em lojas WooCommerce: melhor parcela, tabela de parcelas, preço no Pix e no boleto, bandeiras de cartão, desconto por quantidade e muito mais.

Software livre sob a licença **GPL-2.0-or-later**, com todos os recursos liberados e sem chave de licença. A única comunicação externa é a consulta de atualizações às releases deste repositório no GitHub.

> **English:** WordPress plugin that shows installments, discounts and interest per payment method on WooCommerce stores. Free software (GPL-2.0-or-later), every feature unlocked, no license key. The interface is in Brazilian Portuguese, with English and Spanish translations.

## Recursos

- Melhor parcela na página do produto e nas listagens, com ou sem juros
- Tabela de parcelamento, em popup ou sanfona, com juros global ou por parcela
- Descontos e juros por forma de pagamento (Pix, boleto, cartões e gateways do WooCommerce), inclusive no checkout
- Preço com desconto no Pix e no boleto, economia no Pix e emblemas de desconto
- Desconto por quantidade (global ou por produto)
- Bandeiras de cartão de crédito e débito
- Remoção da faixa de preço de produtos variáveis e atualização do preço pela quantidade
- Preço com desconto nos dados estruturados (Schema.org, Rank Math) e post meta para feeds XML
- Personalização de textos, ícones, cores e posições
- Widgets para Elementor e integrações com Astra, Woodmart, Xstore, Shoptimizer, Machic, Ricky, Tiered Pricing Table e Dynamic Pricing & Discounts

### Shortcodes

| Shortcode | Exibe |
| --- | --- |
| `[woo_custom_installments_modal]` | Formas de pagamento e parcelamento (popup/sanfona) |
| `[woo_custom_installments_card_info]` | Melhor parcela |
| `[woo_custom_installments_group]` | Grupo de preço completo |
| `[woo_custom_installments_table_installments]` | Tabela de parcelamento |
| `[woo_custom_installments_pix_container]` | Forma de pagamento Pix |
| `[woo_custom_installments_ticket_container]` | Forma de pagamento boleto |
| `[woo_custom_installments_credit_card_container]` | Bandeiras de cartão de crédito |
| `[woo_custom_installments_debit_card_container]` | Bandeiras de cartão de débito |
| `[woo_custom_installments_ticket_discount_badge]` | Emblema de desconto no boleto |
| `[woo_custom_installments_pix_info]` | Informação de desconto no Pix |
| `[woo_custom_installments_economy_pix_badge]` | Emblema de economia no Pix |
| `[woo_custom_installments_get_price_on_pix]` | Preço no Pix |
| `[woo_custom_installments_get_price_on_ticket]` | Preço no boleto |
| `[woo_custom_installments_get_economy_pix_price]` | Valor economizado no Pix |
| `[woo_custom_installments_sale_badge]` | Emblema de promoção |

## Requisitos

- WordPress 6.0+
- WooCommerce 9.0+
- PHP 7.4+

## Instalação

1. Baixe `custom-installments-for-woocommerce.zip` na [última release](https://github.com/fredpiuma/custom-installments-for-woocommerce/releases/latest).
2. No painel do WordPress, acesse **Plugins → Adicionar novo → Enviar plugin** e envie o arquivo.
3. Ative o plugin e configure em **WooCommerce → Custom Installments**.

As atualizações seguintes aparecem no painel do WordPress como as de qualquer outro plugin. Na aba **Sobre** é possível ativar as atualizações automáticas, e na lista de plugins há o link **Verificar atualizações**.

### Migrando do Parcelas Customizadas para WooCommerce

Options, metadados de produtos, hooks e shortcodes mantêm os mesmos nomes, por isso as configurações existentes são aproveitadas:

1. Desative o plugin *Parcelas Customizadas para WooCommerce*.
2. Instale e ative o *Custom Installments for WooCommerce*.

Os dois plugins não rodam ao mesmo tempo. Enquanto o original estiver ativo, este exibe um aviso e não é carregado.

## Fator de multiplicação (PagSeguro)

O PagSeguro informa os juros como um fator de multiplicação sobre o valor total. Para converter esse fator em percentual de juros, use `juros (%) = (fator − 1) × 100`. Exemplo: o fator `1,0459` equivale a `4,59%`. Informe os percentuais em **Geral → Definir taxa de juros por parcela**.

## Desenvolvimento

O autoloader do Composer fica versionado em `vendor/`, então o plugin roda direto do repositório. Depois de criar ou mover classes, gere-o novamente:

```bash
composer dump-autoload -o
```

O carregamento automático das classes depende do classmap otimizado (`vendor/composer/autoload_classmap.php`).

### Publicando uma versão

1. Atualize a versão no cabeçalho e em `$plugin_version` de `custom-installments-for-woocommerce.php`, em `readme.txt` e no `CHANGELOG.md`.
2. Crie e envie a tag: `git tag v6.0.1 && git push origin v6.0.1`.
3. O workflow **Release** gera `custom-installments-for-woocommerce.zip` e publica a release. A partir daí, as lojas recebem a atualização.

## Licença e créditos

- Copyright (C) MeuMouse.com, autora da obra original, *Parcelas Customizadas para WooCommerce*.
- Copyright (C) 2026 [Frederico de Castro](https://www.fredericodecastro.com.br/links), pelas modificações e pela manutenção deste fork.

Este programa é software livre: você pode redistribuí-lo e/ou modificá-lo sob os termos da GNU General Public License, conforme publicada pela Free Software Foundation, na versão 2 da Licença ou (a seu critério) em qualquer versão posterior. Veja [LICENSE](LICENSE).

Este é um fork independente, sem afiliação com MeuMouse.com nem endosso dela. "WooCommerce" é marca registrada da Automattic Inc. As bandeiras de pagamento são marcas de seus respectivos titulares.
