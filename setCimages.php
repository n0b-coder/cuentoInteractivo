
<?php
    require_once("Conexion.php");
    $Images =array();
    $Images["historia"] = array(); 
    $Images["finales"] = array(); 
    $Images["p_resol"] = array(); 
    $Images["torre"] = array(); 
    $Images["indagacion"] = array(); 
    $Images["acertijo"] = array();
    $Images["facertijo"] = array(); 
    $Images["portada"] = array(); 
    $Images["personajes"] = array(); 

    $sql = "SELECT * FROM `fondos`";
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
            $type = $row['Type'];
            if($type== "portada")
            { array_push($Images["portada"], $imag);}
            if($type== "historia")
            { array_push($Images["historia"], $imag);}
            if($type== "torre")
            { array_push($Images["torre"], $imag);}
            if($type== "indagacion")
            { array_push($Images["indagacion"], $imag);}
            if($type== "facertijo")
            { array_push($Images["facertijo"], $imag);}
            if($type== "p_resol")
            { array_push($Images["p_resol"], $imag);}
            if($type== "final")
            { array_push($Images["finales"], $imag);}
        }
           
    }

    $sql = "SELECT * FROM `personajes`";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
        while($row=$result->fetch_assoc())
        {
            $pers = array();
            $pers['imagen_id'] = $row['Id_im_personaje'];
            $pers['imname'] = $row['name'];
            $pers['Imag_link'] = $row['image_personaje'];
            $pers['id_pers_gen'] = $row['id_personaje'];
            array_push($Images["personajes"], $pers);
        }
    }

    $sql = "SELECT * FROM `acertijo`";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
        while($row=$result->fetch_assoc())
        {
            $acert = array();
            $acert['imagen_id'] = $row['Id_acertijo'];
            $acert['imname'] = $row['Name_acertijo'];
            $acert['Imag_link'] = $row['Image_acertijo'];
            array_push($Images["acertijo"], $acert);
        }
    }
    

    echo json_encode($Images,JSON_UNESCAPED_SLASHES);
    
?>
