<?php

namespace App\Models\BLL;

class Cadastrocurso {
    private $cod_curso;
    private $curso;
    
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
        $this->setCod_curso($post);
        $this->setCurso($post);
    }
    /*
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Cadastrocurso;
        $dados['1'] = $dal->consulta();
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO SALVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Cadastrocurso;
        $dal->salvar($this->getCurso());
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Cadastrocurso;        
        $dal->atualizar($this->getCod_curso(), $this->getCurso()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastrocurso;
        $dal->excluir($this->getCod_curso()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastrocurso;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }    
    /*
     * INÍCIO GETTERS E SETTERS
     */
    private function getCod_curso() {
        return $this->cod_curso;
    }
    
    private function getCurso(){
        return $this->curso;
    }


    private function setCod_curso($post) {
        if (isset($post['cod_curso'])){
            $this->cod_curso = strtoupper($post['cod_curso']);
        }
    }
    
        private function setCurso($post) {
        if (isset($post['curso'])){
            $this->curso = strtoupper($post['curso']);
        }
    }
}
