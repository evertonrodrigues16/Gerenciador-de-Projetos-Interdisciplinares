<?php
/*
 * O ARQUIVO INDEX.PHP � O ARQUIVO PUBLICO DA APLICA��O
 * RESPONSAVEL POR CARREGAR A CLASSE AUTOLOAD E INICIALIZAR A CLASSE DE ROTAS
*/
require_once __DIR__ .'/../vendor/autoload.php';

$route = new App\Routes();