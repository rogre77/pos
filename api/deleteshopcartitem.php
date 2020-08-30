<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/shopcart.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Shopcart($db);
    
    if(isset($_GET['pcode']))
        $item->pcode = $_GET['pcode'];

    if($item->deleteShopcartItem()){
        header("Location: ../index.php");
    } else{
        echo json_encode("Item could not be deleted");
    }
?>