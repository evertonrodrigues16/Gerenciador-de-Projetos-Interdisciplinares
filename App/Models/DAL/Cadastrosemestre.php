<?php

namespace App\Models\DAL;

class Cadastrosemestre extends Conn{
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
                        SELECT tbl_semestre.cod_semestre,
                            tbl_semestre.semestre
                        FROM una_projetos_db.tbl_semestre
                        ORDER BY tbl_semestre.cod_semestre;
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
    public function salvar($semestre){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_semestre
                        (semestre)
                        VALUES
                        (:semestre);
                    ');
            $stmt->bindParam(':semestre', $semestre);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
    public function atualizar($cod_semestre, $semestre){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_semestre
                        SET
                        semestre = :semestre
                        WHERE cod_semestre = :cod_semestre;
                    ');
            $stmt->bindParam(':cod_semestre', $cod_semestre);
            $stmt->bindParam(':semestre', $semestre);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    public function excluir($cod_semestre){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    DELETE FROM una_projetos_db.tbl_semestre
                    WHERE cod_semestre = :cod_semestre;
                ');
            
            $stmt->bindParam(':cod_semestre', $cod_semestre);
            
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
                        SELECT tbl_semestre.cod_semestre,
                            tbl_semestre.semestre
                        FROM una_projetos_db.tbl_semestre
                        WHERE tbl_semestre.semestre like :arg
                        ORDER BY tbl_semestre.cod_semestre;
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
