<?php
    require_once("Conexion.php");
    $json = file_get_contents("php://input");    

    $phpObj=json_decode($json);

    $pestana = $json->Id_pestana;
    $cuento = $json->Id_cuento;

    
    $sql = "SELECT * FROM `pestana` WHERE pestana.Id_Pestana = $pestana";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
            $row=$result->fetch_assoc();
            $texto_O = $row['Texto'];
            $id_fondo_O = $row['Id_fondo'];
            $id_personaje_O = $row['Id_personaje'];
    }



    if(isset($json->texto))
    {
        if(isset($json->Id_pestana) && strcmp ($json->texto , $texto_O)  !==0)
        {
            $sql = "UPDATE `pestana` SET `Texto`= '$json->texto'
            WHERE Id_Pestana = '$json->Id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        } 
    } 

    
    if(isset($json->imagen_id))
    {
        if(isset($json->Id_pestana) &&  $json->imagen_id != $id_fondo_O )
        {
            $sql = "UPDATE `pestana` SET `Id_fondo`= '$json->imagen_id'
            WHERE Id_Pestana = '$json->Id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        } 
    } 


    if(isset($json->personaje_id))
    {
        if(isset($json->Id_pestana) &&  $json->personaje_id !=  $id_personaje_O )
        {
            $sql = "UPDATE `pestana` SET `Id_personaje`= '$json->personaje_id'
            WHERE Id_Pestana = '$json->Id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        } 
    } 



?>