<?php
    class PosTerminal{

        public $pcode, $pdesc, $unitprice, $bulkprice, $bulkqty, $instock, $category_id,
                $brand, $created;
        
        public function __construct(){

        }

        // Initialize terminal
        public function initTerminal($shopcart){
            $shopcart->deleteAllItems();

            return true;
        }

        // Scan Product/Barcode
        public function scanProduct($shopcart, $barcode){
            $this->getProductDetails($barcode);
            $this->addToCart($shopcart);            
        }

        // Get Product Details
        public function getProductDetails($barcode){
            $response = file_get_contents('http://localhost/pos/api/getproduct.php?pcode='.$barcode);
            $product = json_decode($response);

            $this->pcode = $product->pcode;
            $this->pdesc = $product->pdesc;
            $this->unitprice = $product->unitprice;
            $this->bulkprice = $product->bulkprice;
            $this->bulkqty = $product->bulkqty;
            $this->instock = $product->instock;
            $this->category_id = $product->category_id;
            $this->brand = $product->brand;
            $this->created = $product->created;

            return true;
        }

        // Set Pricing
        public function setPricing($shopcart) {
            // calculate individual and bulk quantities
            $shopcart->quantity = 1;
            $bulkCnt = 0;
            if ($shopcart->bulk_quantity > 0)
                $bulkCnt = intval($shopcart->quantity / $shopcart->bulk_quantity);
            $bulkItemCnt = $shopcart->bulk_quantity * $bulkCnt;
            $indItemCnt = $shopcart->quantity - $bulkItemCnt;
            
            // calculate individual and bulk amounts
            $shopcart->unit_total_amt = $shopcart->unitprice * $indItemCnt;
            $shopcart->bulk_total_amt = $shopcart->bulkprice * $bulkCnt;
        }

        // Add item to cart
        public function addToCart($shopcart) {
            // init shopcart data
            $shopcart->pcode = $this->pcode;
            $shopcart->pdesc = $this->pdesc;
            $shopcart->brand = $this->brand;
            $shopcart->category_id = $this->category_id;
            $shopcart->unitprice = $this->unitprice;
            $shopcart->bulkprice = $this->bulkprice;
            $shopcart->bulk_quantity = $this->bulkqty;
            
            $this->setPricing($shopcart);

            // update details if item is already in shopcart
            if ($shopcart->getShopcartItem()) {
                $shopcart->quantity = $shopcart->quantity + 1;
                if ($shopcart->bulk_quantity > 0)
                $bulkCnt = intval($shopcart->quantity / $shopcart->bulk_quantity);
        
                $bulkItemCnt = $shopcart->bulk_quantity * $bulkCnt;
                $indItemCnt = $shopcart->quantity - $bulkItemCnt;
                
                $shopcart->unit_total_amt = $shopcart->unitprice * $indItemCnt;
                $shopcart->bulk_total_amt = $shopcart->bulkprice * $bulkCnt;
        
                $shopcart->updateShopcartItem();
        
            // Add item to shopcart if first time
            } else {
                $shopcart->createShopcartItem();
            }    
            
        }

        public function calculateTotal(){
            $response = file_get_contents('http://localhost/pos/api/getshopcartitems.php');

            if ($response == "") {
                return 0;
            } else {
                $obj = json_decode($response);
                $arr = json_decode(json_encode($obj), true);
            }

			$overallTotalAmt = 0;
			foreach ($arr as $row) {
                $itemTotalAmt = $row['unit_total_amt'] + $row['bulk_total_amt'];
                $overallTotalAmt = $overallTotalAmt + $itemTotalAmt;
            }          
            return $overallTotalAmt;
        }

    }
?>