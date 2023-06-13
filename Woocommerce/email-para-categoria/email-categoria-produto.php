<?php

// Função para verificar a categoria dos produtos em um pedido
function verificar_categoria_do_produto($order_id) {
    // Obtém o objeto do pedido
    $order = wc_get_order($order_id);

    // Verifica se existem produtos no pedido
    if ($order->get_item_count() > 0) {
        // Loop pelos itens do pedido
        foreach ($order->get_items() as $item_id => $item) {
            // Verifica a categoria do produto
            $product_id = $item->get_product_id();
            $product = wc_get_product($product_id);
            $categories = $product->get_category_ids();

            // Verifica se a categoria específica está presente
            if (in_array('17', $categories)) { //Substitua o número 17 pelo ID da categoria desejada
                // Obtém o endereço de e-mail do cliente
                $customer_email = $order->get_billing_email();

                // Envia o e-mail ao cliente
                $to = $customer_email;
                $subject = 'Informações sobre o uso do produto';
                $message = 'Seguem informações a respeito do uso do produto: A, B, C, D.';
                wp_mail($to, $subject, $message);
                break; // Interrompe o loop, já que encontrou um produto da categoria
            }
        }
    }
}

// Gancho para executar a função após a conclusão do pedido
add_action('woocommerce_order_status_completed', 'verificar_categoria_do_produto');

?>