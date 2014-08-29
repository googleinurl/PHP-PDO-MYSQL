<?php

class Executaq {

    public $dados = array();
    public $where = array();
    public $tabela = null;
    public $sql = null;
    public $getMsg = null;
    public $lastId = null;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        require_once 'Dados.class.php';
    }

    public function insert(array $dados, $tabela) {
        if (IsSet($this->dados) && $this->tabela) {
            try {

                $objDados = new Dados($this->db);
                $this->campos = implode(',', array_keys($this->dados));
                $this->valores = ":" . implode(",:", array_keys($this->dados));
                $this->insert = $objDados->connect()->prepare("INSERT INTO {$this->tabela} ({$this->campos}) values ({$this->valores});");
                foreach ($this->dados as $this->campo => $this->valor) {
                    $this->insert->bindParam(":{$this->campo}", $this->dados[$this->campo], PDO::PARAM_STR);
                }
                $this->insert->execute($this->dados);
                $this->lastId = $this->insert;
                $objDados->disconnect();
                return TRUE;
            } catch (PDOException $e) {
                $this->getMsg = $e->getMessage();
                return FALSE;
            }
        }
    }

    public function update(&$sql, array $dados) {
        if (IsSet($this->dados)) {
            try {
                $objDados = new Dados($this->db);
                $this->update = $objDados->connect()->prepare($this->sql);
                foreach ($this->dados as $this->campo => $this->valor) {
                    $this->update->bindParam(":{$this->campo}", $this->dados[$this->campo], PDO::PARAM_STR);
                }
                $this->update->execute($this->dados);
                $objDados->disconnect();
                return TRUE;
            } catch (PDOException $e) {

                $this->getMsg = $e->getMessage();
                return FALSE;
            }
        }
    }

    public function select(&$sql, array $dados = null) {

        try {
            if (IsSet($this->dados) && IsSet($this->sql)) {
                $objDados = new Dados($this->db);
                $this->select = $objDados->connect()->prepare($this->sql);
                foreach ($this->dados as $this->campo => $this->valor) {
                    $this->select->bindParam(":{$this->campo}", $this->dados[$this->campo], PDO::PARAM_STR);
                }

                $this->select->execute($this->dados);
                $this->dados = array();
            } else {

                $this->select = $objDados->connect()->query($this->sql);
                $this->dados = array();
            }
            $objDados->disconnect();

            return $res = ($this->select->rowCount()) ? $this->select->fetchAll(PDO::FETCH_ASSOC) : array();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete(&$sql, array $dados) {
        if (IsSet($this->dados)) {
            try {
                $objDados = new Dados($this->db);
                $this->delete = $objDados->connect()->prepare($this->sql);
                foreach ($this->dados as $this->campo => $this->valor) {
                    $this->delete->bindParam(":{$this->campo}", $this->dados[$this->campo], PDO::PARAM_STR);
                }
                $this->delete->execute($this->dados);
                $objDados->disconnect();
                return TRUE;
            } catch (PDOException $e) {
                $this->getMsg = $e->getMessage();
                return FALSE;
            }
        }
    }

}



