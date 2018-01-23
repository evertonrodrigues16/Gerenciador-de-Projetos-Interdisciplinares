<?php

namespace App\Models\DAL;

class Postagemprojeto extends Conn{
    /*
     * TODOS OS METODOS ABAIXO FUNCIONAM DA MESMA FORMA
     * ABRE CONEXAO COM O BANCO DE DADOS
     * EXECUTA UM COMANDO SQL
     * RECEBE OS DADOS SOLICITADOS
     * OS RETORNA COMO UM ARRAY
     */
    
    public function salvar($nome_projeto, $palavras_chave, $objetivo, $resumo,
            $arquivo, $cod_curso, $cod_usuario, $cod_semestre, $cod_status_projeto){
        try {
            $dbh = $this->getDb();
            $stmt = $dbh->prepare(
                    '
                        INSERT INTO una_projetos_db.tbl_projeto
                        (nome_projeto, palavras_chave, objetivo, resumo,
            arquivo, cod_curso, cod_usuario, cod_semestre, cod_status_projeto)
                        VALUES
                        (:nome_projeto, :palavras_chave, :objetivo, :resumo,
            :arquivo, :cod_curso, :cod_usuario, :cod_semestre, :cod_status_projeto);
                    ');
            $stmt->bindParam(':nome_projeto', $nome_projeto);
            $stmt->bindParam(':palavras_chave', $palavras_chave);
            $stmt->bindParam(':objetivo', $objetivo);
            $stmt->bindParam(':resumo', $resumo);
            $stmt->bindParam(':arquivo', $arquivo);
            $stmt->bindParam(':cod_curso', $cod_curso);
            $stmt->bindParam(':cod_usuario', $cod_usuario);
            $stmt->bindParam(':cod_semestre', $cod_semestre);
            $stmt->bindParam(':cod_status_projeto', $cod_status_projeto);
            
            $stmt->execute();
            $cod = $dbh->lastInsertId();
            $this->closeConection();
            return $cod;
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        }    
    }
}
