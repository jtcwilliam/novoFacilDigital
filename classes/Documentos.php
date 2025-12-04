<?php



class Documentos
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $pdoConn;
    private $id_documento;
    private $idServico;
    private $status;



    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }

    public function  trazerDocumentos($filtro = null)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from documento ";

            if ($filtro != null) {
                $sql .= $filtro;
            }


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


    public function  trazerDocumentoArquivo($filtro)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select * from servico_documento dc inner join carta_servico c  on c.id_carta_servico = dc.id_servico  inner join documento dcm    on dcm.id_doc =  id_documento    where id_servico=" . $filtro;


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


    public function  montarArquivosDoComuniqueSe($idSolicitacao)
    {
        try {


            $pdo = $this->getPdoConn();

            $sql = "select  s.descricao_status, s.id_status   ,id_arquivo,nome_arquivo, ls.solicitante, p.nome_pessoa  from arquivo ar inner join status s   on ar.status_arquivo  = s.id_status inner join solicitacao ls on ls.id_solicitacao  = ar.id_solicitacao  inner join pessoa p on ls.solicitante  = p.id_pessoa  where ls.id_solicitacao =" . $idSolicitacao . "  and  status_arquivo in (12, 13) ";



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





    public function  inserirServicoDocumento()
    {
        try {

            $pdo = $this->getPdoConn();

            //
            $stmt = $pdo->prepare("INSERT INTO servico_documento(id_servico,id_documento, status) VALUES (:idservico,:id_documento,:idstatus)");

            // $stmt = $pdo->prepare("  UPDATE  pessoas SET pwd =  :senha  WHERE id_pessoa = :idPessoa   ");

            $stmt->bindValue(':idservico',  $this->getIdServico(), PDO::PARAM_STR);

            $stmt->bindValue(':id_documento',  $this->getIdDocumento(), PDO::PARAM_STR);

            $stmt->bindValue(':idstatus', $this->getStatus(), PDO::PARAM_STR);

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
     * Get the value of idServico
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set the value of idServico
     *
     * @return  self
     */
    public function setIdServico($idServico)
    {
        $this->idServico = $idServico;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of id_documento
     */
    public function getIdDocumento()
    {
        return $this->id_documento;
    }

    /**
     * Set the value of id_documento
     *
     * @return  self
     */
    public function setIdDocumento($id_documento)
    {
        $this->id_documento = $id_documento;

        return $this;
    }
}
