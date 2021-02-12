<?php

class Endereco{

   public $idendereco; 
   public $tipo; 
   public $logradouro; 
   public $numero;
   public $complemento; 
   public $bairro; 
   public $cep; 
   public $referencia; 

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbendereco";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbendereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b,
        cep=:ce, referencia=:r";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":t", $this->tipo);
        $stmt->bindParam(":l", $this->logradouro);
        $stmt->bindParam(":n", $this->numero);
        $stmt->bindParam(":c", $this->complemento);
        $stmt->bindParam(":b", $this->bairro);
        $stmt->bindParam(":ce", $this->cep);
        $stmt->bindParam(":r", $this->referencia);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
   }

   public function atualizar(){
        $query = "update tbendereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c,
        bairro=:b, cep=:ce, referencia=:r where idendereco=:id";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":t", $this->tipo);
        $stmt->bindParam(":l", $this->logradouro);
        $stmt->bindParam(":n", $this->numero);
        $stmt->bindParam(":c", $this->complemento);
        $stmt->bindParam(":b", $this->bairro);
        $stmt->bindParam(":ce", $this->cep);
        $stmt->bindParam(":r", $this->referencia);
        $stmt->bindParam(":id", $this->idendereco);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}    
?>