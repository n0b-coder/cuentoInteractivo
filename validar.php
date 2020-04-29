<?php
require_once("Conexion.php");


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
    session_start();
    $_SESSION['user'] = $Email; //inicia sesion con el usuario (email) asignado
    header("location:paneldeadministrador.php");
}
else 
echo "<p class='error'>- Contraseña Incorrecta </p>";
}

mysqli_free_result($result);
mysqli_close($conn);

}


?>