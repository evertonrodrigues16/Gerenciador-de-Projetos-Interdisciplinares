<?php

namespace App\Controllers;

class Cadastroperfilusuario {
    /*
     * FAZ A VERIFICAÇÃO DE LOGIN E PERMISSÕES DO USUARIO
     * EM SEGUIDA ESTANCIA A CLASSE MODEL E VIEW
     * BUSCA OS DADOS DE TODOS OS CAMPUS NO BANCO DE DADOS
     * E OS EXIBE NA TELA
     */
    public function index($msg=""){
        $per = new \App\Models\BLL\Permissoes();
        
        $per->iniciarSessao();
        if ($per->verificarLogin()){
            if ($per->verificacoes("gerenciar_usuario")){
            $view = new \App\Views\Cadastroperfilusuario\Cadastroperfilusuario();
            $model = new \App\Models\BLL\Cadastroperfilusuario();
            $view->render($model->consulta(), $msg);
            }
            else{
                header("Location: http://$_SERVER[HTTP_HOST]/acessonegado");
            }
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método salvar, exibe a tela novamente com a msg de confirmacao
     */
    public function salvar(){
        $model = new \App\Models\BLL\Cadastroperfilusuario();
        $model->salvar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastroperfilusuario");
        $this->index("Salvo com sucesso!");
    }
    
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método atualizar, exibe a tela novamente com a msg de confirmacao
     */
    public function atualizar(){
        $model = new \App\Models\BLL\Cadastroperfilusuario();
        $model->atualizar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastroperfilusuario");
        $this->index("Atualizado com sucesso!");
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método excluir, exibe a tela novamente com a msg de confirmacao
     */
    public function excluir(){
        $model = new \App\Models\BLL\Cadastroperfilusuario();
        $model->excluir();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastroperfilusuario");
        $this->index("Excluído com sucesso!");
    }
    
    /*
     * Enstacia a classe model e view
     * Recebe os dados via ajax
     * Recebe os dados da variavel global $_POST
     * Destroi a variavel global $_POST para que o sistema entenda que não esta sendo processado mais um formulario
     * Chama o metodo filtrar da view passando os dados retornados pelo banco de dados na funcao filtrar da model
     */
    public function filtrar(){
        $view = new \App\Views\Cadastroperfilusuario\Cadastroperfilusuario();
        $model = new \App\Models\BLL\Cadastroperfilusuario();
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_POST);
        $argumento = strtoupper($post['argumento']);
        $view->filtrar($model->filtrar($argumento)); 
    }
}
