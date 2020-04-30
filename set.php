<?php
require_once("Conexion.php");
$id_cuento; $id_personaje;
  $data =array();
  $Seccion=array();
  $pilar = array();


$sql= "SELECT * FROM settings";
$result =  $conn->query($sql);
if($result->num_rows>0)
{ 
        $row=$result->fetch_assoc();
        $id_cuento = $row['Id_cuento'];
        $id_personaje = $row['Id_personaje'];    
}

$sql = "SELECT pestana.Id_Pestana, cuento.Cuento_Name , pestana.Seccion, pestana.Pagina , pestana.Name, pestana.Texto, fondos.fondo_img , personajes.image_personaje , pestana.Type
FROM pestana 
INNER JOIN cuento  ON pestana.Id_cuento = cuento.Id_cuento
INNER JOIN fondos  ON pestana.Id_fondo = fondos.Id_fondo
LEFT JOIN personajes  ON pestana.Id_personaje = personajes.Id_im_personaje WHERE pestana.Id_cuento = '$id_cuento'";


$result =  $conn->query($sql);
if($result->num_rows>0)
{ 
    while($row=$result->fetch_assoc())
    {
      
      $tipo= $row['Type'];
      if($tipo == 'portada')
      {
          $portada = array( );
          $portada['texto'] = $row['Texto'];
          $portada['imagen_fondo'] = $row['fondo_img']; 
          $data["portada"] = $portada;  
      } 
      if($tipo == 'history' || $tipo == 'indaga' || $tipo == 'final' )
      {
        $p = array( );
        $p['texto'] = $row['Texto'];
        $p['imagen_fondo'] = $row['fondo_img'];
        $p['imagen_personaje'] = $row['image_personaje'];
        $numpag = $row['Pagina'];
        $numsec = $row['Seccion'];
        if($tipo == 'history')
        $Seccion[1][$numsec][$numpag] = $p;
        if($tipo == 'indaga')
        $Seccion[2][$numsec][$numpag] = $p;
        if($tipo == 'final')
        $Seccion[3][$numsec][$numpag] = $p;
      } 
    }
    $data["historia"]= $Seccion[1];
    $data["indagacion"]= $Seccion[2];
    $data["finales"]= $Seccion[3];
}


$sql = "SELECT pilar.Id_pilar, cuento.Cuento_Name , pilar.Num_pilar, pilar.Name, acertijo.Name_acertijo, acertijo.Image_acertijo, acertijo.Fondo_acertijo , acertijo.Solucion, fondos.fondo_img , personajes.image_personaje 
FROM `pilar` 
JOIN cuento  JOIN acertijo  JOIN fondos JOIN personajes  
ON pilar.Id_cuento = cuento.Id_cuento AND pilar.Id_acertijo = acertijo.Id_acertijo 
AND pilar.Id_acertijo = acertijo.Id_acertijo
AND pilar.Id_fondo = fondos.Id_fondo
AND pilar.Id_personaje = personajes.Id_im_personaje WHERE pilar.Id_cuento = '$id_cuento'";


$result =  $conn->query($sql);
if($result->num_rows>0)
{ 
    while($row=$result->fetch_assoc())
    {
      $numpil = $row['Num_pilar'];
      $pi = array( );
      $pi['pilar_name'] = $row['Name'];
      $pi['acertijo_name'] = $row['Name_acertijo'];
      $pi['imagen_acertijo'] = $row['Image_acertijo'];
      $f = $row['Fondo_acertijo'];
        $sql1 = "SELECT fondo_img FROM fondos WHERE Id_fondo = '$f'";
        $res =  $conn->query($sql1);
        if($res->num_rows>0)
        { 
        $row1=$res->fetch_assoc();
        $pi['fondo_acertijo'] = $row1['fondo_img'];
        }
      $pi['solucion'] = $row['Solucion'];
      $pi['torre'] = $row['fondo_img'];
      $pi['imagen_personaje'] = $row['image_personaje'];

      $pilar[$numpil] = $pi;
      } 
    $data["pilares"]= $pilar;
  }    
echo json_encode($data);


mysqli_close($conn);

?>