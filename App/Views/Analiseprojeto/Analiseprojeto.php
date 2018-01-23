<?php

namespace App\Views\Analiseprojeto;

class Analiseprojeto {
    public function render($table, $msg="", $acao=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header($acao);      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Projetos Pendentes de Análise");   
        
        //$componente->input("Analiseprojeto", $table);
        
        $componente->table($table, "Analiseprojeto", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Projetos Pendentes de Análise");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Analiseprojeto", "table-striped");
    }
}
