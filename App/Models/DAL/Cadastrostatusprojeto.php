<?php

namespace App\Models\DAL;

class Cadastrostatusprojeto extends Conn{
    /*
     * TODOS OS METODOS ABAIXO FUNCIONAM DA MESMA FORMA
     * ABRE CONEXAO COM O BANCO DE DADOS
     * EXECUTA UM COMANDO SQL
     * RECEBE OS DADOS SOLICITADOS
     * OS RETORNA COMO UM ARRAY
     */
    public function consulta(){
        try {
            $dbh = $this->getDb();
            $consulta = $dbh->query(
                    '
                        SELECT tbl_status_projeto.cod_status_projeto,
                            tbl_status_projeto.status
                        FROM una_projetos_db.tbl_status_projeto
                        ORDER BY tbl_status_projeto.cod_status_projeto;
                    ');            
        $dados = $consulta->fetchall(\PDO::FETCH_ASSOC);
        $this->closeConection();
        return $dados;
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }
    }
    
    public function comboPostagem(){
        try {
            $dbh = $this->getDb();
            $consulta = $dbh->query(
                    '
                        SELECT tbl_status_projeto.cod_status_projeto,
                            tbl_status_projeto.status
                        FROM una_projetos_db.tbl_status_projeto
                        WHERE tbl_status_projeto.status = "PENDENTE"
                        ORDER BY tbl_status_projeto.cod_status_projeto;
                    ');            
        $dados = $consulta->fetchall(\PDO::FETCH_ASSOC);
        $this->closeConection();
        return $dados;
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }
    }
    public function salvar($status){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_status_projeto
                        (status)
                        VALUES
                        (:status);
                    ');
            $stmt->bindParam(':status', $status);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
    public function atualizar($cod_status_projeto, $status){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_status_projeto
                        SET
                        status = :status
                        WHERE cod_status_projeto = :cod_status_projeto;
                    ');
            $stmt->bindParam(':cod_status_projeto', $cod_status_projeto);
            $stmt->bindParam(':status', $status);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    public function excluir($cod_status_projeto){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    DELETE FROM una_projetos_db.tbl_status_projeto
                    WHERE cod_status_projeto = :cod_status_projeto;
                ');
            
            $stmt->bindParam(':cod_status_projeto', $cod_status_projeto);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function filtrar($argumento){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare(
                '
                        SELECT tbl_status_projeto.cod_status_projeto,
                            tbl_status_projeto.status
                        FROM una_projetos_db.tbl_status_projeto
                        WHERE tbl_status_projeto.status like :arg
                        ORDER BY tbl_status_projeto.cod_status_projeto;
                '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':arg' => "%" . $argumento . "%"));
            $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            $this->closeConection();
            return $dados;
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
}
