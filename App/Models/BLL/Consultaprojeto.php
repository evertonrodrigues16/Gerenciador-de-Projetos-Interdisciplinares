<?php

namespace App\Models\BLL;

class Consultaprojeto extends Projeto{
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
        $dal = new \App\Models\DAL\Consultaprojeto();
        $dCurso = new \App\Models\DAL\Cadastrocurso();
        $dUsuario = new \App\Models\DAL\Cadastrousuario();
        $dSemestre = new \App\Models\DAL\Cadastrosemestre();
        $dStatus = new \App\Models\DAL\Cadastrostatusprojeto();       
                
        $dados['1'] = $dal->consulta();
        $dados['2'] = $dCurso->consulta();
        $dados['3'] = $dUsuario->comboBox();
        $dados['4'] = $dSemestre->consulta();
        $dados['5'] = $dStatus->consulta();
        //var_dump($dados);
        return $dados;      
    }
    
    /*
     * ESTANCIA A CLASSE MODEL DE ACESSO A DADOS
     * CHAMA O METODO FILTRAR PASSANDO OS DADOS FORNECIDOS PELO USUARIO
     */
    public function filtrar(){        
        $dal = new \App\Models\DAL\Consultaprojeto;
        $dados['1'] = $dal->filtrar($this->getNome_projeto(), $this->getPalavras_chave(),
                $this->getCod_curso()); 
        //var_dump($dados);
        return $dados;
    } 
}
