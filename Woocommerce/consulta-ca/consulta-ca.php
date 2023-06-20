<?php

// Adicionar campo extra na aba "Avançado" da página de edição do produto
function adicionar_campo_extra_produto() {
    echo '<div class="options_group">';
    
    woocommerce_wp_text_input( array(
        'id'          => '_campo_extra',
        'label'       => __( 'Código Consulta CA', 'text-domain' ),
        'placeholder' => '',
        'desc_tip'    => true,
        'description' => __( 'Insira o código para consulta CA.', 'text-domain' )
    ) );
    
    echo '</div>';
}
add_action( 'woocommerce_product_options_advanced', 'adicionar_campo_extra_produto' );

// Salvar valor do campo extra
function salvar_campo_extra_produto( $product_id ) {
    $campo_extra = isset( $_POST['_campo_extra'] ) ? sanitize_text_field( $_POST['_campo_extra'] ) : '';
    update_post_meta( $product_id, '_campo_extra', $campo_extra );
}
add_action( 'woocommerce_process_product_meta', 'salvar_campo_extra_produto' );

// Exibir o botão "Consultar CA" na página de produto
function exibir_botao_consultar_ca() {
    global $product;
    $campo_extra = get_post_meta( $product->get_id(), '_campo_extra', true );
    
    if ( ! empty( $campo_extra ) ) {
        echo '<a href="https://consultaca.com/' . $campo_extra . '" class="button" target="_blank">' . __( 'Consultar CA', 'text-domain' ) . '</a>';
    }
}
add_action( 'woocommerce_after_add_to_cart_button', 'exibir_botao_consultar_ca' );

?>