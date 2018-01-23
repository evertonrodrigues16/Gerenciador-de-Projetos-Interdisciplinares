<?php

namespace App\Models\DAL;

class Cadastroperfilusuario extends Conn{
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
                        SELECT tbl_perfil_usuario.cod_perfil,
                            tbl_perfil_usuario.nome_perfil
                        FROM una_projetos_db.tbl_perfil_usuario
                        ORDER BY tbl_perfil_usuario.cod_perfil;
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
    public function salvar($nome_perfil){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_perfil_usuario
                        (nome_perfil)
                        VALUES
                        (:nome_perfil);
                    ');
            $stmt->bindParam(':nome_perfil', $nome_perfil);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
    public function atualizar($cod_perfil, $nome_perfil){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_perfil_usuario
                        SET
                        nome_perfil = :nome_perfil
                        WHERE cod_perfil = :cod_perfil;
                    ');
            $stmt->bindParam(':cod_perfil', $cod_perfil);
            $stmt->bindParam(':nome_perfil', $nome_perfil);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    public function excluir($cod_perfil){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    DELETE FROM una_projetos_db.tbl_perfil_usuario
                    WHERE cod_perfil = :cod_perfil;
                ');
            
            $stmt->bindParam(':cod_perfil', $cod_perfil);
            
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
                        SELECT tbl_perfil_usuario.cod_perfil,
                            tbl_perfil_usuario.nome_perfil
                        FROM una_projetos_db.tbl_perfil_usuario
                        WHERE tbl_perfil_usuario.nome_perfil like :arg
                        ORDER BY tbl_perfil_usuario.cod_perfil;
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
