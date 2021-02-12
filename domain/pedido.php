<?php

class Pedido{

   public $idpedido; 
   public $datapedido;
   public $idcliente;
   public $recebimento; 
   public $situacao;

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbpedido";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbpedido set idcliente=:idc, 
        recebimento=:r, situacao=:s";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":idc", $this->idcliente);
        $stmt->bindParam(":r", $this->recebimento);
        $stmt->bindParam(":s", $this->situacao);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}    
?>