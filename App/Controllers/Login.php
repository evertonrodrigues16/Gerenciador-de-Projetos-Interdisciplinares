<?php
/*
 * Controller login
 */
namespace App\Controllers;

class Login {
    /*
     * EXIBE A TELA DE LOGIN DO SISTEMA
     */
    public function index($msg=""){
        $view = new \App\Views\Login\Login();
        $view->render($msg);
    }
    /*
     * ESTANCIA A CLASSE MODEL
     * CHAMA O METODO LOGIN, SE OS DADOS FORNECIDOS FOREM VALIDADOS JUNTO AO BANCO DE DADOS
     * RETORNA UM TRUE E O USUARIO RECEBE ACESSO AO SISTEMA
     */
    public function login(){
       $model = new \App\Models\BLL\login;
       $login = $model->login();
       if ($login == true){
           header("Location: http://$_SERVER[HTTP_HOST]");
       }
       else{
           header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/login");
           $this->index("Informações de login inválidas!");
           
       }
    }
    /*
     * DESTROI A VARIAVEL DE SESSÃO E REDIRECIONA O USUARIO A TELA DE LOGIN
     */
    public function logout(){
        session_start();
        unset($_SESSION);
        session_destroy();
        header("Location: http://$_SERVER[HTTP_HOST]/login");
    }
}
