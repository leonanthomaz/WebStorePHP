<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos {

    //Listando produtos pela coluna 'visivel'
    public function listaProdutosDisponiveis($c){

        $db = new Database();

        $categorias = $this->listaCategorias();
        
        $sql = 'SELECT * FROM produtos ';
        $sql .= 'WHERE visivel = 1 ';

        if(in_array($c, $categorias)){
            $sql .= 'AND categoria =' ."'$c'";
        }
        
        // if($c == 'masculino' || $c == 'feminino'){
        //     $sql .= 'AND categoria =' ."'$c'";
        // }

        //die($sql);
        $produtos = $db->select($sql);

        //$resultados = $db->select('SELECT * FROM produtos WHERE visivel = 1');
        return $produtos;
    }

    public function listaCategorias(){

        $db = new Database();
        $resultados = $db->select('SELECT DISTINCT categoria FROM produtos');
        $categorias = [];
        foreach($resultados as $resultado){
            array_push($categorias, $resultado->categoria);
        }
        return $categorias;
    }

}