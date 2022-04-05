<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\enviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;

class Carrinho {

    //Carregar o carrinho - carrinho.php
    public function carrinho(){

        //Verificando a existência ou não do carrinho na tela
        if(!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0){

            //Acrescenta ao dados o valor nulo
            $dados = [
                'carrinho' => null
            ];
        }else{

            //Se não, captura os valores dos ids e verifica no banco
            $ids = [];
            foreach($_SESSION['carrinho'] as $id_produto => $qtd){
                array_push($ids, $id_produto);
            }

            $ids = implode(',', $ids);
            $produtos = new Produtos();
            $resultados = $produtos->buscarProdutosPorID($ids);

            //Ciclo de vida do carrinho
            $dados_tmp = [];
            foreach($_SESSION['carrinho'] as $id_produto => $qtd){

                foreach($resultados as $produto){
                    if($produto->id_produto == $id_produto){
                        $id_produto = $produto->id_produto;
                        $imagem = $produto->imagem;
                        $titulo = $produto->nome;
                        $quantidade = $qtd;
                        $preco = $produto->preco * $qtd;
    
                        array_push($dados_tmp, [
                            'id_produto' => $id_produto,
                                'imagem' => $imagem,
                                    'titulo' => $titulo,
                                        'quantidade' => $quantidade,
                                            'preco' => $preco,
                        ]);
                        break;
                    }
                }
            }

            //Pegando o total
            $total_cart = 0;
            foreach($dados_tmp as $item){
                $total_cart += $item['preco'];
            }

            //Acrescentando os dados temporarios ao Total
            array_push($dados_tmp, $total_cart);

            $dados = [
                'carrinho' => $dados_tmp
            ];
            
        }
        
        //Layout do carrinho
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer'
        ], $dados);
    }

    public function add_carrinho(){

        //Catpurando o GET com o id do produto
        if(!isset($_GET['id_produto'])){
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }
        $id_produto = $_GET['id_produto'];

        $Produtos = new Produtos();
        $resultados = $Produtos->verificarEstoqueProduto($id_produto);

        //Catpurando o GET com o id do produto
        if(!$resultados){
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }

        //Gerenciando a variavel
        $carrinho = [];

        if(isset($_SESSION['carrinho'])){
            $carrinho = $_SESSION['carrinho'];
        }

        //Adicionando o produto no carrinho
        if(key_exists($id_produto, $carrinho)){
            //Se já existe produto no carrinho
            $carrinho[$id_produto]++;
        }else{
            //Adicionando produto ao carrinho
            $carrinho[$id_produto] = 1;
        }

        //Atualiza os dados do carrinho na sessão
        $_SESSION['carrinho'] = $carrinho;

        //Resposta
        $total_qtd = 0;
        foreach($carrinho as $qtd){
            $total_qtd += $qtd;
        }
        echo $total_qtd;
    }

    public function limpar_carrinho(){
        unset($_SESSION['carrinho']);
        //Atualizar para o carrinho
        $this->carrinho();
    }

    public function remover_item(){
        $id_produto = $_GET['id_produto'];
        $carrinho = $_SESSION['carrinho'];
        unset($carrinho[$id_produto]);
        $_SESSION['carrinho'] = $carrinho;
        $this->carrinho();
    }

    public function finalizar_pedido(){

        //Store::printData($_SESSION);
        if(!isset($_SESSION['cliente'])){
            $_SESSION['tmp_carrinho'] = true;
            Store::redirect('login');
        }else{
            Store::redirect('finalizar_pedido_resumo');
        }
    }

    public function finalizar_pedido_resumo(){

        if(!isset($_SESSION['cliente'])){
            Store::redirect('inicio');
        }

        $ids = [];
        foreach($_SESSION['carrinho'] as $id_produto => $qtd){
            array_push($ids, $id_produto);
        }

        $ids = implode(',', $ids);
        $produtos = new Produtos();
        $resultados = $produtos->buscarProdutosPorID($ids);

        //Ciclo de vida do carrinho
        $dados_tmp = [];
        foreach($_SESSION['carrinho'] as $id_produto => $qtd){

            foreach($resultados as $produto){
                if($produto->id_produto == $id_produto){
                    $id_produto = $produto->id_produto;
                    $imagem = $produto->imagem;
                    $titulo = $produto->nome;
                    $quantidade = $qtd;
                    $preco = $produto->preco * $qtd;

                    array_push($dados_tmp, [
                        'id_produto' => $id_produto,
                            'imagem' => $imagem,
                                'titulo' => $titulo,
                                    'quantidade' => $quantidade,
                                        'preco' => $preco,
                    ]);
                    break;
                }
            }
        }

        //Pegando o total
        $total_cart = 0;
        foreach($dados_tmp as $item){
            $total_cart += $item['preco'];
        }

        //Acrescentando os dados temporarios ao Total
        array_push($dados_tmp, $total_cart);

        $dados = [];
        $dados['carrinho'] = $dados_tmp;

        //Buscar informações do cliente
        $cliente = new Clientes();
        $dados_cliente = $cliente->buscar_dados_cliente($_SESSION['cliente']);
        $dados['cliente'] = $dados_cliente;
        
        //Layout do carrinho
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'finalizar_pedido_resumo',
            'layouts/footer',
            'layouts/html_footer'
        ], $dados);
    }

    public function set_endereco_alternativo(){

        $post = json_decode(file_get_contents('php://input'), true);

        $_SESSION['dados_alternativos'] = [
            'endereco' => $post['endereco'],
            'cidade' => $post['cidade'],
            'email' => $post['email'],
            'telefone' => $post['telefone'],
        ];
       
    }

    public function metodo_pagamento(){

        echo 'escolher_metodo_pagamento';

        // $post = json_decode(file_get_contents('php://input'), true);

        // $_SESSION['dados_alternativos'] = [
        //     'endereco' => $post['endereco_alternativo'],
        //     'cidade' => $post['cidade_alternativo'],
        //     'email' => $post['email_alternativo'],
        //     'telefone' => $post['telefone_alternativo'],
        // ];

        Store::printData($_SESSION);
    }
}