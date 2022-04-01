<?php

//Inicializando a sessão

use core\classes\Database;

session_start();

//Carregando o config
require_once '../config.php';

//carrega todas as classes do projeto
require_once '../vendor/autoload.php';

//Carregando Rotas
require_once '../core/routes.php';

// $db = new Database();
// $clientes = $db->select('SELECT * FROM clientes');

// echo '<pre>';
// print_r($clientes);
// echo '</pre>';
