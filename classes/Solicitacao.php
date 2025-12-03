<?php


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


class Solicitacao
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $pdoConn;

    private $email;
    private $telefone;
    private $nome;



    private $assuntoSolicitacao;
    private $descricaoSolicitacao;
    private $documentoPublico;
    private $dataSolicitacao;
    private $statusSolicitacao;
    private $solicitante;
    private $tipoDocumento;
    private $protocolo;
    private $arquivo;
    private $id_solicitacao;
    private $solicitacao;
    private $documentoSolicitante;
    private $idAtendente;
    private $cidade;
    private $autorizadosRequerimento;


    private $cepSolicitacao;
    private $logradouroSol;
    private $numeroSol;
    private $complemento;
    private $bairro;
    private $idRequerimento;
    private $codigoRequerimento;


    private $nomeTerceiro;
    private $documentoTerceiro;
    private $emailTerceiro;
    private $telefoneTerceiro;
    private $representaTerceiro;





    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }


    //

    public function  consultarSolicitacaoPorAtendente($idAtendente)
    {
        try {

            /*select        sl.id_carta_servico ,  sl.descricao_solicitacao , TO_CHAR(data_solicitacao, 'DD/MM/YY  ás  HH:Mi') as "dias", ar.nome_secretaria ,
            stt.descricao_status ,
            sl.id_solicitacao, sl.status_solicitacao      
            from solicitacao sl  inner join carta_servico cs on cs.id_nome_carta_servico  = sl.id_carta_servico   
            inner join area ar on ar.id_secretaria = cs.id_secretaria 
             inner join status stt on sl.status_solicitacao  = stt.id_status  
             inner join nome_carta_servico ncs on ncs.id_nome_carta_servico  = cs.id_carta_servico  
             
             
                    */


            $pdo = $this->getPdoConn();

            $sql = "select   sl.id_carta_servico ,  sl.descricao_solicitacao , TO_CHAR(data_solicitacao, 'DD/MM/YY  ás  HH:Mi') as \"dias\", 
            ar.nome_secretaria , stt.descricao_status , sl.id_solicitacao, sl.status_solicitacao from solicitacao sl  
            inner join carta_servico cs on cs.id_carta_servico  = sl.id_carta_servico  
            inner join area ar on ar.id_secretaria = cs.id_secretaria  
            inner join status stt on sl.status_solicitacao  = stt.id_status   
            inner join nome_carta_servico ncs on ncs.id_nome_carta_servico  = cs.id_nome_carta_servico  where   sl.id_atendente=" . $idAtendente;

            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultaSolicitacaoPorStatus($status)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select        sl.assuntoSolicitacao,  descricaoCarta, date_format(dataSolicitacao, '%d/%m/%Y  ás  %H:%i') as dias, nomeSecretaria,  stt.descricaoStatus , sl.id_solicitacao      from solicitacao sl 
             inner join status stt on sl.statusSolicitacao = stt.idStatus inner join linkCartaServico lcs on lcs.idlinkCartaServico = sl.assuntoSolicitacao 
             where sl.statussolicitacao in(" . $status . ")";



            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  trazerSolicitacao($protocolo)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from solicitacao sl inner join carta_servico cs  on cs.id_carta_servico = sl.id_carta_servico inner join pessoa ps on ps.id_pessoa = sl.solicitante  where  protocolo='" . $protocolo . "'";



            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //voltar aqui
    public function  pesquisarSolicitacoesPorCategoria($idCategoria)
    {
        try {


            $pdo = $this->getPdoConn();

            $sql = "select  id_solicitacao     , ncs.nome_servico   ,  sl.descricao_solicitacao  ,ncs.id_secretaria , sl.solicitante,
                    sl.tipo_documento , sl.documento_publico ,
                    dc.descricao_doc , ps.nome_pessoa, ps.email_usuario,    sl.id_carta_servico  ,  sl.cep_solicitacao ,  
                    sl.logradouro_sol ,  sl.numero_sol ,
                    sl.complemento, sl.bairro ,
                    TO_CHAR(data_solicitacao, 'DD') as dia,
 				TO_CHAR(data_solicitacao, 'MM') as mês,
				TO_CHAR(data_solicitacao, 'YY') as ano,
				TO_CHAR(data_solicitacao, 'DD/MM/YY') as \"diaDaSolicitacao\", sts.descricao_status , ct.descricao_categoria  
                    from solicitacao sl   
                    inner join carta_servico cs on cs.id_carta_servico  = sl.id_carta_servico 
                    inner join  nome_carta_servico ncs   on ncs.id_nome_carta_servico  = cs.id_nome_carta_servico 
                    inner join documento dc on dc.id_doc = sl.tipo_documento   inner join pessoa ps on ps.id_pessoa = sl.solicitante                     
                    inner join status sts on sts.id_status = sl.status_solicitacao                     
                    inner join categoria ct on ct.id_categoria   = cs.categoria_atendimento 
                    where  sl.status_solicitacao  = 10      order by TO_CHAR(data_solicitacao, 'DD/MM/YY') asc limit 1  ";


            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }

            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarSolicitacaoRelatorio($id_solicitacao)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = " select ncs.nome_servico ,  sl.descricao_solicitacao , ncs.id_secretaria , sl.solicitante, sl.tipo_documento ,
             sl.documento_publico , dc.descricao_doc , ps.nome_pessoa, ps.email_usuario, sl.doc_solicitacao_pessoal , sl.id_carta_servico 
                    from solicitacao sl inner join  carta_servico cs on cs.id_carta_servico = sl.id_carta_servico 
                    inner join nome_carta_servico ncs on ncs.id_nome_carta_servico = cs.id_nome_carta_servico            
                    inner join documento dc on dc.id_doc = sl.tipo_documento inner join pessoa ps on ps.id_pessoa = sl.solicitante 
                    where id_solicitacao = " . $id_solicitacao;



            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarRequerimento($idRequerimento)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = " select nome,cpfCnpj,telefone,email,cep,logradouro,numero,complemento, assinatura, statusRequerimento,
             cidade, solicitacao, bairro , autorizadosRequerimento from requerimentoAutomatico where codigoRequerimento = '" . $idRequerimento . "'";



            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  pesquisarAssinatura($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $sql = " select ncs.nome_servico   ,  sl.descricao_solicitacao  ,  sl.solicitante,
             sl.tipo_documento, sl.documento_publico,
              ps.nome_pessoa, ps.email_usuario, sl.doc_solicitacao_pessoal, /*sl.assuntoSolicitacao,*/
                sl.cep_solicitacao   ,  sl.logradouro_sol    ,  sl.numero_sol, 
                sl.complemento, sl.bairro ,
                TO_CHAR(data_solicitacao, 'DD') as dia,
 				TO_CHAR(data_solicitacao, 'MM') as mês,
				TO_CHAR(data_solicitacao, 'YY') as ano,
				sl.assinatura_solicitacao,d.descricao_doc,    assinatura_solicitacao,
                TO_CHAR(data_solicitacao, 'DD/MM/YYYY') as dia_da_solicitacao , sts.descricao_status
                from solicitacao sl inner join  carta_servico cs on cs.id_carta_servico = sl.id_carta_servico  
                inner join nome_carta_servico ncs on ncs.id_nome_carta_servico  = cs.id_nome_carta_servico 
                inner join pessoa ps on ps.id_pessoa = sl.solicitante 
                inner join documento d on d.id_doc = sl.tipo_documento 
                inner join status sts on sts.id_status = sl.status_solicitacao
                where sl.id_solicitacao =" . $id_solicitacao . "  and status_solicitacao in (10,11,12,13)   ";



            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  pesquisaManualAtendente($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $sql = " select * from  carta_servico cs   inner join servico_documento sd on cs.id_carta_servico = sd.id_servico 
            inner join documento dc on dc.id_doc = sd.id_documento 
            inner join nome_carta_servico ncs  on ncs.id_nome_carta_servico  = cs.id_nome_carta_servico 
            inner join solicitacao sl on sl.id_carta_servico = cs.id_carta_servico
             where servico_habilitado is not null and sl.id_solicitacao= " . $id_solicitacao;



            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  atribuirSolicitacaoAtendente()
    {
        try {

            $pdo = $this->getPdoConn();


            $idAtendente =   $this->getIdAtendente();
            $id_solicitacao = $this->getSolicitacao();
            $idStatusSolicitacao = $this->getStatusSolicitacao();

            $stmt = $pdo->prepare("  UPDATE solicitacao set id_atendente=?, status_solicitacao=?     where id_solicitacao=?");

            //corrigir isto aqui
            $stmt->bindParam(1,  $idAtendente, PDO::PARAM_INT);
            $stmt->bindParam(2,  $idStatusSolicitacao, PDO::PARAM_INT);
            $stmt->bindParam(3,  $id_solicitacao, PDO::PARAM_INT);





            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  mudarStatusSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();



            $idStatusSolicitacao = $this->getStatusSolicitacao();
            $id_solicitacao = $this->getIdSolicitacao();




            $stmt = $pdo->prepare("  UPDATE solicitacao set statusSolicitacao=?     where id_solicitacao=?");


            $stmt->bindParam(1,  $idStatusSolicitacao, PDO::PARAM_INT);
            $stmt->bindParam(2,  $id_solicitacao, PDO::PARAM_INT);






            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }







    public function  inserirAssinaturaSolicitacao($assinador)
    {
        try {

            $pdo = $this->getPdoConn();


            $arquivo =   $this->getArquivo();
            $id_solicitacao = $this->getSolicitacao();




            if ($assinador == 0) {
                $stmt = $pdo->prepare("  UPDATE solicitacao set assinatura_solicitacao=?, status_solicitacao=10   where id_solicitacao=?");
            } else {
                $stmt = $pdo->prepare("  UPDATE solicitacao set assinatura_terceiro=?, status_solicitacao=10   where id_solicitacao=?");
            }

            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $id_solicitacao, PDO::PARAM_INT);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  criarRequerimento()
    {
        try {

            $pdo = $this->getPdoConn();
            //


            $nomeValidador = $this->getNome();
            $status = 1;
            $stmt = $pdo->prepare(" INSERT INTO requerimentoAutomatico (statusRequerimento, codigoRequerimento)
             VALUES (?,?)");






            $stmt->bindParam(1,  $status, PDO::PARAM_INT);
            $stmt->bindParam(2,  $nomeValidador, PDO::PARAM_STR);











            //            \\





            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  gravarRequerimento()
    {
        try {

            $pdo = $this->getPdoConn();
            //
            $stmt = $pdo->prepare(" UPDATE requerimentoAutomatico set 
            nome=? ,cpfCnpj=? ,telefone=? ,email=? ,cep=? ,logradouro=?  ,numero=?  
            ,complemento=? , assinatura=? , statusRequerimento=? , cidade=? , solicitacao=? , bairro=?, autorizadosRequerimento=?  where codigoRequerimento=?");



            $nome = $this->getsolicitante();

            $cpfCnpj = $this->getDocumentoSolicitante();

            $telefone = $this->getTelefone();

            $email = $this->getEmail();

            $cep = $this->getCepSolicitacao();

            $logradouroSol = $this->getLogradouroSol();

            $numero = $this->getNumeroSol();

            $complemento = $this->getNumeroSol();

            $assinatura = $this->getArquivo();

            $statusRequerimento = $this->getStatusSolicitacao();

            $cidade = $this->getCidade();

            $solicitacao = $this->getSolicitacao();

            $bairroMorador = $this->getBairro();

            $nomeRandomico = $this->getCodigoRequerimento();

            $autorizadosRequerimento = $this->getAutorizadosRequerimento();


            $stmt->bindParam(1,  $nome, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $cpfCnpj, PDO::PARAM_STR);
            $stmt->bindParam(3,  $telefone, PDO::PARAM_STR);
            $stmt->bindParam(4,  $email, PDO::PARAM_STR);
            $stmt->bindParam(5,  $cep, PDO::PARAM_STR);
            $stmt->bindParam(6,  $logradouroSol, PDO::PARAM_STR);
            $stmt->bindParam(7,  $numero, PDO::PARAM_STR);
            $stmt->bindParam(8,  $complemento, PDO::PARAM_STR);
            $stmt->bindParam(9,  $assinatura, PDO::PARAM_LOB);
            $stmt->bindParam(10, $statusRequerimento, PDO::PARAM_INT);
            $stmt->bindParam(11, $cidade, PDO::PARAM_STR);
            $stmt->bindParam(12, $solicitacao, PDO::PARAM_STR);
            $stmt->bindParam(13, $bairroMorador, PDO::PARAM_STR);
            $stmt->bindParam(14, $autorizadosRequerimento, PDO::PARAM_STR);
            $stmt->bindParam(15, $nomeRandomico, PDO::PARAM_STR);











            //            \\





            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  gravarSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();
 
            //
            $stmt = $pdo->prepare(" INSERT INTO solicitacao (id_carta_servico,descricao_solicitacao, documento_publico,data_solicitacao,
            status_solicitacao,
             solicitante,tipo_documento, protocolo, doc_solicitacao_pessoal,  cep_solicitacao   ,  logradouro_sol   
              ,  numero_sol, complemento, bairro, nome_terceiro,  documento_terceiro,  email_terceiro, telefone_terceiro, representa_terceiro  )
             VALUES ( :assuntoSolicitacao,:descricaoSolicitacao, :documentoPublico, :dataSolicitacao,
              :statusSolicitacao, :solicitante, :tipoDocumento, :protocolo, :docSolicitacaoPessoal,  :cepSolicitacao, 
                :logradouroSol, :numeroSol,  :complemento,   :bairro, :nomeTerceiro,  :documentoTerceiro,  :emailTerceiro,  :telefoneTerceiro, :representaTerceiro )");

            $stmt->bindValue(':assuntoSolicitacao',  $this->getAssuntoSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':descricaoSolicitacao',  $this->getDescricaoSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':documentoPublico',  $this->getDocumentoPublico(), PDO::PARAM_STR);

            $stmt->bindValue(':dataSolicitacao',  $this->getDataSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':statusSolicitacao',  $this->getStatusSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':solicitante',  $this->getsolicitante(), PDO::PARAM_STR);

            $stmt->bindValue(':tipoDocumento',  $this->getTipoDocumento(), PDO::PARAM_STR);

            $stmt->bindValue(':protocolo',  $this->getProtocolo(), PDO::PARAM_STR);

            $stmt->bindValue(':docSolicitacaoPessoal',  $this->getDocumentoSolicitante(), PDO::PARAM_STR);
            //            //
            $stmt->bindValue(':cepSolicitacao',  $this->getCepSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':logradouroSol',  $this->getLogradouroSol(), PDO::PARAM_STR);

            $stmt->bindValue(':numeroSol',  $this->getNumeroSol(), PDO::PARAM_STR);

            $stmt->bindValue(':complemento',  $this->getComplemento(), PDO::PARAM_STR);

            $stmt->bindValue(':bairro',  $this->getBairro(), PDO::PARAM_STR);

            $stmt->bindValue(':nomeTerceiro',  $this->getNomeTerceiro(), PDO::PARAM_STR);

            $stmt->bindValue(':documentoTerceiro',  $this->getDocumentoTerceiro(), PDO::PARAM_STR);

            $stmt->bindValue(':emailTerceiro',  $this->getEmailTerceiro(), PDO::PARAM_STR);

            $stmt->bindValue(':telefoneTerceiro',  $this->getTelefoneTerceiro(), PDO::PARAM_STR);

            $stmt->bindValue(':representaTerceiro',  $this->getRepresentaTerceiro(), PDO::PARAM_STR);

 



 




            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    function getConexao()
    {
        return $this->conexao;
    }



    function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }







    /**
     * Get the value of dns
     */
    public function getDns()
    {
        return $this->dns;
    }

    /**
     * Set the value of dns
     *
     * @return  self
     */
    public function setDns($dns)
    {
        $this->dns = $dns;

        return $this;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }



    /**
     * Get the value of pdoConn
     */
    public function getPdoConn()
    {
        return $this->pdoConn;
    }

    /**
     * Set the value of pdoConn
     *
     * @return  self
     */
    public function setPdoConn($pdoConn)
    {
        $this->pdoConn = $pdoConn;

        return $this;
    }



    /**
     * Get the value of assuntoSolicitacao
     */
    public function getAssuntoSolicitacao()
    {
        return $this->assuntoSolicitacao;
    }

    /**
     * Set the value of assuntoSolicitacao
     *
     * @return  self
     */
    public function setAssuntoSolicitacao($assuntoSolicitacao)
    {
        $this->assuntoSolicitacao = $assuntoSolicitacao;

        return $this;
    }

    /**
     * Get the value of descricaoSolicitacao
     */
    public function getDescricaoSolicitacao()
    {
        return $this->descricaoSolicitacao;
    }

    /**
     * Set the value of descricaoSolicitacao
     *
     * @return  self
     */
    public function setDescricaoSolicitacao($descricaoSolicitacao)
    {
        $this->descricaoSolicitacao = $descricaoSolicitacao;

        return $this;
    }

    /**
     * Get the value of documentoPublico
     */
    public function getDocumentoPublico()
    {
        return $this->documentoPublico;
    }

    /**
     * Set the value of documentoPublico
     *
     * @return  self
     */
    public function setDocumentoPublico($documentoPublico)
    {
        $this->documentoPublico = $documentoPublico;

        return $this;
    }

    /**
     * Get the value of dataSolicitacao
     */
    public function getDataSolicitacao()
    {
        return $this->dataSolicitacao;
    }

    /**
     * Set the value of dataSolicitacao
     *
     * @return  self
     */
    public function setDataSolicitacao($dataSolicitacao)
    {
        $this->dataSolicitacao = $dataSolicitacao;

        return $this;
    }

    /**
     * Get the value of statusSolicitacao
     */
    public function getStatusSolicitacao()
    {
        return $this->statusSolicitacao;
    }

    /**
     * Set the value of statusSolicitacao
     *
     * @return  self
     */
    public function setStatusSolicitacao($statusSolicitacao)
    {
        $this->statusSolicitacao = $statusSolicitacao;

        return $this;
    }

    /**
     * Get the value of solicitante
     */
    public function getsolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set the value of solicitante
     *
     * @return  self
     */
    public function setsolicitante($solicitante)
    {
        $this->solicitante = $solicitante;

        return $this;
    }

    /**
     * Get the value of tipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set the value of tipoDocumento
     *
     * @return  self
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get the value of protocolo
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set the value of protocolo
     *
     * @return  self
     */
    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * Get the value of arquivo
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get the value of solicitacao
     */
    public function getSolicitacao()
    {
        return $this->solicitacao;
    }

    /**
     * Set the value of solicitacao
     *
     * @return  self
     */
    public function setSolicitacao($solicitacao)
    {
        $this->solicitacao = $solicitacao;

        return $this;
    }

    /**
     * Get the value of documentoSolicitante
     */
    public function getDocumentoSolicitante()
    {
        return $this->documentoSolicitante;
    }

    /**
     * Set the value of documentoSolicitante
     *
     * @return  self
     */
    public function setDocumentoSolicitante($documentoSolicitante)
    {
        $this->documentoSolicitante = $documentoSolicitante;

        return $this;
    }

    /**
     * Get the value of cepSolicitacao
     */
    public function getCepSolicitacao()
    {
        return $this->cepSolicitacao;
    }

    /**
     * Set the value of cepSolicitacao
     *
     * @return  self
     */
    public function setCepSolicitacao($cepSolicitacao)
    {
        $this->cepSolicitacao = $cepSolicitacao;

        return $this;
    }

    /**
     * Get the value of logradouroSol
     */
    public function getLogradouroSol()
    {
        return $this->logradouroSol;
    }

    /**
     * Set the value of logradouroSol
     *
     * @return  self
     */
    public function setLogradouroSol($logradouroSol)
    {
        $this->logradouroSol = $logradouroSol;

        return $this;
    }

    /**
     * Get the value of numeroSol
     */
    public function getNumeroSol()
    {
        return $this->numeroSol;
    }

    /**
     * Set the value of numeroSol
     *
     * @return  self
     */
    public function setNumeroSol($numeroSol)
    {
        $this->numeroSol = $numeroSol;

        return $this;
    }

    /**
     * Get the value of complemento
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return  self
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get the value of bairro
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of idAtendente
     */
    public function getIdAtendente()
    {
        return $this->idAtendente;
    }

    /**
     * Set the value of idAtendente
     *
     * @return  self
     */
    public function setIdAtendente($idAtendente)
    {
        $this->idAtendente = $idAtendente;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of id_solicitacao
     */
    public function getIdSolicitacao()
    {
        return $this->id_solicitacao;
    }

    /**
     * Set the value of id_solicitacao
     *
     * @return  self
     */
    public function setIdSolicitacao($id_solicitacao)
    {
        $this->id_solicitacao = $id_solicitacao;

        return $this;
    }

    /**
     * Get the value of idRequerimento
     */
    public function getIdRequerimento()
    {
        return $this->idRequerimento;
    }

    /**
     * Set the value of idRequerimento
     *
     * @return  self
     */
    public function setIdRequerimento($idRequerimento)
    {
        $this->idRequerimento = $idRequerimento;

        return $this;
    }

    /**
     * Get the value of codigoRequerimento
     */
    public function getCodigoRequerimento()
    {
        return $this->codigoRequerimento;
    }

    /**
     * Set the value of codigoRequerimento
     *
     * @return  self
     */
    public function setCodigoRequerimento($codigoRequerimento)
    {
        $this->codigoRequerimento = $codigoRequerimento;

        return $this;
    }

    /**
     * Get the value of nomeTerceiro
     */
    public function getNomeTerceiro()
    {
        return $this->nomeTerceiro;
    }

    /**
     * Set the value of nomeTerceiro
     *
     * @return  self
     */
    public function setNomeTerceiro($nomeTerceiro)
    {
        $this->nomeTerceiro = $nomeTerceiro;

        return $this;
    }

    /**
     * Get the value of documentoTerceiro
     */
    public function getDocumentoTerceiro()
    {
        return $this->documentoTerceiro;
    }

    /**
     * Set the value of documentoTerceiro
     *
     * @return  self
     */
    public function setDocumentoTerceiro($documentoTerceiro)
    {
        $this->documentoTerceiro = $documentoTerceiro;

        return $this;
    }

    /**
     * Get the value of emailTerceiro
     */
    public function getEmailTerceiro()
    {
        return $this->emailTerceiro;
    }

    /**
     * Set the value of emailTerceiro
     *
     * @return  self
     */
    public function setEmailTerceiro($emailTerceiro)
    {
        $this->emailTerceiro = $emailTerceiro;

        return $this;
    }

    /**
     * Get the value of telefoneTerceiro
     */
    public function getTelefoneTerceiro()
    {
        return $this->telefoneTerceiro;
    }

    /**
     * Set the value of telefoneTerceiro
     *
     * @return  self
     */
    public function setTelefoneTerceiro($telefoneTerceiro)
    {
        $this->telefoneTerceiro = $telefoneTerceiro;

        return $this;
    }

    /**
     * Get the value of representaTerceiro
     */
    public function getRepresentaTerceiro()
    {
        return $this->representaTerceiro;
    }

    /**
     * Set the value of representaTerceiro
     *
     * @return  self
     */
    public function setRepresentaTerceiro($representaTerceiro)
    {
        $this->representaTerceiro = $representaTerceiro;

        return $this;
    }

    /**
     * Get the value of autorizadosRequerimento
     */
    public function getAutorizadosRequerimento()
    {
        return $this->autorizadosRequerimento;
    }

    /**
     * Set the value of autorizadosRequerimento
     *
     * @return  self
     */
    public function setAutorizadosRequerimento($autorizadosRequerimento)
    {
        $this->autorizadosRequerimento = $autorizadosRequerimento;

        return $this;
    }
}
