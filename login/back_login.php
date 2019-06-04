<?php

    include('security.php');

    $mysqli = mysqli_init();
    $conexion = new mysqli('localhost','root','Usuario@2019','login');

    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_errno);
        exit();
    }

    if(isset($_POST['login'])) {
        
        if(empty($_POST['user'])) {
           header("Location: login.php?errorusuario=si");
            
        }else {
            
            $user = $_POST['user'];
            $password = $_POST['password'];
            $password = sha1($password);

        }
    }

    $user_name = "select id, username, password from usuario where username = '" . $user . "' and password = '" . $password . "' and role = 'usuario'";
    $result1 = $conexion->query($user_name);

    $user_name2 = "select id, username, password from usuario where username = '" . $user . "' and password = '" . $password . "' and role = 'admin'";
    $result2 = $conexion->query($user_name2);

    if ($row1 = $result1->fetch_assoc()) {
       $update_date1 = "UPDATE `usuario` SET `fechaUltimoAcceso` = CURRENT_DATE() WHERE `username` = '" . $user . "'";
       $updt1 = $conexion->query($update_date1);
       $_SESSION['identified'] = 4286573154;
       $_SESSION['user'] = $row1['id'];
       $_SESSION['pass'] = $password;
        header ("Location: home_user.php");
    }

    else if ($row2 = $result2->fetch_assoc()) {
        $update_date2 = "UPDATE `usuario` SET `fechaUltimoAcceso` = CURRENT_DATE() WHERE `username` = '" . $user . "'";
        $updt2 = $conexion->query($update_date2);
        $_SESSION['identified'] = 4286573154;
        $_SESSION['user'] = $row2['id'];
        $_SESSION['pass'] = $password;
        header ("Location: home_admin.php");
    }
     else
        header("Location: login.php?errorusuario=si");

    $result1->free();
    $result2->free();
    mysqli_close($conexion);
?>