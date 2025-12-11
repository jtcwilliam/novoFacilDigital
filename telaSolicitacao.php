<?php
/*
echo '<pre>';
print_r($_SESSION['usuariosLogados']);
echo '</pre>';
*/


?>


<div class="small-12 large-12 cell" style="padding: 30px;">

    <div class=" grid-x grid-padding-x">
        <div class="small-12 large-12 cell">



            <fieldset class="fieldset" id="aberturaSolicitacao">
                <legend>
                    <h3>Olá. Seja bem vindo ao + Digital</h3>
                </legend>



                <div class="small-12 large-12 cell">
                    <br>

                    <a class="button " target="_blank" style="font-weight: 300; width: 100%;" onclick=" $('#iniciosSolicitacao').show();   $('#aberturaSolicitacao').hide(); ">
                        Abrir uma nova Solicitação
                    </a>

                </div>



                <div class="small-12 large-12 cell">


                    <fieldset class="fieldset">
                        <legend>
                            <h4>Solicitações em Andamento</h4>
                        </legend>



                        <div id="solicitacaoStatusContainer" style="background-color: gray;">


                        </div>


                    </fieldset>

                </div>











            </fieldset>




            <!-- combo com a carta de serviço.. inicial  . -->


            <?php

            include_once 'comps/comboSelecaoServico.php';


            ?>



            <!-- area para fazer a solicitacao-->


            <?php

            include_once 'comps/telaSolicitacao.php';

            ?>

            <!-- fim da area da solicitacao -->


            <!-- area dos campos de  documentacao -->

            <?php

            include_once 'comps/telaDocumentacao.php';

            ?>


            <!-- fim campo documentacao -->


            <!-- inicio do campo assinatura  -->

            <?php


            include_once 'comps/telaAssinatura.php';

            ?>

            <!-- fim do campo assinatura -->

            <fieldset class="fieldset" id="finalizacaoSolicitacao">


                <legend>
                    <h4 id="">Sua Solicitação foi cadastrada com sucesso</h4>

                </legend>
                <br>
                <div class=" grid-x grid-padding-x" style="display: block; margin-top: -60px;">

                </div>

                <div class=" grid-x grid-padding-x" style="display: block; margin-top: -60px;">
                    <div class="small-12 large-12 cell" style="width: 100%;  " id="solicitacaoFinalizada">




                    </div>

                    <div class="small-12 large-12 cell" style="width: 100%;  " id="solicitacaoFinalizada">




                    </div>


                </div>


            </fieldset>



            <fieldset class="fieldset" id="estagios">

                <div class=" grid-x grid-padding-x">
                    <div class="small-12 large-3 cell">


                    </div>


                    <center>
                        <div class=" grid-x grid-padding-x">
                            <div class="small-12 large-2 cell" id="escolha"> <b>1</b><br>
                                <i>Escolha da Solicitação</i>
                            </div>

                            <div class="small-12 large-2 cell" id="complemento" style="color: #999;"> <b>2</b><br>
                                <i>Complemento da Solicitação</i>
                            </div>

                            <div class="small-12 large-2 cell" id="docsEstagio" style="color: #999;"> <b>3</b><br>
                                <i id="docsEstagio">Documentação Necessária</i>
                            </div>

                            <div class="small-12 large-2 cell" id="finalizacao" style="color: #999;"> <b>4</b><br>
                                <i>Assinatura</i>
                            </div>

                            <div class="small-12 large-2 cell" id="solicitacaoEnviada" style="color: #999;"> <b>5</b><br>
                                <i>Solicitação Enviada</i>
                            </div>
                        </div>
                    </center>


                    <div class="small-12 large-12 cell" id="botaoRetorno">
                        <center><a class="button " style="width: 40%; margin-top: 40px;  " onclick="window.location.reload()">Voltar para a tela inicial das Solicitações</a></center>
                    </div>
                </div>

                <div class="small-12 large-3 cell">


                </div>
        </div>






        </fieldset>








    </div>




</div>
</div>

<script>
    $('#linkHelpServico').hide();
    $('#iniciosSolicitacao').hide();
    $('#fieldSolicitacao').hide();
    $('#boxTerceiro').hide();
    $('#documentacao').hide();
    $('.mensagemB').hide();
    $('#arquivosAnexosSucesso').hide();
    $('#envioAssinatura').hide();
    $('#finalizacaoSolicitacao').hide();
    $('#txtCEP').mask("00000-000");

    $('#botaoRetorno').hide();
    $('#tudoCertoLink').hide();



    consultarSolicitacaoStatus('10, 11');




    function clonarClasse() {
        var elementoParaClonar = $('#boxPessoas');

        // 2. Clona o elemento, incluindo seus descendentes e nós de texto (cópia profunda)
        var elementoClonado = elementoParaClonar.clone(false, false); // O 'true, true' garante a cópia de eventos e descendentes

        // 3. Adiciona o elemento clonado ao final da div com a classe "container"
        elementoClonado.appendTo('#containerClone');
    }


    function trocaCampo(valor) {

        if (valor === '35') {
            $('#boxInsc').show();

            $('#tipoInscricaoLbl').html('IPTU');

            $('#inscDocu').mask("00.0000.0000.0000");

        } else if (valor === '36') {

            $('#boxInsc').show();
            $('#tipoInscricaoLbl').html('Inscrição Mobiliária');


            $('#inscDocu').mask("000.000.000.000");

        } else if (valor === '37') {

            $('#boxInsc').show();
            $('#tipoInscricaoLbl').html('Cadastro');


            $('#inscDocu').mask("0000000000000000");

        } else {
            $('#tipoInscricaoLbl').html('Outros');


            $('#inscDocu').mask("000000000000000    00000000");

        }

        return true;

    }

    function inserirSolicitacao(solicitante) {
        let infos;
        let pessoa = [];
        $('.atuarPessoa').each(function() {
            emailAtuar = $(this).find('.emailAtuar').val();
            nomeAtuar = $(this).find('.nomeAtuar').val();
            celularAtuar = $(this).find('.celularAtuar').val();

            infos = `Nome: ${nomeAtuar}. Email ${emailAtuar}. Celular  ${celularAtuar } `;
            pessoa.push(infos);
         

        })

        console.log(pessoa);
        

        var formData = {
            representaTerceiro: $('#representaTerceiro').val(),
            nomeTerceiro: $('#nomeTerceiro').val(),
            cpfTerceiro: $('#cpfTerceiro').val(),
            emailTerceiro: $('#emailTerceiro').val(),
            telefoneTerceiro: $('#telefoneTerceiro').val(),

            //alterar o nome para idServicos
            assuntoSolicitacao: $('#txtServicoSolicitar').val(),
            descricao: $('#txtDescricao').val(),
            documentoPublico: $('#inscDocu').val(),
            comboTipoInscricao: $('#comboTipoInscricao').val(),
            idUsuario: solicitante,
            statusSolicitacao: 9,
            inserirSolicitacao: 0,
            cpfSolicitante: $('#cpfSolicitante').val(),
            txtCEP: $('#txtCEP').val(),
            txtRua: $('#txtRua').val(),
            txtNUmero: $('#txtNUmero').val(),
            txtComplemento: $('#txtComplemento').val(),
            txtBairro: $('#txtBairro').val(),
            representantes: pessoa


        };
        $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                console.log(data);


                if (data.retorno == true) {
                    $('#idSolicitacaoHidden').val(data.idSolicitacaoHidden);
                    $('#documentacao').show();
                    $('#fieldSolicitacao').hide();
                    $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)');
                    $('#complemento').css('color', 'rgba(8, 124, 4, 0.66)');
                    $('#docsEstagio').css('color', 'rgba(0, 0, 0, 1)');
                }
            });
    }

    function qrCodeAssinatura(link) {

        var formData = {
            link

        };
        $.ajax({
                type: 'POST',
                url: 'qrcode.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                console.log(data);


                $('#img').html(data);


            });
    }


    function verificarAssinatura(idSolicitacao) {

        var formData = {
            idSolicitacao,
            verificarAssinatura: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'json',
                encode: true
            })
            .done(function(data) {

                if (data.retorno == 10) {

                    $('#envioAssinatura').hide();



                }

            });
    }







    //solicitacaoStatusContainer

    function consultarSolicitacaoStatus(idStatus) {

        var formData = {
            idStatus,

            trazerSolicitacaoStatus: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/solicitacaoController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {
                $('#solicitacaoStatusContainer').html(data);
            });
    }



    function finalizarSolicitacao(idSolicitacao) {

        var formData = {
            idSolicitacao,

            finalizaSolicitacao: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                $('#envioAssinatura').hide();

                $('#finalizacaoSolicitacao').show();

                $('#botaoRetorno').show();

                $('#solicitacaoFinalizada').html(data);

            });
    }



    function exibirSolicitacao(idSolicitacao) {

        $('#exibirSolicitacoes').foundation('open');

        var formData = {
            idSolicitacao,

            finalizaSolicitacao: '1'

        };
        $.ajax({
                type: 'POST',
                url: 'ajax/salvaAssinaturaController.php',
                data: formData,
                dataType: 'html',
                encode: true
            })
            .done(function(data) {

                $('#envioAssinatura').hide();



                $('#exibirSolicitacaoModal').html(data);

            });
    }
</script>