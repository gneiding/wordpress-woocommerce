<?php
/*
* Mostra os preços dos produtos com desconto de 5% e um texto indicando que o desconto é válido para pagamentos em boleto ou pix
* O desconto sobre esses meios de pagamento não são adicionados, apenas as informações
*/
// Adicionar filtro para exibir o preço com desconto
add_filter('woocommerce_get_price_html', 'custom_product_price_html', 10, 2);
function custom_product_price_html($price, $product) {
    if (is_product()) { // Verificar se é uma página de produto individual
        if ($product->is_type('variable')) { // Verificar se é um produto com variação
            $variation_prices = $product->get_variation_prices(); // Obter preços das variações

            // Verificar se há preços em promoção nas variações
            if (!empty($variation_prices['sale_price'])) {
                $sale_prices = $variation_prices['sale_price'];
                $min_sale_price = min($sale_prices); // Menor preço em promoção

                // Calcular o valor com desconto para a menor variação em promoção
                $discounted_price = $min_sale_price * 0.95;
                $discount_text = '(com 5% de desconto no Boleto ou Pix)';
            } else {
                $regular_prices = $variation_prices['regular_price'];
                $min_regular_price = min($regular_prices); // Menor preço regular

                // Calcular o valor regular com desconto para a menor variação
                $discounted_price = $min_regular_price * 0.95;
                $discount_text = '(com 5% de desconto no Boleto ou Pix)';
            }

            // Formatar o preço com desconto
            $discounted_price_html = wc_price($discounted_price);

            // Obter o menor preço das variações
            $min_variation_price_html = wc_price(min($variation_prices['price']));

            // Adicionar o texto "a partir de" ao preço principal
            $price_html = '<span style="font-size: 0.8em">A partir de </span>' . $discounted_price_html;//$min_variation_price_html;

            // Exibir o preço com desconto e o texto adicional
            $price_html .= '<br/><span style="font-weight: normal; font-size: 15px;">' . $discount_text . '</span>';

            return $price_html;
        } elseif ($product->is_on_sale()) { // Verificar se o produto simples está em promoção
            // Calcular o valor com desconto para o produto simples em promoção
            $discounted_price = $product->get_sale_price() * 0.95;
            $discount_text = '(com 5% de desconto no Boleto ou Pix)';

            // Formatar o preço com desconto
            $discounted_price_html = wc_price($discounted_price);

            // Exibir o preço com desconto e o texto adicional
            return $discounted_price_html . '<br/><span style="font-weight: normal; font-size: 15px;">' . $discount_text . '</span>';
        } else {
            // Calcular o valor regular com desconto para o produto simples
            $discounted_price = $product->get_regular_price() * 0.95;
            $discount_text = '(com 5% de desconto no Boleto ou Pix)';

            // Formatar o preço com desconto
            $discounted_price_html = wc_price($discounted_price);

            // Exibir o preço com desconto e o texto adicional
            return $discounted_price_html . '<br/><span style="font-weight: normal; font-size: 15px;">' . $discount_text . '</span>';
        }
    }

    // Caso contrário, retornar o preço padrão
    return $price;
}
?>