<?php

namespace App\Models\DAL;

class Conn {
    private $driver;
    private $host;
    private $dbName;
    private $user;
    private $password;
    private $dbh;
    private $connection;
    /*
     * CHAMA O METODO SET ATRIBUTOS
     * CRIA UMA NOVA CONEXAO COM O BANCO USANDO A CLASSE PDO
     * RETORNA A CONEXAO ESTABELECIDA PRONTA PARA RECEBER COMANDOS
     */
    public function getDb(){ 
        $this->setAtributos();
        $opcoes = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
        $this->connection = new \PDO("{$this->driver}:dbname={$this->dbName};host={$this->host}", $this->user, $this->password, $opcoes);
        return $this->connection;
    }
    /*
     * SETA OS DADOS DE CONEXAO A BASE DE DADOS
     */
    private function setAtributos(){
        $this->driver = "mysql";
        $this->host = "unapi.cjngpuwk3u9s.us-east-2.rds.amazonaws.com:3306";
        $this->dbName = "una_projetos_db";
        $this->user = "unapi";
        $this->password = "ejrs0194";
        $this->dbh;
    }
    /*
     * DESTROI A CONEXAO ABERTA
     */
    public function closeConection(){
        $this->connection = null;
    }
    /*
     * EXIBE UMA MENSAGEM NA TELA
     */
    public function modal($msg){
        $componente = new \App\Views\Layout\Componentes();
        $componente->msg($msg);
    }
}
