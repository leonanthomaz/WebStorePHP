<?php

namespace core\classes;

use Exception;
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

        $sql = trim($sql);

        if(!preg_match('/^SELECT/i', $sql)){
            throw new Exception('Não é uma instrução SELECT');
            //die('Não é uma instrução SELECT');

        }

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

    public function insert($sql, $param = null){
        $sql = trim($sql);

        if(!preg_match('/^INSERT/i', $sql)){
            throw new Exception('Não é uma instrução INSERT');
            //die('Não é uma instrução SELECT');

        }

        $this->conectar();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->desconectar();
    }

    public function update($sql, $param = null){

        $sql = trim($sql);

        if(!preg_match('/^UPDATE/i', $sql)){
            throw new Exception('Não é uma instrução UPDATE');
            //die('Não é uma instrução SELECT');

        }

        $this->conectar();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->desconectar();
    }

    public function delete($sql, $param = null){

        $sql = trim($sql);

        if(!preg_match('/^DELETE/i', $sql)){
            throw new Exception('Não é uma instrução DELETE');
            //die('Não é uma instrução SELECT');

        }

        $this->conectar();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->desconectar();
    }

    public function statement($sql, $param = null){

        $sql = trim($sql);

        if(preg_match('/^(SELECT|INSERT|UPDATE|DELETE)/i', $sql)){
            throw new Exception('Instrução inválida!');
            //die('Não é uma instrução SELECT');

        }

        $this->conectar();

        $results = null;

        try{
            if(!empty($param)){
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute($param);
            }else{
                $stmt = $this->conexao->prepare($sql);
                $stmt->execute();
            }

        }catch(PDOException $e){
            return false;
        }

        $this->desconectar();
    }
}
