<?php

namespace App\Models\BLL;

class Permissoes extends Cadastropermissoes{
    
    public function carregaPermissoes ()
    {
        $dal = new \App\Models\DAL\Permissoes();        
        $dados = $dal->consulta($_SESSION['cod_perfil']);
        
        $_SESSION['adcionar_projeto'] = $dados['0']['adcionar_projeto'];
        $_SESSION['editar_projeto'] = $dados['0']['editar_projeto'];
        $_SESSION['excluir_projeto'] = $dados['0']['excluir_projeto'];
        $_SESSION['gerenciar_usuario'] = $dados['0']['gerenciar_usuario'];
        $_SESSION['aprovar_trabalho'] = $dados['0']['aprovar_trabalho'];
    }
    public function iniciarSessao(){
        //VERIFICA SESSÃO E INICIA SESSÃO
        if (!isset($_SESSION)) {
            session_start();
        }
    }
    
    public function verificarLogin(){
        //VERIFICA SE ESTÁ LOGADO
        if (isset($_SESSION['logado']) == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function verificaIntegrante(){
        $integrante = new \App\Models\DAL\Cadastrointegrantes();
        //echo "cod usuario" . $_SESSION['codusuario'] . "cod projeto " . $_GET['cod_projeto'];
        if ($integrante->verficarIntegrante($_SESSION['codusuario'], $_GET['cod_projeto']))
        {
            return 'editar';
        }
        else
        {
            return 'bloqueado';
        }
    }
    
    public function verificacoes($requisicao)
    {        
        switch ($requisicao)
        {
            case 'adcionar_projeto' :
                if ($_SESSION['adcionar_projeto'] == "Acesso Permitido"){
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 'editar_projeto' :
                if ($_SESSION['editar_projeto'] == "Acesso Permitido"){
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 'excluir_projeto' :
                if ($_SESSION['excluir_projeto'] == "Acesso Permitido"){
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 'gerenciar_usuario' :
                if ($_SESSION['gerenciar_usuario'] == "Acesso Permitido"){
                    return true;
                }
                else {
                    return false;
                }
                break;
            case 'aprovar_trabalho' :
                if ($_SESSION['aprovar_trabalho'] == "Acesso Permitido"){
                    return true;
                }
                else {
                    return false;
                }
                break;
        }
    }
}
