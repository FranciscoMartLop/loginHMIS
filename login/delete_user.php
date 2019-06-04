<?php

    include('security.php');

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','root','Usuario@2019','login');

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_errno);
        exit();
    }

    $id = $_POST['id'];

    if (!empty($id) and $_POST['id'] != 'none'){
        $delete = "DELETE from `usuario` where `id` = '" . $id . "'";
        $conexion->query($delete);
        header('Location: home_admin.php?delete=y');
    
    } else
        header('Location: home_admin.php?delete=n');

    mysqli_close($conexion);