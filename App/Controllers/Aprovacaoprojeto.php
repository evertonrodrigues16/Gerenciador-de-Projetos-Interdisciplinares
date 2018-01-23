<?php

namespace App\Controllers;

class Aprovacaoprojeto {
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
            if ($per->verificacoes("aprovar_trabalho")){
            $view = new \App\Views\Aprovacaoprojeto\Aprovacaoprojeto();
            $model = new \App\Models\BLL\Detalharprojeto();
            $view->render($model->consulta(), $msg, "bloqueado");
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
     * Em seguida chama o método aprovar, exibe a tela novamente com a msg de confirmacao
     */
    public function aprovar(){
        $model = new \App\Models\BLL\Detalharprojeto();
        $cod = $model->aprovar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/analiseprojeto");
        $this->index("Projeto aprovado com sucesso!");
    }
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método reprovar, exibe a tela novamente com a msg de confirmacao
     */
    public function reprovar(){
        $model = new \App\Models\BLL\Detalharprojeto();
        $cod = $model->reprovar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/analiseprojeto");
        $this->index("Projeto reprovado com sucesso!");
    }
}
