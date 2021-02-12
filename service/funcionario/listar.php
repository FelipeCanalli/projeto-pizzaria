<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

require_once "../../config/database.php";

require_once "../../domain/funcionario.php";

$database = new Database();

$db = $database->getConnection();

$funcionario = new Funcionario($db);

$rs = $funcionario->listar();

if($rs->rowCount()>0){
    $funcionario_arr["saida"]=array();

    while ($linha = $rs->fetch(PDO::FETCH_ASSOC)){
        
        extract($linha);
        $array_item = array(

            "idfuncionario"=> $idfuncionario,
            "nomefun"=> $nomefun,
            "cpf"=> $cpf, 
            "usuario"=> $usuario,
            "senha"=> "", 
            "perfil"=> $perfil, 
            "idcontato"=> $idcontato, 
            
        );

        array_push($funcionario_arr["saida"],$array_item);
    }

    header("HTTP/1.0 200");
    echo json_encode($funcionario_arr);
    
}else{
    header("HTTP/1.0 400");
    echo_encode(array("mensagem"=>"Não há funcionários cadastrados"));
}
?>