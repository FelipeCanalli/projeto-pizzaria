<?php

class Funcionario{

   public $idfuncionario; 
   public $nomefun; 
   public $cpf; 
   public $usuario;
   public $senha; 
   public $perfil; 
   public $idcontato; 

   public function __construct($db){
       $this->conexao = $db;
   }

   public function listar(){
       $query = "select * from tbfuncionario";

       $stmt = $this->conexao->prepare($query);

       $stmt->execute();

       return $stmt;
   }

   public function cadastrar(){
        $query = "insert into tbfuncionario set nomefun=:n, cpf=:c, 
        usuario=:u, senha=:s, perfil=:p, idcontato=:idc";

        $stmt = $this->conexao-> prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":n", $this->nomefun);
        $stmt->bindParam(":c", $this->cpf);
        $stmt->bindParam(":u", $this->usuario);
        $stmt->bindParam(":s", $this->senha);
        $stmt->bindParam(":p", $this->perfil);
        $stmt->bindParam(":idc", $this->idcontato);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
}    
?>