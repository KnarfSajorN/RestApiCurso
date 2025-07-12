<?php
    class ClienteModel extends MySql{
        private $intIdcliente;
        private $strIndetificacion;
        private $strNombre;
        private $strApellido;
        private $strTelefono;
        private $strEmail;
        private $strdireccion;
        private $strNit;
        private $strNomFiscal;
        private $strDirFiscal;
        private $strStatus;

        public function __construct(){
            parent::__construct();
        }
        public function insertCliente(string $identificacion, string $nombre, string $apellido, string $telefono, string $email, string $direccion, string $nit, string $nomFiscal, string $dirFiscal, int $status){
            
            $this->strIndetificacion = $identificacion;
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->strTelefono = $telefono;
            $this->strEmail = $email;
            $this->strdireccion = $direccion;
            $this->strNit = $nit;
            $this->strNomFiscal = $nomFiscal;
            $this->strDirFiscal = $dirFiscal;
            $this->strStatus = ($status == 1) ? 1 : 0;

            $sql = "SELECT identificacion,email FROM cliente_frank WHERE (identificacion = :ident OR email = :email) AND status = :estado;";
            $arrParams = array('ident' => $this->strIndetificacion, 
                                'email' => $this->strEmail, 
                                'estado' => 1
                                );
            $request = $this->select($sql, $arrParams);
            if(!empty($request)){
                return "exist";
            } else {
                $query_insert = "INSERT INTO cliente_frank(identificacion, nombre, apellido, telefono, email, direccion, nit, nomFiscal, dirFiscal, status) 
                                 VALUES(:identificacion, :nombre, :apellido, :telefono, :email, :direccion, :nit, :nomFiscal, :dirFiscal, :status)";
                $arrData = array('identificacion' => $this->strIndetificacion,
                                'nombre' => $this->strNombre,
                                'apellido' => $this->strApellido,  
                                'telefono' => $this->strTelefono,
                                'email' => $this->strEmail,
                                'direccion' => $this->strdireccion,
                                'nit' => $this->strNit,
                                'nomFiscal' => $this->strNomFiscal,
                                'dirFiscal' => $this->strDirFiscal,
                                'status' => $this->strStatus
                                );
                $request_insert = $this->insert($query_insert, $arrData);
                if($request_insert > 0){
                    $return = true;
                } else {
                    $return = false;  
                }
                return $return;
            }
        }

        public function putCliente(int $idcliente, string $identificacion, string $nombre, string $apellido, string $telefono, string $email, string $direccion, string $nit, string $nomFiscal, string $dirFiscal, int $status){
            
            $this->intIdcliente = $idcliente;
            $this->strIndetificacion = $identificacion;
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->strTelefono = $telefono;
            $this->strEmail = $email;
            $this->strdireccion = $direccion;
            $this->strNit = $nit;
            $this->strNomFiscal = $nomFiscal;
            $this->strDirFiscal = $dirFiscal;
            $this->strStatus = ($status == 1) ? 1 : 0;
            
            $sql = "SELECT * FROM cliente_frank WHERE (identificacion = :ident OR email = :email) AND idcliente != :idcliente AND status = :estado;";
            $arrParams = array('ident' => $this->strIndetificacion, 
                                'email' => $this->strEmail, 
                                'idcliente' => $this->intIdcliente,
                                'estado' => 1
                                );
            $request = $this->select($sql, $arrParams);
            if(!empty($request)){
                return "exist";
            } else {
                $query_update = "UPDATE cliente_frank SET identificacion = :identificacion, nombre = :nombre, apellido = :apellido, telefono = :telefono, email = :email, direccion = :direccion, nit = :nit, nomFiscal = :nomFiscal, dirFiscal = :dirFiscal, status = :status 
                                 WHERE idcliente = :idcliente";
                $arrData = array('identificacion' => $this->strIndetificacion,
                                'nombre' => $this->strNombre,
                                'apellido' => $this->strApellido,  
                                'telefono' => $this->strTelefono,   
                                'email' => $this->strEmail,
                                'direccion' => $this->strdireccion,
                                'nit' => $this->strNit,
                                'nomFiscal' => $this->strNomFiscal,
                                'dirFiscal' => $this->strDirFiscal,
                                'status' => $this->strStatus,
                                'idcliente' => $this->intIdcliente
                                );
                $request_update = $this->update($query_update, $arrData);
                if($request_update){
                    $return = true;
                } else {
                    $return = false;
                }
                return $return;
            }

        }

        public function GetCliente(int $idcliente){
            $this->intIdcliente = $idcliente;
            $sql = "SELECT  idCliente, 
                            identificacion,
                            nombres, 
                            apellidos,
                            telefono, 
                            email, 
                            nit, 
                            nombreFiscal, 
                            direccionFiscal, 
                            DATE_FORMAT(datecreated, '%d-%m-%Y') => fechaRegistro 
                            FROM cliente_frank WHERE idcliente = :idcliente AND status != 0";
            $arrData = array('idcliente' => $this->intIdcliente);
            $request = $this->select($sql, $arrData);
            return $request;
        }
        
        public function getClientes(){
            $sql = "SELECT  idCliente, 
                            identificacion,
                            nombres, 
                            apellidos,
                            telefono, 
                            email, 
                            nit, 
                            nombreFiscal, 
                            direccionFiscal, 
                            DATE_FORMAT(datecreated, '%d-%m-%Y') => fechaRegistro 
                            FROM cliente_frank WHERE status != 0 ORDER BY idcliente DESC";
            $request = $this->select_all($sql);
            return $request;    
        }
        

        public function deleteCliente(int $idcliente){
            $this->intIdcliente = $idcliente;
            $sql = "UPDATE cliente_frank SET status = :estado WHERE idcliente = :idcliente";
            $arrData = array(':idcliente' => $this->intIdcliente,
                            ':estado' => 0);
            $request = $this->update($sql, $arrData);
            if($request){
                $return = 'true';
            } else {
                $return = 'false';
            }
            return $return;
        }
        
    }
?>