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
	
	$id_regional = $_POST['id_regional'];
	
	$query = "SELECT id_circuito, circuito FROM circuitos WHERE id_regional = '$id_regional' ORDER BY circuito";
	$resultado=$link->query($query);
	
	while($row = $resultado->fetch_assoc())
	{
		$html.= "<option value='".$row['id_circuito']."'>".$row['circuito']."</option>";
	}
	echo $html;
?>
