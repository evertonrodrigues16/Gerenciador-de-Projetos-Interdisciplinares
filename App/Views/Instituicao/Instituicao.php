<?php

namespace App\Views\Instituicao;

class Instituicao {
    public function render($table, $msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->panel("abrir", "panel-default", "Cadastro Instituição - SM");
        
        $componente->form("abrir", "", "/instituicao");
        
        $componente->input("Instituicao", $table);
        
        $componente->button("medio");

        $componente->filto("'/instituicao'");        
        
        $componenteFechar->form("fechar", "normal", "/instituicao");
        
        $componente->table($table, "Instituicao", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Instituição - SM");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Instituicao", "table-striped");
    }
}
