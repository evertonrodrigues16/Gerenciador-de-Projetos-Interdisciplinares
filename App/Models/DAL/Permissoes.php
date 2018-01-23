<?php

namespace App\Models\DAL;

class Permissoes extends Conn{
    /*
     * TODOS OS METODOS ABAIXO FUNCIONAM DA MESMA FORMA
     * ABRE CONEXAO COM O BANCO DE DADOS
     * EXECUTA UM COMANDO SQL
     * RECEBE OS DADOS SOLICITADOS
     * OS RETORNA COMO UM ARRAY
     */
    public function consulta($cod_perfil){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare(
                '
                    SELECT * 
                    FROM una_projetos_db.tbl_permissao
                    WHERE tbl_permissao.cod_perfil = :cod_perfil;
                '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':cod_perfil' => $cod_perfil));
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
