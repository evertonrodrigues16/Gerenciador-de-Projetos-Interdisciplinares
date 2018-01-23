<?php

namespace App\Views\Cadastropermissoes;

class Cadastropermissoes {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-10 col-md-offset-1");
        
        $componente->panel("abrir", "panel-default", "Cadastro Permissoes");
        
        $componente->form("abrir", "", "/cadastropermissoes");
        
        $componente->input("Cadastropermissoes", $table);
        
        $componente->button("medio");   
        
        $componente->filto("'/cadastropermissoes'");  
        
        $componenteFechar->form("fechar", "normal", "/cadastropermissoes");
        
        $componente->table($table, "Cadastropermissoes", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Permissoes");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Cadastropermissoes", "table-striped");
    }
}
