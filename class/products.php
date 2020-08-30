<?php
    class Products{

        // Connection
        private $conn;

        // Table
        private $db_table = "Products";

        // Columns
        public $id;
        public $pcode;
        public $pdesc;
        public $unitprice;
        public $bulkprice;
        public $bulkqty;
        public $instock;
        public $category_id;
        public $brand;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getProducts(){
            $sqlQuery = "SELECT id, pcode, pdesc, unitprice, bulkprice, bulkqty, instock, category_id, brand, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createProduct(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        pcode = :pcode, 
                        pdesc = :pdesc, 
                        unitprice = :unitprice, 
                        bulkprice = :bulkprice, 
                        bulkqty = :bulkqty, 
                        instock = :instock, 
                        category_id = :category_id, 
                        brand = :brand, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->pcode=htmlspecialchars(strip_tags($this->pcode));
            $this->pdesc=htmlspecialchars(strip_tags($this->pdesc));
            $this->unitprice=htmlspecialchars(strip_tags($this->unitprice));
            $this->bulkprice=htmlspecialchars(strip_tags($this->bulkprice));
            $this->instock=htmlspecialchars(strip_tags($this->instock));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->brand=htmlspecialchars(strip_tags($this->brand));
        
            // bind data
            $stmt->bindParam(":pcode", $this->pcode);
            $stmt->bindParam(":pdesc", $this->pdesc);
            $stmt->bindParam(":unitprice", $this->unitprice);
            $stmt->bindParam(":bulkprice", $this->bulkprice);
            $stmt->bindParam(":bulkqty", $this->bulkqty);
            $stmt->bindParam(":instock", $this->instock);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleProduct(){
          $sqlQuery = "SELECT 
                        id, 
                        pcode, 
                        pdesc, 
                        unitprice, 
                        bulkprice, 
                        bulkqty, 
                        instock, 
                        category_id, 
                        brand, 
                        created 
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
              
              $this->id = $dataRow['id'];
              $this->pcode = $dataRow['pcode'];
              $this->pdesc = $dataRow['pdesc'];
              $this->unitprice = $dataRow['unitprice'];
              $this->bulkprice = $dataRow['bulkprice'];
              $this->bulkqty = $dataRow['bulkqty'];
              $this->instock = $dataRow['instock'];
              $this->category_id = $dataRow['category_id'];
              $this->brand = $dataRow['brand'];
              $this->created = $dataRow['created'];
              return true;
           }
              return false;

        }        

        // UPDATE
        public function updateProduct(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        pcode = :pcode, 
                        pdesc = :pdesc, 
                        unitprice = :unitprice, 
                        bulkprice = :bulkprice, 
                        bulkqty = :bulkqty, 
                        instock = :instock, 
                        category_id = :category_id, 
                        brand = :brand, 
                        created = :created                   
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->pcode=htmlspecialchars(strip_tags($this->pcode));
            $this->pdesc=htmlspecialchars(strip_tags($this->pdesc));
            $this->unitprice=htmlspecialchars(strip_tags($this->unitprice));
            $this->bulkprice=htmlspecialchars(strip_tags($this->bulkprice));
            $this->bulkqty=htmlspecialchars(strip_tags($this->bulkqty));
            $this->instock=htmlspecialchars(strip_tags($this->instock));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->brand=htmlspecialchars(strip_tags($this->brand));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":pcode", $this->pcode);
            $stmt->bindParam(":pdesc", $this->pdesc);
            $stmt->bindParam(":unitprice", $this->unitprice);
            $stmt->bindParam(":bulkprice", $this->bulkprice);
            $stmt->bindParam(":bulkqty", $this->bulkqty);
            $stmt->bindParam(":instock", $this->instock);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":brand", $this->brand);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteProduct(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>