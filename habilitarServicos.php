<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php';

session_start();

$dadotipo_pessoa =     $_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa'];
$responsavelPessoa =   $_SESSION['usuarioLogado']['dados'][0]['id_unidade'];



if (!isset($_SESSION)) {
    session_start();
}

/*

if ($_SESSION['usuarioLogado']['dados'][0]['idtipo_pessoa'] != 4) {
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


*/
//include_once 'includes/verificadorADM.php';



?>

<body>

    <div class="reveal" id="adm_das_datas" data-reveal style="background-color:ivory">
        <div style="display: grid;  justify-content: center; align-content: center;   padding-top: 0px;">


            <div class="grid-x grid-padding-x" id="inforDatas">

            </div>

        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>



    <?php

    ////
    include_once 'includes/linksAdm.php';

    ?>

    <div class="grid-container">
        <div class="grid-x grid-padding-x">



            <div class="small-12 large-12 cell">







                <!-- liberação de datas para agendamento -->
                <fieldset class="fieldset">
                    <legend> <label>Habilitar serviços para o atendimento</label></legend>

                    <form action="ajax/habilitaServicosController.php" method="POST" enctype="multipart/form-data">
                        <div class=" grid-x grid-padding-x">

                            <div class="small-12 large-12 cell">
                                <label for="qtdeMesas">Escolha Serviço a ser habilitado<br>
                                    <select class="js-example-basic-single  responsive-combobox" id="comboServicosDocumentos" name="comboServicos"
                                        style="width: 100%;">
                                    </select>
                                </label>
                            </div>

                            <div class="small-12 large-12 cell">
                                <label for="qtdeMesas">Qual Categoria vai atender este servico?<br>
                                    <select class="js-example-basic-single  responsive-combobox" id="comboServicosCategoria" name="comboCategoria"
                                        style="width: 100%;">
                                    </select>
                                </label>
                            </div>






                            <div class="small-12 large-12 cell">


                                <label for="qtdeMesas">Insira as informações para o atendimento<br>
                                    <textarea rows="12" style="width: 100%;" name="infoAtendimentos">Digite aqui as informações para o Atendente</textarea>
                                </label>

                            </div>


                            <div class="small-12 large-12 cell">
                                <label for="qtdeMesas">Digite Tags para tornar fácil encontrar esse serviço?<br>
                                    <textarea rows="12" style="width: 100%;" name="tagsAtendimento">Digite aqui as Tags</textarea>
                                </label>
                            </div>

                            <div class="small-12 large-12 cell">


                                <label for="qtdeMesas">Escolha qual(is) documento(s) compõe este serviço<br>

                                    <select class="js-example-basic-single  responsive-combobox" multiple="multiple" id="comboDocumentos" name="comboDocumentos[]"
                                        style="width: 100%;">

                                    </select>
                                </label>

                                <Br>
                            </div>



                        </div>

                        <div class="grid-x grid-padding-x">




                            <div class="small-12 large-3 cell">
                                <label for="qtdeMesas">&nbsp;<br>
                                    <input type="submit" class="button fundoBotoesTopo "
                                        style="height: 3em; width: 100%; color: white; font-weight: bold;" id="enviarHorarios" />
                                </label>
                            </div>

                        </div>
                    </form>
                </fieldset>








            </div>

        </div>

    </div>

    <?php

    include_once 'includes/footer.php';

    ?>
    <script>
        //parte para preencher os horários

        <?php

        if (isset($_GET['servico'])) { ?>

            alert('Serviço Habilitado com Sucesso!');

        <?php
        }


        ?>

        criaCombo('comboServicosDocumentos');

        criaCombo('comboServicosCategoria');


        criaCombo('comboDocumentos');
    </script>



</body>

</html>