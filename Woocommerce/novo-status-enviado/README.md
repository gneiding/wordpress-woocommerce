# Novo Status de Pedido 'Enviado' para WooCommerce

Este plugin adiciona um novo status de pedido chamado 'Enviado' ao WooCommerce, incluindo a funcionalidade de envio de email para o cliente quando o status do pedido é alterado para 'Enviado'.

## Instalação

1. Baixe o arquivo ZIP do plugin [aqui](https://github.com/gneiding/wordpress-woocommerce/blob/main/Woocommerce/novo-status-enviado/novo-status-enviado.zip).
2. No painel administrativo do WordPress, vá para **Plugins > Adicionar Novo**.
3. Clique em **Enviar Plugin** no topo da página.
4. Selecione o arquivo ZIP baixado e clique em **Instalar Agora**.
5. Após a instalação, ative o plugin.

## Funcionalidades

- Adiciona um novo status de pedido 'Enviado' ao WooCommerce.
- Envia um email ao cliente quando o status do pedido é alterado para 'Enviado'.
- Adiciona a opção de alterar o status para 'Enviado' nas ações em massa na lista de pedidos.
- Estiliza os pedidos com status 'Enviado' na lista de pedidos no admin.

## Uso

Após a ativação do plugin:

1. Ao visualizar a lista de pedidos no WooCommerce, você verá a nova opção de status 'Enviado'.
2. Você pode alterar o status de um pedido individualmente ou usando as ações em massa.
3. Quando um pedido é alterado para o status 'Enviado', o cliente receberá um email notificando que o pedido foi enviado.

## Personalização

O plugin aplica uma cor de fundo verde claro para os pedidos com status 'Enviado' na lista de pedidos do admin. Você pode personalizar esta cor editando o código CSS dentro da função `pi_styling_admin_order_list`.

## Código

O plugin contém as seguintes funções principais:

- **pi_register_enviado_status**: Registra o novo status 'Enviado'.
- **pi_add_enviado_to_list**: Adiciona 'Enviado' à lista de status de pedidos.
- **pi_register_enviado_bulk_action**: Adiciona a ação em massa para alterar status para 'Enviado'.
- **pi_bulk_process_custom_status**: Processa a ação em massa de alterar status para 'Enviado'.
- **pi_styling_admin_order_list**: Estiliza os pedidos com status 'Enviado' na lista de pedidos do admin.
- **pi_send_mail_on_enviado**: Envia um email ao cliente quando o status do pedido é alterado para 'Enviado'.

## Contribuição

Sinta-se à vontade para contribuir com melhorias ou correções. Basta abrir um pull request no [repositório do GitHub](https://github.com/gneiding/wordpress-woocommerce).

## Licença

Este plugin é distribuído sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

## Suporte

Para suporte, por favor abra uma issue no [repositório do GitHub](https://github.com/gneiding/wordpress-woocommerce/issues).

