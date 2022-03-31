<?php

namespace core\classes;

use PDO;
use PDOException;

class Database {

    private $conexao;

    private function conectar(){
        $this->conexao = new PDO(
            'mysql:'. 
            'host='.  MYSQL_SERVER .';'. 
            'dbname=' .MYSQL_DATABASE . ';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //debug
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function desconectar(){
        $this->conectar = null;
    }

    public function select($sql, $param = null){

        $this->conectar();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute($param);
                $results =  $stmt->fetchAll(PDO::FETCH_CLASS);
            }else{
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
                $results =  $stmt->fetchAll(PDO::FETCH_CLASS);
            }

        }catch(PDOException $e){
            return false;
        }

        $this->desconectar();

        return $results;
    }
}
