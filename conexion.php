<?php

	const DB_Str = "mysql:host=localhost;dbname=convocatorias";
	const DB_USER = "root";
	const DB_PASS = "basededatos";

	$mysqli = new mysqli("localhost","root","basededatos","convocatorias"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>
