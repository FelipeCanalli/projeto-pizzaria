<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/pagamento.php";

$database = new Database();

$db = $database->getConnection();

$pagamento = new Pagamento($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->idpedido) && !empty($data->forma) && !empty($data->total)){
    $pagamento->idpedido = $data->idpedido;
    $pagamento->forma = $data->forma;
    $pagamento->bandeira = $data->bandeira;
    $pagamento->total = $data->total;
    $pagamento->troco = $data->troco;

    if($pagamento ->cadastrar()){
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