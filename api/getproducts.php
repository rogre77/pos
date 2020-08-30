<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/products.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Products($db);

    $stmt = $items->getProducts();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        
        $productArr = array();
        $productArr["body"] = array();
        $productArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "pcode" => $pcode,
                "pdesc" => $pdesc,
                "unitprice" => $unitprice,
                "bulkprice" => $bulkprice,
                "instock" => $instock,
                "category_id" => $category_id,
                "brand" => $brand,
                "created" => $created
            );

            array_push($productArr["body"], $e);
        }
        echo json_encode($productArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>