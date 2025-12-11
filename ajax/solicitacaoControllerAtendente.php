<?php




include_once '../classes/Solicitacao.php';
include_once '../classes/Log.php';
include_once '../classes/arquivo.php';

$objSolicitacao = new Solicitacao();
$objLog = new Log();
$objArquivo = new Arquivo();





if (isset($_POST['managerSolicitacoesPorAtendente'])) {




    $solicitacoesAbertas = $objSolicitacao->consultarSolicitacaoPorAtendente($_POST['idAtendente']);




    foreach ($solicitacoesAbertas as $key => $value) {
        $idSolicitacao =  $value['id_solicitacao'];

        $statusoArquivo = $objArquivo->consultarDadosArquivosParaInfo($value['id_solicitacao']);
        foreach ($statusoArquivo as $key => $valorSolicitacao) {
            if ($valorSolicitacao['status_arquivo'] == '12' || $valorSolicitacao['status_arquivo'] == '13') {


                $statusArquivo  = '<td style="background-color: #635d4d ;color:white" colspan="3"><b>id:</b> ' . $value['id_solicitacao']  . ' - Arquivo Solicitado ao cidadão</td>';

                break;
            } else {
                //$statusArquivo = 'Solicitação em Andamento / Análise';
                $statusArquivo  = '<td style="background-color: #fff2cdff" colspan="3"><b>id:</b> ' . $value['id_solicitacao']  . ' - Solicitação em Andamento / Análise</td>';
            }
        }





        echo '<div class="small-12 large-3 cell">
                        
                    <table>
                        <tr>
                            ' . $statusArquivo . '
                        </tr>
                         <tr>
                            <td colspan="3"><a style="color: green; font-weight: 400"  
                            onclick="atribuirAtendente(' .  $value['id_solicitacao'] . ', 1 )">Clique para continuar os procedimentos</a></td>
                        </tr>
                        
                            
                    </table>
                    </div>';
    }





    exit();
}





if (isset($_POST['listarArquivosAtendente'])) {




    $arquivosNecessarios = $objArquivo->consultarListaAquivosNecessarios($_POST['solicitacao']);






?>

    <div class="grid-x grid-margin-x" style="font-weight: 600;">
        <div class="small-2 cell "> Status do Arquivo </div>
        <div class="small-4 cell"> Documento</div>
        <div class="small-1 cell">Visualizar <br>Arquivo</div>
        <div class="small-1 cell">Solicitar<br>Arquivo </div>
        <div class="small-1 cell">Alterar<br>Arquivo</div>
        <div class="small-1 cell">Excluir<br>Arquivo</div>
        <div class="small-1 cell">Assinado Digital</div>
    </div>

    <?php





    $verificarComuniqueSe = false;

    foreach ($arquivosNecessarios as $key => $value) { ?>
        <?php
        $arquivos = $objArquivo->consultaArquivosParaComuniquese($_POST['solicitacao'], $value['id_documento']);

        $statusSolicitacaoNegada = array(0, 2, 12, 13);



        //verifica se o arquivo foi postado
        if (isset($arquivos[0])) {
            //se este arquivo nao esta ativo, ou seja, se ele foi `reclamado` pelo atendente, muda a cor '
            if (in_array($arquivos[0]['status_arquivo'], $statusSolicitacaoNegada)) {

                $linhaStatusArquivos = ' style=" color: red; font-weight: 300"  ';
                $verificarComuniqueSe = true;
            } else {
                //se nao, essta tudo certo
                $linhaStatusArquivos = ' style=""  ';
            }


            //se existe arquivo na linha que esta sendo rodada
            if (!empty($arquivos)) {

                //se o arquivo nao esta com assinatura digital, boa, deixa o statuso nao, esse status permite imprimir no relatorio unificado
                if ($arquivos[0]['assinado_digital'] == 0) {
                    $assinaturaDigital = 'Não';
                    $statusArquivo = 1;
                } else {
                    //se o arquivo esta com assinatura digital, ai deu ruim, com esse status nao pode imprimir
                    $assinaturaDigital = 'Sim';
                    $statusArquivo = 0;
                }


                //exibição dos arquivos
        ?>


                <div class="grid-x grid-margin-x" <?= $linhaStatusArquivos ?>>

                    <!-- status do arquivo -->
                    <div class="small-2 cell "><?= $arquivos[0]['descricao_status'] ?> </div>


                    <!-- descricao do arquivo -->
                    <div class="small-4 cell"><?= $value['descricao_doc']   ?> </div>


                    <!-- visualizacao do arquivo -->
                    <div class="small-1 cell">

                        <a target="_blank" href="<?= $arquivos[0]['arquivo'] ?>">
                            <h4><i class="fi-zoom-in large" <?= $linhaStatusArquivos ?>></i></h4>
                        </a>

                    </div>

                    <!-- solicitacao   envio do arquivo -->
                    <div class="small-1 cell">





                    </div>

                    <div class="small-1 cell">


                        <a onclick="   $('#modalComunicaArquivo').foundation('open');  
                                                $('#nomeDoArquivoEnvio').html('Substituir Arquivo  <?= $arquivos[0]['nome_arquivo'] ?>'); 
                                                $('#acaoComuniqueSE').val('alterarArquivo'); 
                                                $('#mandaStatus').val('13');   
                                                $('#aquivoPraSolicitar').val('<?= $arquivos[0]['id_arquivo'] ?>');">
                            <h4>
                                <i class="fi-x large" <?= $linhaStatusArquivos ?>></i>
                            </h4>
                        </a>





                    </div>


                    <!-- solicitacao   exclusao do arquivo -->
                    <div class="small-1 cell">

                        <a onclick="   $('#modalComunicaArquivo').foundation('open');  
                                                $('#nomeDoArquivoEnvio').html('Cancelar o Arquivo  <?= $arquivos[0]['nome_arquivo'] ?>'); 
                                                $('#acaoComuniqueSE').val('alterarArquivo');  
                                                $('#mandaStatus').val('4');  
                                                $('#aquivoPraSolicitar').val('<?= $arquivos[0]['id_arquivo'] ?>');">
                            <h4>
                                <i class="fi-minus-circle large" <?= $linhaStatusArquivos ?>></i>
                            </h4>
                        </a>

                    </div>

                    <div class="small-1 cell">
                        <a onclick="arquivoAssinaturaDigital(<?= $arquivos[0]['id_arquivo']  . ',' . $statusArquivo ?>);        ">
                            <?= $assinaturaDigital ?>
                        </a>
                    </div>
                </div>
            <?php
            } else { ?>










            <?php
            }
        } else { ?>

            <div class="grid-x grid-margin-x">

                <!-- status do arquivo -->
                <div class="small-2 cell "> Arquivo Não Enviado</div>


                <!-- descricao do arquivo -->
                <div class="small-4 cell"><?= $value['descricao_doc']   ?> </div>


                <!-- visualizacao do arquivo -->
                <div class="small-1 cell">

                    -

                </div>

                <!-- solicitacao   envio do arquivo -->
                <div class="small-1 cell">

                    <a onclick="    $('#acaoComuniqueSE').val('solicitarArquivo');  
                                        $('#nomeDoArquivoEnvio').html('Solicitar Arquivo  <?= $value['descricao_doc'] ?>'); 
                                        $('#aquivoPraSolicitar').val('<?= $value['id_documento'] ?>');  
                                        $('#modalComunicaArquivo').foundation('open');">
                        <h4>
                            <i class="fi-megaphone large"></i>
                        </h4>
                    </a>



                </div>

                <div class="small-1 cell">

                    -

                </div>


                <!-- solicitacao   exclusao do arquivo -->
                <div class="small-1 cell">

                    -

                </div>

                <div class="small-1 cell">
                    -
                </div>
            </div>





        <?php

        }
    }


    echo '<h1>' . $verificarComuniqueSe . '</h1>';

    if ($verificarComuniqueSe == true) {
        ?>

        <a class="button" style="width: 100%; background-color: green;  border-radius: 30px;" onclick="finalizarComuniqueSe(<?= $_POST['solicitacao'] ?>)">
            <h5>Clique aqui para enviar "comunique-se" ao cidadão </h5>
        </a>
    <?php

    }


    ?>



<?php


    exit();
}


if (isset($_POST['exibirSolicitacaoAtendente'])) {
    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);
?>



    <div class="grid-x grid-padding-x">




        <div class="small-12 large-12 cell">
            <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
                <legend>
                    <h4 id="" style="color: #56658E; "><b>Solicitacao</b></h4>
                </legend>


                <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">

                    <div class="small-12 large-5 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Assunto da Solicitação</label>
                        <p><?= $assinaturaAtiva[0]['nome_servico'] ?></p>

                    </div>


                    <div class="small-12 large-7 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Descrição da Sua Solicitação</label>
                        <p><?= $assinaturaAtiva[0]['descricao_solicitacao'] ?></p>
                    </div>



                    <div class="small-12 large-4 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Nome do Solicitante</label>
                        <input type="hidden" value="<?= $assinaturaAtiva[0]['nome_pessoa'] ?>" id="txtnome_pessoaParaEnvioArquivo" />
                        <p><?= $assinaturaAtiva[0]['nome_pessoa'] ?> </p>
                    </div>
                    <div class="small-12 large-4 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">CPF do Solicitante</label>
                        <p><?= $assinaturaAtiva[0]['doc_solicitacao_pessoal'] ?></p>
                    </div>

                    <div class="small-12 large-4 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Email do Solicitante</label>
                        <input type="hidden" value="<?= $assinaturaAtiva[0]['email_usuario'] ?>" id="txtEmailParaEnvioArquivo" />
                        <p><?= $assinaturaAtiva[0]['email_usuario'] ?></p>
                    </div>



                    <div class="small-12 large-3 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Dia da Solicitação</label>
                        <p><?= $assinaturaAtiva[0]['dia_da_solicitacao'] ?></p>

                    </div>

                    <div class="small-12 large-2 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">CEP: </label>
                        <p><?= $assinaturaAtiva[0]['cep_solicitacao'] ?></p>

                    </div>

                    <div class="small-12 large-5 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Logradouro</label>
                        <p><?= $assinaturaAtiva[0]['logradouro_sol'] . ',' . $assinaturaAtiva[0]['numero_sol'] ?></p>

                    </div>

                    <div class="small-12 large-2 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Complemento</label>
                        <p><?= $assinaturaAtiva[0]['complemento'] ?></p>


                    </div>

                    <div class="small-12 large-4 cell">
                        <label style="color: #56658E; font-size: 1.1em; ">Bairro</label>
                        <p><?= $assinaturaAtiva[0]['bairro'] ?></p>

                    </div>

                    <div class="small-12 large-3 cell" id="boxInsc">
                        <label style="color: #56658E; font-size: 1.1em; "><?= $assinaturaAtiva[0]['descricao_doc'] ?></label>

                        <p><?= $assinaturaAtiva[0]['documento_publico'] ?></p>

                    </div>

                    <div class="small-12 large-5 cell">
                        <?php
                        echo '<center><img style="" src="' . $assinaturaAtiva[0]['assinatura_solicitacao']  . '" /><br> <p   style="margin-top: -30px; font-size:1em"> Assinatura </p> </center>';
                        ?>
                    </div>
            </fieldset>
        </div>


        <div class="small-12 large-12 cell">
            <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
                <legend>
                    <h4 id="" style="color: #56658E; "><b>Atos da Solicitação</b></h4>
                </legend>


                <?php


                $logs = $objLog->informarLogAtendente($_POST['idSolicitacao']);




                if (isset($logs['dados'])) {

                    //daqui
                    foreach ($logs['dados'] as $key => $value) { ?>
                        <div class="grid-x grid-padding-x">

                            <div class="small-12 large-3 cell">
                                <?php



                                switch ($value['status_log']) {
                                    case '6':

                                        $styleLinha = ' style="color:green;"';
                                        echo '<h5><i style="color:green; "  class="fi-check large">  - ' . $value['descricao_status'] . '</i></h5>';
                                        break;

                                    case '13':
                                        $styleLinha = ' style="color:red;"';
                                        echo '<h5><i style="color:red"  class="fi-page-doc large"> - ' . $value['descricao_status'] . '</i></h5>';
                                        break;

                                        
                                    case '4':
                                        $styleLinha = ' style="color:gray;"';
                                        echo '<h5><i style="color:gray"  class="fi-x-circle large"> - ' . $value['descricao_status'] . '</i></h5>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }



                                ?>
                            </div>



                            <div class="small-12 large-4 cell" <?= $styleLinha ?>>
                                <?= $value['nome_log']  ?>
                            </div>


                            <div class="small-12 large-1 cell" <?= $styleLinha ?>>
                                <?= $value['data_log']  ?>
                            </div>

                            <div class="small-12 large-2 cell" <?= $styleLinha ?>>
                                <?= $value['nome_pessoa_log']  ?>
                            </div>


                            <div class="small-12 large-2 cell" <?= $styleLinha ?>>
                                <?= $value['descricao_tipo_pessoa']  ?>
                            </div>


                        </div>

                    <?php


                        echo '<br>';
                    }
                } else {
                    ?>


                    <div class="grid-x grid-padding-x">

                        <div class="small-12 large-12 cell">
                            <center>
                                <h4>Não há interações nesta solicitação</h4>
                            </center>
                        </div>
                    </div>



                <?php


                }



                //aqui



                ?>

            </fieldset>
        </div>

        <div class="small-12 large-12 cell">
            <fieldset class="fieldset" id="fieldsetDocumentacao" style="display: block; font-size:1em">
                <legend>
                    <h4 id="" style="color: #56658E; "><b>Documentos Anexos a Solicitacao</b></h4>
                </legend>


                <div class="small-12 large-12 cell">
                    <label style="color: #56658E; font-size: 1.1em; "></label>


                    <div id="tabelaArquivos"></div>


                </div>
            </fieldset>


        </div>
    </div>


    <?php
    die();
}


if (isset($_POST['atribuirSolicitacaoAtendente'])) {


    $objSolicitacao->setIdAtendente($_POST['idAtendente']);
    $objSolicitacao->setSolicitacao($_POST['idSolicitacao']);
    $objSolicitacao->setStatusSolicitacao('11');

    if ($objSolicitacao->atribuirSolicitacaoAtendente() == true) {
        echo json_encode(array('retorno' => true));
    }

    exit();
}


if (isset($_POST['categoriaSolicitacaoIndexAtendente'])) {


    $solicitaCategorias = $objSolicitacao->pesquisarSolicitacoesPorCategoria($_POST['categoria']);



    echo '<table class="  hover   table-scroll "  style=" font-size: 0.8em" >    
            <thead>
                <tr>
                <th width="6%">ID Solicitação</th>
            
                <th width="6%">Dia de Solicitação</th>
                
                <th width="8%">Status</th>
                <th width="15%"><center>Atribuir </center></th>
                
                </tr>
            </thead>
            <tbody>
    ';
    foreach ($solicitaCategorias as $key => $value) { ?>
        <tr style="font-size: 1.5em;">
            <td><?= $value['id_solicitacao'] ?></td>

            <td><?= $value['diaDaSolicitacao']  ?></td>
            <td><?= $value['descricao_status']  ?></td>
            <td>
                <center> <a style=" color: #56658E;" onclick="atribuirAtendente(<?= $value['id_solicitacao'] ?>, '<?= $value['descricao_solicitacao']  ?>')">Clique aqui para Iniciar Atendimento</a></center>
            </td>
        </tr>
    <?php  }

    echo '
            </tbody>
        </table>';

    ?>

<?php
    exit();
}
