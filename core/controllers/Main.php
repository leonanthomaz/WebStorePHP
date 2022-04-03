<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Store;

class Main {

    public function index(){

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    public function loja(){
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    public function carrinho(){
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    public function cadastrar(){

        //Verificar se já tem sessão aberta
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'cadastrar',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    public function registrar(){

        //Verificar se já tem sessão aberta
        if(Store::clienteLogado()){
            $this->index();
            return;
        }

        //Verificar injection direta
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->index();
            return;
        }

        if($_POST['senha'] !== $_POST['senha2']){
            $_SESSION['erro'] = 'As senhas não conferem';
            $this->cadastrar();
            return;
        }

        $db = new Database();
        $parametros = [
            'email' => strtolower(trim($_POST['email'])),
        ];
        $resultados = $db->select('SELECT * FROM clientes WHERE email = :email', $parametros);

        if(count($resultados) != 0){
            $_SESSION['erro'] = 'Já existe um cliente com este email';
            $this->cadastrar();
            return;
        }

        $purl = Store::criarHash();
        //echo $purl;

        $parametros = [
            ':email' => strtolower(trim($_POST['email'])),
            ':senha' => password_hash($_POST['email'], PASSWORD_DEFAULT),
            ':nome' => (trim($_POST['nome'])),
            ':endereco' => ($_POST['endereco']),
            ':cidade' => $_POST['cidade'],
            ':telefone' => (trim($_POST['telefone'])),
            ':purl' => $purl,
            ':ativo' => 0,
        ];

        $db->insert('INSERT INTO clientes 
        VALUES (
        null,
        :email, 
        :senha, 
        :nome, 
        :endereco, 
        :cidade, 
        :telefone, 
        :purl, 
        :ativo,
        NOW(),
        NOW(),
        null
        )', $parametros);
        
        $link_purl = 'http://localhost/sistema/WebStorePHP/public/?a=confirmar_email&purl='.$purl;

        //Criar
        
    }
}
