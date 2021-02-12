<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

require_once "../../config/database.php";

require_once "../../domain/pagamento.php";

$database = new Database();

$db = $database->getConnection();

$pagamento = new Pagamento($db);

$rs = $pagamento->listar();

if($rs->rowCount()>0){
    $pagamento_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        
        extract($linha);
        $array_item = array(

            "idpagamento"=> $idpagamento,
            "idpedido"=> $idpedido,
            "forma"=> $forma, 
            "bandeira"=> $bandeira,
            "total"=> $total, 
            "troco"=> $troco,

        );

        array_push($pagamento_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($pagamento_arr);
    
}else{
    header("HTTP/1.0 400");
    echo_encode(array("mensagem"=>"Não há pagamentos cadastrados"));
}
?>