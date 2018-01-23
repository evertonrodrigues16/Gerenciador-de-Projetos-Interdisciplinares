<?php

namespace App\Controllers;

class Professor extends Cadastrousuario{
    /*
     * O MÉTODO INDEX É PUBLICO, PORTANTO O SISTEMA NÃO FARÁ VERIFICAÇÃO DE LOGIN
     * PARA PERMITIR QUE PESSOAS SEM CADASTRO POSSAM ACESSAR ESSA PAGINA E SE CADASTRAR
     */
    public function index($msg=""){
        $view = new \App\Views\Cadastrousuario\Professor();
        $model = new \App\Models\BLL\Professor();
        $view->render($model->consultar(), $msg, "novo");
    }
    
    public function consultar($msg=""){
        /*
         * VERIFICA SE HÁ UMA SESSION EM ANDAMENTO, SE NÃO CRIA UMA NOVA
         * EM SEGUIDA VERIFICA SE O USUARIO ESTÁ LOGADO, SE NÃO O REDIRECIONA A PAGINA DE LOGIN
         */
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['logado']) == true){
            $view = new \App\Views\Cadastrousuario\Professor();
            $model = new \App\Models\BLL\Professor();
            $view->render($model->consulta(), $msg, "editar"); 
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método SALVAR, exibe a tela novamente com a msg de confirmacao
     */
    public function salvar(){
        $model = new \App\Models\BLL\Professor();
        $model->salvar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/login");
        $this->index("Salvo com sucesso!");
        
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método ATUALIZAR, exibe a tela novamente com a msg de confirmacao
     */
    public function atualizar(){
        $model = new \App\Models\BLL\Professor();
        $model->atualizar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/");
        $this->index("Atualizado com sucesso!");
    }
}
