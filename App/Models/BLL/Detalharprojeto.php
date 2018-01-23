<?php

namespace App\Models\BLL;

class Detalharprojeto extends Projeto{
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
     * ESTANCIA A CLASSE  MODEL DE ACESSO A DADOS
     * CHAMA O METODO CONSULTA
     * RETORNANDO UM ARRAY COM OS DADOS VINDOS DO BANCO
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Detalharprojeto();
        $dCurso = new \App\Models\DAL\Cadastrocurso();
        $dUsuario = new \App\Models\DAL\Cadastrousuario();
        $dSemestre = new \App\Models\DAL\Cadastrosemestre();
        $dStatus = new \App\Models\DAL\Cadastrostatusprojeto();
        $dIntegrantes = new \App\Models\DAL\Cadastrointegrantes();
                
        $dados['1'] = $dal->consulta($this->getCod_projeto());
        $dados['2'] = $dCurso->consulta();
        $dados['3'] = $dUsuario->comboBox();
        $dados['4'] = $dSemestre->consulta();
        $dados['5'] = $dStatus->consulta();
        $dados['6'] = $dIntegrantes->consulta($this->getCod_projeto());
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO ATUALIZAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Detalharprojeto;
        if ($this->getArquivo() != "")
        {
            $dal->atualizar($this->getCod_projeto(), $this->getNome_projeto(), $this->getPalavras_chave(), $this->getObjetivo(),
                $this->getResumo(), $this->getArquivo(), $this->getCod_curso(), $this->getCod_usuario(),
                $this->getCod_semestre());
        }
        else
        {
            $dal->atualizarSemArquivo($this->getCod_projeto(), $this->getNome_projeto(), $this->getPalavras_chave(), $this->getObjetivo(),
                $this->getResumo(), $this->getCod_curso(), $this->getCod_usuario(),
                $this->getCod_semestre());
        }
        return $this->getCod_projeto();
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO EXCLUIR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Detalharprojeto;
        $dal->excluir($this->getCod_projeto()); 
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO APROVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function aprovar(){
        $dal = new \App\Models\DAL\Detalharprojeto;
        $dal->aprovar($this->getCod_projeto(), "1");
    }
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO REPROVAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function reprovar(){
        $dal = new \App\Models\DAL\Detalharprojeto;
        $dal->aprovar($this->getCod_projeto(), "2");
    }
}
