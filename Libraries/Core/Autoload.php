<?php
    spl_autoload_register(function ($class_name) {
        //$dir = "Libraries/Core/";
        $file = "Libraries/Core/" . '/' . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            throw new Exception("File not found: " . $file);
        }
    });
?>