<?php

function custom_restrict_access() {
    // Verifique se o usuário não está logado
    if (!is_user_logged_in()) {
        // Adicione aqui os IDs das páginas que deseja restringir substituindo os número 1, 2 e 3 pelos IDs desejados
        $restricted_pages = array(1, 2, 3);

        // Verifique se a página atual é uma das páginas restritas
        if (in_array(get_the_ID(), $restricted_pages)) {
            // Obtenha a URL da página de login
            $login_url = wp_login_url();

            // Obtenha a URL da página atual
            $current_url = get_permalink();

            // Redirecione o usuário para a página de login com a URL de destino
            wp_safe_redirect(add_query_arg('redirect_to', urlencode($current_url), $login_url));
            exit;
        }
    }
}
add_action('template_redirect', 'custom_restrict_access');

?>
