<?php

namespace App\Controllers;

class Cadastrousuario {
    /*
     * FAZ A VERIFICAÇÃO DE LOGIN E PERMISSÕES DO USUARIO
     * EM SEGUIDA ESTANCIA A CLASSE MODEL  E VIEW 
     * BUSCA OS DADOS DE TODOS OS USUARIOS NO BANCO DE DADOS
     * E OS EXIBE NA TELA
     */
    public function index($msg=""){   
        $per = new \App\Models\BLL\Permissoes();
        
        $per->iniciarSessao();
        if ($per->verificarLogin()){
            if ($per->verificacoes("gerenciar_usuario")){
            $view = new \App\Views\Cadastrousuario\Cadastrousuario();
            $model = new \App\Models\BLL\Cadastrousuario();
            unset($_GET);
            $view->render($model->consultar(), $msg);
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
     * USUARIOS ADMINISTRADORES NÃO PODEM CRIAR NOVOS USUARIOS, ELES DEVEM SE  REGISTRAR NO SISTEMA SOZINHO
     * O METODO EXIBE UMA MSG DE ALERTA NA TELA
     */
    public function salvar(){
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastrousuario");
        $this->index("Usuário não cadastrado! O sistema não aceita criação de usuário pelo administrador do sistema!");
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método ATUALIZAR, exibe a tela novamente com a msg de confirmacao
     */
    public function atualizar(){
        $model = new \App\Models\BLL\Cadastrousuario();
        $model->atualizar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastrousuario");
        $this->index("Atualizado com sucesso!");
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método EXCLUIR, exibe a tela novamente com a msg de confirmacao
     */
    public function excluir(){
        $model = new \App\Models\BLL\Cadastrousuario();
        $model->excluir();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastrousuario");
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
        $view = new \App\Views\Cadastrousuario\Cadastrousuario();
        $model = new \App\Models\BLL\Cadastrousuario();
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        unset($_POST);
        $argumento = strtoupper($post['argumento']);
        $view->filtrar($model->filtrar($argumento)); 
    }
    private function msg($msg){
        include_once \BASE_DIR  . DS . 'Modal.phtml';
    }
}
