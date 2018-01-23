<?php

namespace App\Views\Login;

class Login {
    public function render($msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $componente->login();     
                
        $componente->section("abrir", "col-md-offset-4 col-md-4");
        
        $componente->panel("abrir", "panel-default", "Una Projetos");
        
        $componente->form("abrir", "", "/login");
        
        $componente->input("Login", "");
        
        $componenteFechar->form("fechar", "", "/login");
        
        $componenteFechar->panel("fechar", "panel-default", "Una Projetos");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
}
