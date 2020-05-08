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

if(isset($_POST['edit']))
{
    $Id_cuento = $_POST['cuento_id'];
    echo $Id_cuento;
}
       
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUKO ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <link href="cf-slideshow-style.css" rel="stylesheet" />
    <script src="CFSlideshow.js"></script>
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
                        Actualizar Nombre
                </div>
                <input type="text" class="form-control" placeholder="JUKO">
            </div>
            <div class="EdRow">
                
                    <div class= "EdText">
                        <button class="Btn">
                            Actualizar Texto
                        </button>
                        <textarea placeholder="Texto a editar" class="HisText" ></textarea>
                    </div>
                    <div class="opcionesCol">
                        <div class= "EdFondo">
                            <button class="Btn">
                                Cambiar Fondo
                            </button>
                            <div class="previewCol">
                            <img class = "Prev" src="https://gameranx.com/wp-content/uploads/2016/05/DOOM4-2.jpg">
                            </div>
                        </div>
                        <div class= "EdPersonaje">
                            <button class="Btn">
                                Cambiar Personaje
                            </button>
                            <div class="previewCol">
                            <img class = "Prev" src="https://www.hyperhype.es/wp-content/uploads/2020/04/Doom-Eternal-Render-3.png">
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
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
            <div class="slider">
                <div class="scrolling-wrapper">
                    <div class="cards"> <img class="images" src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg"></div>
                    <div class="cards"> <img class="images" src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg"></div>
                    <div class="cards"> <img class="images" src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg"></div>
                    <div class="cards"> <img class="images" src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg"></div>
                    <div class="cards"> <img class="images" src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg"></div>
                    <div class="cards"> <img class="images" src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg"></div>
                </div>
            </div>
        </div>


    </div>

</body>

</html>