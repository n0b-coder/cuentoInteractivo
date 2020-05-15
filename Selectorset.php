<?php
    require_once("Conexion.php");
    $cuentos =array();
    $cuentos["cuentos"] = array();
    $sql= "SELECT settings.Id_cuento, cuento.Cuento_Name
    FROM `settings` JOIN cuento ON  settings.Id_cuento = cuento.Id_cuento";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
            $cuento_actual = array();
            $row=$result->fetch_assoc();
            $cuento_actual['id'] = $row['Id_cuento'];
            $cuento_actual['name'] = $row['Cuento_Name'];
            $cuentos["Cuento_actual"]=  $cuento_actual;    
    }
     
    $sql= "SELECT * FROM `cuento`";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
        while($row=$result->fetch_assoc())
        {
            $cuento = array();
            $cuento['id'] = $row['Id_cuento'];
            $cuento['Cuento_Name'] = $row['Cuento_Name'];
            $cuento['Portada'] = $row['portada'];
            array_push($cuentos["cuentos"], $cuento);
        }
           
    }

    echo json_encode($cuentos,JSON_UNESCAPED_SLASHES);
    
?>
