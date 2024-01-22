<?php
/**
Snippet utilizado para alterar a visibilidade de um elemento a partir de sua ID, de acordo com os dias da semana
Recomendado alterar apenas as linhas 16 (os valores numéricos) e 20 trocando o id-da-sua-div pelo id configurado no elemento
IMPORTANTE: É necessário adicionar o ID ao elemento alvo bem como colocar o seguinte CSS para esse elemento:
#id-da-sua-div {
    display: none;
}
**/

function exibir_banner_em_dias_especificos() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var dataAtual = new Date();
            var diasPermitidos = [1, 4]; // Substitua pelos dias desejados (onde 0 é Domingo, 1 é Segunda, etc.)

            if (diasPermitidos.includes(dataAtual.getDay())) {
                // Exibir a div do banner
                document.getElementById('id-da-sua-div').style.display = 'block';
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'exibir_banner_em_dias_especificos');

?>
