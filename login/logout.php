<?php
    include ('security.php');

    session_destroy();

    header('location: login.php');
?>
