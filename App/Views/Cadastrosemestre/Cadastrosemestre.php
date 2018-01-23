<?php

namespace App\Views\Cadastrosemestre;

class Cadastrosemestre {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($table, $msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-10 col-md-offset-1");
        
        $componente->panel("abrir", "panel-default", "Cadastro Semestre");
        
        $componente->form("abrir", "", "/cadastrosemestre");
        
        $componente->input("Cadastrosemestre", $table);
        
        $componente->button("medio");   
        
        $componente->filto("'/cadastrosemestre'");  
        
        $componenteFechar->form("fechar", "normal", "/cadastrosemestre");
        
        $componente->table($table, "Cadastrosemestre", "table-striped");            
        
        $componenteFechar->panel("fechar", "panel-default", "Cadastro Semestre");
        
        $componenteFechar->section("fechar", "col-md-4 col-md-offset-4");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
    public function filtrar($table){
        $componente = new \App\Views\Layout\Componentes();

        $componente->table($table, "Cadastrosemestre", "table-striped");
    }
}
