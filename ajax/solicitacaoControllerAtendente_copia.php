<?php




include_once '../classes/Solicitacao.php';
include_once '../classes/arquivo.php';

$objSolicitacao = new Solicitacao();
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

    echo '<pre>';

    print_r($arquivosNecessarios);
    echo '</pre>';






?>

    <div class="grid-x grid-margin-x">
        <div class="small-1 cell ">status</div>
        <div class="small-3 cell">Documento</div>
        <div class="small-1 cell">Visualizar</div>
        <div class="small-1 cell">Solicitar</div>
        <div class="small-1 cell">Excluir</div>
        <div class="small-1 cell">Documento</div>
        <div class="small-1 cell">Assinado?</div>
    </div>
    <table>



        <thead>
            <th>Status</th>
            <th>Documento</th>
            <th></th>
            <th> Arquivo</th>
            <th>Alterar Arquivo</th>
            <th></th>
            <th> Digital?</th>
        </thead>
        <tbody>
            <?php





            foreach ($arquivosNecessarios as $key => $value) { ?>

                <?php

                $arquivos = $objArquivo->consultaArquivosParaComuniquese($_POST['solicitacao'], $value['id_documento']);


                if (isset($arquivos[0])) {
                    if ($arquivos[0]['status_arquivo'] != '1') {

                        $linhaStatusArquivos = ' style="background-color: #f89d47ff; color: Black"  ';
                    } else {
                        $linhaStatusArquivos = ' style=""  ';
                    }


                    if (!empty($arquivos)) {

                        if ($arquivos[0]['assinado_digital'] == 0) {
                            $assinaturaDigital = 'Não';
                            $statusArquivo = 1;
                        } else {
                            $assinaturaDigital = 'Sim';
                            $statusArquivo = 0;
                        }



                        echo '  <tr   ' . $linhaStatusArquivos . '>
                        <td   ><b>' . $arquivos[0]['descricao_status'] . '</b> </td>
                        <td    ' . $linhaStatusArquivos . ' > <b>' . $arquivos[0]['nome_arquivo'] . '</b></td>
                        <td     ' . $linhaStatusArquivos . '>  <center><a    target="_blank" href="' . $arquivos[0]['arquivo'] . '" >   <h4><i ' . $linhaStatusArquivos . ' class="fi-zoom-in large"></i></h4> </a> </center> </td>
                        <td     ' . $linhaStatusArquivos . '> <center>-</center>  </td>
                        <td     ' . $linhaStatusArquivos . '> <center>Alterar</center>  </td>

                        <td   ' . $linhaStatusArquivos . '><center>    
                            <a  ' . $linhaStatusArquivos .
                            ' onclick="$(\'#modalComunicaArquivo\').foundation(\'open\');  
                              $(\'#nomeDoArquivoEnvio\').html(\'Substituir Arquivo  ' . $arquivos[0]['nome_arquivo'] . '\'); 
                              $(\'#acaoComuniqueSE\').val(\'alterarArquivo\');  $(\'#aquivoPraSolicitar\').val(' .   $arquivos[0]['id_arquivo']  . ');    
                                  " ><h4><i class="fi-x large"></i></h4></a>
                        </center> </td>

                        <td  ' . $linhaStatusArquivos . '><center>    
                            <a  ' . $linhaStatusArquivos . ' onclick="arquivoAssinaturaDigital(' .   $arquivos[0]['id_arquivo']  . ',' . $statusArquivo . ');        " ><h4>' . $assinaturaDigital . '</h4></a>
                        </center> </td>
                    
                    
                    
                </tr>';
                    }
                } else {

                    echo '   <tr>


            <td > 
            Nulo </td>
                                <td  >' .  $value['descricao_doc'] . '</td>
                                <td  >
                                    <center> - </center>
                                </td>
                                <td  >
                               
                                    <center><a onclick="  $(\'#acaoComuniqueSE\').val(\'solicitarArquivo\');  $(\'#nomeDoArquivoEnvio\').html(\'Solicitar Arquivo  ' . $value['descricao_doc'] . '\'); 
                                      $(\'#aquivoPraSolicitar\').val(' .  $value['id_documento'] . ');  $(\'#modalComunicaArquivo\').foundation(\'open\');">  <h4><i class="fi-megaphone large"></i></h4></a> </center> 
                                </td>
                                <td  >
                                    <center> - </center>
                                </td>
                                 <td  >
                                    <center> x </center>
                                </td>
                                 <td  >
                                    <center> x </center>
                                </td>

                            </tr> ';
                }





                ?>



            <?php

            }

            ?>
        </tbody>
    </table>
<?php










    exit();
}


if (isset($_POST['exibirSolicitacaoAtendente'])) {
    $assinaturaAtiva =     $objSolicitacao->pesquisarAssinatura($_POST['idSolicitacao']);
?>

    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
        <legend>
            <h4 id="" style="color: #56658E; "><b>Solicitação</b></h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



            <div class="small-12 large-10 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Assunto da Solicitação</label>
                <p><?= $assinaturaAtiva[0]['nome_servico'] ?></p>

            </div>


            <div class="small-12 large-12 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Descrição da Sua Solicitação</label>
                <p><?= $assinaturaAtiva[0]['descricao_solicitacao'] ?></p>
            </div>


            <div class="small-12 large-12 cell">
                <label style="color: #56658E; font-size: 1.1em; ">Documentos Anexos a Solicitacao</label>

                <table>
                    <tbody>
                        <div id="tabelaArquivos"></div>
                    </tbody>
                </table>


            </div>





        </div>
    </fieldset>



    <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em">
        <legend>
            <h4 id="" style="color: #56658E; "><b>Dados do Solicitante</b></h4>
        </legend>


        <div class=" grid-x  grid-padding-x" style="padding-bottom: 10px;">



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
