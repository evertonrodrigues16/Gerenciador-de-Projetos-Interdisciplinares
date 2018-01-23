<?php

namespace App\Views\Cadastroperfilusuario;

class Cadastroperfilusuario {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-10 col-md-offset-1");
        
        $componente->panel("abrir", "panel-default", "Cadastro Perfil Usuario");
        
        $componente->form("abrir", "", "/cadastroperfilusuario");
        
        $componente->input("Cadastroperfilusuario", $table);
        
        $componente->button("medio");   
        
        $componente->filto("'/cadastroperfilusuario'");  
        
        $componenteFechar->form("fechar", "normal", "/cadastroperfilusuario");
        
        $componente->table($table, "Cadastroperfilusuario", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Perfil Usuario");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Cadastroperfilusuario", "table-striped");
    }
}
