<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

require_once "../../config/database.php";

require_once "../../domain/contato.php";

$database = new Database();

$db = $database->getConnection();

$contato = new Contato($db);

$rs = $contato->listar();

if($rs->rowCount()>0){
    $contato_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        
        extract($linha);
        $array_item = array(

            "idcontato"=> $idcontato,
            "email"=> $email,
            "celular"=> $celular, 
            "telefone"=> $telefone,
            
        );

        array_push($contato_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($contato_arr);
    
}else{
    header("HTTP/1.0 400");
    echo_encode(array("mensagem"=>"Não há contatos cadastrados"));
}
?>