 
<fieldset class="fieldset" id="iniciosSolicitacao">
    <legend>
        <h3>Olá. Vamos fazer sua solicitação no Facil Digital</h3>
    </legend>
    <label>Informe abaixo uma palavra-chave relacionada à sua necessidade e indicaremos o serviço correspondente


        <div class="small-12 large-2 cell">
            <label>Digite aqui
                <input type="text" style="width: 100%;" id="txtConultaServicoInicial" onkeydown="consultaServicosInicial($('#txtConultaServicoInicial').val())" />
            </label>
        </div>



    </label>
    <div class="small-12 large-12 cell">
        

        <div id="retornoServicosEscolha" >

        </div>
         
    </div>


    <div class="small-12 large-12 cell">
        <br>
        <center>
            <a class="button " id="tudoCertoLink" target="_blank" style="font-weight: 300; width: 50%;" onclick="$('#iniciosSolicitacao').hide(); 
                         $('#fieldSolicitacao').show();   
                           $('#escolha').css('color', 'rgba(8, 124, 4, 0.66)');  
                           $('#complemento').css('color', 'rgba(0, 0, 0, 1)');  ">
                Tudo Certo! Quero continuar!
            </a>
        </center>
    </div>

    <input type="hidden" id="txtServicoSolicitar" value=""/>

</fieldset>


<script>
    function consultaServicosInicial(dadosServico) {


        if (dadosServico.length > 3) {

            var formData = {
                dadosServico,
                containner: 'comboServicos'

            };
            $.ajax({
                    type: 'POST',
                    url: 'ajax/solicitaServicosComboController.php',
                    data: formData,
                    dataType: 'html',
                    encode: true
                })
                .done(function(data) {

                    $('#retornoServicosEscolha').html(data);
                    //console.log(data);

                });

        }if(dadosServico.length <= 3){
                    $('#retornoServicosEscolha').html('');
            
        }


    }
</script>