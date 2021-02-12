<?php

class Produto{

    public $idproduto;
    public $tipo;
    public $nomeproduto;
    public $descricao;
    public $preco;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from tbproduto";
        // Parar executar uma consulta é necessário prepará la
        $stmt = $this->conexao->prepare($query);
        // Execução da consulta
        $stmt->execute();
        
        return $stmt;
    }

    public function cadastrar(){
        $query = "insert into tbproduto set tipo=:t, nomeproduto=:n, descricao=:d, preco=:p";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":t", $this->tipo);
        $stmt->bindParam(":n", $this->nomeproduto);
        $stmt->bindParam(":d", $this->descricao);
        $stmt->bindParam(":p", $this->preco);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function detalhar($id){
        $query = "select idproduto, nomeproduto, descricao, preco from tbproduto where idproduto=:id;";

        $stmt = $this->conexao-> prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt;
    }

}

?>