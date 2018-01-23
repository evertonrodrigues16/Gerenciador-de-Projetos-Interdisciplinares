<?php

namespace App\Views\Aprovacaoprojeto;

class Aprovacaoprojeto {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg="", $acao=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header($acao);      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Aprovacao Projeto");
        
        $componente->form("abrir", "", "/aprovacaoprojeto");
        
        $componente->input("Aprovacaoprojeto", $table);
        
        if ($acao == "editar")
        {
            $componente->button("medio"); 
        }        
        
        $componenteFechar->form("fechar", "normal", "/aprovacaoprojeto");           
        
        $componenteFechar->panel("fechar", "panel-default", "Aprovacao Projeto");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Aprovacaoprojeto", "table-striped");
    }
}
