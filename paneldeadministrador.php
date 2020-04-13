<!DOCTYPE html>
<html lang="en">
<?php
session_start(); //inicia una sesion o reanuda una existente
$variable_S =  $_SESSION['user'];
if($variable_S == null || $variable_S == '')
{
    echo "<p class='error'>- por favor inicie sesion para poder ingresar al panel de administracion </p>";
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUKO ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta content="JUKO">
</head>

<body>

    <div class="containerdeadmin">


        <div class="Maindeadmin">
            <div id="Titulodeadmin">
                <h1 id="he1deadminP"> Bienvenido <?php echo $_SESSION['user']?> </h1>
           
        </div>

        <div class="cerrarS">
        <form action="Cerrar_Sesion.php">
            <input type="submit" value="Cerrar Sesion" class="BtnHover BtnUser">
        </form>
    </div>

</body>

</html>