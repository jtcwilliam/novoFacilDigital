<?php



class Arquivo
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $arquivo;

    private $pdoConn;
    private $id_arquivo;
    private $nome_arquivo;
    private $tipo_arquivo;
    private $id_solicitacao;
    private $status_arquivo;
    private $estiloArquivo;
    private $id_tipo_documento;
    private $codigoTrocaArquivo;
    private $assinado_digital;

    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }


    public function  consultarListaAquivosNecessarios($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select * from servico_documento sd inner join documento dc on dc.id_doc = sd.id_documento
                                where id_servico in(
                                select  sl.id_carta_servico
                                     from solicitacao sl inner join carta_servico cs 
                                on cs.id_carta_servico = sl.id_carta_servico
                                where id_solicitacao = " . $id_solicitacao . ")");

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarDadosArquivosParaInfo($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select  id_arquivo ,nome_arquivo, tipo_arquivo, id_tipo_documento, status_arquivo  from arquivo where id_solicitacao =" . $id_solicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultaArquivosParaComuniquese($id_solicitacao, $id_tipo_documento)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select  arquivo ,id_arquivo ,nome_arquivo, tipo_arquivo, id_tipo_documento, status_arquivo, st.descricao_status, assinado_digital 
             from arquivo ar inner join status st on ar.status_arquivo = st.id_status  where id_solicitacao =" . $id_solicitacao . " 
               and  id_tipo_documento=" . $id_tipo_documento);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  dadosArquivoSolicitante($id_arquivo)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select  ar.id_arquivo ,sl.solicitante, ps.nome_pessoa ,  nome_arquivo from solicitacao sl inner join pessoa ps on ps.id_pessoa = sl.solicitante 
 INNER join arquivo ar on ar.id_solicitacao  = sl.id_solicitacao where ar.id_arquivo =" . $id_arquivo);


            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    public function  gerarArquivo($id_arquivo)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select arquivo, nome_arquivo, tipo_arquivo  from arquivo where id_arquivo =" . $id_arquivo);


            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  solicitarArquivoRelatorio($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select lc.descricaoCarta,  sl.descricaoSolicitacao  ,lc.nomeSecretaria, sl.solicitante,
             sl.tipoDocumento, sl.documentoPublico,  nome_arquivo, tipo_arquivo, ar.arquivo, 
 dc.descricaoDoc, ps.nome_pessoa, ps.email_usuario, sl.docSolicitacaoPessoal, sl.assuntoSolicitacao,  sl.cepSolicitacao   ,  sl.logradouroSol    ,  sl.numeroSol,
  sl.complemento, sl.bairro , sl.representaTerceiro    ,    sl.nomeTerceiro,  sl.documentoTerceiro , sl.emailTerceiro, sl.telefoneTerceiro , 
  date_format(dataSolicitacao, '%d ' ) as 'dias', 

  date_format(dataSolicitacao, '%M' ) as 'mes', 

  date_format(dataSolicitacao, ' de %Y ' ) as 'ano', sl.assinaturaSolicitacao, sl.assinaturaTerceiro, sl.nomeTerceiro  
 
 
  from solicitacao sl inner join  linkCartaServico lc on lc.idlinkCartaServico = sl.assuntoSolicitacao 
 inner join documento dc on dc.idDoc = sl.tipoDocumento inner join pessoas ps on ps.id_pessoa = sl.solicitante 
 INNER join arquivo ar on ar.id_solicitacao  = sl.id_solicitacao where sl.id_solicitacao =" . $id_solicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultarArquivoParaSolicitacao($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select   nome_arquivo, tipo_arquivo, arquivo from arquivo where id_solicitacao =" . $id_solicitacao);

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  consultarArquivoParaSolicitacaoRelatorio($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select   nome_arquivo, tipo_arquivo, arquivo from arquivo where  assinado_digital !=1 and  id_solicitacao =" . $id_solicitacao);

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  consultarArquivoParaSolicitacaoTeste($id_arquivo)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  select   nome_arquivo, tipo_arquivo, arquivo from arquivo where id_arquivo =" . $id_arquivo);

            $stmt->execute();

            $datasDisponiveis = $stmt->fetchAll();

            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarQuantidadeArquivo($id_solicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select arquivo from arquivo where id_solicitacao =" . $id_solicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  inserirArquivos()
    {
        try {


            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $arquivo =   $this->getArquivo();
            $arquivoTipo = $this->getTipoArquivo();
            $nome_arquivo = $this->getNomeArquivo();
            $id_solicitacao = $this->getIdSolicitacao();
            $status_arquivo = $this->getStatusArquivo();
            $id_tipo_documento = $this->getIdTipoDocumento();
            $assinado_digital = $this->getAssinadoDigital();



            $stmt = $pdo->prepare("  INSERT INTO  arquivo ( arquivo, tipo_arquivo, nome_arquivo, id_solicitacao, status_arquivo, id_tipo_documento,assinado_digital    )   values (?,?,?,?,?, ?,?) RETURNING  id_arquivo  ");


            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $arquivoTipo, PDO::PARAM_LOB);
            $stmt->bindParam(3,  $nome_arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(4,  $id_solicitacao, PDO::PARAM_INT);
            $stmt->bindParam(5,  $status_arquivo, PDO::PARAM_INT);
            $stmt->bindParam(6,  $id_tipo_documento, PDO::PARAM_INT);
            $stmt->bindParam(7,  $assinado_digital, PDO::PARAM_INT);








            if ($stmt->execute()) {

                $newUserId = $stmt->fetchColumn();


                return json_encode(array('ultimoID' => $newUserId, 'retorno' => true));


                //return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  apagarArquivo()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id_arquivo =   $this->getIdArquivo();
            $id_status = $this->getStatusArquivo();



            $stmt = $pdo->prepare("  UPDATE arquivo set   status_arquivo=:status_arquivo  where id_arquivo = :id_arquivo ");

            //corrigir isto aqui
            $stmt->bindParam(':id_arquivo',  $id_arquivo, PDO::PARAM_INT);
            $stmt->bindParam(':status_arquivo',  $id_status, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  informarAssinatura()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id_arquivo =   $this->getIdArquivo();
            $assinado_digital = $this->getAssinadoDigital();






            $stmt = $pdo->prepare("  UPDATE arquivo set assinado_digital = ?   where id_arquivo = ? ");

            //corrigir isto aqui

            $stmt->bindParam(1,  $assinado_digital, PDO::PARAM_INT);
            $stmt->bindParam(2,  $id_arquivo, PDO::PARAM_INT);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    //area de atualizacao de arquivo do comunique-se que envia do email
    public function  atualizarAquivoSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id_arquivo =   $this->getIdArquivo();
            $arquivo = $this->getArquivo();
            $tipo_arquivo = $this->getTipoArquivo(



            );
            $statusArquivo = $this->getStatusArquivo();



            $stmt = $pdo->prepare("  UPDATE arquivo set arquivo = ?, tipo_arquivo=?,  status_arquivo=? where id_arquivo = ?");



            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_INT);
            $stmt->bindParam(2,  $tipo_arquivo, PDO::PARAM_STR);
            $stmt->bindParam(3,  $statusArquivo, PDO::PARAM_INT);
            $stmt->bindParam(4,  $id_arquivo, PDO::PARAM_INT);

            if ($stmt->execute()) {

                $stmt_b = $pdo->prepare("  UPDATE log set status_log=1 where id_arquivo =:idArquivo ");


                $stmt_b->bindParam(':idArquivo',  $id_arquivo, PDO::PARAM_INT);

                if ($stmt_b->execute()) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  atualizarAquivoSolicitacaoSolicitadoComuniqueSe()
    {
        try {



            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $arquivo = $this->getArquivo();
            $tipo_arquivo = $this->getTipoArquivo();
            $id_tipo_documento = $this->getIdTipoDocumento();
            $idTrocaArquivo = $this->getCodigoTrocaArquivo();

            $stmt = $pdo->prepare("  UPDATE arquivo set arquivo = ?, tipo_arquivo=?, id_tipo_documento=?, status_arquivo='1'  where tipo_arquivo = ?");





            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $tipo_arquivo, PDO::PARAM_STR);
            $stmt->bindParam(3,  $id_tipo_documento, PDO::PARAM_INT);
            $stmt->bindParam(4,  $idTrocaArquivo, PDO::PARAM_STR);

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
     * Get the value of nome_arquivo
     */
    public function getNomeArquivo()
    {
        return $this->nome_arquivo;
    }

    /**
     * Set the value of nome_arquivo
     *
     * @return  self
     */
    public function setNomeArquivo($nome_arquivo)
    {
        $this->nome_arquivo = $nome_arquivo;

        return $this;
    }

    /**
     * Get the value of tipo_arquivo
     */
    public function getTipoArquivo()
    {
        return $this->tipo_arquivo;
    }

    /**
     * Set the value of tipo_arquivo
     *
     * @return  self
     */
    public function setTipoArquivo($tipo_arquivo)
    {
        $this->tipo_arquivo = $tipo_arquivo;

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
     * Get the value of status_arquivo
     */
    public function getStatusArquivo()
    {
        return $this->status_arquivo;
    }

    /**
     * Set the value of status_arquivo
     *
     * @return  self
     */
    public function setStatusArquivo($status_arquivo)
    {
        $this->status_arquivo = $status_arquivo;

        return $this;
    }

    /**
     * Get the value of id_arquivo
     */
    public function getIdArquivo()
    {
        return $this->id_arquivo;
    }

    /**
     * Set the value of id_arquivo
     *
     * @return  self
     */
    public function setIdArquivo($id_arquivo)
    {
        $this->id_arquivo = $id_arquivo;

        return $this;
    }

    /**
     * Get the value of estiloArquivo
     */
    public function getEstiloArquivo()
    {
        return $this->estiloArquivo;
    }

    /**
     * Set the value of estiloArquivo
     *
     * @return  self
     */
    public function setEstiloArquivo($estiloArquivo)
    {
        $this->estiloArquivo = $estiloArquivo;

        return $this;
    }

    /**
     * Get the value of id_tipo_documento
     */
    public function getIdTipoDocumento()
    {
        return $this->id_tipo_documento;
    }

    /**
     * Set the value of id_tipo_documento
     *
     * @return  self
     */
    public function setIdTipoDocumento($id_tipo_documento)
    {
        $this->id_tipo_documento = $id_tipo_documento;

        return $this;
    }

    /**
     * Get the value of codigoTrocaArquivo
     */
    public function getCodigoTrocaArquivo()
    {
        return $this->codigoTrocaArquivo;
    }

    /**
     * Set the value of codigoTrocaArquivo
     *
     * @return  self
     */
    public function setCodigoTrocaArquivo($codigoTrocaArquivo)
    {
        $this->codigoTrocaArquivo = $codigoTrocaArquivo;

        return $this;
    }

    /**
     * Get the value of assinado_digital
     */
    public function getAssinadoDigital()
    {
        return $this->assinado_digital;
    }

    /**
     * Set the value of assinado_digital
     *
     * @return  self
     */
    public function setAssinadoDigital($assinado_digital)
    {
        $this->assinado_digital = $assinado_digital;

        return $this;
    }
}
