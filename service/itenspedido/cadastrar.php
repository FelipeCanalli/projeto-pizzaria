<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/itenspedido.php";

$database = new Database();

$db = $database->getConnection();

$itenspedido = new Itenspedido($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->idpedido) && !empty($data->idproduto) && !empty($data->quantidade)){
    $itenspedido->idpedido = $data->idpedido;
    $itenspedido->idproduto = $data->idproduto;
    $itenspedido->observacao1 = $data->observacao1;
    $itenspedido->metade = $data->metade;
    $itenspedido->observacao2 = $data->observacao2;
    $itenspedido->quantidade = $data->quantidade;

    if($itenspedido ->cadastrar()){
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