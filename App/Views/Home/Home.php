<?php

namespace App\Views\Home;

class Home {
    /*
     * INSERE OS COMPONENTES HTML NA PAGINA
     */
    public function render($msg=""){
        $componente = new \App\Views\Layout\Componentes();
        $componenteFechar = new \App\Views\Layout\Componentes();
        $layout = new \App\Views\Layout\Layout();
        
        $layout->header();      
                
        $componente->section("abrir", "col-md-12");
        
        $componente->input("Home", "");
        
        $componenteFechar->section("fechar", "col-md-12");
        
        if ($msg != ""){
            $componente->msg($msg);
        }

        $layout->footer();
    }
}
