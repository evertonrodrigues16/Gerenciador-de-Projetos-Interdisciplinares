<?php

namespace App\Views\Detalharprojeto;

class Detalharprojeto {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg="", $acao=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header($acao);      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Detalhar Projeto");
        
        $componente->form("abrir", "", "/detalharprojeto");
        
        $componente->input("Detalharprojeto", $table);
        
        if ($acao == "editar")
        {
            $componente->button("medio"); 
        }        
        
        $componenteFechar->form("fechar", "normal", "/detalharprojeto");           
        
        $componenteFechar->panel("fechar", "panel-default", "Detalhar Projeto");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Detalharprojeto", "table-striped");
    }
}
