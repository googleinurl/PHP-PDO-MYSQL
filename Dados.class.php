<?php

class Dados extends PDO{
    /* MÉtodo construtor do banco de dados */

    private $db;

    function __construct($db) {
        $this->db = $db;
    
    }

    /* Evita que a classe seja clonada */

    public function __clone() {
        
    }

    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    private static $banco = array('dbtype' => 'mysql',
        'host' => '172.16.0.100',
        'port' => '3306',
        'user' => 'seu_user',
        'password' => '123456',
    );

    /* Metodos que trazem o conteudo da variavel desejada
      @return   $xxx = conteudo da variavel solicitada */

    private function getDBType() {
        return self::$banco['dbtype'];
    }

    private function getHost() {
        return self::$banco['host'];
    }

    private function getPort() {
        return self::$banco['port'];
    }

    private function getUser() {
        return self::$banco['user'];
    }

    private function getPassword() {
        return self::$banco['password'];
    }

    private function getDB() {
        return $this->db;
    }

    public function connect() {
        try {
            $this->conexao = new PDO($this->getDBType() .
                    ":host=" . $this->getHost() .
                    ";port=" . $this->getPort() .
                    ";dbname=" . $this->getDB(), $this->getUser(), $this->getPassword());
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $i) {

            die("Erro: <code>" . $i->getMessage() . "</code>"); //erro
        }
        return ($this->conexao);
    }

    public function disconnect() {
        $this->conexao = null;
    }

}

?>
