<?php

namespace App\Models\DAL;

class Cadastropermissoes extends Conn{
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
                        SELECT tbl_permissao.cod_permissao,
                            tbl_perfil_usuario.nome_perfil,
                            tbl_permissao.adcionar_projeto,
                            tbl_permissao.editar_projeto,
                            tbl_permissao.excluir_projeto,
                            tbl_permissao.gerenciar_usuario,
                            tbl_permissao.aprovar_trabalho
                        FROM una_projetos_db.tbl_permissao
                        INNER JOIN tbl_perfil_usuario ON tbl_permissao.cod_perfil = tbl_perfil_usuario.cod_perfil
                        ORDER BY tbl_permissao.cod_permissao;
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
    public function salvar($cod_perfil, $adcionar_projeto, $editar_projeto, $excluir_projeto, 
            $gerenciar_usuario, $aprovar_trabalho){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_permissao
                        (cod_perfil, adcionar_projeto, editar_projeto, excluir_projeto,
                        gerenciar_usuario, aprovar_trabalho)
                        VALUES
                        (:cod_perfil, :adcionar_projeto, :editar_projeto, :excluir_projeto,
                        :gerenciar_usuario, :aprovar_trabalho);
                    ');
            $stmt->bindParam(':cod_perfil', $cod_perfil);
            $stmt->bindParam(':adcionar_projeto', $adcionar_projeto);
            $stmt->bindParam(':editar_projeto', $editar_projeto);
            $stmt->bindParam(':excluir_projeto', $excluir_projeto);
            $stmt->bindParam(':gerenciar_usuario', $gerenciar_usuario);
            $stmt->bindParam(':aprovar_trabalho', $aprovar_trabalho);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
    public function atualizar($cod_permissao, $cod_perfil, $adcionar_projeto, $editar_projeto, $excluir_projeto, 
            $gerenciar_usuario, $aprovar_trabalho){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_permissao
                        SET
                        cod_perfil = :cod_perfil, adcionar_projeto = :adcionar_projeto,
                        editar_projeto = :editar_projeto, excluir_projeto = :excluir_projeto,
                        gerenciar_usuario = :gerenciar_usuario, aprovar_trabalho = :aprovar_trabalho
                        WHERE cod_permissao = :cod_permissao;
                    ');
            $stmt->bindParam(':cod_permissao', $cod_permissao);
            $stmt->bindParam(':cod_perfil', $cod_perfil);
            $stmt->bindParam(':adcionar_projeto', $adcionar_projeto);
            $stmt->bindParam(':editar_projeto', $editar_projeto);
            $stmt->bindParam(':excluir_projeto', $excluir_projeto);
            $stmt->bindParam(':gerenciar_usuario', $gerenciar_usuario);
            $stmt->bindParam(':aprovar_trabalho', $aprovar_trabalho);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    public function excluir($cod_permissao){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    DELETE FROM una_projetos_db.tbl_permissao
                    WHERE cod_permissao = :cod_permissao;
                ');
            
            $stmt->bindParam(':cod_permissao', $cod_permissao);
            
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
                        SELECT tbl_permissao.cod_permissao,
                            tbl_perfil_usuario.nome_perfil,
                            tbl_permissao.adcionar_projeto,
                            tbl_permissao.editar_projeto,
                            tbl_permissao.excluir_projeto,
                            tbl_permissao.gerenciar_usuario,
                            tbl_permissao.aprovar_trabalho
                        FROM una_projetos_db.tbl_permissao
                        INNER JOIN tbl_perfil_usuario ON tbl_permissao.cod_perfil = tbl_perfil_usuario.cod_perfil
                        WHERE tbl_permissao.cod_perfil like :arg
                        ORDER BY tbl_permissao.cod_permissao;
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
