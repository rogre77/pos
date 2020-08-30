<?php

  use PHPUnit\Framework\TestCase;
  include_once './config/database.php';
  include_once './class/shopcart.php';
  include_once './class/posterminal.php';

  class FunctionsTests extends TestCase 
  {

    // Testing barcodes = "ABCDABA"
    public function testscanBarcodes_ABCDABA() {
      $database = new Database();
      $db = $database->getConnection();
      $terminal = new PosTerminal();
      $shopcart = new Shopcart($db);

      $terminal->initTerminal($shopcart);

      $barcodes = "ABCDABA";  
      $result = 13.25;

      $barcodes = str_split($barcodes);

      foreach ($barcodes as $barcode) {
        $terminal->scanProduct($shopcart, $barcode);
      }      

      $this->assertEquals($result, $terminal->calculateTotal());
    }

    // Testing barcodes = "CCCCCCC"
    public function testscanBarcodes_CCCCCCC() {
      $database = new Database();
      $db = $database->getConnection();
      $terminal = new PosTerminal();
      $shopcart = new Shopcart($db);

      $terminal->initTerminal($shopcart);

      $barcodes = "CCCCCCC";  
      $result = 6;

      $barcodes = str_split($barcodes);

      foreach ($barcodes as $barcode) {
        $terminal->scanProduct($shopcart, $barcode);
      }      

      $this->assertEquals($result, $terminal->calculateTotal());
    }

    // Testing barcodes = "ABCD"
    public function testscanBarcodes_ABCD() {
      $database = new Database();
      $db = $database->getConnection();
      $terminal = new PosTerminal();
      $shopcart = new Shopcart($db);

      $terminal->initTerminal($shopcart);

      $barcodes = "ABCD";  
      $result = 7.25;

      $barcodes = str_split($barcodes);

      foreach ($barcodes as $barcode) {
        $terminal->scanProduct($shopcart, $barcode);
      }      

      $this->assertEquals($result, $terminal->calculateTotal());
    }    
  }
