<?php

namespace App\Controllers;

class Acessonegado {
    /*
     * VERIFICA SE O USUARIO ESTÁ LOGADO E EXIBE A TELA INICIAL DO SISTEMA
     */
    Public Function index($msg=""){
        $per = new \App\Models\BLL\Permissoes();
        
        $per->iniciarSessao();
        if ($per->verificarLogin()){
            $view = new \App\Views\Acessonegado\Acessonegado();
            $view->render($msg);        
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }    
    }
}
