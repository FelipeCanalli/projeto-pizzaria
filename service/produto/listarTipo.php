<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/produto.php";

$database = new Database();

$db = $database->getConnection();

$tipo=$_GET['tipo'];

$produto = new Produto($db);

$rs = $produto->listarTipo($tipo);

if($rs->rowCount()>0){
    $produto_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
    
        $array_item = array(
            "idproduto"=>$linha["idproduto"],
            "tipo"=>$linha["tipo"],
            "nomeproduto"=>$linha["nomeproduto"],
            "descricao"=>$linha["descricao"],
            "preco"=>$linha["preco"]
        );
        
        array_push($produto_arr["saida"],$array_item);
    
    }

    header("http/1.0 200");
    echo json_encode($produto_arr);

}else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há produtos cadastrados"));
}
?>