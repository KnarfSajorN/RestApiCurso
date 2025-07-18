<?php
    class MySql extends Conexion{
        private $conexion;
        private $strQuery;
        private $arrValues;

        public function __construct(){
            parent::__construct();
            //$this->conexion = $this->conexion->connect();
            $this->conexion = $this->connect();
        }

        public function insert(string $query, array $values){
            try {
                $this->strQuery = $query;
                $this->arrValues = $values;
                $insert = $this->conexion->prepare($this->strQuery);
                $resInsert = $insert->execute($this->arrValues);
                $idInsert = $this->conexion->lastInsertId();
                $insert->closeCursor();
                return $idInsert ? $idInsert : 0;
            } catch (PDOException $e) {
                $response = "Error: " . $e->getMessage();
                return $response;
            }
            
        }

        public function select_all(string $query){
            try
            {
                $this->strQuery = $query;
                $execute = $this->conexion->query($this->strQuery);
                $request = $execute->fetchAll(PDO::FETCH_ASSOC);
                $execute->closeCursor();
                return $request;
            } catch (PDOException $e) {
                $response = "Error: " . $e->getMessage();
                return $response;
            }
        }

        public function select(string $query, array $values){
            try {
                $this->strQuery = $query;
                $this->arrValues = $values;
                $select = $this->conexion->prepare($this->strQuery);
                $select->execute($this->arrValues);
                $request = $select->fetch(PDO::FETCH_ASSOC);
                $select->closeCursor();
                return $request ? $request : [];
            } catch (PDOException $e) {
                $response = "Error: " . $e->getMessage();
                return $response;
            }
        }

        public function update(string $query, array $values){
            try {
                $this->strQuery = $query;
                $this->arrValues = $values;
                $update = $this->conexion->prepare($this->strQuery);
                $resUpdate = $update->execute($this->arrValues);
                $update->closeCursor();
                return $resUpdate ? true : false;
            } catch (PDOException $e) {
                $response = "Error: " . $e->getMessage();
                return $response;
            }
        }

        public function delete(string $query, array $values){
            try {
                $this->strQuery = $query;
                $this->arrValues = $values;
                $delete = $this->conexion->prepare($this->strQuery);
                $resDelete = $delete->execute($this->arrValues);
                $delete->closeCursor();
                return $resDelete ? true : false;
            } catch (PDOException $e) {
                $response = "Error: " . $e->getMessage();
                return $response;
            }
        }
    }
?>