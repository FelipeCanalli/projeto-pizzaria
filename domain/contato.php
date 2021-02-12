<?php

class Contato{

   public $idcontato; 
   public $email; 
   public $celular; 
   public $telefone;

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbcontato";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbcontato set email=:e, celular=:c, telefone=:t";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":e", $this->email);
        $stmt->bindParam(":c", $this->celular);
        $stmt->bindParam(":t", $this->telefone);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tbcontato set telefone=:t, celular=:c, email=:e where idcontato=:id";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":t",  $this->telefone);
        $stmt->bindParam(":c", $this->celular);
        $stmt->bindParam(":e", $this->email);
        $stmt->bindParam(":id", $this->idcontato);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}    
?>