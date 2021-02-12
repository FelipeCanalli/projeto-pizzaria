<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/cadastro.php";

$database = new Database();
$db = $database->getConnection();

$cadastro = new Cadastro($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nomecliente) && !empty($data->cpf) &&
!empty($data->email) && !empty($data->telefone) && !empty($data->celular) && 
!empty($data->tipo) && !empty($data->logradouro) && !empty($data->numero) && 
!empty($data->bairro) && !empty($data->cep)){
    
    $cadastro->nomecliente=$data->nomecliente;
    $cadastro->cpf=$data->cpf;
    $cadastro->email=$data->email;
    $cadastro->telefone=$data->telefone;
    $cadastro->celular=$data->celular;
    $cadastro->tipo=$data->tipo;
    $cadastro->logradouro=$data->logradouro;
    $cadastro->numero=$data->numero;
    $cadastro->complemento=$data->complemento;
    $cadastro->bairro=$data->bairro;
    $cadastro->cep=$data->cep;
    $cadastro->referencia=$data->referencia;

      if($cadastro ->cadastrar()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Cadastrado realizado com sucesso"));
    }else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível realizar o cadastro"));
    }
}else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}
?>