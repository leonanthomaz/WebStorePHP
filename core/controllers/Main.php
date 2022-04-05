<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\enviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;

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

        //Buscar a lista de produtos
        $produtos = new Produtos();
        
        $c = 'todos';

        if(isset($_GET['c'])){
            $c = $_GET['c'];
        }

        //Buscar no banco
        $lista_produtos = $produtos->listaProdutosDisponiveis($c);
        $lista_categorias = $produtos->listaCategorias();

        $dados = [
            'produtos' => $lista_produtos,
            'categorias' => $lista_categorias,
        ];
        
        //Store::printData($lista_produtos);

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
            
        ], $dados);
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
            
            //Redireciona pagina inicial
            Store::redirect();
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
           
            //Redireciona pagina inicial
            Store::redirect();
        }
    }

    public function login(){

        //Verificar se existe cliente logado
        if(Store::clienteLogado()){
            Store::redirect();
            return;
        }

        //Apresentação do formulário
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_form',
            'layouts/footer',
            'layouts/html_footer'
        ]);
        
    }

    public function conectar(){

        //Verificar se existe cliente logado
        if(Store::clienteLogado()){
            Store::redirect();
            return;
        }

        //Verificando se tem o post do form login
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            Store::redirect();
            return;
        }

        // validar se os campos vieram corretamente preenchidos
        if (
            !isset($_POST['email']) ||
            !isset($_POST['senha']) ||
            !filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulário
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        //Prepara os dados para o model
        $usuario = trim(strtolower($_POST['email']));
        $senha = trim($_POST['senha']);

        //carrega o model e verifica
        $cliente = new Clientes();
        $resultado = $cliente->validarLogin($usuario, $senha);

        if(is_bool($resultado)){
            $_SESSION['erro'] = 'Login inválido...';
            Store::redirect('login');
            return;
        }else{

           // login válido. Coloca os dados na sessão
           $_SESSION['cliente'] = $resultado->id_cliente;
           $_SESSION['usuario'] = $resultado->email;
           $_SESSION['nome'] = $resultado->nome;

           // se não, redirecionar para o 
           if(isset($_SESSION['tmp_carrinho'])){
            unset($_SESSION['tmp_carrinho']);
            Store::redirect('finalizar_pedido_resumo');
           }else{
            Store::redirect();
           } 
        }

        echo 'Ok';

    }

    // ===========================================================
    public function logout(){

        // remove as variáveis da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome']);

        //session_destroy();

        // redireciona para o início da loja
        Store::redirect();
    }

}
