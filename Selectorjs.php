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

    <div class="container-fluid" id="adminApp">

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
                        <input type="text" class="form-control" :placeholder="placeName()" readonly>
                </div>
                <?php
                                $selected = $id_cuento_sel;
                             
                                ?>
                               
                               <div class="ScrollImg row">
                            <div class="scrollingWrapper col">

                                <div class="cards" v-for="(item, index) in admin_data.cuentos" :key="index">
                                <img v-on:click="getId(item[0].id)" :class="{ActBtn:item[0].id == selected , NAddBtn:item[0].id != selected}" @click="selected = item[0].id"  :src="item[0].imagen_fondo">
                                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-infinite-loading@^2/dist/vue-infinite-loading.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://kit.fontawesome.com/0d8e639741.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="admin.js"></script>

</body>
</html>