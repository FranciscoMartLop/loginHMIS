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
    <title>Inicio admin</title>
    <link rel="stylesheet" href="css/home_admin.css">
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

            <h5 style="padding: 1%"><?php echo "Bienvenido " . $row['username'] . " (admin)"?></h5>
            <a href="logout.php" style="padding: 1%">
                <input type="submit" value="Logout">
            </a>

            <?php $result->free(); ?>

            <form action="home_admin.php" method="post" class="vertical-menu">
                <input type="submit" value="Usuarios">
                <input type="submit" name="list_users" value="Listar usuarios">
                <input type="submit" name="create_user" value="Crear usuario">
            </form>

            <?php
                            if (isset($_GET['create']) and !strcmp($_GET['create'], 'n')){ ?>
                            <br>
                            <label style="color: red; padding: 0% 5%;" class='error'>Por favor, rellena todos los campos</label>
                            <?php  } ?>
                            <?php
                            if (isset($_GET['create']) and !strcmp($_GET['create'], 'y')){ ?>
                            <br>
                            <label style="color: green; padding: 0% 5%;">Usuario creado con éxito</label>
                            <?php  }

                            if (isset($_GET['modify']) and !strcmp($_GET['modify'], 'n')){ ?>
                            <br>
                            <label style="color: red; padding: 0% 5%;" class='error'>Por favor, rellena todos los campos</label>
                            <?php  } ?>
                            <?php
                            if (isset($_GET['modify']) and !strcmp($_GET['modify'], 'y')){ ?>
                            <br>
                            <label style="color: green; padding: 0% 5%;">Usuario modificado con éxito</label>
                            <?php  }

                            if (isset($_GET['delete']) and !strcmp($_GET['delete'], 'n')){ ?>
                            <br>
                            <label style="color: red; padding: 0% 5%;" class='error'>Hubo problemas al borrar al usuario</label>
                            <?php  } ?>
                            <?php
                            if (isset($_GET['delete']) and !strcmp($_GET['delete'], 'y')){ ?>
                            <br>
                            <label style="color: green; padding: 0% 5%;">Usuario borrado con éxito</label>
                            <?php  } ?>

            <?php

            if (!isset($_POST['list_users'])){
                $bottom = 0;
                
                }else{

                    $users = "SELECT id, username, email, activo from usuario";
                    $result1 = $conexion->query($users);
                                
            ?>
                    <br>
                    <br>

                    <table class="all_users">
                        <tr class="tables_title">
                            <td>username</td>
                            <td>email</td>
                            <td>activo</td>
                            <td></td>
                        </tr>

                        <?php
                            while ($row1 = $result1->fetch_assoc()) { ?>
                            <tr class="info">
                                <td style="padding-left: 5%; padding-right: 5%;">
                                    <?php echo $row1['username'] ?>
                                </td>
                                <td align="center">
                                    <?php echo $row1['email'] ?>
                                </td>
                                <td align="center">
                                    <?php 

                                    if ($row1['activo'] == 1) {
                                        echo "si";
                                    } else {
                                        echo "no";
                                    }
                                    
                                    ?>
                                </td>
                                <td>
                                    <form action="home_admin.php" method="post">
                                        <input class="btn" name="edit_user" type="submit" value="Editar">
                                        <input class="btn" name="delete_user" type="submit" value="Borrar">
                                        <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php }
                            ?>

                    </table>

                    <?php
        
                $result1->free();
                
            }

            if (!isset($_POST['create_user'])){
                $bottom = 0;
                
                }else{

                    ?>

                    <div class="main">
                    <h4>Crear usuario</h4>
                    <hr>
                    <form action="create_user.php" method="post" class="create">
                        <p>Email (*)</p>
                        <label class="login"><input name="email" type="text"> </label>
                        <p>Usuario (*)</p>
                        <label class="login"><input name="user" type="text"> </label>
                        <p>Password (*)</p>
                        <label class="login"><input  name="password" type="password"></label>
                        <p>Repetir Password (*)</p>
                        <label class="login"><input  name="password2" type="password"></label>
                        <br>
                        <input type="checkbox" name="active" value="active"> Activo <br><br>
                        <input type="radio" name="role" value="usuario"> Usuario
                        <input type="radio" name="role2" value="admin"> Admin <br>
                        <br>
                        <input class="login" name="login" type="submit" value="Guardar">
                    </form>
                    <br>
                    <label style="text-indent: 1em">(*) No vacío</label><br>
                
                </div>

                <?php

                }

                if (!isset($_POST['edit_user'])){
                    $bottom = 0;
                    
                }else{

                    $id = $_POST['id'];

                    $users = "SELECT `id`, `email`, `username`, `password`, `activo`, `role` from `usuario` where `id` = '" . $id . "'";
                    $result3 = $conexion->query($users);
                    $row3 = $result3->fetch_assoc();

                    ?>

                    <div class="main">
                    <h4>Modificar usuario</h4>
                    <hr>
                    <form action="modify_user.php" method="post" class="create">
                        <p>Email (*)</p>
                        <label class="login"><input name="email" type="text" value =<?php echo $row3['email'] ?>> </label>
                        <p>Usuario (*)</p>
                        <label class="login"><input name="user" type="text" value =<?php echo $row3['username'] ?> disabled> </label>
                        <p>Password (*)</p>
                        <label class="login"><input  name="password" type="password"></label>
                        <p>Repetir Password (*)</p>
                        <label class="login"><input  name="password2" type="password"></label>
                        <br>
                        <input type="checkbox" name="active" value="active" <?php if($row3['activo']){?> checked <?php } ?>> Activo <br><br>
                        <input type="radio" name="role" value="usuario"> Usuario
                        <input type="radio" name="role2" value="admin"> Admin <br>
                        <br>
                        <input class="login" name="login" type="submit" value="Guardar">
                        <input type="hidden" name="id" value="<?php echo $row3['id']; ?>">
                    </form>
                    <br>
                    <label style="text-indent: 1em">(*) No vacío</label><br>
                
                </div>

                <?php
                $result3->free();
                }

                if (!isset($_POST['delete_user'])){
                    $bottom = 0;
                    
                }else{

                    $id = $_POST['id'];

                    $users = "SELECT `id`, `email`, `username`, `password`, `activo`, `role` from `usuario` where `id` = '" . $id . "'";
                    $result4 = $conexion->query($users);
                    $row4 = $result4->fetch_assoc();

                    ?>

                    <div class="main">
                    <h4>Eliminar usuario</h4>
                    <hr>
                    <form action="delete_user.php" method="post" class="create">
                        <p>Email (*)</p>
                        <label class="login"><input name="email" type="text" value =<?php echo $row4['email'] ?> disabled> </label>
                        <p>Usuario (*)</p>
                        <label class="login"><input name="user" type="text" value =<?php echo $row4['username'] ?> disabled> </label>
                        <br>
                        <input type="checkbox" name="active" value="active" <?php if($row4['activo']){?> checked <?php } ?> disabled> Activo <br><br>
                        <input type="radio" name="role" value="usuario" <?php if($row4['role'] == 'usuario'){?> checked <?php } ?> disabled> Usuario
                        <input type="radio" name="role2" value="admin" <?php if($row4['role'] == 'admin'){?> checked <?php } ?> disabled> Admin <br>
                        <br>
                        <input class="login" name="login" type="submit" value="Eliminar">
                        <input type="hidden" name="id" value="<?php echo $row4['id']; ?>">
                    </form>
                    <br>
                    <label style="text-indent: 1em">(*) No vacío</label><br>
                
                </div>

                <?php
                $result4->free();
                }
                
                                
            ?>

            

</body>
</html>