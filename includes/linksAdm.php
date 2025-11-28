<?php




$tipo_pessoa = $_SESSION['usuarioLogado']['dados'][0]['tipo_pessoa'];


switch ($tipo_pessoa) {
    case '5': ?>


        <div class="grid-x grid-padding-x">

            <div class="expanded button-group">
                <a class="button fundoBotoesTopo"><?php echo 'Usuario: ' . $_SESSION['usuarioLogado']['dados'][0]['nome']     ?></a>

                <a class="button fundoBotoesTopo" href="managerMais.php">Solicitações em Aberto </b></a>
                <a class="button fundoBotoesTopo" href="habilitarServicos.php"> Habilitar Serviços </b></a>
                <a class="button fundoBotoesTopo" href="consultaUsuario.php">Alterar Dados Usuário</a>


                <a class="button fundoBotoesTopo" href="logout.php">Saissr</a>

            </div>


        </div>





    <?php

        break;

    case '4': ?>

        <div class="grid-x grid-padding-x">

            <div class="expanded button-group">
                <a class="button fundoBotoesTopo"><?php echo 'Usuario: ' . $_SESSION['usuarioLogado']['dados'][0]['nome']     ?></a>



                <a class="button fundoBotoesTopo" href="managerMais.php">Solicitações em Aberto </b></a>
                <a class="button fundoBotoesTopo" href="habilitarServicos.php"> Habilitar Serviços </b></a>
                <a class="button fundoBotoesTopo" href="consultaUsuario.php">Alterar Dados Usuário</a>

                <a class="button fundoBotoesTopo" href="logout.php">Sair</a>


            </div>


        </div>




    <?php
        break;
    case '3': ?>

        <div class="grid-x grid-padding-x">

            <div class="expanded button-group">
                <a class="button fundoBotoesTopo"><?php echo 'Usuario: ' . $_SESSION['usuarioLogado']['dados'][0]['nome']     ?></a>


                <a class="button fundoBotoesTopo" href="baixarSenhas.php">Check in Atendimento</a>
                <a class="button fundoBotoesTopo" href="logout.php">Sair</a>


            </div>


        </div>




<?php
        break;
    default:

        break;
}


?>