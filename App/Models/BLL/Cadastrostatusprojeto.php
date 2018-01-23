<?php

namespace App\Models\BLL;

class Cadastrostatusprojeto {
    private $cod_status_projeto;
    private $status;
    
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
        $this->setCod_status_projeto($post);
        $this->setStatus($post);
    }
    /*
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Cadastrostatusprojeto;
        $dados['1'] = $dal->consulta();
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO SALVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Cadastrostatusprojeto;
        $dal->salvar($this->getStatus());
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Cadastrostatusprojeto;        
        $dal->atualizar($this->getCod_status_projeto(), $this->getStatus()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastrostatusprojeto;
        $dal->excluir($this->getCod_status_projeto()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastrostatusprojeto;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCod_status_projeto() {
        return $this->cod_status_projeto;
    }
    
    private function getStatus(){
        return $this->status;
    }


    private function setCod_status_projeto($post) {
        if (isset($post['cod_status_projeto'])){
            $this->cod_status_projeto = strtoupper($post['cod_status_projeto']);
        }
    }
    
        private function setStatus($post) {
        if (isset($post['status'])){
            $this->status = strtoupper($post['status']);
        }
    }
}
