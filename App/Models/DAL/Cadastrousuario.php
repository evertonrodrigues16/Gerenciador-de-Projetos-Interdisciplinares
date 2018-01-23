<?php

namespace App\Models\DAL;

class Cadastrousuario extends Conn{
    
    /*
     * METODO EXCLUIR
     * RECEBE COMO PARAMETRO O COD DO USUARIO
     * EM SEGUIDA SE CONECTA AO BANCO E EXECUTA A QUERY DELETE
     * FECHA CONEXÃO E ENCERRA O METODO
     */
    public function excluir($COD_USUARIO){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
            '
            DELETE FROM una_projetos_db.tbl_usuario
            WHERE tbl_usuario.cod_usuario = :cod_usuario;
            ');
            
            $stmt->bindParam(':cod_usuario', $COD_USUARIO);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    /*
     * IRÁ FAZER UMA CONEXAO AO BANCO E EM SEGUIDA
     * BUSCAR TODOS OS USUARIOS CADASTRADOS NA BASE DE DADOS
     */
    public function consultar($COD_USUARIO){
        try {
            $dbh = $this->getDb();
            $consulta = $dbh->query(
                    '
                        SELECT tbl_usuario.cod_usuario,
                            tbl_usuario.nome,
                            tbl_usuario.ra,
                            tbl_usuario.login,
                            tbl_curso.curso,
                            tbl_campus.campus,
                            tbl_telefone.telefone1,
                            tbl_telefone.telefone2,
                            tbl_usuario.email,
                            tbl_perfil_usuario.nome_perfil,
                            tbl_usuario.senha
                        FROM ((((una_projetos_db.tbl_usuario
                        INNER JOIN tbl_curso ON tbl_usuario.cod_curso = tbl_curso.cod_curso)
                        INNER JOIN tbl_campus ON tbl_usuario.cod_campus = tbl_campus.cod_campus)
                        INNER JOIN tbl_perfil_usuario ON tbl_usuario.cod_perfil = tbl_perfil_usuario.cod_perfil)
                        INNER JOIN tbl_telefone ON tbl_usuario.cod_usuario = tbl_telefone.cod_usuario)
                        ORDER BY tbl_usuario.cod_usuario;
                    ');            
            $dados = $consulta->fetchall(\PDO::FETCH_ASSOC);
            $this->closeConection();
            return $dados;
            
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        }
    }
    
    public function salvarTelefone($COD_USUARIO, $TELEFONE1, $TELEFONE2){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_telefone
                        (telefone1, telefone2, cod_usuario)
                        VALUES
                        (:telefone1, :telefone2, :cod_usuario);
                    ');
            $stmt->bindParam(':cod_usuario', $COD_USUARIO);
            $stmt->bindParam(':telefone1', $TELEFONE1);
            $stmt->bindParam(':telefone2', $TELEFONE2);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function atualizar($COD_USUARIO, $NOME, $RA, $LOGIN, $COD_CURSO, $COD_CAMPUS, $EMAIL, $COD_PERFIL, $SENHA){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        UPDATE 
                        una_projetos_db.tbl_usuario
                        SET
                        nome = :nome,
                        ra = :ra,
                        login = :login,
                        cod_curso = :cod_curso,
                        cod_campus = :cod_campus,
                        email = :email,
                        cod_perfil = :cod_perfil,
                        senha = :senha 
                        WHERE 
                        cod_usuario = :cod_usuario;
                    ');
            $stmt->bindParam(':cod_usuario', $COD_USUARIO);
            $stmt->bindParam(':nome', $NOME);
            $stmt->bindParam(':ra', $RA);
            $stmt->bindParam(':login', $LOGIN);
            $stmt->bindParam(':cod_curso', $COD_CURSO);
            $stmt->bindParam(':cod_campus', $COD_CAMPUS);
            $stmt->bindParam(':email', $EMAIL);
            $stmt->bindParam(':cod_perfil', $COD_PERFIL);
            $stmt->bindParam(':senha', $SENHA);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function atualizarTelefone($COD_USUARIO, $TELEFONE1, $TELEFONE2){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        UPDATE 
                                una_projetos_db.tbl_telefone
                        SET
                                telefone1 = :telefone1,
                                telefone2 = :telefone2
                        WHERE 
                                cod_usuario = :cod_usuario;
                    ');
            $stmt->bindParam(':cod_usuario', $COD_USUARIO);
            $stmt->bindParam(':telefone1', $TELEFONE1);
            $stmt->bindParam(':telefone2', $TELEFONE2);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function filtrar($argumento){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare(
                    '
                        SELECT tbl_usuario.cod_usuario,
                            tbl_usuario.nome,
                            tbl_usuario.ra,
                            tbl_usuario.login,
                            tbl_curso.curso,
                            tbl_campus.campus,
                            tbl_telefone.telefone1,
                            tbl_telefone.telefone2,
                            tbl_usuario.email,
                            tbl_perfil_usuario.nome_perfil,
                            tbl_usuario.senha
                        FROM ((((una_projetos_db.tbl_usuario
                        INNER JOIN tbl_curso ON tbl_usuario.cod_curso = tbl_curso.cod_curso)
                        INNER JOIN tbl_campus ON tbl_usuario.cod_campus = tbl_campus.cod_campus)
                        INNER JOIN tbl_perfil_usuario ON tbl_usuario.cod_perfil = tbl_perfil_usuario.cod_perfil)
                        INNER JOIN tbl_telefone ON tbl_usuario.cod_usuario = tbl_telefone.cod_usuario)
                        WHERE tbl_usuario.nome LIKE :arg
                        ORDER BY tbl_usuario.cod_usuario;
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
    
    public function comboBox(){
        try {
            $dbh = $this->getDb();
            $consulta = $dbh->query(
                    '
                        SELECT tbl_usuario.cod_usuario,
                            tbl_usuario.nome,
                            tbl_usuario.ra,
                            tbl_usuario.login,
                            tbl_curso.curso,
                            tbl_campus.campus,
                            tbl_telefone.telefone1,
                            tbl_telefone.telefone2,
                            tbl_usuario.email,
                            tbl_perfil_usuario.nome_perfil,
                            tbl_usuario.senha
                        FROM ((((una_projetos_db.tbl_usuario
                        INNER JOIN tbl_curso ON tbl_usuario.cod_curso = tbl_curso.cod_curso)
                        INNER JOIN tbl_campus ON tbl_usuario.cod_campus = tbl_campus.cod_campus)
                        INNER JOIN tbl_perfil_usuario ON tbl_usuario.cod_perfil = tbl_perfil_usuario.cod_perfil)
                        INNER JOIN tbl_telefone ON tbl_usuario.cod_usuario = tbl_telefone.cod_usuario)
                        WHERE nome_perfil = "PROFESSOR"
                        ORDER BY tbl_usuario.cod_usuario;
                    ');            
            $dados = $consulta->fetchall(\PDO::FETCH_ASSOC);
            $this->closeConection();
            return $dados;
            
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        }
    }
}
