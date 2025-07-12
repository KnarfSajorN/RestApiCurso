<?php
    class Errors extends Controllers {
        public function __construct() {
            parent::__construct();
        }

        public function notFound() {
            $data['page_tag'] = "Error 404";
            $data['page_title'] = "Pagina no encontrada";
            $data['page_name'] = "error404";
            $this->view->getView($this, "error404", $data);
        }

        public function forbidden() {
            $data['page_tag'] = "Error 403";
            $data['page_title'] = "Acceso denegado";
            $data['page_name'] = "error403";
            $this->view->getView($this, "error403", $data);
        }
    }
    $notFound = new Errors();
    $notFound->notFound();
?>