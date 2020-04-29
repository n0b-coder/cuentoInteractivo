<!DOCTYPE html>
<html lang="es">


<?php
if(isset($_POST['log_try']))
{
    $Email = $_POST['user'];
    $Contraseña = $_POST['password'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUKO_ADMIN</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta content="JUKO">
</head>

<body>

    <div class="Maindeadmin">
        <div class="ContAdmin">
            <div id="Titulodeadmin">
                <h1 id="he1deadmin"> JUKO ADMIN</h1>
            </div>
            <div class="formulario">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <input type="email" class="IntLog" name="user" placeholder="User Email"  value =  "  <?php if(isset($Email)) echo $Email ?> "required>
                    <input type="password" class="IntLog" name="password" placeholder="Password" required>
                    <input type="submit" value="Log me in!" class="BtnUser" name= "log_try">
                    <?php
                    include ("validar.php");
                    ?>

                </form>
            </div>
        </div>
    </div>


</body>

</html>