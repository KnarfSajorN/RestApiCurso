<?php
    class Home extends Controllers {
        public function __construct() {
            parent::__construct();
        }

        public function home($params) {
            $data['page_tasg'] = "Home";
            $data['page_title'] = "Pagina principal";
            $data['page_name'] = "home";
            $this->view->getView($this, "home", $data);
        }
    }
?>