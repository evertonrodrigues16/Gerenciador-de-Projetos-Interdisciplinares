<?php

namespace App\Models\BLL;

class Cadastroperfilusuario {
    private $cod_perfil;
    private $nome_perfil;
    
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
        $this->setCod_perfil($post);
        $this->setNome_perfil($post);
    }
    /*
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Cadastroperfilusuario;
        $dados['1'] = $dal->consulta();
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO SALVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Cadastroperfilusuario;
        $dal->salvar($this->getNome_perfil());
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Cadastroperfilusuario;        
        $dal->atualizar($this->getCod_perfil(), $this->getNome_perfil()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastroperfilusuario;
        $dal->excluir($this->getCod_perfil()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastroperfilusuario;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCod_perfil() {
        return $this->cod_perfil;
    }
    
    private function getNome_perfil(){
        return $this->nome_perfil;
    }


    private function setCod_perfil($post) {
        if (isset($post['cod_perfil'])){
            $this->cod_perfil = strtoupper($post['cod_perfil']);
        }
    }
    
        private function setNome_perfil($post) {
        if (isset($post['nome_perfil'])){
            $this->nome_perfil = strtoupper($post['nome_perfil']);
        }
    }
}
