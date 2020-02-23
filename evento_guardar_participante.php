<?php
session_start();
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "form_login.php"
</script>';
}
require_once("conexion.php");
$link = $mysqli;
 


if (mysqli_connect_errno())

{

echo "Error de conexion a mysql: " . mysqli_connect_error();

}

$participante = $_POST['participante'];


$query = "select participante from t_participantes where participante='$participante'";
$result = mysqli_query($link,$query);
$check_user = mysqli_num_rows($result);


if($check_user>0){
  echo '<script language = javascript>
  alert("El participante ya existe en la BD")
  self.location = "formulario_crear_participante.php"
  </script>';
} else {
mysqli_free_result($result);

	
$query = "INSERT INTO t_participantes (participante)VALUES('".$participante."')";
	$link->query($query);
	mysqli_close($link);


	echo '<script language = javascript>
	alert("El participante fue guardado correctamente")
	self.location = "formulario_crear_participante.php"
	</script>';

} /* Cierre del else que corresponde a else del $check_user>0 */
?>
