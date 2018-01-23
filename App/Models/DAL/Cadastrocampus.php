<?php

namespace App\Models\DAL;

class Cadastrocampus extends Conn {
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
                        SELECT tbl_campus.cod_campus,
                            tbl_campus.campus
                        FROM una_projetos_db.tbl_campus
                        ORDER BY tbl_campus.cod_campus;
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
    public function salvar($campus){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_campus
                        (campus)
                        VALUES
                        (:campus);
                    ');
            $stmt->bindParam(':campus', $campus);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
    public function atualizar($cod_campus, $campus){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_campus
                        SET
                        campus = :campus
                        WHERE cod_campus = :cod_campus;
                    ');
            $stmt->bindParam(':cod_campus', $cod_campus);
            $stmt->bindParam(':campus', $campus);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    public function excluir($cod_campus){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    DELETE FROM una_projetos_db.tbl_campus
                    WHERE cod_campus = :cod_campus;
                ');
            
            $stmt->bindParam(':cod_campus', $cod_campus);
            
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
                        SELECT tbl_campus.cod_campus,
                            tbl_campus.campus
                        FROM una_projetos_db.tbl_campus
                        WHERE tbl_campus.campus like :arg
                        ORDER BY tbl_campus.cod_campus;
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
