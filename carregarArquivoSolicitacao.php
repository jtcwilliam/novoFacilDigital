<?php

if (session_start()) {
}


?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';



?>

<body style="background-image: url('imgs/fundoSistema.png') ;         background-size: cover " id="telaMaior">

    <!-- modais de informação sucesso cadastrado -->


    <div class=" full reveal" id="exibirSolicitacoes" data-reveal style="background-color:rgb(216, 216, 219);  ">
        <div style="display: grid;  justify-content: center; align-content: center;  padding-top: 0px;" id="exibirSolicitacaoModal">

        </div>
        <br>
        <div class="grid-x grid-padding-x" id="containerCadastro" style="height: 70vh;  ">
            <div class="auto cell"></div>
            <div class="small-12 large-10 cell" style="color: green;">

                <div class=" grid-x grid-padding-x" style="color: green;">
                    <div class="small-12 large-2 cell" id="escolha"> <b>1</b><br>
                        <i>Escolha da Solicitação</i>
                    </div>

                    <div class="small-12 large-3 cell" id="complemento"> <b>2</b><br>
                        <i>Preenchimento da Solicitação</i>
                    </div>

                    <div class="small-12 large-2 cell" id="docsEstagio"> <b>3</b><br>
                        <i id="docsEstagio">Documentação Necessária</i>
                    </div>

                    <div class="small-12 large-2 cell" id="finalizacao"> <b>4</b><br>
                        <i>Assinatura</i>
                    </div>

                    <div class="small-12 large-3 cell" id="solicitacaoEnviada"> <b>5</b><br>
                        <i>Solicitação Enviada Aguarde retorno</i>
                    </div>

                    <div class="small-12 large-12 cell" id="solicitacaoEnviada"><br>
                        <a class="button" style="width: 100%; background-color: #2C255B;" onclick="$('#exibirSolicitacoes').foundation('close');">Fechar esta janela</a>
                    </div>





                </div>

                <br>
            </div>
            <div class="auto cell"></div>
        </div>


    </div>


    <!-- upload de arquivos -->
    <div class="   small reveal" id="carregandoArquivos" data-reveal style="background-color:rgb(216, 216, 219);">
        <div style="display: grid;  justify-content: center; align-content: center;  padding-top: 0px;">
            <center style="color: black;">
                <h4>

                    Aguarde um Pouco enquanto esse arquivo está sendo gravado!



                </h4>

            </center>
        </div>

    </div>



    <!-- duvida sobre Servicos -->
    <div class="   small reveal" id="modalDuvidasCartas" data-reveal style="background-color:rgb(216, 216, 219);">
        <div style="display: grid;  justify-content: center; align-content: center;  padding-top: 0px;">
            <center style="color: black;">
                <h4>
                    <a target="_blank" style="color: black;" id="linkHelpServico">Ola! Se você tem alguma dúvida sobre os procedimentos ou qual
                        documentação será necessária para realizar a solicitação "<b><i><span style="color:#28536b" id='codigoSolicitacao'></span></i> </b>" <br>
                        <b><i>clique aqui</i></b> e você
                        será redirecionado para a carta de serviços da prefeitura. Após retirar suas dúvidas, volte aqui para realizar sua solicitação!
                    </a>


                    <br>

                    <br>

                    <a class="button sucess" data-close aria-label="Close modal" target="_blank"> Clique aqui para Fechar esta Janela!</a>

                </h4>

            </center>
        </div>

    </div>
    <!-- fim dos modais -->


    <div class="full reveal" id="usuarioInserido" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Olá. Seja Bem vindo</h2>
                <h3>Você foi cadastrado com Sucesso <br> Para continuar seu agendamento, digite sua senha!</h3>
                <br>

                <a data-close aria-label="Close modal" style="color:rgb(209, 234, 248); font-weight: bold;">
                    <h3>Clique aqui para fechar</h3>
                </a>



                <h4 style="font-style: italic;"><b> <br>

                        <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" />

            </center>
        </div>
        <button class="close-button" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>









    <!-- modal confirmação da solicitação -->
    <div class="full reveal" id="modalSucesso" data-reveal style="background-color:#2C255B;">
        <div style="display: grid;  justify-content: center; align-content: center; height: 100vh; padding-top: 0px;">
            <center style="color: white;">
                <h2>Olá <span id="nomeNoticia"></span>. <br>
                    Ótimas Notícias! <span class="protocoloAgendamento"></span></h2>
                <p class="lead"></p>
                <h4 style="font-style: italic;"><b>Dica: Tire um print dessa tela e leve no dia do agendamento! Ela Serve de protocolo para o atendimento! </h4>
                <h4 style="font-style: italic;"><b> Não esqueça de levar seu documento com foto para identificação! <br>
                        <br><a class=" button " style="width: 30%; border-radius: 16px;" href="https://portalfacil.guarulhos.sp.gov.br">Acessar o portal do Fácil</a></h4>
                <img src="imgs/logoGoverno-1024x240.jpg" style="width: 60%; padding-top: 10em;" :) />
            </center>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- fim dos modais -->




    <!--container com todos os elementros para login e cadastro -->
    <div class="grid-x grid-padding-x" id="containerCadastro" style="height: 70vh;  ">
        <div class="auto cell">

        </div>



        <div class="small-12 large-6 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(216, 216, 219);">

            <div class="grid-container">



                <div class="grid-x grid-padding-x" style="margin-bottom: 30px;">
                    <div class="auto cell">

                    </div>

                    <div class="small-4 cell large-5">
                        <img src="imgs/logoPlusDigital.png" style="width: 100%; margin-top: 20px;" />




                    </div>
                    <div class="auto cell">

                    </div>
                </div>






                <div class="grid-x grid-padding-x">
                    <div class="auto cell">

                    </div>



                    <div class="small-12 large-12 cell" id="exibiAgendamento">
                        <br>

                        <div class=" grid-x grid-padding-x">
                            <div class="small-12 large-12 cell" id="arquivosInseriveis" style="width: 100%;">


                            </div>
                        </div>



                    </div>

                    <div class="auto cell">

                    </div>
                    <?php

                    include_once 'includes/footer.php';

                    ?>

                    <br>

                    <div class="grid-x grid-padding-x">

                        <div class="auto cell">

                        </div>
                        <div class="small-12 cell large-9">
                            <br>
                            <center><img src="imgs/gestaoPNG.png" style="width: 70%;" /></center>
                        </div>

                        <div class="auto cell">

                        </div>
                    </div>

                </div>









            </div>



        </div>


        <div class="auto cell">

        </div>




    </div>

    <div class="grid-x grid-padding-x" id="containerCadastraSolicitacao" style="display: none ;height: 120vh; background-color:rgb(216, 216, 219); margin-top: 0; ">




        <?php






        ?>

    </div>




    <script>
        $(document).ready(function() {





        })
        criarCaixaArquivo(<?= $_GET['idSolicitacao'] ?>);

        function criarCaixaArquivo(idSolicitacao) {

            criaCampoArquivoComuniqueSeUnico = '1';

            var formData = {
                idSolicitacao,
                criaCampoArquivoComuniqueSeUnico
            };

            $.ajax({
                    type: 'POST',
                    url: 'ajax/arquivosController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {

                    $('#arquivosInseriveis').html(data);

                });
        }


        function subirArquivo(arquivo, id, idArquivo) {
            var formData = new FormData();
            var file = $(`#${id}`)[0].files[0];



            //
            if (file) {
                formData.append('file', file);


                formData.append('carregarArquivoApagadoPeloAtendenteSolicitante', 1);
                formData.append('idArquivo', idArquivo);

                formData.append('idSolicitacao', $('#idSolicitacao').val());



                $.ajax({
                    url: 'ajax/arquivosController.php', // Replace with your server endpoint
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    success: function(response) {
                        console.log(response);




                        if (response.retorno == true) {
                            alert('O arquivo foi Gravado com Sucesso. Se você ja enviou todos os arquivos solicitados, nós vamos dar andamento a sua solicitação!');
                            criarCaixaArquivo(<?= $_GET['idSolicitacao'] ?>);
                        }
                    },
                    error: function(error) {
                        alert('Error uploading file.');
                    }
                });
            } else {
                alert('Please select a file to upload.');
            }
        }
    </script>
</body>

</html>