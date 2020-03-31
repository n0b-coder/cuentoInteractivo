<?php
require_once("Conexion.php");
$db = "sql10330000";
$Email = $_POST['user'];
$Contraseña = $_POST['password'];
if (!mysqli_select_db($conn,$db))
{
    echo "la base no existe ";
}
else
    echo " la base existe ";

$consulta= "SELECT * FROM Administradores WHERE email ='$Email' and password = '$Contraseña'";
$result = mysqli_query( $conn,$consulta);
$filas = mysqli_num_rows($result);
if($filas>0)
{
header("location:paneldeadministrador.html");
}
else 
echo "Error en la autenticacion";
mysqli_free_result($result);
mysqli_close($conn);
?>