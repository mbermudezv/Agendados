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

$login_usuario = $_SESSION['username'];


if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}

$id = $_POST["id_matrix"];
$id_fecha = $_POST["fecha"]; 
$id_regional = $_POST["regional"];
$actividad = $_POST["actividad"];
$participantes = $_POST["participantes"];
$id_responsable = $_POST["responsable"];
$observaciones = $_POST["observaciones"];
 
// sql para actualizar

$update = "UPDATE t_matrix SET id_fecha = '".$id_fecha."', id_regional = '".$id_regional."', actividad = '".$actividad."', participantes = '".$participantes."', id_responsable = '".$id_responsable."', observaciones = '".$observaciones."' WHERE id_matrix = '".$id."'";
$link->query($update);  

if (mysqli_query($link, $update)) {
    echo "Registro actualizado";
} else {
    echo "Error al actualizar registro: " . mysqli_error($link);
}

mysqli_close($link);

// Redireccion al index 
header('Location: principal.php');
exit();  
?> 
