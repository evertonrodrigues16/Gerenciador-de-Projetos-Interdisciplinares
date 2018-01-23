<?php

namespace App\Views\Cadastrostatusprojeto;

class Cadastrostatusprojeto {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-10 col-md-offset-1");
        
        $componente->panel("abrir", "panel-default", "Cadastro Status Projeto");
        
        $componente->form("abrir", "", "/cadastrostatusprojeto");
        
        $componente->input("Cadastrostatusprojeto", $table);
        
        $componente->button("medio");   
        
        $componente->filto("'/cadastrostatusprojeto'");  
        
        $componenteFechar->form("fechar", "normal", "/cadastrostatusprojeto");
        
        $componente->table($table, "Cadastrostatusprojeto", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Status Projeto");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Cadastrostatusprojeto", "table-striped");
    }
}
