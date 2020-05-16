<?php
    require_once("Conexion.php");
    $json = file_get_contents("php://input");    

    $phpObj=json_decode($json);
    $pestana = $phpObj->Id_pestana;

    
    
    $sql = "SELECT * FROM `pestana` WHERE pestana.Id_Pestana = $pestana";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
            $row=$result->fetch_assoc();
            $texto_O = $row['Texto'];
            $id_fondo_O = $row['Id_fondo'];
            $id_personaje_O = $row['Id_personaje'];
    }



    if(isset($phpObj->texto))
    {
        if(isset($phpObj->Id_pestana) && strcmp ($phpObj->texto , $texto_O)  !==0)
        {
            $sql = "UPDATE `pestana` SET `Texto`= '$phpObj->texto'
            WHERE Id_Pestana = ' $phpObj->Id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        } 
    } 

    
    if(isset( $phpObj->imagen_id))
    {
        if(isset( $phpObj->Id_pestana) &&   $phpObj->imagen_id != $id_fondo_O )
        {
            $sql = "UPDATE `pestana` SET `Id_fondo`= ' $phpObj->imagen_id'
            WHERE Id_Pestana = ' $phpObj->Id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        } 
    } 


    if(isset( $phpObj->personaje_id))
    {
        if(isset( $phpObj->Id_pestana) &&   $phpObj->personaje_id !=  $id_personaje_O )
        {
            $sql = "UPDATE `pestana` SET `Id_personaje`= ' $phpObj->personaje_id'
            WHERE Id_Pestana = ' $phpObj->Id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        } 
    } 



?>