<?php

class Cliente{

   public $idcliente; 
   public $nomecliente; 
   public $cpf; 
   public $idcontato; 
   public $idendereco; 

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbcliente";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbcliente set nomecliente=:c, cpf=:cpf, idcontato=:idc, idendereco=:ide";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":c", $this->nomecliente);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":idc", $this->idcontato);
        $stmt->bindParam(":ide", $this->idendereco);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tbcliente set nomecliente=:n, cpf=:c, idcontato=:ic, idendereco=:ie where idcliente=:id";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":n",  $this->nomecliente);
        $stmt->bindParam(":c", $this->cpf);
        $stmt->bindParam(":ic", $this->idcontato);
        $stmt->bindParam(":ie", $this->idendereco);
        $stmt->bindParam(":id", $this->idcliente);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}    
?>