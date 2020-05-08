<!DOCTYPE html>
<html lang="es">

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
                <h3 id="clas-Tipo"> Clase </h3>
                <h3 id="clas-Secc"> Sección </h3>
                <h3 id="clas-Pag"> Página   </h3>
                </div>
                <button class="NBtn" v-on:click="uploadFile()">
                    Cambiar Imagen
                </button>
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