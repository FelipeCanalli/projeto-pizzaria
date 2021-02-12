<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/funcionario.php";

$database = new Database();

$db = $database->getConnection();

$funcionario = new Funcionario($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nomefun) && !empty($data->cpf)  && !empty($data->usuario) 
&& !empty($data->senha) && !empty($data->idcontato) ){
    
    $funcionario->nomefun = $data->nomefun;
    $funcionario->cpf = $data->cpf;
    $funcionario->usuario = $data->usuario;
    $funcionario->senha = $data->senha;
    $funcionario->perfil = $data->perfil;
    $funcionario->idcontato = $data->idcontato;

    if($funcionario ->cadastrar()){
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