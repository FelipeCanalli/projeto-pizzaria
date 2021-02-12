<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/endereco.php";

$database = new Database();

$db = $database->getConnection();

$endereco = new Endereco($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->tipo) && !empty($data->logradouro) && !empty($data->numero)  && 
!empty($data->bairro)  && !empty($data->cep)) {

    $endereco->tipo = $data->tipo;
    $endereco->logradouro = $data->logradouro;
    $endereco->numero = $data->numero;
    $endereco->complemento = $data->complemento;
    $endereco->bairro = $data->bairro;
    $endereco->cep = $data->cep;
    $endereco->referencia = $data->referencia;

    if($endereco ->cadastrar()){
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
