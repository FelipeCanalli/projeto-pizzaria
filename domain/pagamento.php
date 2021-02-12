<?php

class Pagamento{

   public $idpagamento; 
   public $idpedido; 
   public $forma; 
   public $bandeira;
   public $total; 
   public $troco;

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbpagamento";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbpagamento set idpedido=:idp, forma=:f, bandeira=:b, total=:to, troco=:tr";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":idp", $this->idpedido);
        $stmt->bindParam(":f", $this->forma);
        $stmt->bindParam(":b", $this->bandeira);
        $stmt->bindParam(":to", $this->total);
        $stmt->bindParam(":tr", $this->troco);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }   
} 
?>