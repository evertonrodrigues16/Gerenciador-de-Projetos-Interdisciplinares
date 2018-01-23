<?php

namespace App\Models\BLL;

class Cadastropermissoes {
    private $cod_permissao;
    private $cod_perfil;
    private $adcionar_projeto;
    private $editar_projeto;
    private $excluir_projeto;
    private $gerenciar_usuario;
    private $aprovar_trabalho;
    
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
        $this->setCod_permissao($post);
        $this->setCod_perfil($post);
        $this->setAdcionar_projeto($post);
        $this->setEditar_projeto($post);
        $this->setExcluir_projeto($post);
        $this->setGerenciar_usuario($post);
        $this->setAprovar_trabalho($post);
    }
    /*
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Cadastropermissoes();
        $combo = new Cadastroperfilusuario();
        $dados['1'] = $dal->consulta();
        $dados['2'] = $combo->consulta();
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO SALVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Cadastropermissoes;
        $dal->salvar($this->getCod_perfil(), $this->getAdcionar_projeto(), $this->getEditar_projeto(), 
                $this->getExcluir_projeto(), $this->getGerenciar_usuario(), $this->getAprovar_trabalho());
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Cadastropermissoes;        
        $dal->atualizar($this->getCod_permissao(), $this->getCod_perfil(), $this->getAdcionar_projeto(), 
                $this->getEditar_projeto(),                 $this->getExcluir_projeto(), $this->getGerenciar_usuario(), 
                $this->getAprovar_trabalho()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastropermissoes;
        $dal->excluir($this->getCod_permissao()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastropermissoes;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCod_permissao() {
        return $this->cod_permissao;
    }
    
    private function getCod_perfil(){
        return $this->cod_perfil;
    }
    private function getAdcionar_projeto(){
        return $this->adcionar_projeto;
    }
    
    private function getEditar_projeto(){
        return $this->editar_projeto;
    }
    
    private function getExcluir_projeto(){
        return $this->excluir_projeto;
    }
    
    private function getGerenciar_usuario(){
        return $this->gerenciar_usuario;
    }
    
    private function getAprovar_trabalho(){
        return $this->aprovar_trabalho;
    }


    private function setCod_permissao($post) {
        if (isset($post['cod_permissao'])){
            $this->cod_permissao = strtoupper($post['cod_permissao']);
        }
    }
    
    private function setCod_perfil($post) {
        if (isset($post['cod_perfil'])){
            $this->cod_perfil = strtoupper($post['cod_perfil']);
        }
    }
    
    private function setAdcionar_projeto($post) {
        if (isset($post['adcionar_projeto'])){
            $this->adcionar_projeto = strtoupper($post['adcionar_projeto']);
        }
    }
    
    private function setEditar_projeto($post) {
        if (isset($post['editar_projeto'])){
            $this->editar_projeto = strtoupper($post['editar_projeto']);
        }
    }
    
    private function setExcluir_projeto($post) {
        if (isset($post['excluir_projeto'])){
            $this->excluir_projeto = strtoupper($post['excluir_projeto']);
        }
    }
    
    private function setGerenciar_usuario($post) {
        if (isset($post['gerenciar_usuario'])){
            $this->gerenciar_usuario = strtoupper($post['gerenciar_usuario']);
        }
    }
    
    private function setAprovar_trabalho($post) {
        if (isset($post['aprovar_trabalho'])){
            $this->aprovar_trabalho = strtoupper($post['aprovar_trabalho']);
        }
    }
}
