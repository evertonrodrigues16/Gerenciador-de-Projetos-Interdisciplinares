<?php

namespace App\Models\BLL;


class Cadastrousuario {
    private $cod_usuario;
    private $nome;
    private $ra;
    private $login;
    private $cod_campus;
    private $cod_curso;
    private $telefone1;
    private $telefone2;
    private $email;
    private $cod_perfil;
    private $senha;    
    
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
        $this->setRa($post);
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
     * METODO QUE PREENCHE OS COMBOBOX E EXIBE O FORMULARIO PRONTO PARA RECEBER OS DADOS DO USUARIO
     */
    public function index(){
        $comboCurso = new \App\Models\BLL\Curso();
        $comboCampus = new \App\Models\BLL\Cadastrocampus();
        $comboPerfil = new \App\Models\BLL\Cadastroperfilusuario();
                
        $dados['2'] = $comboCurso->consultar();
        $dados['3'] = $comboCampus->consulta();
        $dados['4'] = $comboPerfil->consulta();
    }
    
    /*
     * MÉTODO EXCLUIR CHAMA O MÉTODO NA CAMADA DE DADOS PASSANDO O COD DO USUARIO COMO PARAMETRO
     */
    public function excluir(){
        $dal = new \App\Models\DAL\Cadastrousuario;
        $dal->excluir($this->getCod_usuario());
    }
    
    /*
     * ESSE MÉTODO IRÁ BUSCAR OS DADOS DE TODOS OS USUARIOS CADASTRADOS AO SISTEMA
     * TERÁ ACESSO A ESSE METODO SOMENTE USUARIOS ADMINISTRADORES
     */
    public function consultar(){
        $dal = new \App\Models\DAL\Cadastrousuario;
        $comboCurso = new \App\Models\BLL\Cadastrocurso();
        $comboCampus = new \App\Models\BLL\Cadastrocampus();
        $comboPerfil = new \App\Models\BLL\Cadastroperfilusuario();
                
        $dados['1'] = $dal->consultar("");
        $dados['2'] = $comboCurso->consulta();
        $dados['3'] = $comboCampus->consulta();
        $dados['4'] = $comboPerfil->consulta();
        
        return $dados;
    }
    
    public function filtrar($argumento){        
        $dal = new \App\Models\DAL\Cadastrousuario;
        $dados['1'] = $dal->filtrar($argumento); 
        return $dados;
    }   
    /*
     * ATUALIZA UM USUARIO NA BASE DE DADOS
     * ACESSO RESTRITO A ADMINISTRADORES
     */
    public function atualizar(){
        $dal = new \App\Models\DAL\Aluno();
        $dal->atualizar($this->getCod_usuario(), $this->getNome(), $this->getRa(), $this->getLogin(), $this->getCod_curso(),
                $this->getCod_campus(), $this->getEmail(), $this->getCod_perfil(), $this->getSenha());
        $dal->atualizarTelefone($this->getCod_usuario(), $this->getTelefone1(), $this->getTelefone2());
    }
    /*
     * INÍCIO GETTERS E SETTERS
     */
    protected function getCod_usuario() {
        return $this->cod_usuario;
    }
    
    protected function setCod_usuario($post) {
        if (isset($post['cod_usuario'])){
            $this->cod_usuario = strtoupper($post['cod_usuario']);
        }
    }
    
    protected function getNome() {
        return $this->nome;
    }
    
    protected function setNome($post) {
        if (isset($post['nome'])){
            $this->nome = strtoupper($post['nome']);
        }
    }
    
    protected function getCod_campus() {
        return $this->cod_campus;
    }
    
    protected function setCod_campus($post) {
        if (isset($post['cod_campus'])){
            $this->cod_campus = strtoupper($post['cod_campus']);
        }
    }
    
    protected function getCod_curso() {
        return $this->cod_curso;
    }
    
    protected function setCod_curso($post) {
        if (isset($post['cod_curso'])){
            $this->cod_curso = strtoupper($post['cod_curso']);
        }
    }
    
    protected function getTelefone1() {
        return $this->telefone1;
    }
    
    protected function setTelefone1($post) {
        if (isset($post['telefone1'])){
            $this->telefone1 = strtoupper($post['telefone1']);
        }
    }
    
    protected function getTelefone2() {
        return $this->telefone2;
    }
    
    protected function setTelefone2($post) {
        if (isset($post['telefone2'])){
            $this->telefone2 = strtoupper($post['telefone2']);
        }
    }
    
    protected function getEmail() {
        return $this->email;
    }
    
    protected function setEmail($post) {
        if (isset($post['email'])){
            $this->email = strtoupper($post['email']);
        }
    }
    
    protected function getCod_perfil() {
        return $this->cod_perfil;
    }
    
    protected function setCod_perfil($post) {
        if (isset($post['cod_perfil'])){
            $this->cod_perfil = strtoupper($post['cod_perfil']);
        }
    }
    
    protected function getSenha() {
        return $this->senha;
    }
    
    protected function setSenha($post) {
        if (isset($post['senha'])){
            $this->senha = $post['senha'];
        }
    }
    
    protected function getRa() {
        return $this->ra;
    }
    
    protected function setRa($post) {
        if (isset($post['ra'])){
            $this->ra = strtoupper($post['ra']);
        }
    }
    
    protected function getLogin() {
        return $this->login;
    }
    
    protected function setLogin($post) {
        if (isset($post['login'])){
            $this->login = strtoupper($post['login']);
        }
    }
    /*
     * FIM GETTERS E SETTERS
     */
}
