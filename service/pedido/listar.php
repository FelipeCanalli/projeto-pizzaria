<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

require_once "../../config/database.php";

require_once "../../domain/pedido.php";

$database = new Database();

$db = $database->getConnection();

$pedido = new Pedido($db);

$rs = $pedido->listar();

if($rs->rowCount()>0){
    $pedido_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        
        extract($linha);
        $array_item = array(

            "idpedido"=> $idpedido,
            "datapedido"=> $datapedido,
            "idcliente"=> $idcliente, 
            "recebimento"=> $recebimento, 
            "situacao"=> $situacao,
            
        );

        array_push($pedido_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($pedido_arr);
    
}else{
    header("HTTP/1.0 400");
    echo_encode(array("mensagem"=>"Não há pedidos cadastrados"));
}
?>