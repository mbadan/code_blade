<?php
    class Turbine{
        // Connection
        private $conn;
        // Table
        private $db_table = "turbines";
        // Columns
        public $id;
        public $name;
        public $type;
        public $latitude;
        public $longitude;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getAllTurbines(){
            $sqlQuery = "SELECT id, name, type, latitude, longitude FROM " . $this->db_table . "";
            $turbine = $this->conn->prepare($sqlQuery);
            $turbine->execute();
            return $turbine;
        }
        // CREATE
        public function createTurbine(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        type = :type, 
                        latitude = :latitude, 
                        longitude = :longitude";
        
            $turbine = $this->conn->prepare($sqlQuery);
        
            // validation
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->type=htmlspecialchars(strip_tags($this->type));

            $turbine->bindParam(":name", $this->name);
            $turbine->bindParam(":type", $this->type);
            $turbine->bindParam(":latitude", $this->latitude);
            $turbine->bindParam(":longitude", $this->longitude);
        
            if($turbine->execute()){
               return true;
            }
            return false;
        }
        // READ
        public function getTurbine(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        type, 
                        latitude, 
                        longitude
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $turbine = $this->conn->prepare($sqlQuery);
            $turbine->bindParam(1, $this->id);
            $turbine->execute();
            $dataRow = $turbine->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->type = $dataRow['type'];
            $this->latitude = $dataRow['latitude'];
            $this->longitude = $dataRow['longitude'];
        }        
        // UPDATE
        public function updateTurbine(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        type = :type, 
                        latitude = :latitude, 
                        longitude = :longitude
                    WHERE 
                        id = :id";
        
            $turbine = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->type=htmlspecialchars(strip_tags($this->type));
        
            // bind data
            $turbine->bindParam(":name", $this->name);
            $turbine->bindParam(":type", $this->type);
            $turbine->bindParam(":latitude", $this->latitude);
            $turbine->bindParam(":longitude", $this->longitude);
            $turbine->bindParam(":id", $this->id);
        
            if($turbine->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteTurbine(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $turbine = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $turbine->bindParam(1, $this->id);
        
            if($turbine->execute()){
                return true;
            }
            return false;
        }
    }
?>