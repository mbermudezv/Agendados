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

$responsable = $_POST['responsable'];


$query = "select responsable from t_responsable where responsable='$responsable'";
$result = mysqli_query($link,$query);
$check_user = mysqli_num_rows($result);


if($check_user>0){
  echo '<script language = javascript>
  alert("La entidad ya existe en la BD")
  self.location = "formulario_crear_responsable.php"
  </script>';
} else {
mysqli_free_result($result);

	
$query = "INSERT INTO t_responsable (responsable)VALUES('".$responsable."')";
	$link->query($query);
	mysqli_close($link);


	echo '<script language = javascript>
	alert("La entidad fue guardada correctamente")
	self.location = "formulario_crear_responsable.php"
	</script>';

} /* Cierre del else que corresponde a else del $check_user>0 */
?>
