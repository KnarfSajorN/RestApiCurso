<?php
    class Controllers{
        public function __construct(){
            // Initialize the controller
            $this->view = new Views();
            $this->loadModel();
        }

        public function loadModel(){
            $model = get_class($this)."Model";
            $routeClass = "Models/" . $model . ".php";
            if (file_exists($routeClass)) {
                require_once($routeClass);
                $this->model = new $model();
            } else {
                throw new Exception("Model file not found: " . $model);
            }
        }

        // public function getView($view, $data = []){
        //     $this->view->getView($this, $view, $data);
        // }
    }
?>