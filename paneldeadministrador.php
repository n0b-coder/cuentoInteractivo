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
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUKO ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="icons/css/fontawesome.css">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <meta content="JUKO">
    
</head>

<body>

    <div class="container-panel" id="panelApp">
    <transition name="pass-page" v-if="loading">
		<div class="preloader">
			<div class="loader"></div>
		</div>
	</transition>
         <!-- success -->
         <div v-if="successImg" id="alerts">
            <div class="modal-mask-img">
            <div class="modal-wrapper">
                <div class="alert-container">
                <div class="modal-body">
                    <slot name="body"> <!-- sirve para futuras alerts -->
                        Imagen cargada.
                    </slot>
                </div>

                <div class="modal-footer">
                    <button class="Btn" @click="successImg=false">
                        Vale
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
        
        <!-- success -->
        <div v-if="success" id="alerts">
            <div class="modal-mask-img">
            <div class="modal-wrapper">
                <div class="alert-container">
                <div class="modal-body">
                    <slot name="body"> <!-- sirve para futuras alerts -->
                        Tus cambios han sido guardados con éxito.
                    </slot>
                </div>

                <div class="modal-footer">
                    <button class="Btn" @click="success=false">
                        Vale
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- gallery -->
        <div v-if="popUp">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="popup-container">
                        
                    
                        <div class="BlockImg">
                            <div class="ShowImg">                               
                                <img class = "PreImg" :src="preview" v-if="panel_data.current_selection.id_imagen_personaje!=0">                            
                                <img class = "PreImg" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Imagen_no_disponible.svg/1200px-Imagen_no_disponible.svg.png" v-if="preview==null && active==true || (panel_data.current_selection.id_imagen_personaje==0)">  
                            </div>
                            <div class="ShowDat">
                                <!-- <input type="text" class="formuControl" placeholder="Nombre"> -->
                                <div class="Datos">
                                <h3 id="clas-Tipo"> Clase: {{panel_data.tipo}}</h3>

                                <h3 id="clas-Tipo"> Sección {{panel_data.current_selection.seccion}}</h3>
                                <h3 id="clas-Tipo"> Página  {{panel_data.current_selection.pagina}} </h3>
                                </div>
                                <i class="icon fas fa-check-circle" style="z-index:900" @click="popUp=false, active=false"></i>      
                                </div>
                        </div>
                        <div class="ScrollImg row">
                        <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadImg">
                            <div style="position:relative">
                            <div class="SubirBtn">
                                <input type="file" name="ImageToUpload" id="ImageToUpload"
                                @change="onFileChange" @click="action=1"/>
                            Reemplazar</div>
                            <div class="SubirBtn" v-if="active==true && section!='resolucion'" @click="panel_data.current_selection.id_imagen_personaje=0">
                            Remover
                            </div>
                                <input type="hidden" name="tipoimagen" :value="panel_data.tipo">                               
                            </div>
                        </form>
                       
                        <!-- preview de la que acaba de subir -->
                        <img class="images" :src="image" v-if="image!=''">
                        <!-- las imgs de la base de datos -->
                        <template class="row" v-for="item in photos">
                            <div class="galCol">
                                <img :class="{galSelected:item.imagen_id == selected , galThumb:item.imagen_id != selected}" class="slider-background" :src="item.Imag_link"  @click="newImg(item)">
                            </div>                                
                        </template>
                        <div class="add">
                            <div class="AddBtn galCol" v-if="(section!=='resolucion' && active==true || active==false)">
                                <input type="file" name="ImageToUpload" id="ImageToUpload"
                                @change="onFileChange" @click="action=2"/>
                            +</div>
                        </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>        
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

        <div class="container-3fluid">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="input-group-text">
                        Actualizar Nombre
                </div>
                <input type="text" class="form-control" placeholder="JUKO">
            </div>
            

            <!-- selection checkbox -->

            <div class="row">
                <div class="checkboxrow row">
                    <label class="col pad">Todo
                        <input type="radio" checked="checked" name="radio" @click="unique=false, panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col pad">Historia
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('historia'), panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col pad">Pilares
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('pilares'), panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col pad">Indagación
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('indagacion'), panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col pad">Resolución
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('resolucion'), panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col pad">Post/resolución
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('postresol'), panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col pad">Finales
                        <input type="radio" checked="checked" name="radio" @click="unique=true, seccion('finales'), panel_data.current_selection=null">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <!-- Slider -->
            
            <div class="slider">
                    <div class="scrolling-wrapper">
                    <!-- portada -->
                        <div class="cards slider-item" v-if="section=='portada' || unique==false">
                            <div class="cards">
                                <img class="slider-background"  @click="activar(panel_data.portada), panel_data.tipo='portada', seccion('portada')" :src="panel_data.portada.imagen_fondo">
                            </div>
                        </div>
                    <!-- historia -->
                        <div
                            class="cards slider-item"
                            v-for="(item, index) in panel_data.historia"                       
                            v-if="section=='historia' || unique==false"
                        >
                            <div class="cards" v-for="item in panel_data.historia[index]">
                                <img class="slider-background"  @click="activar(item), panel_data.tipo='historia', seccion('historia')" :src="item.imagen_fondo">
                            </div>
                        </div>
                        <!-- pilares -->
                        <template
                            class="cards slider-item"
                            v-if="section=='pilares' || unique==false"
                        >
                            <div class="cards" v-for="itemPil in panel_data.pilares">
                                <img class="slider-background"  @click="activar(itemPil), panel_data.tipo='torres', seccion('pilares')" :src="itemPil.torre">
                            </div>
                        </template>
                        <!-- indagacion -->
                        <div
                            class="cards slider-item"
                            v-for="(itemi, index) in panel_data.indagacion"                       
                            v-if="unique == false || section=='indagacion'"
                        >
                            <div class="cards" v-for="itemi in panel_data.indagacion[index]">
                                <img class="slider-background"  @click="activar(itemi), panel_data.tipo='indagacion', seccion('indagacion')" :src="itemi.imagen_fondo">
                            </div>
                        </div>
                        <!-- resolución -->
                        <template
                            class="cards slider-item"
                            v-if="section=='resolucion' || unique==false"
                        >
                            <div class="cards" v-for="itemRes in panel_data.pilares">
                                <img class="slider-background"  @click="activar(itemRes), panel_data.tipo='fondos-acertijo', seccion('resolucion')" :src="itemRes.fondo_acertijo">
                            </div>
                        </template>
                        <!-- post-resolución -->
                        <div
                            class="cards slider-item"
                            v-for="(itempr, index) in panel_data.post_resol"                      
                            v-if="section=='postresol' || unique==false"
                        >
                            <div class="cards" v-for="itempr in panel_data.post_resol[index]">
                                <img class="slider-background"  @click="activar(itempr), panel_data.tipo='post_resol', seccion(panel_data.tipo), section='postresol'" :src="itempr.imagen_fondo">
                            </div>
                        </div>
                        <!-- finales -->
                        <div
                            class="cards slider-item" v-for="(itemf, index) in panel_data.finales" v-if="unique == false || section=='finales'"
                        >
                            <div class="cards" v-for="itemf in panel_data.finales[index]">
                                <img class="slider-background" @click="activar(itemf), panel_data.tipo='finales', seccion('finales')" :src="itemf.imagen_fondo">
                            </div>
                        </div>
                        <!-- add -->
                         <div class="AddBtn galCol">
                            
                        +</div>
                    </div>
                </div>
            
            <!-- edit page -->
            <div class="EdRow" v-if="panel_data.current_selection">                
                    <div class= "EdText" v-if="(section!='pilares') && (section!='indagacion') && (section!='postresol')">
                        <button class="Btn">{{status.texto}}</button>
                        <textarea cols="30" rows="5" name="textarea" class="HisText" placeholder="Texto a editar" v-model="txt" name="newtext"></textarea>
                        <input type="hidden" name="pestana_id"  value ="panel_data.current_selection.texto">
                    </div>
                    <div class="opcionesCol">
                        <div class= "EdFondo">
                            <button class="Btn" @click="popUp=true, action=1">
                                Cambiar Fondo
                            </button>                            
                            <div class="previewCol">
                                <img class = "Prev" :src="preview">
                            </div>
                        </div>
                        <!-- Personaje -->
                        <div class= "EdPersonaje" v-if="(section!='pilares') && (section!='indagacion') && (section!='postresol') && (section!='portada')">
                            <button class="Btn" @click="active=true, popUp=true, active=1">
                                {{status.imagen}}
                            </button>
                            <div class="dropdown">                          
                                <select class="dropdown-sel" v-model="pos">
                                    <option disabled selected value="Posición">Posición</option>
                                    <option>Centro</option>
                                    <option>Izquierda</option>
                                    <option>Derecha</option>
                                </select>
                            </div> 
                            <div class="previewCol">
                                <img v-if="imag2!==0 || panel_data.current_selection.id_imagen_personaje || panel_data.current_selection.imagen_acertijo" class = "Prev" :src="personajeprev">
                                <img v-if="(preview==null) || (personajeprev==null) && (section!='resolucion') || (panel_data.current_selection.id_imagen_personaje==0)" class = "Prev" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Imagen_no_disponible.svg/1200px-Imagen_no_disponible.svg.png">
                            </div>
                        </div>
                    </div>
                    <div class="submit row">
                            <button class="Btn" @click="save(panel_data.current_selection), panel_data.current_selection=null, success = true">Guardar cambios</button>
                    </div>
                </div>               
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<script type="text/javascript" src="icons/js/fontawesome.js"></script>
	<script type="text/javascript" src="icons/js/regular.js"></script>
	<script type="text/javascript" src="icons/js/solid.js"></script>    
    <script type="text/javascript" src="paneljs.js"></script>
    

</body>

</html>