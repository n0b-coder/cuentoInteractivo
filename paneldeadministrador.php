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

    $id_pestana = 2;
    $sql = "SELECT pestana.Texto , fondos.fondo_img, personajes.image_personaje
    FROM pestana 
    INNER JOIN fondos  ON pestana.Id_fondo = fondos.Id_fondo
    LEFT JOIN personajes  ON pestana.Id_personaje = personajes.Id_im_personaje
    WHERE Id_Pestana = '$id_pestana'";
    require_once("Conexion.php");
    $result =  $conn->query($sql);
    if($result->num_rows>0)
    { 
        $row=$result->fetch_assoc();
        $Texto = $row['Texto'];
        $Fondo = $row['fondo_img'];
        $Personaje = $row['image_personaje'];
       

    }
    if(isset($_POST['actualizetext']))
    {
        $Ntext = $_POST['newtext'];
        if (strcmp ($Texto , $Ntext )  !==0) 
        {
            $sql = "UPDATE `pestana` SET `Texto`= '$Ntext'
            WHERE Id_Pestana = '$id_pestana'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }
              $Texto= $Ntext;
        }
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
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                            <input type="submit" value="Actualizar Texto" class="Btn" name= "actualizetext">
                            <input type="text" class="HisText"   value= "<?php echo $Texto?>" name= "newtext">
                            <input type="hidden" name="pestana_id"   value =  "<?php echo $id_pestana ?>">
                        </form>
                    </div>
                    <div class="opcionesCol">
                        <div class= "EdFondo">
                        <form action="ChangeImg.php" method="post">
                            <input type="submit" value="Cambiar Fondo" class="Btn" name= "lol">
                        </form>
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