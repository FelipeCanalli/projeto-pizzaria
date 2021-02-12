<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

require_once "../../config/database.php";

require_once "../../domain/itenspedido.php";

$database = new Database();

$db = $database->getConnection();

$itenspedido = new Itenspedido($db);

$rs = $itenspedido->listar();

if($rs->rowCount()>0){
    $itenspedido_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        
        extract($linha);
        $array_item = array(

            "iditens"=> $iditens,
            "idpedido"=> $idpedido,
            "idproduto"=> $idproduto, 
            "observacao1"=> $observacao1,
            "metade"=> $metade, 
            "observacao2"=> $observacao2,
            "quantidade"=> $quantidade, 

        );

        array_push($itenspedido_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($itenspedido_arr);
    
}else{
    header("HTTP/1.0 400");
    echo_encode(array("mensagem"=>"Não há itens cadastrados"));
}
?>