<?php

include_once '../classes/Solicitacao.php';
$objSolicitacao = new Solicitacao();

if (isset($_POST['ajudaAtendente'])) {



    $manualAtendente = $objSolicitacao->pesquisaManualAtendente($_POST['solicitacao']);
?>

    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">
            <h3><?= ltrim($manualAtendente[0]['nome_servico']); ?></h3>
        </div>
    </div>

 



    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">

           <fieldset class="fieldset">
                <legend><b>Informações restritas para o atendente</b></legend>
                <ul>
                    <?php
                        echo $manualAtendente[0]['info_atendente'];
                    ?>
                </ul>
            </fieldset>


            <fieldset class="fieldset">
                <legend><b>Os documentos listados abaixo são necessários para dar prosseguimento</b></legend>
                <ul>
                    <?php
                    foreach ($manualAtendente as $key => $value) {
                        echo '<li>' . $value['descricao_doc'] . '</li>';
                    }
                    ?>
                </ul>
            </fieldset>

             <fieldset class="fieldset">
                <legend><b>Texto da Carta de Serviço</b></legend>
                <ul>
                    <?php
                        echo $manualAtendente[0]['texto_carta_servico'];
                    ?>
                </ul>
            </fieldset>




         

        </div>
    </div>



 

<?php










}
