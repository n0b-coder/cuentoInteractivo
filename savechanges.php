<?php
    require_once("Conexion.php");
    $json = file_get_contents("php://input");    

    $phpObj=json_decode($json);
    var_dump($phpObj);
    $pestana = $phpObj->Id_pestana;
    $cuento = $phpObj->Id_cuento;
    $Type = 0; 
    if($phpObj->tipo == "historia" || $phpObj->tipo == "portadas" || $phpObj->tipo == "indagacion"|| $phpObj->tipo == "finales"|| $phpObj->tipo == "post_resol")
    {$sql = "SELECT * FROM `pestana` WHERE Id_Pestana = $pestana AND Id_cuento = $cuento"; $Type = 0;
    }

    if($phpObj->tipo == "torres"|| $phpObj->tipo == "fondos-acertijo")
    {$sql = "SELECT pilar.Id_pilar, pilar.Id_acertijo,  pilar.Id_fondo , acertijo.Image_acertijo , acertijo.Fondo_acertijo ,  acertijo.Solucion
      FROM `pilar` JOIN acertijo ON pilar.Id_acertijo = acertijo.Id_acertijo WHERE  Id_pilar = $pestana AND Id_cuento = $cuento"; $Type = 1;  
      echo "Acertijo:";
    }

    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
      $row=$result->fetch_assoc();
      if($phpObj->tipo == "historia" ||  $phpObj->tipo == "finales" || $phpObj->tipo == "portadas")   
      {    
        $texto_O = $row['Texto'];
        if($phpObj->tipo != "portadas")
        {
          $id_imag_2 = $row['Id_personaje'];
          $personaje_pos = $row['personaje_pos'];
        }
        
      }
      if($phpObj->tipo == "fondos-acertijo") 
      {
        $id_imag_2 = $row['Image_acertijo']; 
        $id_acertijo = $row['Id_acertijo'];
        $texto_O = $row['Solucion'];
        $id_fondo_O = $row['Fondo_acertijo'];
  
      }
      else{
         $id_fondo_O = $row['Id_fondo']; 
      }
          
    }



    if(isset($phpObj->texto))
    {
        if(isset($phpObj->Id_pestana) && strcmp ($phpObj->texto , $texto_O)  !==0)
        {
          if($phpObj->tipo == "fondos-acertijo") 
          {
            $sql = "UPDATE `acertijo` SET `Solucion`= '$phpObj->texto'
            WHERE Id_acertijo = '$id_acertijo'";
          }
          else {            
            $sql = "UPDATE `pestana` SET `Texto`= '$phpObj->texto'
            WHERE Id_Pestana = ' $phpObj->Id_pestana'";
          }
            if ($conn->query($sql) === TRUE) {
                echo " Text Record updated successfully ";
              } else {
                echo "Error updating record Text in: " . $conn->error;
              }
        } 
    } 

    
    if(isset( $phpObj->imagen_id))
    {   
        if(isset( $phpObj->Id_pestana) &&   $phpObj->imagen_id != $id_fondo_O )
        {
          if( $Type == 0)
          {
            $sql = "UPDATE `pestana` SET `Id_fondo`= ' $phpObj->imagen_id'
            WHERE Id_Pestana = ' $phpObj->Id_pestana'";
          }
          else
          {
            if($phpObj->tipo == "torres")
            {
              $sql = "UPDATE `pilar` SET `Id_fondo`= ' $phpObj->imagen_id'
              WHERE Id_pilar = ' $phpObj->Id_pestana'";
            }
            if($phpObj->tipo == "fondos-acertijo")
            {
              $sql = "UPDATE `acertijo` SET  `Fondo_acertijo` = ' $phpObj->imagen_id'
              WHERE Id_acertijo = '$id_acertijo'";
            }
          }
            if ($conn->query($sql) === TRUE) {
                echo "Fondos Record updated successfully";
              } else {
                echo "Error updating record Fondos in: " . $conn->error;
              }
        } 
    } 


    if(isset( $phpObj->imagen2_id))
    {
        if(isset( $phpObj->Id_pestana) &&   $phpObj->imagen2_id !=  $id_imag_2)
        {
          if( $phpObj->tipo == "historia" ||  $phpObj->tipo == "finales")
          {

            if( $phpObj->imagen2_id != "0"){
              $sql = "UPDATE `pestana` SET `Id_personaje`= '$phpObj->imagen2_id'
              WHERE Id_Pestana = ' $phpObj->Id_pestana'";
            }
            else{
              $sql = "UPDATE `pestana` SET `Id_personaje`= NULL, 	`personaje_pos`= NULL
              WHERE Id_Pestana = ' $phpObj->Id_pestana'";
            }
            
          }
          if($phpObj->tipo == "fondos-acertijo")
            {
              $sql = "UPDATE `acertijo` SET  `Image_acertijo` = '$phpObj->imagen2_id'
              WHERE Id_acertijo = '$id_acertijo'";
            }
            if ($conn->query($sql) === TRUE) {
                echo " Imagen 2 Record updated successfully";
              } else {
                echo "Error updating record Imagen 2 in: " . $conn->error;
              }
        } 
    }
    
    if(isset( $phpObj->personaje_pos) && $id_imag_2 != NULL)
    {
      if( $phpObj->imagen2_id != "0"){
        $sql = "UPDATE `pestana` SET 	`personaje_pos`= '$phpObj->personaje_pos'
        WHERE Id_Pestana = ' $phpObj->Id_pestana'";
      }
      if ($conn->query($sql) === TRUE) {
        echo " Imagen 2 Record updated successfully";
      } else {
        echo "Error updating personaje pos in: " . $conn->error;
      }
    }
?>