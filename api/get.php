<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/turbines.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Turbine($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getTurbine();
    if($item->name != null){
        // create array
        $turbine = array(
            "id" =>  $item->id,
            "name" => $item->name,
            "type" => $item->type,
            "latitude" => $item->latitude,
            "longitude" => $item->longitude
        );
      
        http_response_code(200);
        echo json_encode($turbine);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Turbina não encontrada.");
    }
?>