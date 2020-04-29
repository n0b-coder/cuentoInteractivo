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
                <h2 id="he1deadminP"> Administrador <?php echo $_SESSION['user']?> </h1>
             </div>

            <div class="cerrarS">
                <form action="Cerrar_Sesion.php">
                <input type="submit" value="Cerrar Sesion" class="BtnHover BtnUser">
                </form>
            </div>
        </div>

        <div class="container-2fluid">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Personaje</span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre del personaje" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="edit row">
                <div class="opciones col">
                    <button class="row">
                        Cambiar Fondo
                    </button>
                    <button class="row">
                        Cambiar Texto
                    </button>
                    <button class="row">
                        Cambiar Personaje
                    </button>
                </div>
                <div class="preview col">
                    <img src="https://image.shutterstock.com/image-photo/beautiful-water-drop-on-dandelion-260nw-789676552.jpg">
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