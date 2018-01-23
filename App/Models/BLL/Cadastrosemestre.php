<?php

namespace App\Models\BLL;

class Cadastrosemestre {
    private $cod_semestre;
    private $semestre;
    
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
        $this->setCod_semestre($post);
        $this->setSemestre($post);
    }
    /*
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Cadastrosemestre;
        $dados['1'] = $dal->consulta();
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO SALVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Cadastrosemestre;
        $dal->salvar($this->getSemestre());
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Cadastrosemestre;        
        $dal->atualizar($this->getCod_semestre(), $this->getSemestre()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastrosemestre;
        $dal->excluir($this->getCod_semestre()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastrosemestre;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCod_semestre() {
        return $this->cod_semestre;
    }
    
    private function getSemestre(){
        return $this->semestre;
    }


    private function setCod_semestre($post) {
        if (isset($post['cod_semestre'])){
            $this->cod_semestre = strtoupper($post['cod_semestre']);
        }
    }
    
        private function setSemestre($post) {
        if (isset($post['semestre'])){
            $this->semestre = strtoupper($post['semestre']);
        }
    }
}
