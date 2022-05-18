<?php 
    class Database {
        private $host = "localhost";
        private $database_name = "farmacia";
        private $username = "root";
        private $password = "";
        public $conn;
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            }catch(PDOException $exception){
                echo "Banco de Dados não Conectado: " . $exception->getMessage();
            }
            return $this->conn;
            
        }
    }  
    
?>