<?php
session_start();
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "index.php"
</script>';
}

require_once("conexion.php");
$link = $mysqli;
$logusuario = $_SESSION['username']; 
$logid = $_SESSION['id_login'];
$time = time();
$dia_actual = date("Y-m-d", $time);  // Dia actual
if (mysqli_connect_errno())

{

echo "Error de conexion a mysql: " . mysqli_connect_error();

}


$login = $_POST["login"];
$actual = $_POST["passwordactual"];
$newpass = $_POST["passwordnuevo"]; 
$newpassr = $_POST["passwordrepite"]; 
$actualencriptado = sha1(md5($actual));

$preguntar = mysqli_query($link, "select password from login where username='$login'");   
        $respuesta = mysqli_fetch_array($preguntar);
	$contraactual = $respuesta[password];

if ($actualencriptado == $contraactual) {
// sql para actualizar
	if ($newpass == $newpassr) {
	$newpass=sha1(md5($newpass));
		$update = "UPDATE login SET password = '".$newpass."' WHERE username = '".$login."'";
		$link->query($update);  

		if (mysqli_query($link, $update)) {
    		echo '<script language = javascript>
			alert("Password cambiado correctamente")
			self.location = "principal.php"
			</script>';
		} else {
    		echo '<script language = javascript>
			alert("Error al actualizar")
			self.location = "formulario_cambiar_contra.php"
			</script>';
		}

	} else {

 	echo '<script language = javascript>
			alert("Las contrasenas deben ser iguales")
			self.location = "formulario_cambiar_contra.php"
			</script>';
	} //Fin del ifelse de contra iguales
} else {
	echo '<script language = javascript>
		alert("El password actual no corresponde")
		self.location = "formulario_cambiar_contra.php"
		</script>';
}
?>
<SCRIPT LANGUAGE="javascript"> 
location.href = "principal.php"; 
</SCRIPT>
