<?php

namespace App\Models\DAL;

class Detalharprojeto extends Conn{
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
                            tbl_projeto.cod_projeto, tbl_projeto.nome_projeto, tbl_projeto.palavras_chave,
                            tbl_projeto.objetivo, tbl_projeto.resumo, tbl_projeto.arquivo,
                            tbl_curso.curso, tbl_usuario.nome as orientador, tbl_semestre.semestre, tbl_status_projeto.status
                        FROM ((((una_projetos_db.tbl_projeto
                            INNER JOIN tbl_curso ON tbl_curso.cod_curso = tbl_projeto.cod_curso)
                                INNER JOIN tbl_usuario ON tbl_usuario.cod_usuario = tbl_projeto.cod_usuario)
                                    INNER JOIN tbl_semestre ON tbl_semestre.cod_semestre = tbl_projeto.cod_semestre)
                                        INNER JOIN tbl_status_projeto ON tbl_status_projeto.cod_status_projeto = tbl_projeto.cod_status_projeto)                      
                    WHERE tbl_projeto.cod_projeto = :cod_projeto
                         ORDER BY tbl_projeto.cod_projeto;
                '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':cod_projeto' => $cod_projeto));
            $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            $this->closeConection();
            return $dados;
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function atualizar($cod_projeto, $nome_projeto, $palavras_chave
            , $objetivo, $resumo, $arquivo, $cod_curso, $cod_usuario, $cod_semestre){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_projeto
                        SET
                        cod_projeto = :cod_projeto,
                        nome_projeto = :nome_projeto,
                        palavras_chave = :palavras_chave,
                        objetivo = :objetivo,
                        resumo = :resumo,
                        arquivo = :arquivo,
                        cod_curso = :cod_curso,
                        cod_usuario = :cod_usuario,
                        cod_semestre = :cod_semestre
                        WHERE cod_projeto = :cod_projeto;
                    ');
            $stmt->bindParam(':cod_projeto', $cod_projeto);
            $stmt->bindParam(':nome_projeto', $nome_projeto);
            $stmt->bindParam(':palavras_chave', $palavras_chave);
            $stmt->bindParam(':objetivo', $objetivo);
            $stmt->bindParam(':resumo', $resumo);
            $stmt->bindParam(':arquivo', $arquivo);
            $stmt->bindParam(':cod_curso', $cod_curso);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->bindParam(':cod_semestre', $cod_semestre);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    
    public function atualizarSemArquivo($cod_projeto, $nome_projeto, $palavras_chave
            , $objetivo, $resumo, $cod_curso, $cod_usuario, $cod_semestre){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_projeto
                        SET
                        cod_projeto = :cod_projeto,
                        nome_projeto = :nome_projeto,
                        palavras_chave = :palavras_chave,
                        objetivo = :objetivo,
                        resumo = :resumo,
                        cod_curso = :cod_curso,
                        cod_usuario = :cod_usuario,
                        cod_semestre = :cod_semestre
                        WHERE cod_projeto = :cod_projeto;
                    ');
            $stmt->bindParam(':cod_projeto', $cod_projeto);
            $stmt->bindParam(':nome_projeto', $nome_projeto);
            $stmt->bindParam(':palavras_chave', $palavras_chave);
            $stmt->bindParam(':objetivo', $objetivo);
            $stmt->bindParam(':resumo', $resumo);
            $stmt->bindParam(':cod_curso', $cod_curso);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->bindParam(':cod_semestre', $cod_semestre);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
    
    public function excluir($cod_projeto){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                '
                    CALL excluir_projeto(?);
                ');
            
            $stmt->bindParam(1, $cod_projeto, \PDO::PARAM_INT, 4000);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function aprovar($cod_projeto, $cod_status_projeto){
        try {
            $dbh = $this->getDb();                
                $stmt = $dbh->prepare(
                    '
                        UPDATE una_projetos_db.tbl_projeto
                        SET
                        cod_projeto = :cod_projeto,
                        cod_status_projeto = :cod_status_projeto
                        WHERE cod_projeto = :cod_projeto;
                    ');
            $stmt->bindParam(':cod_projeto', $cod_projeto);
            $stmt->bindParam(':cod_status_projeto', $cod_status_projeto);
            
            $stmt->execute();
            $this->closeConection();
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }      
    }
}
