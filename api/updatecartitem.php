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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // shopcart item values
    $item->pcode = $data->pcode;
    $item->pdesc = $data->pdesc;
    $item->brand = $data->brand;
    $item->category_id = $data->category_id;
    $item->unitprice = $data->unitprice;
    $item->bulkprice = $data->bulkprice;
    $item->quantity = $data->quantity;
    $item->bulk_quantity = $data->bulk_quantity;
    $item->unit_total_amt = $data->unit_total_amt;
    $item->bulk_total_amt = $data->bulk_total_amt;
    
    if($item->updateShopcartItem()){
        echo json_encode("Shopcart item updated.");
    } else{
        echo json_encode("Shopcart item could not be updated");
    }
?>