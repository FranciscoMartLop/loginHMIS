<?php
	session_start();

	if($_SESSION['identified']!= 4286573154 )
        header('Location: login.php');
?>