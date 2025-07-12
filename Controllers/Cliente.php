<?php
    class Cliente extends Controllers {
        public function __construct() {
            parent::__construct();
            // session_start();
            // if (empty($_SESSION['login'])) {
            //     header('Location: ' . BASE_URL . '/login');
            //     exit;
            // }
        }

        public function cliente($idClente) {
            try {
                $method = $_SERVER['REQUEST_METHOD'];
                $response = [];
                if ($method == "GET")
                {
                    if(empty($idCliente) or !is_numeric($idClente)) {
                        $response = array('status ' => false,'msg' => 'Error en los parametros');
                        $code = 400;
                        die();
                    }
                    $arrCliente = $this->model->getCliente($idClente);
                    if (empty($arrCliente)) {
                        $response = array('status' => false, 'msg' => 'Cliente no encontrado');
                        $code = 404;
                        die();
                    }else {
                        $response = array('status' => true, 'data' => $arrCliente);
                        $code = 200;
                    }
                } else {
                    $response = array('status' => false, 'msg' => 'Metodo no permitido');
                    $code = 405;
                }
                jsonResponse($response, $code);
                die();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            die();
        }

        public function insertCliente() {
            try {
                $method = $_SERVER['REQUEST_METHOD'];
                $response = [];
                if ($method == "POST") {
                    $data = json_decode(file_get_contents("php://input"), true);
                    if(empty($_POST['identificacion'])){
                        $response = array('status' => false, 'msg' => 'la identificacion es requerida');
                        json_decode($response, 200);
                        die();
                    }
                    if($empty($arrData['nombres']) or !testString($data['nombres'])) {
                        $response = array('status' => false, 'msg' => 'El nombre es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    if(empty($data['apellidos']) or !testString($data['apellidos'])) {
                        $response = array('status' => false, 'msg' => 'El apellido es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    if(empty($data['telefono']) or !testPhone($data['telefono'])) {
                        $response = array('status' => false, 'msg' => 'El telefono es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    if(empty($data['direccion']) or !testString($data['direccion'])) {
                        $response = array('status' => false, 'msg' => 'La direccion es requerida');
                        json_decode($response, 200);            
                        die();
                    }
                    if(empty($data['email']) or !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $response = array('status' => false, 'msg' => 'El email es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    $strIdentificacion = $_POST['identificacion'];
                    $strNombres = ucword(strlower($_POST['nombres']));
                    $strApellidos = ucword(strlower($_POST['apellidos']));
                    $intTelefono = $_POST['telefono'];
                    $strEmail = strtolower($_POST['email']);
                    $strDireccion = ucword(strlower($_POST['direccion']));
                    $strNit = !empty($_POST['nit']) ? $_POST['nit'] : '';
                    $strNomfiscal = !empty($_POST['nomFiscal']) ? ucword(strlower($_POST['nomFiscal'])) : '';
                    $strDirFiscal = !empty($_POST['dirFiscal']) ? ucword(strlower($_POST['dirFiscal'])) : '';

                    $request = $this->model->setCliente($strIdentificacion, $strNombres, $strApellidos, $intTelefono, $strEmail, $strDireccion, $strNit, $strNomfiscal, $strDirFiscal);
                    if ($request > 0) {
                        $arrCliente = array( 'idCliente' => $request, 'identificacion' => $strIdentificacion, 'nombres' => $strNombres, 'apellidos' => $strApellidos, 'telefono' => $intTelefono, 'email' => $strEmail, 'direccion' => $strDireccion, 'nit' => $strNit, 'nomFiscal' => $strNomfiscal, 'dirFiscal' => $strDirFiscal);
                        
                        $response = array('status' => true, 'msg' => 'Cliente registrado correctamente', 'data' => $arrCliente);

                        $code = 201;
                    } else {
                        $response = array('status' => false, 'msg' => 'Error al registrar el cliente, identificacion ya existe');
                        $code = 400;    
                    }
                } else {
                    $response = array('status' => false, 'msg' => 'Metodo no permitido');
                    $code = 405;
                }
                jsonResponse($response, $code);
                die();
            } catch (Exception $e) {
                echo "Error en el proceso: " . $e->getMessage();
            }
            die();
        }

        public function clientes() {
            try {
                $method = $_SERVER['REQUEST_METHOD'];
                $response = [];
                if ($method == "GET") {
                    $arrClientes = $this->model->getClientes();
                    if (empty($arrClientes)) {
                        $response = array('status' => false, 'msg' => 'No hay clientes registrados');
                        $code = 404;
                        die();
                    } else {
                        $response = array('status' => true, 'data' => $arrClientes);
                        $code = 200;
                    }
                } else {
                    $response = array('status' => false, 'msg' => 'Metodo no permitido');
                    $code = 405;
                }
                jsonResponse($response, $code);
                die();
            } catch (Exception $e) {
                echo "Error en el proceso: " . $e->getMessage();
            }
            die();
        }

        public function actualizarCliente($idCliente) {
            try {
                $method = $_SERVER['REQUEST_METHOD'];
                $response = [];
                if ($method == "PUT") {
                    $data = json_decode(file_get_contents("php://input"), true);
                    if(empty($idCliente) or !is_numeric($idCliente)) {
                        $response = array('status' => false, 'msg' => 'Error en los parametros');
                        $code = 400;
                        jsonResponse($response, $code);
                        die();
                    }
                    if(empty($data['nombres']) or !testString($data['nombres'])) {
                        $response = array('status' => false, 'msg' => 'El nombre es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    if(empty($data['apellidos']) or !testString($data['apellidos'])) {
                        $response = array('status' => false, 'msg' => 'El apellido es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    if(empty($data['telefono']) or !testPhone($data['telefono'])) {
                        $response = array('status' => false, 'msg' => 'El telefono es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    if(empty($data['direccion']) or !testString($data['direccion'])) {
                        $response = array('status' => false, 'msg' => 'La direccion es requerida');
                        json_decode($response, 200);            
                        die();
                    }
                    if(empty($data['email']) or !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $response = array('status' => false, 'msg' => 'El email es requerido');
                        json_decode($response, 200);
                        die();
                    }
                    $strIdentificacion = $data['identificacion'];
                    $strNombres = ucword(strlower($data['nombres']));
                    $strApellidos = ucword(strlower($data['apellidos']));
                    $intTelefono = $data['telefono'];
                    $strEmail = strtolower($data['email']);
                    $strDireccion = ucword(strlower($data['direccion']));
                    $strNit = !empty($data['nit']) ? $data['nit'] : '';
                    $strNomfiscal = !empty($data['nomFiscal']) ? ucword(strlower($data['nomFiscal'])) : '';
                    $strDirFiscal = !empty($data['dirFiscal']) ? ucword(strlower($data['dirFiscal'])) : ''; 

                    $buscarCliente = $this->model->getCliente($idCliente);
                    if (empty($buscarCliente)) {
                        $response = array('status' => false, 'msg' => 'Cliente no encontrado');
                        $code = 404;
                        jsonResponse($response, $code);
                        die();
                    }

                    $request = $this->model->putCliente($idCliente, $strNombres, $strApellidos, $intTelefono, $strEmail, $strDireccion, $strNit, $strNomfiscal, $strDirFiscal);
                    if ($request) {
                        $arrCliente = array('idCliente' => $idCliente, 'nombres' => $strNombres, 'apellidos' => $strApellidos, 'telefono' => $intTelefono, 'email' => $strEmail, 'direccion' => $strDireccion, 'nit' => $strNit, 'nomFiscal' => $strNomfiscal, 'dirFiscal' => $strDirFiscal);   
                        $response = array('status' => true, 'msg' => 'Cliente actualizado correctamente', 'data' => $arrCliente);
                        $code = 200;
                    } else {
                        $response = array('status' => false, 'msg' => 'Error al actualizar el cliente, identificacion ya existe');
                        $code = 400;
                    } 
                } else {
                    $response = array('status' => false, 'msg' => 'Metodo no permitido');
                    $code = 405;
                }
                jsonResponse($response, $code);
                die();
            } catch (Exception $e) {
                echo "Error en el proceso: " . $e->getMessage();
            }   
            die();
        }

        public function eliminarCliente($idCliente) {
            try {
                $method = $_SERVER['REQUEST_METHOD'];
                $response = [];
                if ($method == "DELETE") {
                    if(empty($idCliente) or !is_numeric($idCliente)) {
                        $response = array('status' => false, 'msg' => 'Error en los parametros');
                        $code = 400;
                        jsonResponse($response, $code);
                        die();
                    }
                    $buscarCliente = $this->model->getCliente($idCliente);
                    if (empty($buscarCliente)) {
                        $response = array('status' => false, 'msg' => 'Cliente no encontrado');
                        $code = 404;
                        jsonResponse($response, $code);
                        die();
                    }
                    $request = $this->model->deleteCliente($idCliente);
                    if ($request) {
                        $response = array('status' => true, 'msg' => 'Cliente eliminado correctamente');
                        $code = 200;
                    } else {
                        $response = array('status' => false, 'msg' => 'Error al eliminar el cliente');
                        $code = 400;
                    }
                } else {
                    $response = array('status' => false, 'msg' => 'Metodo no permitido');
                    $code = 405;
                }
                jsonResponse($response, $code);
                die();
            } catch (Exception $e) {
                echo "Error en el proceso: " . $e->getMessage();
            }
            die();
        }
    }
?>