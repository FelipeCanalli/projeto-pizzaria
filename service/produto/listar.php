<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

// Importar a conexão com o banco e o dominio do produto
require_once "../../config/database.php";

require_once "../../domain/produto.php";

$database = new Database();

$db = $database->getConnection();

$produto = new Produto($db);

$rs = $produto->listar();

// Se houver algum produto cadastrado, este deverá
// ser mostrado. Caso contrário será exibida uma mensagem
// ao cliente
if($rs->rowCount()>0){
    $produto_arr["saida"]=array();

    // Enquanto ele não pegar todos os dados do banco, usando a interface PDO 
    // fazendo associação por nome de coluna 
    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
    
        extract($linha);
        $array_item = array(

            "idproduto"=>$idproduto,
            "tipo"=>$tipo,
            "nomeproduto"=>$nomeproduto,
            "descricao"=>$descricao,
            "preco"=>$preco,
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