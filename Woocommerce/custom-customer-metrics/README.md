# Custom Customer Metrics for WooCommerce

**Plugin Name:** Custom Customer Metrics for WooCommerce  
**Plugin URI:** https://www.piwebsites.com.br  
**Description:** Permite que clientes de produtos visualizem suas métricas de vendas no WooCommerce.  
**Version:** 1.0  
**Author:** Ivan Meskauskas Gneiding  
**Author URI:** https://www.piwebsites.com.br  
**License:** GPL2

## Descrição

O plugin Custom Customer Metrics for WooCommerce permite que clientes de produtos visualizem suas métricas de vendas no WooCommerce. Este plugin adiciona um campo personalizado para associar o cliente ao produto e cria uma página de métricas onde os clientes podem ver as vendas de seus respectivos produtos.

## Funcionalidades

- Adiciona um campo personalizado para o ID do cliente no produto.
- Cria uma página automaticamente com o nome e slug "metricas" para exibir as métricas de vendas.
- Exibe as métricas de vendas dos produtos do cliente logado.

## Instalação

### Manualmente

1. **Baixe o plugin**:
   - Baixe o arquivo ZIP do plugin.

2. **Envie para o WordPress**:
   - No painel administrativo do WordPress, vá para `Plugins > Adicionar Novo` e clique em `Enviar Plugin`.

3. **Instale o plugin**:
   - Selecione o arquivo ZIP do plugin e clique em `Instalar Agora`.

4. **Ative o plugin**:
   - Após a instalação, clique em `Ativar`.

### Via FTP

1. **Extrair o arquivo ZIP**:
   - Extraia o arquivo ZIP do plugin para uma pasta no seu computador.

2. **Envie para o servidor**:
   - Use um cliente FTP para fazer upload da pasta extraída para o diretório `wp-content/plugins` no seu servidor WordPress.

3. **Ative o plugin**:
   - No painel administrativo do WordPress, vá para `Plugins` e ative o plugin `Custom Customer Metrics for WooCommerce`.

## Utilização

1. **Associar Cliente ao Produto**:
   - Ao criar ou editar um produto no WooCommerce, você verá um campo personalizado chamado "Cliente ID". Insira o ID do cliente do produto.
   
2. **Descobrir o ID do Cliente**:
   - No painel administrativo do WordPress, vá para `Usuários > Todos os Usuários`.
   - Encontre o usuário desejado na lista.
   - Passe o cursor sobre o nome de usuário. O link de edição do usuário aparecerá na parte inferior do navegador, mostrando o ID do usuário no final do URL, por exemplo, `user_id=123`.

3. **Visualizar Métricas**:
   - O plugin cria automaticamente uma página chamada "Métricas" com o slug "metricas" ao ser ativado.
   - Clientes podem acessar essa página para visualizar as métricas de vendas de seus produtos.

## Suporte

Para suporte, entre em contato com o autor através do [site do autor](https://www.piwebsites.com.br).

## Licença

Este plugin é distribuído sob a licença GPL2. Para mais informações, veja o arquivo LICENSE.

---

**Nota:** Este plugin requer o WooCommerce para funcionar corretamente.

