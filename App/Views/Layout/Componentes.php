<?php
namespace App\Views\Layout;
define( 'DS', DIRECTORY_SEPARATOR );
define( 'BASE_DIR', dirname( __FILE__ ) . DS );

class Componentes {
    
    public function section($acao, $grid, $fluid=""){
        
        if ($acao == "abrir"){
            include_once 'Section.phtml';
        }
        else {
            include_once 'SectionFechar.phtml';
        }
    }
    public function windows($acao){
        if ($acao == "abrir"){
            include_once 'Windows.phtml';
        }
        else {
            include_once 'WindowsFechar.phtml';
        }
    }
    public function panel($acao, $class = "panel-default", $titulo){
        
        if ($acao == "abrir"){
            include_once 'Panel.phtml';
        }
        else {
            include_once 'PanelFechar.phtml';
        }
    }    
    public function form($acao, $class = "form-inline", $action = ""){
        if ($acao == "abrir"){
            include_once 'Form.phtml';
        }
        else {
            include_once 'FormFechar.phtml';
        }        
    }    
    public function input($local, $table, $imprimir=""){
        
        include_once \BASE_DIR . DS."..".DS.$local.DS."Input.phtml";
    }    
    public function button($tamanho = "btn-group", $cmd = "#"){
        if ($tamanho=="maior"){
            $tamanho="btn-lg";
        }
        elseif ($tamanho=="grande"){
            $tamanho="";     
        }
        elseif ($tamanho=="medio"){
            $tamanho="btn-sm";     
        }
        else{
             $tamanho="btn-xs";
        }
        include_once 'Botoes.phtml';
    }    
    public function table($table, $local, $class = "", $theadClass = ""){
        
        $i = 0;
        include_once \BASE_DIR . DS."..".DS.$local.DS."Table.phtml";
    }
    public function filto($url){
        include_once "Filtro.phtml";
    }
    
    public function login(){
        include_once "Login.phtml";
    }
    
    public function msg($msg){
        include_once 'Modal.phtml';
    }
    public function options($table, $campo1, $campo2){
        include_once 'Options.phtml';
    }
}
