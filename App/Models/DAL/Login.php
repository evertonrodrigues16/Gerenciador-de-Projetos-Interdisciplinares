<?php

namespace App\Models\DAL;

class Login extends Conn {
    private $dados;
    /*
     * TODOS OS METODOS ABAIXO FUNCIONAM DA MESMA FORMA
     * ABRE CONEXAO COM O BANCO DE DADOS
     * EXECUTA UM COMANDO SQL
     * RECEBE OS DADOS SOLICITADOS
     * OS RETORNA COMO UM ARRAY
     */
    public function loginAluno($ra, $senha){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare('
                    SELECT
                        *
                    FROM 
                        tbl_usuario
                    WHERE
                        ra = :ra AND
                        senha = :senha;
                  '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':ra' => $ra, ':senha' => $senha));
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
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function loginProfessor($login, $senha){
        try {
            $dbh = $this->getDb();

            $stmt = $dbh->prepare('
                    SELECT
                        *
                    FROM 
                        tbl_usuario
                    WHERE
                        login = :login AND
                        senha = :senha;
                  '
                    , array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

            $stmt->execute(array(':login' => $login, ':senha' => $senha));
            $dados = $stmt->fetchall(\PDO::FETCH_ASSOC);
            if (count($dados) > 0){
                $this->dados = $dados;
                $this->closeConection();
                return true;
            }
            else{
                $this->modal("Informações de login inválidas!");
                $this->closeConection();
                return false;
            }
        } catch (\PDOException $e) {
            $erro = "Ocorreu um erro ao acessar o banco de dados!";
            $e->getMessage();
            $this->modal($e);
        } 
    }
    
    public function obterDados(){
        return $this->dados;
        
    }
    
    
}
