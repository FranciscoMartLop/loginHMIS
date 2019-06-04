<?php

    // Llamamos al archivo de seguridad.

    include ('security.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio usuario</title>
    <link rel="stylesheet" href="css/home_user.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    
    <?php    
            
            $mysqli = mysqli_init();
            $conexion = new mysqli('localhost','root','Usuario@2019','login');
        
            if ($mysqli->connect_errno) {
                printf("Falló la conexión: %s\n", $mysqli->connect_errno);
                exit();
            }
            
            $student_name = "select username from usuario where id =  '" . $_SESSION['user'] . "'";
            $result = $conexion->query($student_name);
            $row = $result->fetch_assoc();
        ?>

            <!-- Mostramos el siguiente mensaje con el nombre del usuario y un enlace para cerrar sesión. -->
            <h5 style="padding: 1%"><?php echo "Bienvenido " . $row['username']?></h5>
            <a href="logout.php" style="padding: 1%">
                <input type="submit" value="Logout">
            </a>

            <?php $result->free(); ?>

    <div class="main">
        <div class="body">
            <h4>Modificar datos personales</h1>
            <hr>
            <form action="back_home_user.php" method="post" class="modify_user">
                <p>Email (*)</p>
                <label class="modify_user"><input name="email" type="text"> </label>
                <p>Antigua contraseña (*)</p>
                <label class="modify_user"><input  name="oldPassword" type="password"></label>
                <p>Nueva contraseña (*)</p>
                <label class="modify_user"><input  name="newPassword" type="password"></label>
                <br>
                <input class="modify_user" name="modify_user" type="submit" value="Modificar datos">
            </form>
            <?php
                    if (isset($_GET['errorusuario']) and !strcmp($_GET['errorusuario'], 'si')){ ?>
                    <br>
                    <label style="color: red;" class='error'>Por favor, rellena todos los campos</label>
                    <?php  } ?>
            <?php
                    if (isset($_GET['datoscorrectos']) and !strcmp($_GET['datoscorrectos'], 'si')){ ?>
                    <br>
                    <label style="color: green;">Datos modificados correctamente</label>
                    <?php  } ?>
            <br>
        (*) No vacío
        </div>
    </div>


</body>
</html>