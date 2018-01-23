<?php

namespace App\Models\BLL;

class Projeto {
    private $cod_projeto;
    private $nome_projeto;
    private $palavras_chave;
    private $objetivo;
    private $resumo;
    private $arquivo;
    private $cod_curso;
    private $cod_usuario;
    private $cod_semestre;
    private $cod_status_projeto;
    
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
        $this->setCod_projeto($post);
        $this->setNome_projeto($post);
        $this->setPalavras_chave($post);
        $this->setObjetivo($post);
        $this->setResumo($post);
        $this->setArquivo($post);
        $this->setCod_curso($post);
        $this->setCod_usuario($post);
        $this->setCod_semestre($post);
        $this->setCod_status_projeto($post);
    }
    
    
    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    public function getCod_projeto() {
        return $this->cod_projeto;
    }
    
    public function getNome_projeto(){
        return $this->nome_projeto;
    }
    
    public function getPalavras_chave(){
        return $this->palavras_chave;
    }
    
    public function getObjetivo(){
        return $this->objetivo;
    }
    
    public function getResumo(){
        return $this->resumo;
    }
    
    public function getArquivo(){
        return $this->arquivo;
    }
    
    public function getCod_curso(){
        return $this->cod_curso;
    }
    
    public function getCod_usuario(){
        return $this->cod_usuario;
    }
    
    public function getCod_semestre(){
        return $this->cod_semestre;
    }
    
    public function getCod_status_projeto(){
        return $this->cod_status_projeto;
    }


    public function setCod_projeto($post) {
        if (isset($post['cod_projeto'])){
            $this->cod_projeto = strtoupper($post['cod_projeto']);
        }
        if (isset($_GET['cod_projeto'])){
            $this->cod_projeto = strtoupper($_GET['cod_projeto']);
            unset($_GET);
        }
    }
    
    public function setNome_projeto($post) {
        if (isset($post['nome_projeto'])){
            $this->nome_projeto = strtoupper($post['nome_projeto']);
        }
    }
    
    public function setPalavras_chave($post) {
        if (isset($post['palavras_chave'])){
            $this->palavras_chave = strtoupper($post['palavras_chave']);
        }
    }
    
    public function setObjetivo($post) {
        if (isset($post['objetivo'])){
            $this->objetivo = strtoupper($post['objetivo']);
        }
    }
    
    public function setResumo($post) {
        if (isset($post['resumo'])){
            $this->resumo = strtoupper($post['resumo']);
        }
    }
    
    public function setArquivo($post) {
        if (isset($_FILES['arquivo'])){
            $upload = new \App\Models\DAL\Upload();        
            $this->arquivo = $upload->upload("Arquivos");
        }
        else
        {
            $this->arquivo = "";
        }
    }
    
    public function setCod_curso($post) {
        if (isset($post['cod_curso'])){
            $this->cod_curso = strtoupper($post['cod_curso']);
        }
    }
    
    public function setCod_usuario($post) {
        if (isset($post['cod_usuario'])){
            $this->cod_usuario = strtoupper($post['cod_usuario']);
        }
    }
    
    public function setCod_semestre($post) {
        if (isset($post['cod_semestre'])){
            $this->cod_semestre = strtoupper($post['cod_semestre']);
        }
    }
    
    public function setCod_status_projeto($post) {
        if (isset($post['cod_status_projeto'])){
            $this->cod_status_projeto = strtoupper($post['cod_status_projeto']);
        }
    }
}
