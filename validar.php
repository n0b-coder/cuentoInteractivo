<?php
require_once("Conexion.php");
$db = "sql10330000";

if(isset($_POST['log_try']))
{
    if(empty($Email)) //comprobacion de parte de servidor por si eliminan el required del html
    {
        echo "<p class='error'>- Correo no ingresado </p>";
    }else{
            if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
            {
                 echo "<p> class='error'>- El correo no esta escrito correctamente </p>";
            }
        }

    if(empty($Contraseña))  //comprobacion de parte de servidor por si eliminan el required del html
    { 
        echo "<p> class='error'>- Contraseña no ingresada </p>";
    }
       
        

if (!mysqli_select_db($conn,$db))
{
    echo "<p> class='error'>- La base de datos no existe </p>";
    die("Connection failed: " . $conn->connect_error);
}

$consulta= "SELECT * FROM Administradores WHERE email ='$Email'";
$result = mysqli_query( $conn,$consulta);
$filas = mysqli_num_rows($result);
if($filas ==0)
{
    echo "<p class='error'>- El correo ingresado no se encuentra inscrito como Administrador </p>";
}
else
{
$consulta= "SELECT * FROM Administradores WHERE email ='$Email' and password = '$Contraseña'";
$result = mysqli_query( $conn,$consulta);
$filas = mysqli_num_rows($result);
if($filas>0)
{
header("location:paneldeadministrador.php?u=$Email");
}
else 
echo "<p class='error'>- Contraseña Incorrecta </p>";
}

mysqli_free_result($result);
mysqli_close($conn);

}


?>