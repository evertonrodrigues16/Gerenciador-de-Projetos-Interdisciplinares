<?php

namespace App\Models\BLL;

class Professor extends Cadastrousuario{
    
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
        $this->setCod_usuario($post);
        $this->setNome($post);
        $this->setLogin($post);
        $this->setCod_curso($post);
        $this->setCod_campus($post);
        $this->setEmail($post);
        $this->setCod_perfil($post);
        $this->setSenha($post);
        $this->setTelefone1($post);
        $this->setTelefone2($post);
    }
    
    /*
     * CONSULTA UM USUARIO PROFESSOR ATRAVES DO SEU COD DE USUARIO
     * CARREGA TAMBÉM OS DADOS QUE IRÃO PREENCHER AS COMBOBOX
     */
    public function consulta(){
        $dal = new \App\Models\DAL\Professor();
        $comboCurso = new \App\Models\BLL\Cadastrocurso();
        $comboCampus = new \App\Models\BLL\Cadastrocampus();
        $comboPerfil = new \App\Models\BLL\Cadastroperfilusuario();
                
        $cod = "";        
        if (isset($_SESSION['codusuario'])){
            $cod = $_SESSION['codusuario'];
        }
        
        unset($_GET);
        $dados['1'] = $dal->consultar($cod);
        $dados['2'] = $comboCurso->consulta();
        $dados['3'] = $comboCampus->consulta();
        $dados['4'] = $comboPerfil->filtrar('PROFESSOR');
        
        return $dados;
    }
    
    /*
     * SALVA UM USUARIO PROFESSOR NA BASE DE DADOS
     */
    public function salvar(){
        $dal = new \App\Models\DAL\Professor();
        $cod = $dal->salvar($this->getNome(), $this->getLogin(), $this->getCod_curso(),
                $this->getCod_campus(), $this->getEmail(), $this->getCod_perfil(), $this->getSenha());
        $dal->salvarTelefone($cod, $this->getTelefone1(), $this->getTelefone2());
    }
    
    /*
     * ATUALIZA OS DADOS DE UM USUARIO PROFESSOR NA BASE DE DADOS
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Professor();
        $dal->atualizar($this->getCod_usuario(), $this->getNome(), "", $this->getLogin(), $this->getCod_curso(),
                $this->getCod_campus(), $this->getEmail(), $this->getCod_perfil(), $this->getSenha());
        $dal->atualizarTelefone($this->getCod_usuario(), $this->getTelefone1(), $this->getTelefone2());
    }
}
