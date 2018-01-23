<?php

namespace App\Views\Cadastrousuario;

class Cadastrousuario {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg="", $estado=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Cadastro Usuários");
        
        $componente->form("abrir", "", "/cadastrousuario");
        
        $componente->input("Cadastrousuario", $table);
        
        $componente->button("medio");

        $componente->filto("'/cadastrousuario'");        
        
        $componenteFechar->form("fechar", "normal", "/cadastrousuario");
        
        $componente->table($table, "Cadastrousuario", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Usuários");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Cadastrousuario", "table-striped");
    }
}
