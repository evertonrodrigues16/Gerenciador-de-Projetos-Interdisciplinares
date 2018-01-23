<?php

namespace App\Views\Postagemprojeto;

class Postagemprojeto {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg="", $acao=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header($acao);      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Postagem Projeto");
        
        $componente->form("abrir", "", "/postagemprojeto");
        
        $componente->input("Postagemprojeto", $table);
        
        $componente->button("medio"); 
        
        $componenteFechar->form("fechar", "normal", "/postagemprojeto");           
        
        $componenteFechar->panel("fechar", "panel-default", "Postagem Projeto");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Postagemprojeto", "table-striped");
    }
}
