<?php

/**
 * Adiciona uma taxa de R$1,99 para produtos da categoria "produto-digital".
 */
function adicionar_taxa_para_produtos_digitais( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    // Defina a taxa para produtos digitais (R$1,99)
    $taxa_por_produto_digital = 1.99;

    foreach ( $cart->get_cart() as $cart_item ) {
        $product_id = $cart_item['product_id'];

        // Verifica se o produto é da categoria "produto-digital"
        if ( has_term( 'produto-digital', 'product_cat', $product_id ) ) {
            // Adiciona a taxa apenas para produtos digitais
            $cart->add_fee( 'Taxa Produto Digital', $taxa_por_produto_digital );
            break; // Não precisa continuar o loop, pois já encontrou um produto digital
        }
    }
}
add_action( 'woocommerce_cart_calculate_fees', 'adicionar_taxa_para_produtos_digitais', 10, 1 );

?>