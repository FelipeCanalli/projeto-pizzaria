<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:PUT");

include_once "../../config/database.php";

include_once "../../domain/contato.php";

$database = new Database();

$db = $database->getConnection();

$contato = new Contato($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->celular) && !empty($data->idcontato)){
    $contato->idcontato = $data->idcontato;
    $contato->email = $data->email;
    $contato->celular = $data->celular;
    $contato->telefone = $data->telefone;

    if($contato->atualizar()){
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
