<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <h3>Bienvenido a mi aplicación web</h3>

    <div class="main">
        <div class="body">
            <h4>Login</h1>
            <hr>
            <form action="back_login.php" method="post" class="login">
                <p>Usuario (*)</p>
                <label class="login"><input name="user" type="text"> </label>
                <p>Password (*)</p>
                <label class="login"><input  name="password" type="password"></label>
                <br>
                <input class="login" name="login" type="submit" value="Login">
                

            </form>
            <?php
                    if (isset($_GET['errorusuario']) and !strcmp($_GET['errorusuario'], 'si')){ ?>
                    <br>
                    <label style="color: red;" class='error'>Usuario o contraseña incorrectos</label>
                    <?php  } ?>
                    <?php
                    if (isset($_GET['registro']) and !strcmp($_GET['registro'], 'si')){ ?>
                    <br>
                    <label style="color: green;">Registro completado con éxito</label>
                    <?php  } ?>
            <br>
            <label>Si aun no tiene cuenta:</label>
            <label style="text-indent: 5em"><a href="sign_in.php">Registrarse</a></label><br>
        (*) No vacío
        </div>
    </div>
    
</body>
</html>