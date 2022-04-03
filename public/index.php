<?php

//Inicializando a sessão

use core\classes\Database;

session_start();

//carrega todas as classes do projeto
require_once '../vendor/autoload.php';

//Carregando Rotas
require_once '../core/routes.php'; 
