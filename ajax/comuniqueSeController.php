<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



include '../classes/Envio.php';
include '../classes/Solicitacao.php';
include '../classes/arquivo.php';
include '../classes/Documentos.php';
include '../classes/Log.php';


$objEnvio = new Envio();
$objSolicitacao = new Solicitacao();
$objArquivo  = new Arquivo();
$objLog = new Log();
$objDocumentos = new Documentos();



//funcao para solicitar arquivo que nao foi anexo
if (isset($_POST['acaoComuniqueSE']) &&  $_POST['acaoComuniqueSE'] == 'solicitarArquivo') {

    $tipoDocumento = $objDocumentos->trazerDocumentos(' where id_doc=' . $_POST['codigoId']);

    $objArquivo->setTipoArquivo('Indefinido');

    $objArquivo->setNomeArquivo($tipoDocumento[0]['descricao_doc']);

    $objArquivo->setIdSolicitacao($_POST['solicitacao']);

    $objArquivo->setStatusArquivo('12');

    $objArquivo->setArquivo('Arquivo vazio');

    $objArquivo->setIdTipoDocumento($tipoDocumento[0]['id_doc']);
    $objArquivo->setAssinadoDigital('0');

    $carregarFinalizaUP = 1;




    if ($dadosDoInsert = $objArquivo->inserirArquivos()) {

        if (!session_start()) {
            session_start();
        }






        $arr = json_decode($dadosDoInsert, true);

        $ultimoId = $arr['ultimoID'];



        //retorno para pegar o ultimoID
        //  $idArquivoParaLog =   $arr['ultimoID'][0]['LAST_INSERT_ID()'];



        $usuarioLog = $_SESSION['usuarioLogado']['dados'][0]['nome'];
        $nomeLog = 'Solicitamos o Envio do Arquivo ' . $tipoDocumento[0]['descricao_doc'];
        $textoLog = $_POST['mensagemComuniqueArquivo'];
        $statusLog = '12';
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dataLog = date('Y-m-d H:i:s');


        $objLog->setnome_pessoaLog($usuarioLog);
        $objLog->setNomeLog($nomeLog);
         
        $objLog->setTextoLog($_POST['mensagemComuniqueArquivo']);
        $objLog->setStatusLog($statusLog);
        $objLog->setDataLog($dataLog);
        $objLog->settipo_pessoaLog($_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa']);
        $objLog->setSolicitacao($_POST['solicitacao']);
        $objLog->setIdArquivo($ultimoId);

        if ($objLog->inserirLog()) {
            echo json_encode(array('retorno' => true));
        }
    }
}


//funcao para solicitar arquivo que nao foi anexo
if (isset($_POST['acaoComuniqueSE']) &&  $_POST['acaoComuniqueSE'] == 'alterarArquivo') {

    
    $statusArquivo = $_POST['mandaStatus'];


    $objArquivo->setIdArquivo($_POST['codigoId']);
    $objArquivo->setStatusArquivo($statusArquivo);
        
    if ($objArquivo->apagarArquivo()) {

        if (!session_start()) {
            session_start();
        }

      
        //solicta dados do arquivo para gravar  no log
        $dadosArquivo = $objArquivo->dadosArquivoSolicitante($_POST['codigoId']);

        

        $usuarioLog = $_SESSION['usuarioLogado']['dados'][0]['nome'];
        $nomeLog = 'Alteração do Arquivo' . $dadosArquivo[0]['nome_arquivo'];
        
        if($statusArquivo == '13'){

            $textoLog = 'Solicitamos Alteração de Arquivo';
        }else
        {
            $textoLog = 'Solicitamos Exclusão de Arquivo';
        }
        

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dataLog = date('Y-m-d H:i:s');


        $objLog->setnome_pessoaLog($usuarioLog);
        $objLog->setNomeLog($nomeLog);
        $objLog->setTextoLog($textoLog);
        
        $objLog->setStatusLog($statusArquivo);
        $objLog->setDataLog($dataLog);
        $objLog->setIdArquivo($_POST['codigoId']);


        $objLog->settipo_pessoaLog($_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa']);
        $objLog->setSolicitacao($_POST['solicitacao']);

        if ($objLog->inserirLog()) {
            echo json_encode(array('retorno' => true));
        }


 



        //criar na classe log o metodo que insere o log aqui, que vem dessa consulta de dados ai, mais o id da ação do log
        // e a mensagem do comunique-se
        //criar um status de comunique-se e arquivo pendente de atualização pelo cidadão
        //terá um botão na tabela com arquivos, com a informação (atualizar comunique-se)
        //nessa hora ele roda essa tabela e verifica quais estão com esse status


        //quando o cidadão enviar o arquivo para a tabela arquivos, atualiza aqui para status ativo (1)
        //ou seja, grava o arquivo lá, atualiza aqui...






        exit();
    }




    exit();
}


if (isset($_POST['enviarEmail'])) {



    ob_start();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">



    </head>

    <body style="font-family: Arial, Helvetica, sans-serif;">
        <style>
            p {
                font-weight: 400;
                font-size: 3em;
                line-height: 1.3em;

            }

            ;


            li {
                font-size: 1.9em;
                line-height: 1.3em;
            }
        </style>


        <?php

        $dadosSolicitacao = $objSolicitacao->consultarSolicitacaoRelatorio($_POST['idSolicitacao']);



        //print_r($dadosSolicitacao);



        $dadosLog = $objLog->exibirLogs($_POST['idSolicitacao'], 1);



        ?>
        <h1>Olá Somos da Equipe Mais Digital da Prefeitura de Guarulhos </h1>

        <p style="font-size: 1.3em; line-height: 1.5em;">Verificamos algumas inconsistencias na Solicitação da <b> <?= $dadosSolicitacao[0]['nome_servico']   ?></b>
            que você realizou! <br>Não se preocupe! Nós vamos te dizer o que aconteceu e te ajudar a resolver esta solicitação!
            Abaixo, segue a lista dos documentos que você precisa enviar.<br>






        <ul style="font-size: 1.3em; line-height: 1.5em;">
            <?php



            foreach ($dadosLog['dados'] as $key => $value) {
                echo '<li><b>' . $value['nome_log'] . '</b><br>' . $value['texto_log'];


                echo '<br></li>';
            } ?>
        </ul>

        <p style="font-size: 1.3em; line-height: 1.2em;">
            <a style="color: blue; text-decoration: none; font-style: italic;"
                href="https://agendafacil.guarulhos.sp.gov.br//maisDigital/carregarArquivoSolicitacao.php?idSolicitacao=<?= $_POST['idSolicitacao'] ?> " target="_blank">
                <h2>Clique aqui para enviar os Arquivos que solicitamos! </h2>
            </a>
        </p>


        <p style="font-size: 1.3em; line-height: 1.5em;">
            <b>Lembre-se: </b> A solicitação ficará em suspensão enquanto você não resolver essas inconsistências. Clique no link que enviamos neste email para fazer a
            alteração adequada e prosseguirmos para a conclusão de sua solicitação<br> <b>Observação:</b> Está solicitação permanecerá
            sem prosseguimento, até que você faça esta correção.
            </h3>
        </p>





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






    $objEnvio->setDestinatario($dadosSolicitacao[0]['email_usuario']);
    $objEnvio->setAssunto('Alteração de Arquivo na sua solicitação');
    $objEnvio->setConteudo($dados);

    if ($objEnvio->envioEmail()) {

        echo json_encode(array('retorno' => true));
    }
    exit();
}
