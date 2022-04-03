<?php

namespace core\classes;

use Exception;

class Store {

    public static function Layout($estruturas, $dados = null){
        if(!is_array($estruturas)){
            throw new Exception('Coleção inválida');
        }

        if(!empty($dados) && is_array(($dados))){
            extract($dados);
        }

        foreach($estruturas as $estrutura){
            include('../core/views/'.$estrutura.'.php');
        }
    }

    public static function clienteLogado(){
        return (isset($_SESSION['cliente']));
    }
}