<?php

namespace App\Controllers;

class Aluno extends Cadastrousuario{
    /*
     * O MÉTODO INDEX É PUBLICO, PORTANTO O SISTEMA NÃO FARÁ VERIFICAÇÃO DE LOGIN
     * PARA PERMITIR QUE PESSOAS SEM CADASTRO POSSAM ACESSAR ESSA PAGINA E SE CADASTRAR
     */
    public function index($msg=""){
        $view = new \App\Views\Cadastrousuario\Aluno();
        $model = new \App\Models\BLL\Aluno();
        $view->render($model->consultar(), $msg, "novo");
    }
    
    public function consultar($msg=""){
        /*
         * VERIFICA SE HÁ UMA SESSION EM ANDAMENTO, SE NÃO CRIA UMA NOVA
         * EM SEGUIDA VERIFICA SE O USUARIO ESTÁ LOGADO, SE NÃO O REDIRECIONA A PAGINA DE LOGIN
         *///echo 'consultar ok';
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['logado']) == true){
            $view = new \App\Views\Cadastrousuario\Aluno();
            $model = new \App\Models\BLL\Aluno();
            $view->render($model->consultar(), $msg, "editar"); 
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }
    }
    /*
     * Enstacia a classe model aluno e view aluno
     * Em seguida chama o método salvar, exibe a tela novamente com a msg de confirmacao
     */
    public function salvar(){
        $model = new \App\Models\BLL\Aluno();
        $model->salvar();                
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/login");
        $this->index("Salvo com sucesso!");
    }
    /*
     * Instacia a classe model aluno e view aluno
     * Em seguida chama o método atualizar, exibe a tela novamente com a msg de confirmacao
     */
    public function atualizar(){
        $model = new \App\Models\BLL\Aluno();
        $model->atualizar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/");
        $this->index("Atualizado com sucesso!");
    }
}
