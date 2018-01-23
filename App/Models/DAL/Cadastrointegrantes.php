<?php

namespace App\Models\DAL;

class Cadastrointegrantes extends Conn{
    /*
     * TODOS OS METODOS ABAIXO FUNCIONAM DA MESMA FORMA
     * ABRE CONEXAO COM O BANCO DE DADOS
     * EXECUTA UM COMANDO SQL
     * RECEBE OS DADOS SOLICITADOS
     * OS RETORNA COMO UM ARRAY
     */
    public function consulta($cod_projeto){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare(
                '
                    SELECT 
                    tbl_integrantes.cod_integrante, 
                    tbl_usuario.nome as integrante, 
                    tbl_projeto.nome_projeto as projeto 
                    FROM ((una_projetos_db.tbl_integrantes
                    INNER JOIN tbl_usuario ON tbl_usuario.cod_usuario = tbl_integrantes.cod_usuario)
                    INNER JOIN tbl_projeto ON tbl_projeto.cod_projeto = tbl_integrantes.cod_projeto)
                    WHERE tbl_integrantes.cod_projeto LIKE :cod_projeto
                    ORDER BY integrante;
                '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':cod_projeto' => "%" . $cod_projeto . "%"));
            $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            $this->closeConection();
            return $dados;
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }
    }
    public function salvar($cod_usuario, $cod_projeto){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_integrantes
                        (cod_usuario, cod_projeto)
                        VALUES
                        (:cod_usuario, :cod_projeto);
                    ');
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->bindParam(':cod_projeto', $cod_projeto);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
    public function atualizar($cod_integrante, $cod_usuario, $cod_projeto){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_integrantes
                        SET
                        cod_usuario = :cod_usuario,
                        cod_projeto = :cod_projeto
                        WHERE cod_integrante = :cod_integrante;
                    ');
            $stmt->bindParam(':cod_integrante', $cod_integrante);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->bindParam(':cod_projeto', $cod_projeto);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    public function excluir($cod_integrante){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    DELETE FROM una_projetos_db.tbl_integrantes
                    WHERE cod_integrante = :cod_integrante;
                ');
            
            $stmt->bindParam(':cod_integrante', $cod_integrante);
            
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
                    SELECT 
                    tbl_integrantes.cod_integrante, 
                    tbl_usuario.nome as integrante, 
                    tbl_projeto.nome_projeto as projeto 
                    FROM ((una_projetos_db.tbl_integrantes
                    INNER JOIN tbl_usuario ON tbl_usuario.cod_usuario = tbl_integrantes.cod_usuario)
                    INNER JOIN tbl_projeto ON tbl_projeto.cod_projeto = tbl_integrantes.cod_projeto)
                    WHERE integrante LIKE :arg
                    ORDER BY integrante;
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
    
    public function verficarIntegrante($cod_usuario, $cod_projeto){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare(
                '
                    SELECT
                    * 
                    FROM una_projetos_db.tbl_integrantes
                    WHERE tbl_integrantes.cod_projeto = :cod_projeto AND
                    tbl_integrantes.cod_usuario = :cod_usuario;
                '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':cod_usuario' => $cod_usuario, 
                                    ':cod_projeto' => $cod_projeto));
            $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            if (count($dados) > 0){
                $this->dados = $dados;
                $this->closeConection();
                return true;
            }
            else{
                //$this->modal("Informações de login inválidas!");
                $this->closeConection();
                return false;
            }
        }
        catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    
    }
    
}
