<?php
/**
* Plugin Name: Novo status 'enviado' no WooCommerce
* Plugin URI: https://www.piwebsites.com.br/contato
* Description: Adiciona o status 'enviado' no WooCommerce com envio de e-mail para o cliente
* Version: 0.97
* Author: Ivan Meskauskas Gneiding
* Author URI: https://github.com/gneiding/wordpress-woocommerce
**/


/**
 * Adiciona status 'enviado' de pedido no WooCommerce com envio de email ao cliente
 **/

 function pi_register_enviado_status() {

	register_post_status(
		'wc-enviado',
		array(
			'label'		=> 'Enviado',
			'public'	=> true,
			'show_in_admin_status_list' => true,
			'label_count'	=> _n_noop( 'Enviado (%s)', 'Enviado (%s)' )
		)
	);

}
add_action( 'init', 'pi_register_enviado_status' );




function pi_add_enviado_to_list( $order_statuses ) {

	$new = array();

	foreach ( $order_statuses as $id => $label ) {
		
		if ( 'wc-completed' === $id ) { 
			$new[ 'wc-enviado' ] = 'Enviado';
		}
		
		$new[ $id ] = $label;

	}

	return $new;

}
add_filter( 'wc_order_statuses', 'pi_add_enviado_to_list' );	



function pi_register_enviado_bulk_action( $bulk_actions ) {

	$bulk_actions[ 'mark_enviado' ] = 'Mudar status para Enviado';
	return $bulk_actions;

}
add_filter( 'bulk_actions-edit-shop_order', 'pi_register_enviado_bulk_action' );



function pi_bulk_process_custom_status( $redirect, $doaction, $object_ids ) {

	if( 'mark_enviado' === $doaction ) {

		foreach ( $object_ids as $order_id ) {
			$order = wc_get_order( $order_id );
			$order->update_status( 'wc-enviado' );
		}

		$redirect = add_query_arg(
			array(
				'bulk_action' => 'marked_enviado',
				'changed' => count( $object_ids ),
			),
			$redirect
		);

	}

	return $redirect;

}
add_action( 'handle_bulk_actions-edit-shop_order', 'pi_bulk_process_custom_status', 20, 3 );


//Configura as cores do novo status
function pi_styling_admin_order_list() {
    global $pagenow, $post;

    if( $pagenow != 'edit.php') return;
    if( get_post_type($post->ID) != 'shop_order' ) return;

    
    $order_status = 'enviado';
    ?>
    <style>
        .order-status.status-<?php echo sanitize_title( $order_status ); ?> {
            background-color:  #d7f8a7 !important;
            color: #0c942b !important;
        }
    </style>
    <?php
}
add_action('admin_head', 'pi_styling_admin_order_list' );


/*
* Faz envio de e-mail ao alterar status
*/
function pi_send_mail_on_enviado($order_id, $checkout=null) {
   global $woocommerce;
   $order = new WC_Order( $order_id );
    if($order->status === 'enviado' ) {       
        // Cria o envio
      $mailer = $woocommerce->mailer();

      $message_body = __( '<p>Olá ' . ucfirst($order->get_billing_first_name()) . ', o pedido <strong>#'. $order->get_order_number() .'</strong> acaba de ser enviado e já está a caminho.</p>
       <p><strong>Forma de entrega:</strong> ' . $order->get_shipping_method() . '</p>
       <p><strong>Detalhes do pedido:</strong> <a href="' . $order->get_view_order_url() .'" target="_blank">clique aqui</a></p> 
       <p><strong>Detalhes de envio:</strong><br/>' . $order->get_formatted_shipping_address() . '</p>
       <p><strong>Obrigado por comprar conosco!</strong></p>' );

      $message = $mailer->wrap_message(
        // Campos da mensagem
        sprintf( __( 'Pedido enviado.' )), $message_body );


      // E-mail do cliente, assunto e mensagem
     $mailer->send( $order->billing_email, sprintf( __( 'Seu pedido (#%s) foi enviado.' ), $order->get_order_number() ), $message );

    }
}
add_action("woocommerce_order_status_changed", "pi_send_mail_on_enviado");