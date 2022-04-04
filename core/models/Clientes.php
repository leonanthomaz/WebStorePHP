<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Clientes {
    
    //Função verificar email
    public function verificarEmail($email){
        $db = new Database();
        $param = [
            'email' => strtolower(trim($email)),
        ];
        $resultados = $db->select('SELECT * FROM clientes WHERE email = :email', $param);

        if(count($resultados) != 0){
            $_SESSION['erro'] = 'Já existe um cliente com este email';
            return true;
        }else{
            return false;
        }
    }

    //Registrar nova conta
    public function registrarConta(){
        $db = new Database();

        $purl = Store::criarHash();
        //echo $purl;

        $param = [
            ':email' => strtolower(trim($_POST['email'])),
            ':senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
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
        )', $param);

        return $purl;
    }

    //Validar o email - PHPMailer
    public function validarEmail($purl){
        
        $db = new Database();
        $param = [
            ':purl' => $purl
        ];
        $resultados = $db->select('SELECT * FROM clientes WHERE purl = :purl', $param);

        if(count($resultados) != 1){
            return false;
        }

        //Encontrado o seguinte cliente para a condição de purl
        $id_cliente = $resultados[0]->id_cliente;

        //atualizar dados do cliente
        $param = [
            ':id_cliente' => $id_cliente
        ];

        $db->update('UPDATE clientes SET purl = null, ativo = 1, updated_at = NOW() WHERE id_cliente = :id_cliente');

        return true;
        
    }

    //Verificando Login
    public function validarLogin($usuario, $senha){
        $param = [
            ':usuario' => $usuario,
        ];

        $db = new Database();

        $resultados = $db->select('SELECT * FROM clientes WHERE email = :usuario AND ativo = 1 AND deleted_at IS NULL', $param);
 
        if(count($resultados) != 1){
            return false;
        }else{
            $usuario = $resultados[0];
            if(!password_verify($senha, $usuario->senha)){
                // não existe usuário
                return false;
            }else{
                // login válido
                return $usuario;
            }
        }


    }

    
}