<?php

namespace core\controllers;

use core\classes\Store;

class Main {

    public function index(){

        $dados = [
            'titulo' => APP_NAME . ' | ' . APP_VERSION,
            //'clientes' => ['Leonan', 'Maria', 'Jose']
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer'
        ], $dados);
    }

    public function loja(){
        echo 'loja';
    }
}
