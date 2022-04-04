<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos {

    //Listando produtos pela coluna 'visivel'
    public function listaProdutosDisponiveis(){
        $db = new Database();
        $resultados = $db->select('SELECT * FROM produtos WHERE visivel = 1');
        return $resultados;
    }

}