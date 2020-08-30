<?php
  include_once './config/database.php';
  include_once './class/shopcart.php';
  include_once './class/products.php';
  include_once './class/posterminal.php';

  $database = new Database();
  $db = $database->getConnection();

  $shopcart = new Shopcart($db);
  $products = new Products($db);
  $terminal = new PosTerminal();

  if(isset($_POST['btnPay'])!=""){
		//Initialize terminal 
			$terminal->initTerminal($shopcart);
  }

  $barcodes = str_split($_POST['BarCode']);
  //print_r($barcodes);

  foreach ($barcodes as $barcode) {
    $terminal->scanProduct($shopcart, $barcode);
  }

  //Refresh index screen
  header("Location: index.php");
?>