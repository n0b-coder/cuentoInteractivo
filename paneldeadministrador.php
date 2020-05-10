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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <meta content="JUKO">
    
</head>

<body>

    <div class="container-fluid" id="panelApp">

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

            <div class="row">
                <div class="checkboxrow">
                    <label class="col">Historia
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Pilares
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Indagación
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Resolución
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="col">Finales
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <!-- selection slider -->

            <div class="slider">
                    <div class="scrolling-wrapper slider-container">
                        <div
                            class="cards slider-item"
                            v-for="(item, index) in panel_data.historia[0]"
                            :key="index"                           
                            :class="item.tipo_pestana"
                        >
                            <div class="cards" v-for="item in panel_data.historia[index]">
                                <img class="slider-background"  @click="activar(item)" :src="item.imagen_fondo">
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
                    <input type="hidden" name="pestana_id"  value ="panel_data.current_selection.historia.texto">
                    </div>
                    <div class="opcionesCol">
                        <div class= "EdFondo">
                            <button class="Btn" @click="popUp=true">
                                Cambiar Fondo
                            </button>
                            <!-- gallery -->
                            <section v-if="popUp">
                                <div class="modal-mask">
                                    <div class="modal-wrapper">
                                        <div class="modal-container py-5 bg-dark">
                                            <div slot="panel">
                                                <div class="galCont">
                                                    <template v-for="(item, index) in gallery">
                                                        <template class="row" v-for="item in gallery[index]">
                                                            <div class="galCol">
                                                                <img class="slider-background" :src="item.Imag_link"  @click="newImg(item)">
                                                            </div>                                
                                                        </template>                  
                                                    </template>                       
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="Btn modal-default-button" v-on:click="popUp=false">
                                                    Elegir
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--  -->
                            <div class="previewCol">
                                <img class = "Prev" :src="panel_data.current_selection.imagen_fondo">
                            </div>
                        </div>
                        <!-- Personaje -->
                        <div class= "EdPersonaje">
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