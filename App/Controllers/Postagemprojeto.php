<?php

namespace App\Controllers;

class Postagemprojeto {
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
            if ($per->verificacoes("adcionar_projeto")){
            $view = new \App\Views\Postagemprojeto\Postagemprojeto();
            $model = new \App\Models\BLL\Postagemprojeto();
            $view->render($model->consulta(), $msg, "novo");
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
        $model = new \App\Models\BLL\Postagemprojeto();
        $cod = $model->salvar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/cadastrointegrantes?cod_projeto=$cod");
        $this->index("Salvo com sucesso!");
    }
}
