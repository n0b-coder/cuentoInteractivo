<!DOCTYPE html>
<html lang="es">

<?php
session_start(); //inicia una sesion o reanuda una existente
$variable_S =  $_SESSION['user'];
$selected = 1;
if($variable_S == null || $variable_S == '')
{
    echo "<p class='error'>- por favor inicie sesion para poder ingresar al panel de administracion </p>";
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELECTOR DE CUENT0o</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta content="JUKO">
</head>
<body>
<div class="container-fluid">

<div class="card-header">
    <div id="Titulodeadmin">
        <h1 id="he1deadminP"> Administrador </h1>
        <h2 id="he2deadminP"> <?php echo $_SESSION['user']?> </h2>               
    </div>
    <div class="cerrarS">
        <form action="Cerrar_Sesion.php">
        <button class="BtnUser">
                    Cerrar Sesión
        </button>
        </form>
    </div>
</div>

<div class="container-2fluid">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <button class="input-group-text">
               Cuento actual seleccionado:
        </div>
        <input type="text" class="form-control" placeholder="JUKO">
    </div>
   
    <div class="slider">
            <div class="scrollingWrapper">     
              
                <div class="cards"> <button class=<?php if($selected == 1 ) echo"ActBtn"; else echo"NAddBtn";?>> JUKO </button> </div>
                <div class="cards"> <button class="NAddBtn"> + NEW </button> </div>
            </div>
    </div>
    <div class= Accion>
    <button class="BtnUser">
            Actualizar
        </button>
        <button class="BtnUser">
            Editar
        </button>
    </div>
</div>


</div>

</body>
