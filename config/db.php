<?php 
    class Database {
        private $host = "localhost";
        private $database_name = "ivfassess_api_faculdade";
        private $username = "ivfassess_ivfassessoria";
        private $password = "ivf@201919!";
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