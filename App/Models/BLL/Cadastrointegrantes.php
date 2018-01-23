<?php

namespace App\Models\BLL;

class Cadastrointegrantes {
    private $cod_integrante;
    private $cod_usuario;
    private $cod_projeto;
    
    /*
     * CONSTRUTOR DA CLASSE
     * VERIFICA SE FOI PROCESSADO ALGUM FORMULARIO
     * PARA ENTÃO SETAR OS ATRIBUTOS
     */
    public function __construct() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_POST);
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->setCod_integrante($post);
        $this->setCod_usuario($post);
        $this->setCod_projeto($post);
    }
    /*
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Cadastrointegrantes;
        $comboUsuario = new \App\Models\DAL\Cadastrousuario();
        $comboProjeto = new \App\Models\DAL\Detalharprojeto();
        $dados['1'] = $comboProjeto->consulta($this->getCod_projeto());
        $dados['2'] = $comboUsuario->consultar("");
        $dados['3'] = $dal->consulta($this->getCod_projeto());
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO SALVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Cadastrointegrantes;
        $dal->salvar($this->getCod_usuario(), $this->getCod_projeto());
        return $this->getCod_projeto();
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Cadastrointegrantes;        
        $dal->atualizar($this->getCod_integrante(), $this->getCod_usuario(), $this->getCod_projeto()); 
        return $this->getCod_projeto();
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastrointegrantes;
        $dal->excluir($this->getCod_integrante());
        return $this->getCod_projeto();
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastrointegrantes;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCod_integrante() {
        return $this->cod_integrante;
    }
    
    private function getCod_usuario(){
        return $this->cod_usuario;
    }
    
    private function getCod_projeto(){
        return $this->cod_projeto;
    }


    private function setCod_integrante($post) {
        if (isset($post['cod_integrante'])){
            $this->cod_integrante = strtoupper($post['cod_integrante']);
        }
    }
    
    private function setCod_usuario($post) {
        if (isset($post['cod_usuario'])){
            $this->cod_usuario = strtoupper($post['cod_usuario']);
        }
    }
    
    private function setCod_projeto($post) {
        if (isset($post['cod_projeto'])){
            $this->cod_projeto = strtoupper($post['cod_projeto']);
        }
        else{
            $this->cod_projeto = "";
        }
        if (isset($_GET['cod_projeto'])){
            $this->cod_projeto = strtoupper($_GET['cod_projeto']);
            unset ($_GET);
        }
    }
}
