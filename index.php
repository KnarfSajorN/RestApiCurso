<?php
    require_once ("Config/Config.php");
    require_once ("Helpers/Helper.php");
    
     $url = isset($_GET['url']) ? $_GET['url'] : "home/home";
     $arrUrl = explode("/", $url);
    $controller = isset($arrUrl[0]) ? $arrUrl[0] : "home";
    $method = isset($arrUrl[1]) ? $arrUrl[1] : "index";
    $params = "";
    if(!empty($arrUrl[1])){
        if($arrUrl[1] != ""){
            $method = $arrUrl[1];
        }
    }

    if(!empty($arrUrl[2]) && $arrUrl[2] != ""){
        for($i = 2; $i < count($arrUrl); $i++){
            if($params == ""){
                $params .= $arrUrl[$i] . ',';
            } else {
                $params .= "/" . $arrUrl[$i];
            }
            $params = rtrim($params, ',');
        }
    }
    require_once("Libraries/Core/Autoload.php");
    require_once("Libraries/Core/Load.php");
?>