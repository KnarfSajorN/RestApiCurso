<?php
    class Conexion{
        private $connect;
        public function __construct(){
            if(CONNECTION){
                try {
                    $connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
                    $this->connect = new PDO($connectionString, DB_USER, DB_PASSWORD);
                    $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    $this->connect = "Error de conexión";
                    echo "Error: ". $e->getMessage();
                }
            }
        }
        
        public function connect(){
            return $this->connect;
        }

    }
?>