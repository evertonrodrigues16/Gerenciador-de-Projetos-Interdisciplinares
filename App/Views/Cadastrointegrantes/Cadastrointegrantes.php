<?php

namespace App\Views\Cadastrointegrantes;

class Cadastrointegrantes {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-10 col-md-offset-1");
        
        $componente->panel("abrir", "panel-default", "Cadastro Integrantes");
        
        $componente->form("abrir", "", "/cadastrointegrantes");
        
        $componente->input("Cadastrointegrantes", $table);
        
        $componente->button("medio");   
        
        $componente->filto("'/cadastrointegrantes'");  
        
        $componenteFechar->form("fechar", "normal", "/cadastrointegrantes");
        
        $componente->table($table, "Cadastrointegrantes", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Integrantes");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Cadastrointegrantes", "table-striped");
    }
}
