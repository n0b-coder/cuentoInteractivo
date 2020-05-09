<!DOCTYPE html>
<html lang="es">
<?php
    session_start(); //inicia una sesion o reanuda una existente
    $variable_S =  $_SESSION['user'];
    $selected = 1;
    $id_pestana = 2;
    $Type = "historia";
    $seccion = 1;
    $pagina =1;
    $id_antigua = 2;
    require_once("Conexion.php");
    if(isset($_POST['sel_gal']))
    {
        $id_nueva = $_POST['newimagen_id'];
        echo $id_nueva;
       
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUKO_IMG_SELECTOR</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta content="JUKO">
</head>
<body>
<div class="Window" id="adminApp">
    <div class="Contenedor">
        <div class="BlockImg">
            <div class="ShowImg">
                <img class = "PreImg" src="https://gameranx.com/wp-content/uploads/2016/05/DOOM4-2.jpg">
            </div>
            <div class="ShowDat">
                <input type="text" class="formuControl" placeholder="Nombre" v-model="newName">
                <div class="Datos">
                <h3 id="clas-Tipo"> Clase: <?php echo $Type ?></h3>

                <h3 id="clas-Secc"> Sección <?php echo $seccion ?></h3>
                <h3 id="clas-Pag"> Página  <?php echo $pagina ?> </h3>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                            <input type="submit" value="Cambiar Imagen" class="NBtn" name= "sel_gal">
                            <input type="hidden" name="newimagen_id"   value = "selected">
                </form>
                </div>
        </div>
        <div class="ScrollImg row">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div>
                <input type="file" name="fileToUpload" id="fileToUpload" style="font-size:1vw!important; cursor:pointer;" @change="onFileChange"/>
            </div>
        </form>
        <div class="scrollingWrapper col">
            <!-- preview de la que acaba de subir -->
            <img class="images" :src="image" v-if="image!=''">
            <!-- las imgs de la base de datos -->
            <div class="cards" v-for="(item, index) in images_data.images" :key="index">
                <img v-on:click="getId(item.imagen_id)" class="images" :class="{ActBtn:item.imagen_id == selected , NAddBtn:item.imagen_id != selected}" @click="selected = item.imagen_id"  :src="item.Imag_link">
            </div>
        </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://kit.fontawesome.com/0d8e639741.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="changeimgs.js"></script>

</body>
</html>