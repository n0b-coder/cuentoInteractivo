<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELECTOR DE CUENT0o</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta content="JUKO">
</head>

<?php
    session_start(); //inicia una sesion o reanuda una existente
    $variable_S =  $_SESSION['user'];
    $selected = 1;
    if($variable_S == null || $variable_S == '')
    {
        echo "<p class='error'>- por favor inicie sesion para poder ingresar al panel de administracion </p>";
        die();
    }
    require_once("Conexion.php");
    $sql= "SELECT settings.Id_cuento, cuento.Cuento_Name, settings.Id_personaje
    FROM `settings` JOIN cuento ON  settings.Id_cuento = cuento.Id_cuento";
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
            $row=$result->fetch_assoc();
            $id_cuento_sel = $row['Id_cuento'];
            $Name_cuento_sel = $row['Cuento_Name'];
            $id_personaje_sel = $row['Id_personaje'];    
    }

?>

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

            
                <input type="text" class="form-control" placeholder="Cuento Actual:" readonly>
                <input type="text" class="form-control" placeholder="<?php echo $Name_cuento_sel ?> " readonly>
        </div>
        
            <div class="slider">
                    <div class="scrollingWrapper">
                        <?php
                        $selected = $id_cuento_sel;
                          $sql = "SELECT * FROM `cuento`";
                          $result =  $conn->query($sql);
                            if($result->num_rows>0)
                            { 
                               
                                while($row=$result->fetch_assoc())
                                {
                                    ?>
                                    <div class="cards"> <input type="image" src="IMG_NEW/portadas/JUKO_P.png" class=<?php if($selected == 1 ) echo"ActBtn"; else echo"NAddBtn";?> v-on:click="selected('$select')">    </div>
                                    <?php
                                    
                                }
                            }
                         ?>
                        <div class="cards"> <button class="NAddBtn"> + NEW </button> </div>
                    </div>
            </div>
            <div class= Accion>
                
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <input type="hidden" name="cuento_id"   value =  "<?php echo $selected ?>">
                    <input type="submit" value="Actualizar" class="BtnUser" name= "actualize">
                </form>

                <form action="paneldeadministrador.php" method="post">
                    <input type="hidden" name="cuento_id"   value =  "<?php echo $selected ?>">
                    <input type="submit" value="Editar" class="BtnUser" name= "edit">
                </form>
            </div>
</div>


</div>

</body>
