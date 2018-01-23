<?php

namespace App\Controllers;

class Consultaprojeto {
    /*
     * FAZ A VERIFICAÇÃO DE LOGIN E PERMISSÕES DO USUARIO
     * EM SEGUIDA ESTANCIA A CLASSE MODEL E VIEW
     * BUSCA OS DADOS DE TODOS OS CAMPUS NO BANCO DE DADOS
     * E OS EXIBE NA TELA
     */
    public function index($msg=""){
        $per = new \App\Models\BLL\Permissoes();
        
        $per->iniciarSessao();
        if ($per->verificarLogin()){
            $view = new \App\Views\Consultaprojeto\Consultaprojeto();
            $model = new \App\Models\BLL\Consultaprojeto();
            $view->render($model->consulta(), $msg);
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }
    }
    
    /*
     * Enstacia a classe model e view
     * Recebe os dados via ajax
     * Recebe os dados da variavel global $_POST
     * Destroi a variavel global $_POST para que o sistema entenda que não esta sendo processado mais um formulario
     * Chama o metodo filtrar da view passando os dados retornados pelo banco de dados na funcao filtrar da model
     */
    public function filtrar(){
        $view = new \App\Views\Consultaprojeto\Consultaprojeto();
        $model = new \App\Models\BLL\Consultaprojeto();
        $view->filtrar($model->filtrar()); 
    }
}
