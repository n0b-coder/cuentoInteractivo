<?php
require_once("Conexion.php");
$id_cuento; $id_personaje;
  $data =array();


  $History =array();
  $Finales =array();
  $Indaga = array();


  $pilar = array();
  $data["historia"] = array();
  $data["indagacion"]= array();
  $data["finales"]= array();
  $data["pilares"]= array();
  $data["current_selection"]=NULL;
  $data["tipo"]=NULL;

  $sec =1;  $numsec=1;

  if(isset($_POST['edit']))
{
  $id_cuento = $_POST['cuento_id'];

}
else
{
  $sql= "SELECT * FROM settings";
$result =  $conn->query($sql);
if($result->num_rows>0)
{ 
        $row=$result->fetch_assoc();
        $id_cuento = $row['Id_cuento'];  
}
}

$data["id_cuento"]=$id_cuento;






$sql = "SELECT pestana.Id_Pestana, cuento.Cuento_Name , pestana.Seccion, pestana.Pagina , pestana.Name, pestana.Texto, 
pestana.Id_fondo, fondos.fondo_img , personajes.image_personaje , pestana.Id_personaje , pestana.Type
FROM pestana 
INNER JOIN cuento  ON pestana.Id_cuento = cuento.Id_cuento
INNER JOIN fondos  ON pestana.Id_fondo = fondos.Id_fondo
LEFT JOIN personajes  ON pestana.Id_personaje = personajes.Id_im_personaje WHERE pestana.Id_cuento = '$id_cuento' ORDER BY pestana.Seccion, pestana.Pagina";


$result =  $conn->query($sql);
if($result->num_rows>0)
{ 
    while($row=$result->fetch_assoc())
    {
      
      $tipo= $row['Type'];
      if($tipo == 'portada')
      {
          $portada = array( );
          $portada['id_portada'] = $row['Id_Pestana'];
          $portada['texto'] = $row['Texto'];
          $portada['imagen_fondo'] = $row['fondo_img']; 
          $data["portada"] = $portada;  
      } 
      if($tipo == 'history' || $tipo == 'indaga' || $tipo == 'final' )
      {
        $p = array( );
        $p['id_pestana'] = $row['Id_Pestana'];
        $p['texto'] = $row['Texto'];
        $p['imagen_fondo'] = $row['fondo_img'];
        $p['imagen_personaje'] = $row['image_personaje'];
        $p['pagina'] = $row['Pagina'];
        $p['seccion'] = $row['Seccion'];
        $numsec = $row['Seccion'];
        if($numsec != $sec )
        {
          array_push($data["historia"],$History); 
          unset($History); 
          $History = array(); 
          array_push($data["indagacion"],$Indaga);
          unset($Indaga); 
          $Indaga = array();
          array_push($data["finales"], $Finales);
          unset($Finales); 
          $Finales = array();
          $sec = $numsec;
        }
          if($tipo == 'history')
          array_push($History, $p);
          if($tipo == 'indaga')
          array_push($Indaga, $p);
          if($tipo == 'final')
          array_push($Finales, $p);
     
      } 
      
    }
 
}   
array_push($data["historia"], $History); 
array_push($data["indagacion"], $Indaga);
array_push($data["finales"], $Finales);


$sql = "SELECT pilar.Id_pilar, cuento.Cuento_Name , pilar.Num_pilar, pilar.Name, acertijo.Name_acertijo, acertijo.Image_acertijo, acertijo.Fondo_acertijo , acertijo.Solucion, fondos.fondo_img , personajes.image_personaje 
FROM `pilar` 
JOIN cuento  JOIN acertijo  JOIN fondos JOIN personajes  
ON pilar.Id_cuento = cuento.Id_cuento AND pilar.Id_acertijo = acertijo.Id_acertijo 
AND pilar.Id_acertijo = acertijo.Id_acertijo
AND pilar.Id_fondo = fondos.Id_fondo
AND pilar.Id_personaje = personajes.Id_im_personaje WHERE pilar.Id_cuento = '$id_cuento' ORDER BY Num_pilar";


$result =  $conn->query($sql);
if($result->num_rows>0)
{ 
    while($row=$result->fetch_assoc())
    { 
      $pi = array( );
      $pi['id_pilar'] = $row['Id_pilar'];
      $pi['num_pilar'] = $row['Num_pilar'];
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
      array_push($data["pilares"], $pi); 
      } 
  }    
echo json_encode($data,JSON_UNESCAPED_SLASHES);


mysqli_close($conn);

?>