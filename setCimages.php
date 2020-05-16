
<?php
    require_once("Conexion.php");
    $images =array();
    $Images["images"] = array();
    $Images["pestana_sel_id"] = 2;

    $sql = "SELECT * FROM `fondos` WHERE Type = 'historia'";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
        while($row=$result->fetch_assoc())
        {
            $imag = array();
            $imag['imagen_id'] = $row['Id_fondo'];
            $imag['imag_Name'] = $row['Name'];
            $imag['Imag_link'] = $row['fondo_img'];
            $imag['Imag_type'] = $row['Type'];
            array_push($Images["images"], $imag);
        }
           
    }

    echo json_encode($Images,JSON_UNESCAPED_SLASHES);
    
?>
