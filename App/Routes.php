<?php
/*
 * O ARQUIVO DE ROTAS FAZ A PONTE ENTRE AS REQUISIÇÕES HTTP DO CLIENTE WEB PARA AS RESPOSTAS DO SERVIDOR
 */

namespace App;

class Routes {
    /* PROPRIEDADE QUE IR�? RECEBER UM ARRAY CONTENDO A URL SOLICITADA, O CONTROLLER RESPONSAVEL E A AÇÃO A SER 
     * EXECUTADA 
     */
    private $routes;
    
    /*
     * CONSTRUTOR DA CLASSE, CHAMA OS MÉTODOS INITROUTES() E RUN()
     */
    public function __construct() {        
        $this->initRoutes();
        $this->run($this->getUrl());
    }
    
    /*
     * VERIFICA SE A VARIAVEL GLOBAL $POST['SUBMIT'] EST�? SETADA, SE SIM A VARI�?VEL ACTION RECEBE 
     * O VALOR DA VARIAVEL $POST['SUBMIT']
     * EM SEGUIDA ADICIONA UMA POSIÇÃO NA PROPRIEDADE $ROUTES.
     */
    protected function initRoutes(){
        $action = "index";
        if (isset($_POST['submit'])){
            $action = $_POST['submit'];
        }
        if (isset($_GET['submit'])){
            if ($_GET['submit']=='consultar'){
                $action = $_GET['submit'];
            }            
        }
        
        $routes['index'] = array('route'=>'/','controller'=>"Home",'action'=>'index');
        $routes['login'] = array('route'=>'/login','controller'=>"Login",'action'=>"{$action}");
        $routes['logout'] = array('route'=>'/logout','controller'=>"Login",'action'=>"Logout");
        $routes['cadastrousuario'] = array('route'=>'/cadastrousuario','controller'=>"Cadastrousuario",'action'=>"{$action}");
        $routes['aluno'] = array('route'=>'/aluno','controller'=>"Aluno",'action'=>"{$action}");
        $routes['professor'] = array('route'=>'/professor','controller'=>"Professor",'action'=>"{$action}");
        $routes['cadastrocampus'] = array('route'=>'/cadastrocampus','controller'=>"Cadastrocampus",'action'=>"{$action}");
        $routes['cadastroperfilusuario'] = array('route'=>'/cadastroperfilusuario','controller'=>"Cadastroperfilusuario",'action'=>"{$action}");
        $routes['cadastropermissoes'] = array('route'=>'/cadastropermissoes','controller'=>"Cadastropermissoes",'action'=>"{$action}");
        $routes['cadastrostatusprojeto'] = array('route'=>'/cadastrostatusprojeto','controller'=>"Cadastrostatusprojeto",'action'=>"{$action}");
        $routes['cadastrosemestre'] = array('route'=>'/cadastrosemestre','controller'=>"Cadastrosemestre",'action'=>"{$action}");
        $routes['cadastrocurso'] = array('route'=>'/cadastrocurso','controller'=>"Cadastrocurso",'action'=>"{$action}");
        $routes['postagemprojeto'] = array('route'=>'/postagemprojeto','controller'=>"Postagemprojeto",'action'=>"{$action}");
        $routes['consultaprojeto'] = array('route'=>'/consultaprojeto','controller'=>"Consultaprojeto",'action'=>"{$action}");
        $routes['analiseprojeto'] = array('route'=>'/analiseprojeto','controller'=>"Analiseprojeto",'action'=>"{$action}");
        $routes['aprovacaoprojeto'] = array('route'=>'/aprovacaoprojeto','controller'=>"Aprovacaoprojeto",'action'=>"{$action}");
        $routes['detalharprojeto'] = array('route'=>'/detalharprojeto','controller'=>"Detalharprojeto",'action'=>"{$action}");
        $routes['cadastrointegrantes'] = array('route'=>'/cadastrointegrantes','controller'=>"Cadastrointegrantes",'action'=>"{$action}");
        $routes['acessonegado'] = array('route'=>'/acessonegado','controller'=>"Acessonegado",'action'=>"{$action}");
        $this->setRoutes($routes);
    }
    
    /*
     * OBTEM A REQUISIÇÃO DO CLIENTE HTTP
     * EX: MEUSITE.COM/REQUISIÇÃOAQUI
     */
    protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
    
    /*
     * SETA A PROPRIEDADE ROUTES COM OS DADOS RECEBIDOS NO MÉTODO INITROUTES()
     */
    protected function setRoutes(array $routes){
        $this->routes = $routes;
    }
    
    /*
     * MONTA O OBJETO DA CLASSE CORRESPONDENTE A SOLICITAÇÃO HTTP E EXECUTA O MÉTODO SOLICITADO
     */
    protected function run($url){
        array_walk($this->routes, function($route) use ($url){
            if ($url == $route['route']){
                $class = "App\\Controllers\\" . \ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
        });
    }
    
}
