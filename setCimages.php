
<?php
    require_once("Conexion.php");
    $images =array();
    $Images["images"] = array();

    $sql = "SELECT * FROM `fondos` WHERE Type = 'historia'";
    $result =  $conn->query($sql);
    $Images["pestana_sel_id"] = 2;



    
    if($result->num_rows>0)
    { 
        while($row=$result->fetch_assoc())
        {
            $imag = array();
            $imag['imagen_id'] = $row['Id_fondo'];
            $imag['imag_Name'] = $row['Name'];
            $imag['Imag_link'] = $row['fondo_img'];
            array_push($Images["images"], $imag);
        }
           
    }

    echo json_encode($Images,JSON_UNESCAPED_SLASHES);
    
?>
