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
 


if (mysqli_connect_errno())

{

echo "Error de conexion a mysql: " . mysqli_connect_error();

}
	
	$id_circuito = $_POST['id_circuito'];
	
	$query = "SELECT id_institucion, nombre FROM institucion WHERE id_circuito = '$id_circuito' ORDER BY nombre";
	$resultado=$link->query($query);
	
	while($row = $resultado->fetch_assoc())
	{
		$html.= "<option value='".$row['id_institucion']."'>".$row['nombre']."</option>";
	}
	echo $html;
?>
