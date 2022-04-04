<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Clientes {
    
    public function verificarEmail($email){
        $db = new Database();
        $parametros = [
            'email' => strtolower(trim($email)),
        ];
        $resultados = $db->select('SELECT * FROM clientes WHERE email = :email', $parametros);

        if(count($resultados) != 0){
            $_SESSION['erro'] = 'Já existe um cliente com este email';
            return true;
        }else{
            return false;
        }
    }

    public function registrarConta(){
        $db = new Database();

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

        return $purl;
    }

    public function validarEmail($purl){
        
        $db = new Database();
        $parametros = [
            ':purl' => $purl
        ];
        $resultados = $db->select('SELECT * FROM clientes WHERE purl = :purl', $parametros);

        if(count($resultados) != 1){
            return false;
        }

        //Encontrado o seguinte cliente para a condição de purl
        $id_cliente = $resultados[0]->id_cliente;

        //atualizar dados do cliente
        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $db->update('UPDATE clientes SET purl = null, ativo = 1, update_at = NOW()');

        return true;
        
    }

    
}