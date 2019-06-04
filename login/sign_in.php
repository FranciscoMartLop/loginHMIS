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
    <title>Inicio</title>
    <link rel="stylesheet" href="css/sign_in.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <h3>Formulario de registro</h3>

    <div class="main">
        <div class="body">
            <h4>Registrarse</h1>
            <hr>
            <form action="back_sign_in.php" method="post" class="login">
                <p>Email (*)</p>
                <label class="login"><input name="email" type="text"> </label>
                <p>Usuario (*)</p>
                <label class="login"><input  name="user" type="text"></label>
                <p>Password (*)</p>
                <label class="login"><input name="password" type="password"> </label>
                <p>Repetir password (*)</p>
                <label class="login"><input  name="password2" type="password"></label>
                <br>
                <input class="login" name="login" type="submit" value="Registrarse">
            </form>
            <br>
            <a href="login.php"><input name="cancelar" type="submit" value="Cancelar"></a>
            <br>
            <?php
                    if (isset($_GET['errorusuario']) and !strcmp($_GET['errorusuario'], 'si')){ ?>
                    <br>
                    <label style="color: red;" class='error'>Por favor, rellene los campos correctamente</label>
                    <?php  } ?>
            <br>
        (*) No vacío
        </div>
    </div>
    
</body>
</html>