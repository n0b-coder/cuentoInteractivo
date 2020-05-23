<?php
    require_once("Conexion.php");
    $json = file_get_contents("php://input");    
    $coso = var_dump($_POST);

    $phpObj=json_decode($json);

    $response=array();

    $response=$phpObj;

    print_r($response);

?>