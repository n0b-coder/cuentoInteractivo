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
            <div class="edit row">
                <div class="opciones col">
                    <div class= "EditText">
                        <button class="row">
                            Cambiar Fondo
                        </button>
                        <input type="text" class="InpText" placeholder="JUKO">
                    </div>
                    <button class="row">
                        Cambiar Fondo
                    </button>
                    <div class="preview col">
                    <img src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg">
                    </div>
                    <button class="row">
                        Cambiar Texto
                    </button>
                    <button class="row">
                        Cambiar Personaje
                    </button>
                </div>
               
            </div>
        </div>

        <div class="row">
            <div class="checkbox row">
                <label class="col">
                    <input type="radio" checked="checked" name="radio">One
                    <span class="checkmark"></span>
                  </label>
                  <label class="col">
                    <input type="radio" checked="checked" name="radio">One
                    <span class="checkmark"></span>
                  </label>
                  <label class="col">
                    <input type="radio" checked="checked" name="radio">One
                    <span class="checkmark"></span>
                  </label>
                  <label class="ccol">
                    <input type="radio" checked="checked" name="radio">One
                    <span class="checkmark"></span>
                  </label>
                  <label class="col">
                    <input type="radio" checked="checked" name="radio">One
                    <span class="checkmark"></span>
                  </label>
            </div>
        </div>
        <div class="slider row">
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

</body>

</html>