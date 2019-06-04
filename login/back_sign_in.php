<?php

    include('security.php');

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','root','Usuario@2019','login');

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_errno);
        exit();
    }

    $email = $_POST['email'];
    $username = $_POST['user'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $password = sha1($password);
    $password2 = sha1($password2);

    if ($password == $password2 and !empty($email) and !empty($username) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['user'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none') {
        $update = "INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `role`, `fechaCreacion`, `fechaUltimoAcceso`)
        VALUES (NULL, '" . $email . "', '" . $username . "', '" . $password . "', '1', 'usuario', CURRENT_DATE(), CURRENT_DATE())";
        $conexion->query($update);
        header('Location: login.php?registro=si');
    
    } else
        header('Location: sign_in.php?errorusuario=si');

    mysqli_close($conexion);