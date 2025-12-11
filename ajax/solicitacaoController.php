<?php

include '../classes/Solicitacao.php';
include '../classes/Envio.php';

$objSolicitacao = new Solicitacao();
$objEnvio = new Envio();






if (isset($_POST['trazerSolicitacaoStatus'])) {
    $solicitacaoStatus = $objSolicitacao->consultaSolicitacaoPorStatus($_POST['idStatus']); ?>



    <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">
        <div class="small-12 large-12 cell">
            <table>
                <thead>
                    <tr>
                        <th width="15%"> Status</th>
                        <th width="65%">Serviço Solicitado</th>
                        <th width="15%"> Data da Solicitação</th>



                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($solicitacaoStatus as $key => $value) {
                    ?>
                        <tr style="font-weight: 300;">
                            <td> <a onclick="exibirSolicitacao( <?= $value['idSolicitacao'] ?>)"> <?= $value['descricaoStatus'] ?> </a> </td>
                            <td><?= $value['descricaoCarta'] ?></td>
                            <td><?= $value['dias'] ?></td>
                        </tr>


                    <?php
                    }
                    ?>
                </tbody>
            </table>


        </div>
    </div>



    <?php
    exit();
}

if (isset($_POST['inserirSolicitacao'])) {




    if (isset($_POST['representaTerceiro'])) {
        $representaTerceiro = $_POST['representaTerceiro'];
    } else {
        $representaTerceiro = '0';
    }

    if (isset($_POST['representantes'])) {

        $representante = $_POST['representantes'];

        $atuantesProcesso = '';

        foreach ($representante as $key => $value) {
            $atuantesProcesso .= $value . '<br>';
        }


        $objSolicitacao->setAtuaProcesso($atuantesProcesso);
    }else
    {
        $objSolicitacao->setAtuaProcesso(' - ');
    }



    $ran = rand();
    $randomico = $ran  . '/' . date('Y');
    $objSolicitacao->setAssuntoSolicitacao($_POST['assuntoSolicitacao']);
    $objSolicitacao->setDescricaoSolicitacao($_POST['descricao']);
    $objSolicitacao->setDocumentoPublico($_POST['documentoPublico']);
    $objSolicitacao->setDocumentoSolicitante($_POST['cpfSolicitante']);

    $objSolicitacao->setDataSolicitacao(date('Y-m-d H:i:s'));
    $objSolicitacao->setStatusSolicitacao($_POST['statusSolicitacao']);
    $objSolicitacao->setsolicitante($_POST['idUsuario']);
    $objSolicitacao->setTipoDocumento($_POST['comboTipoInscricao']);
    $objSolicitacao->setProtocolo($randomico);


    if ($representaTerceiro == 1) {
        $objSolicitacao->setNomeTerceiro($_POST['nomeTerceiro']);
        $objSolicitacao->setDocumentoTerceiro($_POST['cpfTerceiro']);
        $objSolicitacao->setEmailTerceiro($_POST['emailTerceiro']);
        $objSolicitacao->setTelefoneTerceiro($_POST['telefoneTerceiro']);
        $objSolicitacao->setRepresentaTerceiro($representaTerceiro);
    } else {
        $objSolicitacao->setNomeTerceiro('0');
        $objSolicitacao->setDocumentoTerceiro('0');
        $objSolicitacao->setEmailTerceiro('0');
        $objSolicitacao->setTelefoneTerceiro('0');
        $objSolicitacao->setRepresentaTerceiro('0');
    }


    $objSolicitacao->setCepSolicitacao($_POST['txtCEP']);

    $objSolicitacao->setLogradouroSol($_POST['txtRua']);

    $objSolicitacao->setNumeroSol($_POST['txtNUmero']);

    $objSolicitacao->setComplemento($_POST['txtComplemento']);

    $objSolicitacao->setBairro($_POST['txtBairro']);
    //            \\


    if ($objSolicitacao->gravarSolicitacao() == true) {
        $protocolo =  $objSolicitacao->trazerSolicitacao($randomico);





        if ($representaTerceiro == 1) {
            //so envia se representa terceiro for =1
            //envio do email para terceiro




            ob_start();

    ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <style>
                    p {
                        font-size: 1.1em;
                        line-height: 1.3em;
                    }

                    ;


                    li {
                        font-size: 1.3em;
                        line-height: 1.3em;
                    }
                </style>

            </head>

            <body style="font-family: Arial, Helvetica, sans-serif;">


                <?php




                ?>
                <h2>Olá <b><?= $_POST['nomeTerceiro']   ?></b>! Somos da Equipe Mais Digital da Prefeitura de Guarulhos </h2>

                <p></b> Gostariamos de informar que <b><?php echo  $protocolo[0]['nome_pessoa']  ?></b> realizou a
                    solicitação </i><?= $protocolo[0]['descricaoCarta'] ?></i> como seu representante!<br>

                    <br>
                    Para os devidos encaminhamentos, precisamos que vossa senhoria assine esta solicitação através do link abaixo



                </p>





                <a style="color: black; text-decoration: none; font-style: italic;"
                    href="https://agendafacil.guarulhos.sp.gov.br/maisDigital/assinatura.php?idSolicitacao=<?= $protocolo[0]['idSolicitacao'] ?>&112ff6666a78800f14e115ef8e7a57a5=1 " target="_blank">
                    Clique aqui para assinar
                </a>
                <br>

                <h4> Estamos á Disposição!<br>

                    <b>Equipe Mais Digital</b>
                    <h2> Prefeitura de Guarulhos</h2>
                </h4>






            </body>

            </html>
    <?php
            $dados = ob_get_contents();
            ob_end_clean();




            $objEnvio->setDestinatario($_POST['emailTerceiro']);
            $objEnvio->setAssunto('Assinatura da Solicitacao');
            $objEnvio->setConteudo($dados);

            if ($objEnvio->envioEmail()) {
            }
        }
        //fim do envio do email para terceiro




        echo json_encode(array('retorno' => true, 'idSolicitacaoHidden' => $protocolo[0]['id_solicitacao']));
    } else {
        echo 'errado';
    }
}



//exibir solicitacao para atendente mexer
if (isset($_POST['solicitacaoAtendente'])  &&  $_POST['solicitacaoAtendente']) {

    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);

    ?>

    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block;">
        <legend>
            <h4 id=""> </h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-10 cell">
                <label>Assunto da Solicitação
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['descricaoCarta'] ?>" />
                </label>
            </div>
            <div class="small-12 large-2 cell">
                <label>Status
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['descricaoStatus'] ?>" />
                </label>

            </div>




            <div class="small-12 large-12 cell">
                <label>Descrição da Sua Solicitação <i>(Campo Obrigatório)</i>
                    <textarea id='txtDescricao' rows="5" readonly style="width: 100%; background-color: white;">  <?= $assinaturaAtiva[0]['descricaoSolicitacao'] ?> </textarea>
                </label>
            </div>



            <div class="small-12 large-3 cell">
                <label>Nome do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="nomeSolicitante" value="<?= $assinaturaAtiva[0]['nome_pessoa'] ?>" />
                </label>
            </div>
            <div class="small-12 large-3 cell">
                <label>CPF do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="cpfSolicitante" value="<?= $assinaturaAtiva[0]['docSolicitacaoPessoal'] ?>" />
                </label>
            </div>

            <div class="small-12 large-4 cell">
                <label>Email do Solicitante
                    <input type="text" readonly style="width: 100%; background-color: white;" id="emailSolicitante" value="<?= $assinaturaAtiva[0]['email_usuario'] ?>" />
                </label>
            </div>



            <div class="small-12 large-2 cell">
                <label>Dia da Solicitação
                    <input type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['diaDaSolicitacao'] ?>" />
                </label>

            </div>

            <div class="small-12 large-1 cell">
                <label>CEP:
                    <input type="text" readonly style="width: 100%; background-color: white;" id="txtCEP" value="<?= $assinaturaAtiva[0]['cepSolicitacao'] ?>" />
                </label>

            </div>

            <div class="small-12 large-4 cell">
                <label>Logradouro
                    <input type="text" id="txtRua" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['logradouroSol'] ?>" />
                </label>

            </div>
            <div class="small-12 large-1 cell">
                <label>Nº
                    <input type="text" id="txtNUmero" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['numeroSol'] ?>" />
                </label>

            </div>
            <div class="small-12 large-2 cell">
                <label>Complemento
                    <input type="text" id="txtComplemento" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['complemento'] ?>" />
                </label>

            </div>

            <div class="small-12 large-2 cell">
                <label>Bairro
                    <input type="text" id="txtBairro" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['bairro'] ?>" />
                </label>

            </div>

            <div class="small-12 large-2 cell" id="boxInsc">
                <label><?= $assinaturaAtiva[0]['descricaoDoc'] ?>

                    <input id="inscDocu" type="text" readonly style="width: 100%; background-color: white;" value="<?= $assinaturaAtiva[0]['documentoPublico'] ?>" />

            </div>

    </fieldset>
<?php
    echo '<center><img style="" src="' . $assinaturaAtiva[0]['assinaturaSolicitacao']  . '" /><br> <p   style="margin-top: -40px; font-size:1.5em">' . $assinaturaAtiva[0]['nome_pessoa']  . ' </p> </center>';





    die();
}
