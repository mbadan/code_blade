<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/turbines.php';
    $database = new Database();
    $db = $database->getConnection();
    $turbine = new Turbine($db);
    $selectAll = $turbine->getAllTurbines();
    $itemCount = $selectAll->rowCount();

    json_encode($itemCount);
    if($itemCount > 0){
        
        $turbineArr = array();
        $turbineArr["body"] = array();
        while ($row = $selectAll->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "type" => $type,
                "latitude" => $latitude,
                "longitude" => $longitude
            );
            array_push($turbineArr["body"], $e);
        }
        echo json_encode($turbineArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhuma turbina encontrada.")
        );
    }
?>