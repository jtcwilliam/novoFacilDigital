<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php

include_once 'includes/head.php'

?>

<body>

    <div class="grid-container" style="display: grid; align-items: center; height: 100vh;">
        <div class="grid-x grid-padding-x">
            <div class="auto cell">

            </div>



            <div class="small-12 large-6 cell" id="exibiAgendamento">

                <!-- primeiro formulario, consulta cpf -->
                <div class="grid-x grid-padding-x" id="loginCPF">
                    <div class="small-12 large-12 cell">
                        <label style="font-weight: bold;">
                            <input type="text" placeholder="Digite aqui seu Usuario (o mesmo da rede)" class="usuario" id="usuario" value="" />
                        </label>

                    </div>

                    <div class="small-12 large-12 cell">
                        <label style="font-weight: bold;">
                            <input type="password" placeholder="Digite sua Senha (a mesma da rede)" id="pwd" value="" />
                        </label>
                        <a class="button succes" href="#" onclick="consultarAcesso()" style="width: 100%;">Acessar Area Administrativa</a>
                        <br>
                    </div>
                </div>




                <!-- confirmacao  -->
                <div class="grid-x grid-padding-x" id="confirmacao">
                    <div class="small-12 large-12 cell">

                        <center>
                            <h4 id="mensagemConfirmacao"></h4>
                        </center>

                    </div>


                </div>







                <img src="imgs/logoPrefeitura.png" />
            </div>

            <div class="auto cell">

            </div>
        </div>

    </div>

    <?php

    include_once 'includes/footer.php';

    ?>
    <script>
        $(document).ready(function() {
            // $('#confirmacao').hide();

            $('.cpf').mask('000.000.000-00');
        })

        function consultarAcesso() {

            var formData = {
                usuario: $('#usuario').val(),
                pwd: $('#pwd').val()
            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/loginPessoaController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {
                

                    condicao = data.retorno;

                    

                    if (data.retorno === false) {

                        alert("Acesso negado! Verifique seu Usuário ou sua Senha");
                        $('#usuario').val("");
                        $('#pwd').val("");


                    } else {
                        //condição retornou true, então pode seguir para o agendamento. ta fa

                        $('#loginCPF').hide();
                        $('#confirmacao').delay('fast').fadeIn();

                        $('#mensagemConfirmacao').html('<b>Olá.</b> <br>Vamos te redirecionar para<br> a Área Administrativa');





                        
                        window.setTimeout(() => {
                            window.location = endereco;
                        }, 1200);

                    }

                    tipo_pessoa = data.dadosUsuario.dados[0]['tipo_pessoa'];


                    switch (tipo_pessoa) {
                        case 5:
                            endereco = "managerMais.php";
                            break;
                        case 4:
                            endereco = "managerMais.php";
                            break;
                        case 3:
                            endereco = "baixarSenhas.php";
                            break;

                        default:

                            endereco = "areaAdm.php";

                    }

                });
            event.preventDefault();
        }
    </script>
</body>

</html>