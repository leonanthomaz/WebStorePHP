<?php

$rotas = [
    'inicio' => 'main@index',
    'loja' => 'main@loja',

    //Cliente - cadastro
    'cadastrar' => 'main@cadastrar',
    'registrar' => 'main@registrar',
    'cadastro_solicitado' => 'main@cadastro_solicitado',
    'confirmar_email' => 'main@confirmar_email',

    //Cliente - acesso
    'login' => 'main@login',
    'logout' => 'main@logout',
    'conectar' => 'main@conectar',

    //Carrinho
    'add_carrinho' => 'carrinho@add_carrinho',
    'carrinho' => 'carrinho@carrinho',
    'limpar_carrinho' => 'carrinho@limpar_carrinho',

];

$acao = 'inicio';

if(isset($_GET['a'])){
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'inicio';
    }else{
        $acao = $_GET['a'];
    }
}

$partes = explode('@', $rotas[$acao]);
$controlador = 'core\\controllers\\'.ucfirst($partes[0]);
$metodo = $partes[1];

$ctr = new $controlador();
$ctr->$metodo();
