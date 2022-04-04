<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\enviarEmail;
use core\classes\Store;
use core\models\Clientes;

class Main {

    //Carregar o index - home.php
    public function index(){

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    //Carregar o loja - loja.php
    public function loja(){
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    //Carregar o carrinho - carrinho.php
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

    //Validando o cadastro do cliente
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
        $cliente = new Clientes();
        
        if($cliente->verificarEmail($_POST['email'])){
            $_SESSION['erro'] = 'Já existe um cliente com este email';
            $this->cadastrar();
            return;
        }

        //Inserir cliente no banco e retornando o purl
        $email_cliente = strtolower(trim($_POST['email']));
        $purl = $cliente->registrarConta();
    
        //envio do email
        $email = new enviarEmail();
        $resultado = $email->enviarEmailCadastro($email_cliente, $purl);

        if($resultado == true){
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'cadastro_solicitado',
                'layouts/footer',
                'layouts/html_footer'
            ]);
        }else{
            echo 'Erro ao enviar o email';
        }
        
    }

    //Confirmar email
    public function confirmar_email(){

         //Verificar se já tem sessão aberta
         if(Store::clienteLogado()){
            $this->index();
            return;
        }

        //verificar se existe purl
        if(isset($_POST['purl'])){
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        //verifica se purl é valido
        if(strlen($purl) != 12){
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validarEmail($purl);

        if($resultado == true){

            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'validacao_realizada',
                'layouts/footer',
                'layouts/html_footer'
            ]);

        }else{
            echo 'Falha ao registrar';
        }
    }

    public function login(){

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

}
