<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

require_once "../../config/database.php";

require_once "../../domain/cliente.php";

$database = new Database();

$db = $database->getConnection();

$cliente = new Cliente($db);

$rs = $cliente->listar();

if($rs->rowCount()>0){
    $cliente_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        
        extract($linha);
        $array_item = array(

            "idcliente"=> $idcliente,
            "nomecliente"=> $nomecliente,
            "cpf"=> $cpf, 
            "idcontato"=> $idcontato, 
            "idendereco"=> $idendereco, 
            
        );

        array_push($cliente_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($cliente_arr);
    
}else{
    header("HTTP/1.0 400");
    echo_encode(array("mensagem"=>"Não há clientes cadastrados"));
}
?>