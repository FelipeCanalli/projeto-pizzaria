<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/cliente.php";

$database = new Database();

$db = $database->getConnection();

$cliente = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nomecliente) && !empty($data->cpf)  && !empty($data->idcontato) && !empty($data->idendereco)) {
    $cliente->nomecliente = $data->nomecliente;
    $cliente->cpf = $data->cpf;
    $cliente->idcontato = $data->idcontato;
    $cliente->idendereco = $data->idendereco;

    if($cliente ->cadastrar()){
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