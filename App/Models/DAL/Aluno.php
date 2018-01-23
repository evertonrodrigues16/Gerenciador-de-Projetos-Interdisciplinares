<?php

namespace App\Models\DAL;

class Aluno extends Cadastrousuario{
    
    /*
     * CONSULTA USUARIO POR COD
     * NÃO TRAZ O ATRIBUTO LOGIN, POR SER ESPECIFICO DE PROFESSOR
     */
    public function consultar($COD_USUARIO){
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
                        WHERE tbl_usuario.cod_usuario = :cod_usuario
                        ORDER BY tbl_usuario.cod_usuario;
                    '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':cod_usuario' => $COD_USUARIO));
            $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            $this->closeConection();
            return $dados;
        } catch (\PDOException $e) {
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    /*
     * ABRE CONEXÃO COM O BANCO E REALIZA UM ISERT NA TABELA USUARIO
     */
    public function salvar($NOME, $RA, $COD_CURSO, $COD_CAMPUS, $EMAIL, $COD_PERFIL, $SENHA){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_usuario
                        (nome, ra, cod_curso, cod_campus, email, cod_perfil, senha)
                        VALUES
                        (:nome, :ra, :cod_curso, :cod_campus, :email, :cod_perfil, :senha);
                    ');
            $stmt->bindParam(':nome', $NOME);
            $stmt->bindParam(':ra', $RA);
            $stmt->bindParam(':cod_curso', $COD_CURSO);
            $stmt->bindParam(':cod_campus', $COD_CAMPUS);
            $stmt->bindParam(':email', $EMAIL);
            $stmt->bindParam(':cod_perfil', $COD_PERFIL);
            $stmt->bindParam(':senha', $SENHA);
            
            $stmt->execute();
            
            $result = $dbh->lastInsertId();
            $this->closeConection();
            return $result;
        } catch (\PDOException $e) {
            if ($e->getCode()==23505){
                $this->modal("Aluno já cadastrado na base de dados!");
            }
            else{
                $e->getMessage();
                $this->modal($e);
            }
        } 
    }
    
    /*
     * ABRE CONEXÃO COM O BANCO E REALIZA UM UPDATE NA TABELA USUARIO
     */
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
}
