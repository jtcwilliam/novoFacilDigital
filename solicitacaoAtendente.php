<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

include_once 'includes/head.php';

session_start();


$dadotipo_pessoa =     $_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa'];
$responsavelPessoa =   $_SESSION['usuarioLogado']['dados'][0]['id_unidade'];




if (!isset($_SESSION)) {
    session_start();
}





if ($_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa'] != 4 && $_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa'] != 5) {
    echo '<center><h1>Acesso Negado</h1> <h4>Você será redirecionado para a pagina inicial</h4></center>';

?>

    <script>
        window.setTimeout(() => {
            window.location =
                "logar.php";
        }, 4600);
    </script>

<?php


    exit();
}



//include_once 'includes/verificadorADM.php';



?>

<body>

    <style>
        a {
            color: #635d4d;
        }
    </style>


    <?php



    ?>

    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">

            <div class=" large reveal" id="modalComunicaArquivo" data-reveal style="padding: 60px   ;background-color: rgb(231, 228, 220);">

                <h1>Comunicado ao Cidadão</h1>
                <h4> <b><i><span id='nomeDoArquivoEnvio'></span></i></b></h4>

                <!-- id de arquivo -->
                <input type="hidden" id="aquivoPraSolicitar" />

                <!-- flag com ação para comunique-se -->
                <input type="hidden" id="acaoComuniqueSE" />


                <!-- flag com ação para comunique-se excluir arquivo -->
                <input type="text" id="mandaStatus" />




                <textarea rows="5" id="mensagemComuniqueArquivo"></textarea>
                <Br>
                <a class="button" style="width: 100%;" onclick="enviarEmailComuniqueSe()"> Enviar Comunicado ao Cidadão</a>

                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- modal tela do atendente -->

            <div class=" large reveal" id="modalManualAtendente" data-reveal style="padding: 60px   ;background-color: rgb(231, 228, 220);">


                <div id="manualDIV"></div>



                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


        </div>
    </div>



    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell">
            <div class="full reveal" id="retorno" data-reveal style="background-color: ivory;top: 0px;left: 220px;right: 40px;margin: 0px;  " data-close-on-esc="false">
                <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 30px;">


                    <div class="grid-x grid-padding-x">
                        <div class="small-12 large-12 cell">
                            <fieldset class="fieldset">
                                <legend>
                                    <h3>Arquivos da Solicitacao</h3>
                                </legend>
                                <table class="table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th colspan="6">
                                                <center>
                                                    <h3><b></b></h3>
                                                </center>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th width="15%">Arquivo Carregado</th>
                                            <th width="70%">Nome do Arquivo</th>
                                            <th width="10%">
                                                <center>Visualizar Arquivo</center>
                                            </th>
                                            <th width="10%">
                                                <center>Solicitar Arquivo</center>
                                            </th>
                                            <th width="10%">
                                                <center>Alterar Arquivo</center>
                                            </th>
                                            <th width="10%">
                                                <center>Assinado digitalmente</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelaArquivos"></tbody>
                                </table>
                            </fieldset>


                        </div>

                        <div class="small-12 large-12 cell">


                            <fieldset class="fieldset">
                                <legend>
                                    <h3>Ações</h3>
                                </legend>
                                <div class="grid-x grid-padding-x">
                                    <div class="small-12 large-6 cell">
                                        <a class="button" style="width: 100%; background-color: green;  border-radius: 30px;" onclick="finalizarComuniqueSe(<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>)">
                                            <h5>Clique aqui para enviar "comunique-se" ao cidadão </h5>
                                        </a>
                                    </div>


                                    <div class="small-12 large-6 cell">
                                        <a class="button" data-close aria-label="Close modal" style="width: 100%; background-color: #4e4e4eff; border-radius: 30px;">
                                            <h5>Clique para fechar este painel</h5>
                                        </a>
                                    </div>
                                </div>


                            </fieldset>
                        </div>

                    </div>


                </div>




            </div>

        </div>
    </div>

    </span></button>
    </div><?php

            ////
            include_once 'includes/linksAdm.php';


            ?>


    <div class="grid-x " style=" align-items: center; background-color: #4a473fff; color: whitesmoke; margin-top: -20px;   ">

        <div class="small-12 large-2 cell">
            <div class="grid-x  grid-padding-x">
                <div class="small-2 cell" style="   display: inline; align-content: center; text-align: justify;">
                    <h2>&nbsp;</i></h2>
                </div>

                <div class="small-10 cell" style="display: inline; align-content: center; text-align: justify;">
                    <a style="color: white;" onclick="ajudaAtendente($('#idSolicitacao').val())">
                        <h5>Ações </h5>
                    </a>
                </div>
            </div>


        </div>
        <div class="small-12 large-2 cell">
            <div class="grid-x  grid-padding-x">
                <div class="small-2 cell" style="   display: inline; align-content: center; text-align: justify;">
                    <h3><i class="fi-torsos-male-female large"></i></h3>
                </div>
                <div class="small-10 cell" style="display: inline; align-content: center; text-align: justify;">
                    <a style="color: white;" target="_blank" href="exibirManual.php?idSolicitacao=<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>">
                        <h6>Quer uma Ajuda? </h6>
                    </a>
                </div>
            </div>
        </div>

        <div class="small-12 large-3 cell">
            <div class="grid-x  grid-padding-x">
                <div class="small-2 cell" style="   display: inline; align-content: center; text-align: justify;">
                    <h3><i class="fi-folder-add large"></i></h3>
                </div>
                <div class="small-10 cell" style="display: inline; align-content: center; text-align: justify;">

                    <a style="color: white;" onclick="exbirArquivosDaSolicitacao($('#idSolicitacao').val())">
                        <h6>Arquivos da Solicitação </h6>
                    </a>

                </div>
            </div>
        </div>
        <div class="small-12 large-2 cell">
            <div class="grid-x  grid-padding-x">
                <div class="small-2 cell" style="   display: inline; align-content: center; text-align: justify;">
                    <h3><i class="fi-page-multiple large"></i></h3>
                </div>
                <div class="small-10 cell" style="display: inline; align-content: center; text-align: justify;">

                    <a style="color: white;" target="_blank" href="relatorio.php?idSolicitacao=<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>">
                        <h6>Relatório </h6>
                    </a>

                </div>
            </div>
        </div>






    </div>




    <div class="grid-x grid-padding-x">
        <div class="small-12 large-12 cell" id="containnerSolicitacao">


        </div>


        <div class="small-12 large-4 cell">
            <input type="hidden" id="idSolicitacao" value="<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>" />

            <fieldset class="fieldset" id="fieldSolicitacao" style="display: block; font-size:1em; width: 100%;">
                <legend>
                    <h4 id="" onclick="$('#retorno').foundation('open')" style="color: #56658E; "><b>Ações</b></h4>
                </legend>




                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-folder-add large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <a onclick="exbirArquivosDaSolicitacao($('#idSolicitacao').val())">
                            <h4>Arquivos da Solicitação </h4>
                        </a>
                    </div>
                </div>





                <div class="grid-x  grid-padding-x" style="display: none;">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-megaphone large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h4>Comunicar ao Cidadão </h4>
                    </div>
                </div>


                <div class="grid-x  grid-padding-x" style="color: #56658E; display: none;">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-archive large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify; color: #56658E;  ">
                        <h4>Arquivar Solicitação </h4>
                    </div>
                </div>



                <div class="grid-x  grid-padding-x" style="display: none;">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-check large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h4>Aprovar Solicitação </h4>
                    </div>
                </div>

                <div class="grid-x  grid-padding-x">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-page-multiple large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <a target="_blank" href="relatorio.php?idSolicitacao=<?= $_GET['89a2e8ef07b59a9a87135b9e2fe979d4b40a616d'] ?>">
                            <h4>Relatório </h4>
                        </a>
                    </div>
                </div>

                <div class="grid-x  grid-padding-x" style="display: none;">
                    <div class="small-1 cell" style="   display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h2><i class="fi-page-copy large"></i></h2>
                    </div>
                    <div class="small-11 cell" style="display: inline; align-content: center; text-align: justify;color: #56658E">
                        <h4>Encaminhar para Processo SEI </h4>
                    </div>
                </div>
            </fieldset>
        </div>
    </div><?php

            include_once 'includes/footer.php';

            ?><script>
        $(document).ready(function() {

            exibirSolicitacao($('#idSolicitacao').val());
            exbirArquivosDaSolicitacao($('#idSolicitacao').val())


        })

        function exibirSolicitacao(idSolicitacao) {
            var formData = {
                idSolicitacao,
                exibirSolicitacaoAtendente: '1'
            }

            ;

            $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoControllerAtendente.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {

                $('#containnerSolicitacao').html(data);
            });
        }

        function exbirArquivosDaSolicitacao(solicitacao) {

            var formData = {
                solicitacao,
                listarArquivosAtendente: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoControllerAtendente.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {
                $('#tabelaArquivos').html(data);

            });
        }


        function ajudaAtendente(solicitacao) {


            var formData = {
                solicitacao,
                ajudaAtendente: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/manualAtendenteController.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {
                $('#modalManualAtendente').foundation('open');
                $('#manualDIV').html(data);

            });
        }


        function arquivoAssinaturaDigital(idArquivo, status) {


            var formData = {
                idArquivo,
                status,
                verificarAssinaturaDigital: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/arquivosController.php',
                data: formData,
                dataType: 'html',
                encode: true

            }).done(function(data) {
                console.log(data);


                alert('Atualizado');
                exbirArquivosDaSolicitacao($('#idSolicitacao').val())
            });
        }



        function apagarArquivosSolicitacao(idArquivo, nomeArquivo) {


            var formData = {
                idArquivo,
                nomeArquivo,
                txtEmailParaEnvioArquivo: $('#txtEmailParaEnvioArquivo').val(),

                txtnome_pessoaParaEnvioArquivo: $('#txtnome_pessoaParaEnvioArquivo').val(),
                apagarArquivoAtendente: '1'
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/arquivosController.php',
                data: formData,
                dataType: 'json',
                encode: true

            }).done(function(data) {

                if (data.retorno == true) {
                    alert('Arquivo deletado e informação enviada ao solicitante');
                }



            });
        }

        function enviarEmailComuniqueSe() {

            var solicitacao = $('#idSolicitacao').val();

            var formData = {

                solicitacao,

                mandaStatus: $('#mandaStatus').val(),

                codigoId: $('#aquivoPraSolicitar').val(), //codigo id do arquivo para alteracao de arquivo  // ou codigo do tipo de documento para solicitação de arquivo

                acaoComuniqueSE: $('#acaoComuniqueSE').val(),

                mensagemComuniqueArquivo: $('#mensagemComuniqueArquivo').val()

            }

            $.ajax({
                type: 'POST',
                url: 'ajax/comuniqueSeController.php',
                data: formData,
                dataType: 'json',
                encode: true
            }).done(function(data) {



                if (data.retorno == true) {
                    alert('Informação Registrada com Sucesso');
                    exbirArquivosDaSolicitacao($('#idSolicitacao').val())
                }

            });
        }


        function finalizarComuniqueSe(idSolicitacao) {

            var formData = {

                idSolicitacao,

                enviarEmail: '1'



            }

            $.ajax({
                type: 'POST',
                url: 'ajax/comuniqueSeController.php',
                data: formData,
                dataType: 'json',
                encode: true
            }).done(function(data) {


                console.log(data);


                if (data.retorno == true) {
                    alert('O Comunique-se foi enviado com sucesso! ');
                    exbirArquivosDaSolicitacao($('#idSolicitacao').val())
                }

            });
        }
    </script>
</body>

</html>