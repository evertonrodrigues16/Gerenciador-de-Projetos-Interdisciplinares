<?php

namespace App\Views\Consultaprojeto;

class Consultaprojeto {
    public function render($table, $msg="", $acao=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header($acao);      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Consulta Projeto");   
        
        $componente->input("Consultaprojeto", $table);
        
        $componente->table($table, "Consultaprojeto", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Consultaprojeto");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Consultaprojeto", "table-striped");
    }
}
