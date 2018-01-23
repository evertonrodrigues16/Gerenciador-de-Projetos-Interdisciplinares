<?php

namespace App\Views\Cadastrousuario;

class Aluno extends Cadastrousuario{
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg="", $estado=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header($estado);      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Cadastro Usuários");
        
        $componente->form("abrir", "", "/aluno");
        
        $componente->input("Cadastrousuario", $table, "aluno");
        
        $componente->button("medio");  
        
        $componenteFechar->form("fechar", "normal", "/aluno");         
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Usuários");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
}
