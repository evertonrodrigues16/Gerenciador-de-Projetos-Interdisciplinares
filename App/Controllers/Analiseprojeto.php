<?php

namespace App\Controllers;

class Analiseprojeto {
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
            if ($per->verificacoes("aprovar_trabalho")){
            $view = new \App\Views\Analiseprojeto\Analiseprojeto();
            $model = new \App\Models\BLL\Analiseprojeto();
            $view->render($model->consulta(), $msg);
            }
            else{
                header("Location: http://$_SERVER[HTTP_HOST]/acessonegado");
            }
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }
    }
}
