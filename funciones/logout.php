<?php
	 //Crear sesión
	 session_start();
	 //Vaciar sesión
	 $_SESSION = array();
	 //Destruir Sesión
	 session_destroy();
	 //Redireccionar a index.php
	 header("location: ../index.php");
?>