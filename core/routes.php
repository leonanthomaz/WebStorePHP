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
    'remover_item' => 'carrinho@remover_item',
    'finalizar_pedido' => 'carrinho@finalizar_pedido',
    'finalizar_pedido_resumo' => 'carrinho@finalizar_pedido_resumo',
    'set_endereco_alternativo' => 'carrinho@set_endereco_alternativo',
    'metodo_pagamento' => 'carrinho@metodo_pagamento',

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
