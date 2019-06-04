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

    if ($password == $password2 and !empty($role1) and !empty($active) and !empty($email) and !empty($username) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['user'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none') {
        $update = "INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `role`, `fechaCreacion`, `fechaUltimoAcceso`)
        VALUES (NULL, '" . $email . "', '" . $username . "', '" . $password . "', '1', 'usuario', CURRENT_DATE(), CURRENT_DATE())";
        $conexion->query($update);
        header('Location: home_admin.php?create=y');

    } else if ($password == $password2 and !empty($role2) and !empty($active) and !empty($email) and !empty($username) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['user'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none'){
        $update = "INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `role`, `fechaCreacion`, `fechaUltimoAcceso`)
        VALUES (NULL, '" . $email . "', '" . $username . "', '" . $password . "', '1', 'admin', CURRENT_DATE(), CURRENT_DATE())";
        $conexion->query($update);
        header('Location: home_admin.php?create=y');

    } else if ($password == $password2 and !empty($role1) and empty($active) and !empty($email) and !empty($username) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['user'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none') {
        $update = "INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `role`, `fechaCreacion`, `fechaUltimoAcceso`)
        VALUES (NULL, '" . $email . "', '" . $username . "', '" . $password . "', '0', 'usuario', CURRENT_DATE(), CURRENT_DATE())";
        $conexion->query($update);
        header('Location: home_admin.php?create=y');

    } else if ($password == $password2 and !empty($role2) and empty($active) and !empty($email) and !empty($username) and !empty($password) and !empty($password2) and $_POST['email'] != 'none' and $_POST['user'] != 'none' and $_POST['password'] != 'none' and $_POST['password2'] != 'none'){
        $update = "INSERT INTO `usuario` (`id`, `email`, `username`, `password`, `activo`, `role`, `fechaCreacion`, `fechaUltimoAcceso`)
        VALUES (NULL, '" . $email . "', '" . $username . "', '" . $password . "', '0', 'admin', CURRENT_DATE(), CURRENT_DATE())";
        $conexion->query($update);
        header('Location: home_admin.php?create=y');

    } else
        header('Location: home_admin.php?create=n');

    mysqli_close($conexion);