<?php

function custom_exclude_shipping_for_postcodes($available_methods) {
    // Lista de CEPs excluídos
    $excluded_postcodes = array('12345', '67890', '11223'); // Adicione os CEPs que deseja excluir

    // Obter o CEP do endereço de entrega
    $shipping_postcode = WC()->customer->get_shipping_postcode();

    // Verificar se o CEP está na lista de excluídos
    if (in_array($shipping_postcode, $excluded_postcodes)) {
        // Remove todos os métodos de envio
        $available_methods = array();
    }

    return $available_methods;
}
add_filter('woocommerce_package_rates', 'custom_exclude_shipping_for_postcodes', 10, 1);

?>

