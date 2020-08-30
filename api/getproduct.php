<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/products.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Products($db);

    $item->pcode = isset($_GET['pcode']) ? $_GET['pcode'] : die();
  
    $item->getSingleProduct();

    if($item->pdesc != null){
        // create array
        $prod_arr = array(
            "id" =>  $item->id,
            "pcode" => $item->pcode,
            "pdesc" => $item->pdesc,
            "unitprice" => $item->unitprice,
            "bulkprice" => $item->bulkprice,
            "bulkqty" => $item->bulkqty,
            "instock" => $item->instock,
            "category_id" => $item->category_id,
            "brand" => $item->brand,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($prod_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Product not found.");
    }
?>