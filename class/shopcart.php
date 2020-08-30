<?php
    class Shopcart{

        // Connection
        private $conn;

        // Table
        private $db_table = "Shopcart";

        // Columns
        public $pcode;
        public $pdesc;
        public $brand;
        public $category_id;
        public $unitprice;
        public $bulkprice;
        public $quantity;
        public $bulk_quantity;
        public $unit_total_amt;
        public $bulk_total_amt;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getShopcartItems(){
            $sqlQuery = "SELECT pcode, 
                                pdesc, 
                                brand, 
                                category_id, 
                                unitprice, 
                                bulkprice, 
                                quantity, 
                                bulk_quantity, 
                                unit_total_amt, 
                                bulk_total_amt  
                        FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createShopcartItem(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        pcode = :pcode, 
                        pdesc = :pdesc, 
                        brand = :brand,
                        category_id = :category_id, 
                        unitprice = :unitprice, 
                        bulkprice = :bulkprice, 
                        quantity = :quantity, 
                        bulk_quantity = :bulk_quantity, 
                        unit_total_amt = :unit_total_amt, 
                        bulk_total_amt = :bulk_total_amt";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->pcode=htmlspecialchars(strip_tags($this->pcode));
            $this->pdesc=htmlspecialchars(strip_tags($this->pdesc));
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->unitprice=htmlspecialchars(strip_tags($this->unitprice));
            $this->bulkprice=htmlspecialchars(strip_tags($this->bulkprice));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            $this->bulk_quantity=htmlspecialchars(strip_tags($this->bulk_quantity));
            $this->unit_total_amt=htmlspecialchars(strip_tags($this->unit_total_amt));
            $this->bulk_total_amt=htmlspecialchars(strip_tags($this->bulk_total_amt));
            
            // bind data
            $stmt->bindParam(":pcode", $this->pcode);
            $stmt->bindParam(":pdesc", $this->pdesc);
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":unitprice", $this->unitprice);
            $stmt->bindParam(":bulkprice", $this->bulkprice);
            $stmt->bindParam(":quantity", $this->quantity);
            $stmt->bindParam(":bulk_quantity", $this->bulk_quantity);
            $stmt->bindParam(":unit_total_amt", $this->unit_total_amt);
            $stmt->bindParam(":bulk_total_amt", $this->bulk_total_amt);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getShopcartItem(){
          $sqlQuery = "SELECT 
                        pcode, 
                        pdesc, 
                        brand, 
                        category_id, 
                        unitprice, 
                        bulkprice, 
                        quantity,
                        bulk_quantity,
                        unit_total_amt, 
                        bulk_total_amt 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       pcode = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->pcode);

           $stmt->execute();

           if($stmt->rowCount() > 0){
              $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
              
              $this->pcode = $dataRow['pcode'];
              $this->pdesc = $dataRow['pdesc'];
              $this->brand = $dataRow['brand'];
              $this->category_id = $dataRow['category_id'];
              $this->unitprice = $dataRow['unitprice'];
              $this->bulkprice = $dataRow['bulkprice'];
              $this->quantity = $dataRow['quantity'];
              $this->bulk_quantity = $dataRow['bulk_quantity'];
              $this->unit_total_amt = $dataRow['unit_total_amt'];
              $this->bulk_total_amt = $dataRow['bulk_total_amt'];
              return true;
           }
              return false;

        }        

        // UPDATE
        public function updateShopcartItem(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        pcode = :pcode, 
                        pdesc = :pdesc, 
                        brand = :brand, 
                        category_id = :category_id, 
                        unitprice = :unitprice, 
                        bulkprice = :bulkprice, 
                        quantity = :quantity, 
                        bulk_quantity = :bulk_quantity, 
                        unit_total_amt = :unit_total_amt,                   
                        bulk_total_amt = :bulk_total_amt                   
                    WHERE 
                        pcode = :pcode";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->pcode=htmlspecialchars(strip_tags($this->pcode));
            $this->pdesc=htmlspecialchars(strip_tags($this->pdesc));
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->unitprice=htmlspecialchars(strip_tags($this->unitprice));
            $this->bulkprice=htmlspecialchars(strip_tags($this->bulkprice));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            $this->bulk_quantity=htmlspecialchars(strip_tags($this->bulk_quantity));
            $this->unit_total_amt=htmlspecialchars(strip_tags($this->unit_total_amt));
            $this->bulk_total_amt=htmlspecialchars(strip_tags($this->bulk_total_amt));
        
            // bind data
            $stmt->bindParam(":pcode", $this->pcode);
            $stmt->bindParam(":pdesc", $this->pdesc);
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":unitprice", $this->unitprice);
            $stmt->bindParam(":bulkprice", $this->bulkprice);
            $stmt->bindParam(":quantity", $this->quantity);
            $stmt->bindParam(":bulk_quantity", $this->bulk_quantity);
            $stmt->bindParam(":unit_total_amt", $this->unit_total_amt);
            $stmt->bindParam(":bulk_total_amt", $this->bulk_total_amt);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteShopcartItem(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE pcode = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->pcode=htmlspecialchars(strip_tags($this->pcode));
        
            $stmt->bindParam(1, $this->pcode);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteAllItems(){
            $sqlQuery = "DELETE FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }        
    }
?>