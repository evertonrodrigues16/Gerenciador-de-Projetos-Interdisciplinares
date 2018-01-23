<?php

namespace App\Controllers;

class Home {
    /*
     * VERIFICA SE O USUARIO ESTÁ LOGADO E EXIBE A TELA INICIAL DO SISTEMA
     */
    Public Function index($msg=""){
        $per = new \App\Models\BLL\Permissoes();
        
        $per->iniciarSessao();
        if ($per->verificarLogin()){
            $home = new \App\Views\Home\Home();
            $home->render($msg);        
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }    
    }
}
