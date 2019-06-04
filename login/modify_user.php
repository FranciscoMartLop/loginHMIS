<?php

    include('security.php');

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','root','Usuario@2019','login');

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_errno);
        exit();
    }

    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $active = $_POST['active'];
    if ($_POST['role']) {
        $role1 = $_POST['role'];
        $role2 = null;
    } else if ($_POST['role2']) {
        $role2 = $_POST['role2'];
        $role1 = null;
    }
    $password = sha1($password);
    $password2 = sha1($password2);



    if ($password == $password2 and !empty($role1) and !empty($active) and !empty($email) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none') {
        $update = "UPDATE `usuario` 
        SET `email` = '" . $email . "', `password` = '" . $password . "', `activo` = '1',  `role` = 'usuario'
        WHERE `id` = '" . $id . "'";
        $conexion->query($update);
        header('Location: home_admin.php?modify=y');

    } else if ($password == $password2 and !empty($role2) and !empty($active) and !empty($email) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none'){
        $update = "UPDATE `usuario` 
        SET `email` = '" . $email . "', `password` = '" . $password . "', `activo` = '1',  `role` = 'admin'
        WHERE `id` = '" . $id . "'";
        $conexion->query($update);
        header('Location: home_admin.php?modify=y');

    } else if ($password == $password2 and !empty($role1) and empty($active) and !empty($email) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none') {
        $update = "UPDATE `usuario` 
        SET `email` = '" . $email . "', `password` = '" . $password . "', `activo` = '0',  `role` = 'usuario'
        WHERE `id` = '" . $id . "'";
        $conexion->query($update);
        header('Location: home_admin.php?modify=y');

    } else if ($password == $password2 and !empty($role2) and empty($active) and !empty($email) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none'){
        $update = "UPDATE `usuario` 
        SET `email` = '" . $email . "', `password` = '" . $password . "', `activo` = '0',  `role` = 'admin'
        WHERE `id` = '" . $id . "'";
        $conexion->query($update);
        header('Location: home_admin.php?modify=y');

    } else
        header('Location: home_admin.php?modify=n');

    mysqli_close($conexion);