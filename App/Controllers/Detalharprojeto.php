<?php

namespace App\Controllers;

class Detalharprojeto{
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
            $view = new \App\Views\Detalharprojeto\Detalharprojeto();
            $autor = $per->verificaIntegrante(); //POSTERIORMENTE VERIFICAR SE O USUARIO É AUTOR DO PROJETO, SE SIM RETORNAR EDITAR, SE NÃO RETORNAR BLOQUEADO
            $model = new \App\Models\BLL\Detalharprojeto();
            
            $view->render($model->consulta(), $msg, $autor);
        }
        else{
            header("Location: http://$_SERVER[HTTP_HOST]/login");
        }
    }
    
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método atualizar, exibe a tela novamente com a msg de confirmacao
     */
    public function atualizar(){
        $model = new \App\Models\BLL\Detalharprojeto();
        $cod = $model->atualizar();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/detalharprojeto?cod_projeto=$cod");
        $this->index("Atualizado com sucesso!");
    }
    
    /*
     * Enstacia a classe model e view
     * Em seguida chama o método excluir, exibe a tela novamente com a msg de confirmacao
     */
    public function excluir(){
        $model = new \App\Models\BLL\Detalharprojeto();
        $model->excluir();
        header("refresh: 2; url=http://$_SERVER[HTTP_HOST]/consultaprojeto");
        $this->index("Excluído com sucesso!");
    }
}
