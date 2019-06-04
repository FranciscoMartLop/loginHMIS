<?php

    include('security.php');

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','root','Usuario@2019','login');

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_errno);
        exit();
    }

    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $oldPassword = sha1($oldPassword);
    $newPassword = sha1($newPassword);

    if (!empty($email) and !empty($oldPassword) and !empty($newPassword) and $_POST['email'] != 'none' and $_POST['oldPassword'] != 'none' and $_POST['newPassword'] != 'none'){
        $update = "UPDATE `usuario` SET `email` = '" . $email . "', `password` = '" . $newPassword . "' WHERE `password` = '" . $oldPassword . "'";
        $conexion->query($update);
        header('Location: home_user.php?datoscorrectos=si');
    
    } else
        header('Location: home_user.php?errorusuario=si');

    mysqli_close($conexion);

    $result1->free();