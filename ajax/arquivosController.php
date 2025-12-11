<?php


include_once '../classes/arquivo.php';
include_once '../classes/Documentos.php';
include_once '../classes/log.php';

$objArquivo = new Arquivo();
$objDOcumento = new Documentos();
$objLog = new Log();


if (isset($_POST['criaCampoArquivo'])) {

    $criarCaixaArquivo =  $objDOcumento->trazerDocumentoArquivo($_POST['idServico']);

    $quantidadeArquivos =  count($criarCaixaArquivo);

    //verificar quantos arquivos tem anexos a este serviço;
    echo   "   <input type='hidden' id='idQuantidadeArquivoDoServico'  value='$quantidadeArquivos'/>";



    $i = 0;
    foreach ($criarCaixaArquivo as $key => $value) {
?>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   ">
            <div class=" small-12 large-12 cell">
                <p class="button   mensagemB " style="width: 100%; background-color: rgb(23, 121, 186);  " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>
            </div>

        </div>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   " id="caixa<?= $i ?>">




            <div class=" small-12 large-12 cell" style="display: grid; align-items: center;">
                <label>
                    <h5><b><i>"<?= $value['descricao_doc'] ?>"</i></b></h5>
                </label>
                <input type="file" id="fileInput<?= $i ?>" name="file<?= $i ?>" class="button" style="background-color:#4c5e6a; height: 3em; "

                    onchange="subirArquivo('file<?= $i ?>','fileInput<?= $i ?>', 'mensagem<?= $i ?>',   ' <?= $value['descricao_doc'] ?> ', 'uploadButton<?= $i ?>', 'caixa<?= $i ?>', $('#idQuantidadeArquivoDoServico').val(),  $('#idTipoDocumento<?= $i ?>').val() )  ">


                <p class="button success mensagemB " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>

            </div>
            <div class="small-12 large-9 cell">
                <label>
                    <!-- campo que pega o tipo do documento para ser gravado no arquivo -->
                    <input type='hidden' id='idTipoDocumento<?= $i ?>' value='<?= $value['id_documento']  ?>' />

                </label>
            </div>



        </div>




    <?php
        $i++;
    }

    ?>

    <script>
        $('.mensagemB').hide();
    </script>

    <?php
    die();
}


if (isset($_POST['criaCampoArquivoComuniqueSeUnico'])) {



    $criarCaixaArquivo =  $objDOcumento->montarArquivosDoComuniqueSe($_POST['idSolicitacao']);






    $quantidadeArquivos =  count($criarCaixaArquivo);

    //verificar quantos arquivos tem anexos a este serviço;
    echo   "   <input type='hidden' id='idQuantidadeArquivoDoServico'  value='$quantidadeArquivos'/>";



    $i = 0;
    foreach ($criarCaixaArquivo as $key => $value) {
    ?>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   ">
            <div class=" small-12 large-12 cell">
                <p class="button   mensagemB " style="width: 100%; background-color: rgb(23, 121, 186);  " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>
            </div>

        </div>


        <div class=" grid-x  grid-padding-x " style="width: 100%;   " id="caixa<?= $i ?>">




            <div class=" small-12 large-12 cell" style="display: grid; align-items: center;">
                <label>
                    <h5><b><i>"<?= $value['nome_arquivo'] ?>"</i></b></h5>
                </label>

                <input type="file" id="fileInput<?= $i ?>" name="file<?= $i ?>" class="button" style="background-color:#4c5e6a; height: 3em; "

                    onchange="subirArquivo('file<?= $i ?>','fileInput<?= $i ?>' ,  <?= $value['id_arquivo']  ?>, '<?= $value['descricao_status']  ?>',  '<?= $value['nome_pessoa']  ?>',  '<?= $value['id_status']  ?>'  )  ">


                <p class="button success mensagemB " id="mensagem<?= $i ?>"> Arquivo Carregado com Sucesso</p>

            </div>
            <div class="small-12 large-9 cell">
                <label>
                    <!-- campo que pega o tipo do documento para ser gravado no arquivo -->
                    <input type='hidden' id='idTipoDocumento<?= $i ?>' value='<?= $value['id_documento']  ?>' />

                </label>
            </div>



        </div>




    <?php
        $i++;
    }

    ?>

    <script>
        $('.mensagemB').hide();
    </script>

    <?php
    die();
}





//controller que delete o arquivo e informa ao cidadão
if (isset($_POST['apagarArquivoAtendente'])) {

    $objArquivo->setIdArquivo($_POST['idArquivo']);
    if ($objArquivo->apagarArquivo()) {
        ob_start();

    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

        </head>

        <body style="font-family: Arial, Helvetica, sans-serif;">
            <center>
                <h2>Olá <?= $_POST['txtnome_pessoaParaEnvioArquivo'] ?> . Somos Equie Mais Digital da Prefeitura de Guarulhos </h2>

                <p style="font-size: 1.2em;">O arquivo <b><?= $_POST['nomeArquivo'] ?> </b> que foi anexo a sua solicitação está errado.
                    <br>Clique no link que enviamos neste email para fazer a
                    alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
                    sem prosseguimento, até que você faça esta correção.
                </p>




                <a style="color: green; text-decoration: none; font-style: italic;"
                    href="http://localhost:8888/testeDigitalPlus_agosto/carregarArquivoSolicitacao.php?idArquivo=<?= $_POST['idArquivo'] ?>" target="_blank">
                    <h2>Clique aqui para alterar o Arquivo <?= $_POST['nomeArquivo'] ?> </h2>
                </a>
                <br>

                <h4> Estamos á Disposição!<br>

                    <b>Equipe Mais Digital</b>
                    <h2> Prefeitura de Guarulhos</h2>
                </h4>





            </center>
        </body>

        </html>
<?php
        $dados = ob_get_contents();
        ob_end_clean();


        //fim do conteudo da mensagem do email

        include_once '../classes/Envio.php';
        $objEnvio = new Envio();

        $objEnvio->setDestinatario($_POST['txtEmailParaEnvioArquivo']);
        $objEnvio->setAssunto('Alteração de Arquivo na sua solicitação');
        $objEnvio->setConteudo($dados);

        if ($objEnvio->envioEmail()) {

            echo json_encode(array('retorno' => true));
        }
    }




    exit();
}

if (isset($_POST['verificarAssinaturaDigital'])) {

    $objArquivo->setIdArquivo($_POST['idArquivo']);
    $objArquivo->setAssinadoDigital($_POST['status']);

    print_r($_POST);


    if ($objArquivo->informarAssinatura()) {
        echo json_encode(array('retorno' => true));
    }
}




if (isset($_POST['carregarArquivoApagadoPeloAtendenteSolicitante'])) {







    //mudar o nome do arquivo para  nao ficar dificil
    $nomeArquivoSalvar = md5($_POST['idSolicitacao'] . date("Y-m-d H:i:s"));

    //pgar o conteudo do arquivo para inserir
    $file = file_get_contents($_FILES['file']['tmp_name']);


    //pegar o tipo do arquivo
    $arquivoTipo =  $_FILES['file']['type'];

    //destruir o nomne do tipo de arquivo
    $tipoDeArquivo = explode('/', $arquivoTipo);


    //pegar somente a extensao
    $tipoArquivo = $tipoDeArquivo[count($tipoDeArquivo) - 1];

    //colocar este tipo de arquivo na pasta
    move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $nomeArquivoSalvar . '.' . $tipoArquivo);




    //o que vai

    //informo o tipo de arquivo para fins de relatorio
    $objArquivo->setTipoArquivo($tipoArquivo);

    //insiro o id do arquivo para saber qual vamos buscar
    $objArquivo->setIdArquivo($_POST['idArquivo']);

    $objArquivo->setStatusArquivo('1');


    //gravo a informa
    $objArquivo->setArquivo('files/' . $nomeArquivoSalvar . '.' . $tipoArquivo);





    //nome_pessoa_log, nome_log,texto_log , status_log , data_log, id_solicitacao ,tipo_pessoa_log, id_arquivo



    if ($objArquivo->atualizarAquivoSolicitacao()) {


        /*Array
(
    [idArquivo] => 45
    [idSolicitacao] => 73
    [status] => Alteração de Arquivo Solicitada
    [nome_pessoa] => William Ferreira
    [status_log] => 13

        //$objLog->setnome_pessoaLog($_POST['nome_pessoa'])
        

         $usuarioLog =   $this->getnome_pessoaLog(); *
            $nomeLog = $this->getNomeLog();
            $textoLog = $this->getTextoLog();
            $statusLog = $this->getStatusLog();
            $dataLog = $this->getDataLog();
            $tipo_pessoa = $this->gettipo_pessoaLog();
            $idSolicitacao = $this->getSolicitacao();
            $idArquivo = $this->getIdArquivo();


        */

        $objLog->setnome_pessoaLog($_POST['nome_pessoa']);

        //status arquivo
        $objLog->setNomeLog($_POST['status']);
        $objLog->setTextoLog('Envio do Arquivo Solicitado');
        $objLog->setStatusLog('6');
        $objLog->setDataLog(date('Y-m-d H:i:s'));
        $objLog->settipo_pessoaLog('1');

        //manda essa solicitacao
        $objLog->setSolicitacao($_POST['idSolicitacao']);
        //manda esse arquivo
        $objLog->setIdArquivo($_POST['idArquivo']);
        $objLog->setLog_fechado(1);













        if ($objLog->inserirLog()) 
            {


           if($objLog->atualizaLog())
            { 
                echo json_encode(array('retorno' => true));
           }
    }

    }


    //$dadosDoInsert = $objArquivo->inserirArquivos();

    //$arr = json_decode($dadosDoInsert, true);






    /* ver da qui



    





    $arquivoTipo =  $_FILES['file']['type'];

    $objArquivo->setTipoArquivo($arquivoTipo);



    $objArquivo->setIdSolicitacao($_POST['idSolicitacao']);


    $objArquivo->setStatusArquivo('1');

    $file = file_get_contents($_FILES['file']['tmp_name']);
    $objArquivo->setArquivo($file);




    $carregarFinalizaUP = 1;
    if ($objArquivo->atualizarAquivoSolicitacao()) {



        echo json_encode(array('retorno' => true));
    }
        

    */

    exit();
}
