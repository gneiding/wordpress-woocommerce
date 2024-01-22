<?php
/**
Snippet utilizado para alterar a visibilidade de um elemento a partir de sua ID, de acordo com uma data inicial e outra final
Recomendado alterar apenas as linhas 16 e 17 colocando as datas inicial e final respectivamente, e a linha 21 trocando o id-da-sua-div pelo id configurado no elemento
IMPORTANTE: É necessário adicionar o ID ao elemento alvo bem como colocar o seguinte CSS para esse elemento:
#id-da-sua-div {
    display: none;
}
**/

function exibir_banner_no_intervalo_de_datas() {
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var dataAtual = new Date();
            var dataInicio = new Date('2024-01-22'); // Substitua com a data de início desejada (ano-mês-dia)
            var dataFim = new Date('2024-01-30'); // Substitua com a data de término desejada (ano-mês-dia)

            if (dataAtual >= dataInicio && dataAtual <= dataFim) {
                // Exibir a div do banner
                document.getElementById('id-da-sua-div').style.display = 'block';
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'exibir_banner_no_intervalo_de_datas');

?>
