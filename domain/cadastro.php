<?php
class Cadastro{
    public $idcliente; 
    public $nomecliente; 
    public $cpf; 

    public $idcontato; 
    public $telefone;
    public $email;
    public $celular;

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

public function cadastrar(){    

    $query = "insert into tbcontato set email=:e, celular=:c, telefone=:t";

        $stmtc = $this->conexao-> prepare($query);

        $stmtc->bindParam(":e", $this->email);
        $stmtc->bindParam(":c", $this->celular);
        $stmtc->bindParam(":t", $this->telefone);

        $stmtc->execute();

        $this->idcontato=$this->conexao->lastInsertId();


    $query = "insert into tbendereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b,
        cep=:ce, referencia=:r";

        $stmte = $this->conexao-> prepare($query);

        $stmte->bindParam(":t", $this->tipo);
        $stmte->bindParam(":l", $this->logradouro);
        $stmte->bindParam(":n", $this->numero);
        $stmte->bindParam(":c", $this->complemento);
        $stmte->bindParam(":b", $this->bairro);
        $stmte->bindParam(":ce", $this->cep);
        $stmte->bindParam(":r", $this->referencia);

        $stmte->execute();

        $this->idendereco=$this->conexao->lastInsertId();


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

}
?>