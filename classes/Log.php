<?php



class Log
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $pdoConn;


    private $idLog;
    private $nomeLog;
    private $textoLog;
    private $statusLog;
    private $dataLog;
    private $solicitacao;
    private $idPessoaLog;
    private $nome_pessoaLog;

    private $tipo_pessoaLog;
    private $idArquivo;


    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }


    public function  trazerCategorias($filtro = null)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from categoria ";

            if ($filtro != null) {
                $sql .=  $filtro;
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



    public function  inserirLog()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $usuarioLog =   $this->getnome_pessoaLog();
            $nomeLog = $this->getNomeLog();
            $textoLog = $this->getTextoLog();
            $statusLog = $this->getStatusLog();
            $dataLog = $this->getDataLog();
            $tipo_pessoa = $this->gettipo_pessoaLog();
            $idSolicitacao = $this->getSolicitacao();
            $idArquivo = $this->getIdArquivo();

            $stmt = $pdo->prepare("  INSERT INTO  log (nome_pessoa_log, nome_log,texto_log , status_log , data_log, id_solicitacao ,tipo_pessoa_log, id_arquivo   )   values (?,?,?,?,?,?,?,?) ");

            $sql = "  INSERT INTO  log (nome_pessoa_log, nome_log,texto_log , status_log , data_log, id_solicitacao ,tipo_pessoa_log, id_arquivo   )  
 values ('" . $usuarioLog . "','" . $nomeLog . "','" . $textoLog . "','" . $statusLog . "','" . $dataLog . "','" . $idSolicitacao . "','" . $tipo_pessoa . "','" . $idArquivo . "') ";

            echo $sql;

            //corrigir isto aqui
            $stmt->bindParam(1,  $usuarioLog, PDO::PARAM_LOB); //

            $stmt->bindParam(2,  $nomeLog, PDO::PARAM_LOB); //

            $stmt->bindParam(3,  $textoLog, PDO::PARAM_LOB); //

            $stmt->bindParam(4,  $statusLog, PDO::PARAM_LOB); //

            $stmt->bindParam(5,  $dataLog, PDO::PARAM_LOB); //

            $stmt->bindParam(6,  $idSolicitacao, PDO::PARAM_LOB); //

            $stmt->bindParam(7,  $tipo_pessoa, PDO::PARAM_LOB); //

            $stmt->bindParam(8,  $idArquivo, PDO::PARAM_LOB); //

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    public function  exibirLogs($idSolicitacao, $id)
    {

        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select * from log where statusLog != $id and  idSolicitacao = $idSolicitacao    ");

            $stmt->execute();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i = 0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
                $i++;
            }

            if (empty($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
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
     * Get the value of idLog
     */
    public function getIdLog()
    {
        return $this->idLog;
    }

    /**
     * Set the value of idLog
     *
     * @return  self
     */
    public function setIdLog($idLog)
    {
        $this->idLog = $idLog;

        return $this;
    }

    /**
     * Get the value of nomeLog
     */
    public function getNomeLog()
    {
        return $this->nomeLog;
    }

    /**
     * Set the value of nomeLog
     *
     * @return  self
     */
    public function setNomeLog($nomeLog)
    {
        $this->nomeLog = $nomeLog;

        return $this;
    }

    /**
     * Get the value of textoLog
     */
    public function getTextoLog()
    {
        return $this->textoLog;
    }

    /**
     * Set the value of textoLog
     *
     * @return  self
     */
    public function setTextoLog($textoLog)
    {
        $this->textoLog = $textoLog;

        return $this;
    }

    /**
     * Get the value of statusLog
     */
    public function getStatusLog()
    {
        return $this->statusLog;
    }

    /**
     * Set the value of statusLog
     *
     * @return  self
     */
    public function setStatusLog($statusLog)
    {
        $this->statusLog = $statusLog;

        return $this;
    }

    /**
     * Get the value of dataLog
     */
    public function getDataLog()
    {
        return $this->dataLog;
    }

    /**
     * Set the value of dataLog
     *
     * @return  self
     */
    public function setDataLog($dataLog)
    {
        $this->dataLog = $dataLog;

        return $this;
    }

    /**
     * Get the value of idPessoaLog
     */
    public function getIdPessoaLog()
    {
        return $this->idPessoaLog;
    }

    /**
     * Set the value of idPessoaLog
     *
     * @return  self
     */
    public function setIdPessoaLog($idPessoaLog)
    {
        $this->idPessoaLog = $idPessoaLog;

        return $this;
    }

    /**
     * Get the value of nome_pessoaLog
     */
    public function getnome_pessoaLog()
    {
        return $this->nome_pessoaLog;
    }

    /**
     * Set the value of nome_pessoaLog
     *
     * @return  self
     */
    public function setnome_pessoaLog($nome_pessoaLog)
    {
        $this->nome_pessoaLog = $nome_pessoaLog;

        return $this;
    }

    /**
     * Get the value of tipo_pessoaLog
     */
    public function gettipo_pessoaLog()
    {
        return $this->tipo_pessoaLog;
    }

    /**
     * Set the value of tipo_pessoaLog
     *
     * @return  self
     */
    public function settipo_pessoaLog($tipo_pessoaLog)
    {
        $this->tipo_pessoaLog = $tipo_pessoaLog;

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
     * Get the value of idArquivo
     */
    public function getIdArquivo()
    {
        return $this->idArquivo;
    }

    /**
     * Set the value of idArquivo
     *
     * @return  self
     */
    public function setIdArquivo($idArquivo)
    {
        $this->idArquivo = $idArquivo;

        return $this;
    }
}
