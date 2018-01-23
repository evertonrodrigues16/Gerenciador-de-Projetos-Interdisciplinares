<?php

namespace App\Models\DAL;

class Analiseprojeto extends Conn{
    /*
     * TODOS OS METODOS ABAIXO FUNCIONAM DA MESMA FORMA
     * ABRE CONEXAO COM O BANCO DE DADOS
     * EXECUTA UM COMANDO SQL
     * RECEBE OS DADOS SOLICITADOS
     * OS RETORNA COMO UM ARRAY
     */
    public function consulta($codusuario){
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
                    WHERE tbl_projeto.cod_usuario = :cod_usuario AND
                            tbl_projeto.cod_status_projeto = 3
                         ORDER BY tbl_projeto.cod_projeto;
                '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':cod_usuario' => $codusuario));
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
