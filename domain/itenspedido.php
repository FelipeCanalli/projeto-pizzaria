<?php

class Itenspedido{

   public $iditens; 
   public $idpedido; 
   public $idproduto; 
   public $observacao1;
   public $metade; 
   public $observacao2; 
   public $quantidade; 

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbitenspedido";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbitenspedido set idpedido=:ped, idproduto=:pro, 
        quantidade=:q, observacao1=:ob, metade=:m, observacao2=:obs";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":ped", $this->idpedido);
        $stmt->bindParam(":pro", $this->idproduto);
        $stmt->bindParam(":q", $this->quantidade);
        $stmt->bindParam(":ob", $this->observacao1);
        $stmt->bindParam(":m", $this->metade);
        $stmt->bindParam(":obs", $this->observacao2);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}    
?>