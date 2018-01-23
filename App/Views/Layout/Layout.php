<?php

namespace App\Views\Layout;

class Layout {
    public function header($btn = "inicial"){
        include_once 'Header.phtml';
    }
    public function footer(){
        include_once 'Footer.phtml';
    }

}
