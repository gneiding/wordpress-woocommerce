<?php

/*
* Mostra os preços dos produtos com desconto de 5% e um texto indicando que o desconto é válido para pagamentos em boleto ou pix
* O desconto sobre esses meios de pagamento não são adicionados, apenas as informações
*/
function custom_product_price_display( $price, $product ) {
    // Verifica se está na página do produto ou em um loop de produtos
   // Verifica se está na página do produto ou em um loop de produtos
   if ( ! is_admin() && ( is_product() || is_shop() ) ) {
       global $pagenow;
       
       // Verifica se não é a página de edição em massa de produtos
       if ( $pagenow === 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'product' && isset( $_GET['action'] ) && $_GET['action'] === 'edit' ) {
           return $price;
       }
       
       // Verifica se o produto tem variações
       if ( $product->is_type( 'variable' ) ) {
           // Obtém as variações do produto
           $variations = $product->get_available_variations();

           // Inicializa um array para armazenar os preços das variações
           $variation_prices = array();

           // Obtém o menor preço entre as variações
           foreach ( $variations as $variation ) {
               $variation_prices[] = floatval( $variation['display_price'] );
           }

           $sale_price = min( $variation_prices ); // Preço promocional mínimo
           $regular_price = min( $variation_prices ); // Preço regular mínimo

           // Aplica o desconto de 5% sobre o preço promocional
           $discounted_price = $sale_price * 0.95;

           // Exibe o preço principal com desconto e texto adicional
           $price = '<span style="font-size: 0.9em; font-weight: normal;">A partir de </span>' . wc_price( $discounted_price ) . '<br/><span style="font-weight: normal; font-size:0.7em;">(com 5% de desconto no Boleto ou Pix)</span><br/><br/><span style="font-weight: normal; font-size:0.8em;">' . wc_price($regular_price) . ' no cartão</span>';
       } else {
           // Verifica se o produto está em promoção
           if ( $product->is_on_sale() ) {
               // Obtém o preço promocional
               $sale_price = wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) );
           } else {
               // Obtém o preço regular
               $sale_price = wc_get_price_to_display( $product );
           }

           $regular_price = $sale_price; // Preço regular igual ao preço promocional

           // Aplica o desconto de 5% sobre o preço promocional
           $discounted_price = $sale_price * 0.95;

           // Exibe o preço com desconto no boleto ou Pix
           //$price .= ' <span class="discount">(com 5% de desconto no Boleto ou Pix: ' . wc_price( $discounted_price ) . ')</span>';

           // Exibe o preço regular no cartão de crédito
           $price = wc_price( $discounted_price ) . '<br/><span style="font-weight: normal; font-size:0.7em;">(com 5% de desconto no Boleto ou Pix)</span><br/><br/><span style="font-weight: normal; font-size:0.8em;">' . wc_price($regular_price) . ' no cartão</span>';

       }
   }
   return $price;
}
add_filter( 'woocommerce_get_price_html', 'custom_product_price_display', 10, 2 );

?>