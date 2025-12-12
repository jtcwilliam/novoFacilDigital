<?php

if (!session_start()) {
    session_start();
}

//utf-8

   
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php


include_once 'includes/head.php';



?>

<body style="background-image: url('imgs/fundoSistema.png') ;         background-size: cover " id="telaMaior">
    <style>
            .button{
                border-radius: 10px;
            }
            .fieldset{
                border-radius: 10px;
            }

        </style>

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



    <!-- modal de termo de uso -->
    <div class="large reveal" id="termoUso" data-reveal style="background-color:white;">
        <div style="  padding-top: 0px;">
            <div style="color: black; text-align: justify; padding-left: 10px; padding-right: 10px; ">
                <h4><b>Termos de Uso do "Agenda Fácil" - versão 1.0</b></h4>




                <p><b>1.⁠ ⁠OBJETIVO</b><br>
                    Estabelecer as condições de uso do Sistema de Agendamento Online das unidades da “Rede Fácil” do Departamento de Atendimento ao Cidadão, subordinado à Secretaria de Gestão da Prefeitura do Município de Guarulhos/SP, garantindo transparência, segurança e conformidade com a Lei Geral de Proteção de Dados (LGPD – Lei nº 13.709/2018) e com boas práticas do serviço público.
                </p>

                <p>
                    <b>2.⁠ ⁠FUNCIONALIDADE DO SISTEMA</b><br>

                    O sistema permite que cidadãos realizem agendamento online para atendimentos presenciais nas unidades do Fácil. Existem duas formas de acesso disponíveis:
                <ul>
                    <li>Acesso Simplificado: requer apenas o nome completo e o CPF do cidadão.</li>
                    <li>⁠Acesso Autenticado: requer nome completo, CPF e senha cadastrada, oferecendo maior segurança e controle.</li>


                    <li>O cidadão pode escolher livremente entre as duas opções para realizar seus agendamentos.</li>

                </ul>
                </p>

                <P>
                    <b>3.⁠ ⁠REGRAS DE USO</b>
                <ul>
                    <li>⁠ ⁠O usuário deve fornecer informações verdadeiras, completas e atualizadas no momento do agendamento;</li>
                    <li>⁠ ⁠Cada CPF pode manter até 2 agendamentos ativos simultaneamente;</li>
                    <li>⁠ ⁠O não comparecimento ao agendamento, sem justificativa, poderá resultar em bloqueio temporário para novos agendamentos;</li>
                    <li>⁠ ⁠Caso o usuário atinja o limite de agendamentos e não consiga realizar nova marcação, será necessário comparecer pessoalmente a uma unidade Fácil para solicitar a liberação.</li>
                    <li>⁠ ⁠Os agendamentos são pessoais e intransferíveis, logo, o usuário não deve compartilhar senhas ou acessos terceirizados;</li>
                    <li>⁠ ⁠O usuário não deve utilizar o sistema para fins ilegais ou fraudulentos. </li>
                </ul>
                </p>

                <p><b>
                        4.⁠ ⁠TRATAMENTO DE DADOS PESSOAIS (LGPD)<br></b>
                    Os dados coletados (nome e CPF, e senha opcional no caso do acesso autenticado) são utilizados exclusivamente para controle de agendamentos e identificação do cidadão. São armazenados em ambiente seguro, com acesso restrito, conforme determina a LGPD – Lei nº 13.709/2018.
                </p>

                <p><b>
                        5.⁠ ⁠SEGURANÇA DA INFORMAÇÃO</b>
                    O sistema conta com criptografia, camadas de segurança para proteger os dados armazenados.
                </p>



                <p><b>
                        6.⁠ ⁠ACEITE</b><br>

                    Ao utilizar o sistema, o usuário declara estar ciente e de acordo com os termos descritos neste documento, inclusive quanto ao uso e tratamento dos dados pessoais conforme a LGPD – Lei nº 13.709/2018.
                </p>

            </div>

            <center>
                <a class="button " data-close aria-label="Close modal" style="  border-radius: 10px   ; color:rgb(255, 255, 255); font-weight: bold;">
                    <h5 style="color:rgb(255, 255, 255);">Clique aqui para Fechar</h5>
                </a>
            </center>


        </div>
    </div>



    <button class="close-button" type="button">
        <span aria-hidden="true"></span>
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

                        <div id="todosContainers">

                            <!-- primeiro formulario, consulta cpf -->
                            <div class=" grid-x grid-padding-x" id="loginCPF">

                                <div class="small-12 large-12 cell">
                                    <form action="#">
                                        <label style="font-weight: bold;"> Digite o CPF para Iniciar a Sua Solicitação
                                            <input type="text" placeholder="Digite aqui seu CPF" class="cpf" id="cpf"
                                                onkeydown="mudarMascara(this.value)" value="" required />
                                        </label>

                                        <input type="submit" class="button succes" href="#" onclick="consultarCPF($('#cpf').val(),0 )"
                                            style="width: 100%;" value="Consultar">


                                        <a class="button succes" href="logar.php"
                                            style="width: 100%; background-color:rgb(10, 47, 67); font-weight: 400;">Acesso Corporativo </a>
                                        <br>
                                    </form>
                                </div>

                            </div>

                            <!-- login completo com usuario e senha-->
                            <div class=" grid-x grid-padding-x" id="logarCompleto">

                                <div class="small-12 large-12 cell">
                                    <form action="#">
                                        <label style="font-weight: bold;"> Digite o CPF para Iniciar o Agendamento
                                            <input type="text" placeholder="Digite aqui seu CPF" id="exibirCpf" readonly />
                                        </label>

                                        <label style="font-weight: bold;"> Digite sua senha para acessar!
                                            <input type="password" placeholder="Digite Sua Senha" id="senhaTxt" />
                                        </label>

                                        <input type="submit" class="button succes" href="#" onclick="logarUsuarioAgendamento($('#cpf').val(), $('#senhaTxt').val()  )"
                                            style="width: 100%;" value="Acessar o sistema">


                                        <a class="button succes" href="esqueciSenha.php" style="width: 100%; color: white;  background-color:rgb(17, 140, 115);">Esqueci Minha Senha</a>
                                        <br>
                                    </form>
                                </div>

                            </div>


                            <!-- segundo formulario, tela para cadastrar identificado completo -->
                            <div class="grid-x grid-padding-x" id="nomeUsuario">

                                <div class="small-12 large-12 cell" style="display: show;" id="camposAgendamentos">
                                    <label style="font-weight: bold; font-size: 1.3em;"> Vamos continuar seu agendamento! Digite seu nome
                                        <input type="text" placeholder="Digite aqui seu Aqui" class="nomeAgendamento"
                                            id="nomeAgendamento" />
                                    </label>

                                    <label style="font-weight: bold;  display: none; "> validacao tipo de usuario

                                        <input type="text" placeholder="Digite aqui seu  validador" class=""
                                            id="valida_tipo_cadastro" value='1' />
                                    </label>

                                    <label style="font-weight: bold;  font-size: 1.3em; " class="agendaCompleto"> Qual seu email?<br>

                                        <input type="text" placeholder="Digite aqui seu  Email Aqui"
                                            id="emailAgendamento" />
                                    </label>

                                    <label style="font-weight: bold;  font-size: 1.3em;" class="agendaCompleto"> Crie uma senha!

                                        <input type="password" placeholder="Crie uma senha "
                                            class="senhaAgendamento" />
                                    </label>



                                    <div class="grid-x grid-padding-x" id="">
                                        <div class="small-12 cell large-12" style="display: grid; align-items: center; justify-items: center;">



                                            <a class="button " style="font-size: 1.3em; color: white;  border-radius: 10px;  " onclick=" $('#termoUso').foundation('open');"> Clique aqui pra ler o Termo de uso</a>

                                            <br>
                                            <a style="font-size: 1.3em; color: black;">Li e Aceito o Termo de Uso &nbsp;<input id="confirmaTermo" type="checkbox" onclick="$('#confirmarInsercaoUsuario').toggle()"> </a>


                                        </div>
                                    </div>

                                    <br>

                                    <a class="button succes" id="confirmarInsercaoUsuario" href="#" onclick="inserirUsuario()" style="width: 100%;">Seguir
                                        para Agendamento</a>
                                    <br>
                                </div>


                            </div>




                            <!-- aqui faz o agendamento -->

                            <div class="grid-x grid-padding-x" id="formularioAgendamento">
                                <div class="small-12 cell large-12" style="display: none;">
                                    <br>
                                    <label class="labels"> CPF</label>
                                    <input type="text" name="txtCPF" id="txtCPF" readonly />

                                </div>

                                <div class="small-12 cell large-12" style="display: none;">
                                    <br>
                                    <label>idUsuario</label>
                                    <input type="text" name="txtIdUsuario" id="txtIdUsuario" readonly />

                                </div>

                                <div class="small-12 cell large-12">
                                    <label> Nome </label>

                                    <input type="text" name="txtNome" id="txtNome" value="" readonly />

                                </div>

                                <div class="small-12 cell large-12">

                                    <label> Em qual Unidade você deseja ser atendido? </label>

                                    <select id="selectUnidade" onchange="$('.comboHorarios').html('<option value=\'0\'>Selecione o dia acima para ver os horários</option>')   ;datasNaUnidade(0,0)">

                                    </select>

                                </div>
                                <div class="small-12 cell large-12" id="aparecerDatas">

                                </div>




                                <div class="small-12 medium-12  large-12 cell" id="horaDIV">
                                    <label>Que bom! Agora selecione a hora do seu Atendimento.</label>
                                    <select class="comboHorarios" onchange="     $('#concluirDIV').show();">
                                        <option value="0">Não Há horários para selecionar</option>

                                    </select>
                                </div>

                                <div class="small-12 cell large-12" id="tipoAgendamentoDiv">
                                    <label> Escolha o tipo de Atendimento </label>
                                    <select class="selectTipoAgendamento">
                                        <option value='1'>Atendimento da Prefeitura</option>
                                        <option value='2'>Atendimento da Profissionais</option>

                                    </select>

                                </div>


                                <div class="small-12 cell large-12">
                                    <Br>

                                    <a class="button  " onclick="registrarAgendamento()" id="concluirDIV"
                                        style="width: 100%; background-color: #28536b; color: white;">
                                        Concluir Agendamento
                                    </a>



                                </div>




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







        include 'telaSolicitacao.php';

        ?>

    </div>




    <script>
        $(document).ready(function() {
            $('#confirmarInsercaoUsuario').hide();

            $('#nomeUsuario').hide();
            $('#formularioAgendamento').hide();
            $('#campoMensagemAgendamentosAtivos').hide();

            $('#agendamentosRealizadosAtivos').hide();
            $('#horaDIV').hide();
            $('#tipoAgendamentoDiv').hide();
            $('#concluirDIV').hide();
            $('.agendaCompleto').hide();
            $('#logarCompleto').hide();




            <?php



            if (isset($_SESSION['usuariosLogados']['condicao']) &&  $_SESSION['usuariosLogados']['condicao'] == 1) {
                echo 'persist(1)';
            } else {
                echo 'persist(0)';
            }


            ?>




        })


        function persist(condicao) {


            if (condicao == 1) {
                $('#telaMaior').css('background-image', 'none');
                $('#telaMaior').css('background-color', '  rgb(216, 216, 219)')
                $('#containerCadastro').fadeOut(200).promise().done(function() {
                    setTimeout(() => {
                        $('#containerCadastraSolicitacao').fadeIn(1000);
                    }, 50)
                });
            } else {

            }
        }

        function consultarCPF(cpf, validador) {



            if (cpf.length == 0 || cpf.length == 1) {
                alert('insira o seu cpf ou cnpj');
                return false;
            }

            if (cpf.length != 18 && cpf.length != 14) {
                alert('Seu Documento está com erro! Tente novamente');
                return false;
            }

            if (cpf.length == 14) {
                if (validaCPF(cpf) == false) {
                    alert('Seu Documento está com erro! Tente novamente');
                    return false;
                }


            } else if (cpf.length == 18) {
                if (validaCNPJ(cpf) == false) {
                    alert('Seu Documento está com erro! Tente novamente');
                    return false;

                }
            }


            var formData = {
                cpf: cpf

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/verificadorController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                


                    console.log(data);


                    condicao = data.retornoCondicao.condicao;

                    console.log(condicao);
                    
                    if (condicao == false) {
                        //condição retornou false, a pessoa não ta cadastrada, abre o nome para gravar
                        $('#loginCPF').hide();
                        $('#nomeUsuario').delay('fast').fadeIn();


                        $('#camposAgendamentos').show()

                        $('.agendaCompleto').show()





                    } else {
                        //condição retornou true, então pode seguir para o agendamento. ta fa
 


                        //verificou se o cara é um usuario cadastrao para o completo e ai abre pra vir a senha
                        if (data.retornoCondicao.dados[0].valida_tipo_cadastro == 1) {



                            $('#loginCPF').hide();
                            $('#nomeUsuario').hide();

                            $('#logarCompleto').show();

                            $('#exibirCpf').val(cpf);






                        } else {
                            alert('sd');

                        }





                    }

                });



            event.preventDefault();
        }


        function logarUsuarioAgendamento(cpf, senha) {
            var formData = {
                cpf: cpf,
                senha: senha

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/logarUsuarioAgendamentoController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {

                    console.log(data);

                    condicao = data.retornoCondicao.condicao;
                    if (condicao == false) {


                        alert('Sua senha está incorreta');

                        $('#senhaTxt').val("");

                    } else {

                        location.reload();


                        $('#containerCadastro').fadeOut(200).promise().done(function() {
                            setTimeout(() => {
                                $('#containerCadastraSolicitacao').fadeIn(1000);

                            }, 50)

                        });
                        //condição retornou true, então pode seguir para o agendamento. ta fa


                        /*
                        $('#logarCompleto').hide();

                        $('#loginCPF').hide();
                        $('#nomeUsuario').hide();
                        $('#formularioAgendamento').show();

                        $('#txtNome').val(data.retornoCondicao.dados[0].nome_pessoa);
                        $('#txtCPF').val(cpf);
                        $('#txtIdUsuario').val(data.retornoCondicao.dados[0].id_pessoa);

                        comboUnidadesComum();
                        agendamentosAtivos(data.retornoCondicao.dados[0].id_pessoa);
                        */
                    }
                });



            event.preventDefault();
        }


        function inserirUsuario() {

            var valida_tipo_cadastro = $('#valida_tipo_cadastro').val();
            var nomeUsuario = $('#nomeAgendamento').val();
            var cpf = $('#cpf').val();
            var emailAgendamento = $('#emailAgendamento').val();
            var senhaAgendamento = $('.senhaAgendamento').val();

            var confirmaTermo = Boolean;




            if ($("#confirmaTermo").is(":checked") == true) {

                confirmaTermo = 1

            } else(
                confirmaTermo = 0
            )




            var formData = {
                cpf: cpf,
                nomeUsuario: nomeUsuario,
                valida_tipo_cadastro: valida_tipo_cadastro,
                emailAgendamento: emailAgendamento,
                senhaAgendamento: senhaAgendamento,
                confirmaTermo: confirmaTermo

            };
            var condicao;
            $.ajax({
                    type: 'POST',
                    url: 'ajax/inserirUsuarioController.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {
                    console.log(data);


                    if (data.retorno == 'nomeErrado') {


                        alert('Verifique se seu nome está Correto');
                        return false();


                    } else {




                        if (data.retorno == true) {

                            if (valida_tipo_cadastro == 1) {
                                $('#usuarioInserido').foundation('open');
                            }


                            consultarCPF(cpf, 1);
                        }
                    }

                });

            event.preventDefault();
        }



        function registrarAgendamento() {
            var comboHorarios = $('.comboHorarios').val();
            var selectUnidade = $('#selectUnidade').val();




            if (selectUnidade != 0) {
                if (comboHorarios != 0) {
                    var formData = {
                        registrarAgendamento: 1,
                        idUsuario: $('#txtIdUsuario').val(),
                        comboHorarios: comboHorarios,
                        selectUnidade: selectUnidade,
                        selectAgendamento: $('.selectTipoAgendamento').val(),
                        idStatus: '3'
                    };
                    var condicao;
                    $.ajax({
                            type: 'POST',
                            url: 'ajax/agendamentoController.php',
                            data: formData,
                            dataType: 'json',
                            encode: true
                        })
                        .done(function(data) {

                            console.log(data);

                            if (data.retorno == true) {
                                $('#formularioAgendamento').hide();
                                $('#modalSucesso').foundation('open');


                                var nomeString = $('.comboHorarios').val()
                                var resultadoEspaco = nomeString.split(" ");
                                console.log(resultadoEspaco);







                                $('.protocoloAgendamento').html('Seu Atendimento será às  ' + $('.comboHorarios')
                                    .val());
                                agendamentosAtivos($('#txtIdUsuario').val());





                                $('#nomeNoticia').html($('#txtNome').val())

                                //txtNome

                                //cpf


                            }
                        });
                    event.preventDefault();
                } else {
                    alert("Você deve selecionar um horário para seu atendimento");
                }
            } else {
                alert("Você deve selecionar uma unidade para seu atendimento");
            }
        }






        /*
        window.setTimeout(() => {
        window.location =
        "https://portaleducacao.guarulhos.sp.gov.br/wp_site/facil/paginaInicial/#";
        }, 4600);
        */

        //https://portalfacil.guarulhos.sp.gov.br/paginaInicial/


        //retorno das datas disponiveis da unidade
    </script>
</body>

</html>