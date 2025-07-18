<?php
    class Views{
        function getView($controller, $view, $data = ""){           
            $viewFile = "Views/" . $view . ".php";
            $controller = get_class($controller);       
            if (file_exists($viewFile)) {
                if($controller != "Home"){
                    $controllerName = "Views/" . $controller . "/". $view . ".php";
                }
                require_once($viewFile);
            } else {
                throw new Exception("View file not found: " . $viewFile);
            }
        }
    }
?>