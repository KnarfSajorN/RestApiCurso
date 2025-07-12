<?php
    function base_url(){
        return BASE_URL;
    }

    function media(){
        return BASE_URL . "Assets";
    }

    function dep($data){
        $format = print_r("<pre>");
        $format .= print_r($data);
        $format .= print_r("</pre>");
        return $format;
    }

    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'], [' ', ''], $strCadena); // Remove extra spaces
        $string = trim($strCadena);
        $string = stripcslashes($string); // Remove backslashes
        $string = str_ireplace(["<script>", "</script>", "<script src>", "<script type=>",
                               "SELECT * FROM", "DELETE FROM", "INSERT INTO", "SELECT COUNT(*)",
                               "DROP TABLE", "OR '1'='1'",  "OR ´1´=´1´", '"', "'", "<", ">", "&",'OR "1"="1"',
                                "is NULL; --", "LIKE '",'LIKE "',"LIKE ´","OR 'a'='a",'OR "a"="a"',"OR ´a´=´a","--","^","[","]","=="], "", $string); // Remove harmful characters
        return $string;
    }
?>