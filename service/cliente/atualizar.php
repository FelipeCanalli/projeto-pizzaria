<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:PUT");

include_once "../../config/database.php";

include_once "../../domain/cliente.php";

$database = new Database();

$db = $database->getConnection();

$cliente = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));

if( !empty($data->idcliente) && !empty($data->nomecliente) && !empty($data->cpf)  && !empty($data->idcontato) && !empty($data->idendereco)) {
    $cliente->idcliente = $data->idcliente;
    $cliente->nomecliente = $data->nomecliente;
    $cliente->cpf = $data->cpf;
    $cliente->idcontato = $data->idcontato;
    $cliente->idendereco = $data->idendereco;

    if($cliente->atualizar()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Dados atualizados com sucesso"));

    }else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível atualizar os dados"));
    }

    }else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
    }
?>
