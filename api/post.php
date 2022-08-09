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
    $data = json_decode(file_get_contents("php://input"));
    $item->name = $data->name;
    $item->type = $data->type;
    $item->latitude = $data->latitude;
    $item->longitude = $data->longitude;
    
    if($item->createTurbine()){
        echo 'Turbina criada com sucesso.';
    } else{
        echo 'A Turbina não pôde ser criada.';
    }
?>