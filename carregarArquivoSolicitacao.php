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





    ` `


    <!--container com todos os elementros para login e cadastro -->
    <div class="grid-x grid-padding-x" id="containerCadastro" style="height: 70vh;  ">
        <div class="auto cell">

        </div>



        <div class="small-12 large-6 cell" style="  padding-left: 10px; padding-right: 10px ;height: 150vh; background-color:rgb(216, 216, 219);">

            <div class="grid-container">







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



                <div class="grid-x grid-padding-x">
                    <div class="auto cell">

                    </div>


                    <!-- preserva -->
                    <div class="small-12 large-12 cell" id="exibiAgendamento">
                        <br>

                        <div class=" grid-x grid-padding-x">
                            <div class="small-12 large-12 cell" id="arquivosInseriveis" style="width: 100%;">


                            </div>
                        </div>



                    </div>

                    <!-- preserva -->

                    <div class="auto cell">

                    </div>
                    <?php

                    include_once 'includes/footer.php';

                    ?>

                    <br>


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


        function subirArquivo(arquivo, id, idArquivo, status, nome_pessoa, status_log) {
            var formData = new FormData();
            var file = $(`#${id}`)[0].files[0];



            //
            if (file) {
                formData.append('file', file);


                formData.append('carregarArquivoApagadoPeloAtendenteSolicitante', 1);
                formData.append('idArquivo', idArquivo);

                formData.append('idSolicitacao',  <?= $_GET['idSolicitacao'] ?> );
                formData.append('status', status);
                formData.append('nome_pessoa', nome_pessoa);
                formData.append('status_log', status_log);



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
