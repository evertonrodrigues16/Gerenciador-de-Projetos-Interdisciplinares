<?php

namespace App\Models\BLL;

class login {
    private $codUsuario;
    private $nome;
    private $ra;
    private $login;
    private $senha;
    private $codPerfil;
    
    /*
     * CONSTRUTOR DA CLASSE
     * VERIFICA SE FOI PROCESSADO ALGUM FORMULARIO
     * PARA ENTÃO SETAR OS ATRIBUTOS
     */
    public function __construct() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_POST);
        $this->setRa($post);
        $this->setLogin($post);
        $this->setSenha($post);
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * VALIDA OS DADOS FORNECIDOS PELO USUARIO
     * SE RETORNAR VERDADEIRO INICIA UMA NOVA SESSÃO
     * SETA OS DADOS DO USUARIO A VARIAVEL DE SESSÃO
     * RETORNA UM BOOLEAN TRUE
     * SE RETORNAR FALSO, APENAS RETORNA UM BOOLEAN FALSE
     */
    public function login(){        
        $login = new \App\Models\DAL\Login;
        if ($this->getRa() != null)
        {
            $logar = $login->loginAluno($this->getRa(), $this->getSenha());
            if ($logar == true){
                $dados = $login->obterDados();
                $this->setCodUsuario($dados);
                $this->setNome($dados);
                $this->setCodperfil($dados);
                if (!isset($_SESSION)){
                    session_start();
                    $_SESSION['logado'] = true;
                    $_SESSION['codusuario'] = $this->getCodUsuario();
                    $_SESSION['nome'] = $this->getNome();
                    $_SESSION['ra'] = $this->getRa();
                    $_SESSION['cod_perfil'] = $this->getCodperfil();
                    $_SESSION['usuario'] = 'aluno';
                    $_SESSION["tempo_limite"] = time() + 600;
                    $per = new Permissoes();
                    $per->carregaPermissoes();
                    return true;
                }
            }
            else{
                return false;
            }
        }
        else
        {
            $logar = $login->loginProfessor($this->getLogin(), $this->getSenha());
            if ($logar == true){
                $dados = $login->obterDados();
                $this->setCodUsuario($dados);
                $this->setNome($dados);
                $this->setCodperfil($dados);
                if (!isset($_SESSION)){
                    session_start();
                    $_SESSION['logado'] = true;
                    $_SESSION['codusuario'] = $this->getCodUsuario();
                    $_SESSION['nome'] = $this->getNome();
                    $_SESSION['login'] = $this->getLogin();
                    $_SESSION['cod_perfil'] = $this->getCodperfil();
                    $_SESSION['usuario'] = 'professor';
                    $_SESSION["tempo_limite"] = time() + 600;
                    $per = new Permissoes();
                    $per->carregaPermissoes();
                    return true;
                }
            }
            else{
                return false;
            }
        }
    }
    /*
     * DESTROI A SESSAO ATUAL
     */
    public function logout(){
        session_destroy();
        unset($_SESSION);
    }
    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCodUsuario() {
        return $this->codUsuario;
    }

    private function getNome() {
        return $this->nome;
    }

    private function getRa() {
        return $this->ra;
    }
    
     private function getLogin() {
        return $this->login;
    }

    private function getSenha() {
        return $this->senha;
    }
    
    private function getCodperfil() {
        return $this->codPerfil;
    }
    private function setCodUsuario($dados) {
        $this->codUsuario = $dados['0']['cod_usuario'];
    }

    private function setNome($dados) {
        $this->nome = $dados['0']['nome'];
    }

    private function setRa($post) {
        if (isset($post['ra'])){
            $this->ra = $post['ra'];
        }
    }
    private function setLogin($post) {
        if (isset($post['login'])){
            $this->login = $post['login'];
        }
    }

    private function setSenha($post) {
        if (isset($post['senha'])){
            $this->senha = $post['senha'];
        }
    }   
    private function setCodperfil($dados) {
        $this->codPerfil = $dados['0']['cod_perfil'];
    }  
}
