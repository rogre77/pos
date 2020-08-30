<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/shopcart.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Shopcart($db);

    $stmt = $items->getShopcartItems();
    $itemCount = $stmt->rowCount();

    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $shopcartArr = array();
        $shopcartArr["body"] = array();
        $shopcartArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "pcode" => $pcode,
                "pdesc" => $pdesc,
                "brand" => $brand,
                "category_id" => $category_id,
                "unitprice" => $unitprice,
                "bulkprice" => $bulkprice,
                "quantity" => $quantity,
                "bulk_quantity" => $bulk_quantity,
                "unit_total_amt" => $unit_total_amt,
                "bulk_total_amt" => $bulk_total_amt
            );

            array_push($shopcartArr["body"], $e);
        }
        http_response_code(200);
        echo json_encode($shopcartArr["body"]);
    }
?>