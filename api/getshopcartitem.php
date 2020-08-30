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

    $item->pcode = isset($_GET['pcode']) ? $_GET['pcode'] : die();

    $item->getShopcartItem();

    if($item->pdesc != null){
        // create array
        $shopcartArr = array(
          "pcode" => $item->pcode,
            "pdesc" => $item->pdesc,
            "brand" => $item->brand,
            "category_id" => $item->category_id,
            "unitprice" => $item->unitprice,
            "bulkprice" => $item->bulkprice,
            "quantity" => $item->quantity,
            "bulk_quantity" => $item->bulk_quantity,
            "unit_total_amt" => $item->unit_total_amt,
            "bulk_total_amt" => $item->bulk_total_amt            
        );
      
        http_response_code(200);
        echo json_encode($shopcartArr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Item not found.");
    }
?>