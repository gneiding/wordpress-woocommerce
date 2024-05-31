<?php

function custom_exclude_shipping_for_postcodes_and_ranges($available_methods) {
    // Lista de CEPs específicos excluídos
    $excluded_postcodes = array('12345', '67890', '11223');

    // Faixas de CEPs excluídos
    $excluded_postcode_ranges = array(
        array('start' => '10000', 'end' => '19999'),
        array('start' => '30000', 'end' => '39999')
    );

    // Obter o CEP do endereço de entrega
    $shipping_postcode = WC()->customer->get_shipping_postcode();

    // Verificar se o CEP está na lista de excluídos
    if (in_array($shipping_postcode, $excluded_postcodes)) {
        // Remove todos os métodos de envio
        $available_methods = array();
    } else {
        // Verificar se o CEP está na faixa de excluídos
        foreach ($excluded_postcode_ranges as $range) {
            if ($shipping_postcode >= $range['start'] && $shipping_postcode <= $range['end']) {
                // Remove todos os métodos de envio
                $available_methods = array();
                break;
            }
        }
    }

    return $available_methods;
}
add_filter('woocommerce_package_rates', 'custom_exclude_shipping_for_postcodes_and_ranges', 10, 1);

function custom_shipping_not_available_message() {
    // Lista de CEPs específicos excluídos
    $excluded_postcodes = array('12345', '67890', '11223');

    // Faixas de CEPs excluídos
    $excluded_postcode_ranges = array(
        array('start' => '10000', 'end' => '19999'),
        array('start' => '30000', 'end' => '39999')
    );

    // Obter o CEP do endereço de entrega
    $shipping_postcode = WC()->customer->get_shipping_postcode();

    // Verificar se o CEP está na lista de excluídos
    if (in_array($shipping_postcode, $excluded_postcodes)) {
        wc_add_notice('Infelizmente, não fazemos entregas para o seu CEP.', 'error');
    } else {
        // Verificar se o CEP está na faixa de excluídos
        foreach ($excluded_postcode_ranges as $range) {
            if ($shipping_postcode >= $range['start'] && $shipping_postcode <= $range['end']) {
                wc_add_notice('Infelizmente, não fazemos entregas para o seu CEP.', 'error');
                break;
            }
        }
    }
}
add_action('woocommerce_check_cart_items', 'custom_shipping_not_available_message');


?>

