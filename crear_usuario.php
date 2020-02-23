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

$username = $_POST["username"];
$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"]; 
$password = $_POST["password"]; 
$passwordrepite = $_POST["passwordrepite"]; 


// sql para actualizar
if ($password == $passwordrepite) {
$password = sha1(md5($password));
$query = "select username from login where username='$username'";
$result = mysqli_query($link,$query);
$check_user = mysqli_num_rows($result);

  if($check_user>0){
        echo '<script language = javascript>
        alert("El usuario ya existe en la BD")
        self.location = "formulario_crear_usuario.php"
        </script>';
  } else {
        mysqli_free_result($result);
	$sql = "INSERT INTO login(username,password,cedula,nombre,tipo)	VALUES('$username','$password','$cedula','$nombre','$tipo')";
		mysqli_query($link,$sql);  
        mysqli_close($link);
	echo '<script language = javascript>
	alert("Usuario creado correctamente")
	self.location = "formulario_crear_usuario.php"
	</script>';

  } /* Cierre del else que corresponde a if-else del $check_user>0 */

} else {

 echo '<script language = javascript>
			alert("Las contrasenas deben ser iguales")
			self.location = "formulario_crear_usuario.php"
			</script>';
}

?>
<SCRIPT LANGUAGE="javascript"> 
location.href = "formulario_crear_usuario.php"; 
</SCRIPT>
