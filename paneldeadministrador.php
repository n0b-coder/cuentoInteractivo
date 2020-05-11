</html>
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
    <title>JUKO ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <meta content="JUKO">
    
</head>

<body>

    <div class="container-fluid" id="panelApp">
        <!-- gallery -->
        <section v-if="popUp">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="popup-container">
                        
                    
                        <div class="BlockImg">
                            <div class="ShowImg">                               
                                <img class = "PreImg" :src="panel_data.current_selection.imagen_fondo">                            
                            </div>
                            <div class="ShowDat">
                                <input type="text" class="formuControl" placeholder="Nombre">
                                <div class="Datos">
                                <h3 id="clas-Tipo"> Clase: <?php echo $Type ?></h3>

                                <h3 id="clas-Secc"> Sección <?php echo $seccion ?></h3>
                                <h3 id="clas-Pag"> Página  <?php echo $pagina ?> </h3>
                                </div>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                                    <input type="submit" value="Elegir" class="Btn" name= "sel_gal" @click="popUp=false">
                                    <input type="hidden" name="newimagen_id" :value="selected">
                                </form>
                                </div>
                        </div>
                        <div class="ScrollImg row">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <div>
                                <input type="file" name="fileToUpload" id="fileToUpload" style="font-size:1vw!important; cursor:pointer;" @change="onFileChange"/>
                            </div>
                        </form>
                       
                        <!-- preview de la que acaba de subir -->
                        <img class="images" :src="image" v-if="image!=''">
                        <!-- las imgs de la base de datos -->
                        <template class="row" v-for="item in gallery.images">
                            <div class="galCol">
                                <img :class="{galSelected:item.imagen_id == selected , galThumb:item.imagen_id != selected}" class="slider-background" :src="item.Imag_link"  @click="newImg(item), selected=item.imagen_id">
                            </div>                                
                        </template> 
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- end popUp -->
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
                        Actualizar Nombre
                </div>
                <input type="text" class="form-control" placeholder="JUKO">
            </div>
            

            <!-- selection checkbox -->

            <div class="container row">
                <div class="checkboxrow row">
                    <label class="col">Todo
                        <input type="radio" checked="checked" name="radio" @click="unique=false">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Historia
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('historia')">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Pilares
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('pilares')">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Indagación
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('indagacion')">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Resolución
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('resolucion')">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Finales
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('finales')">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <!-- selection slider :class="item.tipo_pestana"-->
            
            <div class="slider">
                    <div class="scrolling-wrapper slider-container">
                    <!-- historia -->
                        <div
                            class="cards slider-item"
                            v-for="(item, index) in panel_data.historia"
                            :key="index"                           
                            v-if="section=='historia' || unique==false"
                        >
                            <div class="cards" v-for="item in panel_data.historia[index]">
                                <img class="slider-background"  @click="activar(item), panel_data.tipo='historia'" :src="item.imagen_fondo">
                                <!-- <img class="slider-img" :src="item.imagen_personaje"> -->
                            </div>
                        </div>
                        <!-- indagacion -->
                        <div
                            class="cards slider-item"
                            v-for="(itemi, index) in panel_data.indagacion"                       
                            v-if="unique == false || section=='indagacion'"
                        >
                            <div class="cards" v-for="itemi in panel_data.indagacion[index]">
                                <img class="slider-background"  @click="activar(itemi), panel_data.tipo='indagacion'" :src="itemi.imagen_fondo">
                                <!-- <img class="slider-img" :src="item.imagen_personaje"> -->
                            </div>
                        </div>
                        <!-- finales -->
                        <div
                            class="cards slider-item" v-for="(itemf, index) in panel_data.finales" v-if="unique == false || section=='finales'"
                        >
                            <div class="cards" v-for="itemf in panel_data.finales[index]">
                                <img class="slider-background" @click="activar(itemf), panel_data.tipo='finales'" :src="itemf.imagen_fondo">
                                <!-- <img class="slider-img" :src="item.imagen_personaje"> -->
                            </div>
                        </div>
                    </div>
                </div>
            
            <!-- edit page -->
            <div class="EdRow"  v-if="panel_data.current_selection">                
                    <div class= "EdText">
                    <button class="Btn">Actualizar Texto</button>
                    <input type="text" class="HisText" placeholder="Texto a editar" v-model="panel_data.current_selection.texto" name="newtext">
                    <input type="hidden" name="pestana_id"  value ="panel_data.current_selection.texto">
                    </div>
                    <div class="opcionesCol">
                        <div class= "EdFondo">
                            <button class="Btn" @click="popUp=true">
                                Cambiar Fondo
                            </button>
                            
                            <div class="previewCol">
                                <img class = "Prev" :src="panel_data.current_selection.imagen_fondo">
                            </div>
                        </div>
                        <!-- Personaje -->
                        <div class= "EdPersonaje" v-if="panel_data.current_selection.imagen_personaje">
                            <button class="Btn">
                            Cambiar personaje:
                            </button>
                            <div class="previewCol">
                                <img class = "Prev" :src="panel_data.current_selection.imagen_personaje">
                            </div>
                        </div>
                        <div class="submit">
                            <button class="Btn" @click="save(panel_data.current_selection)">Guardar</button>
                        </div>
                    </div>
                </div>               
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://kit.fontawesome.com/0d8e639741.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="paneljs.js"></script>
    

</body>

</html>