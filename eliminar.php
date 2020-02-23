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
$xeliminar = $_GET['idx'];
$fechaActual = date('d-m-Y H:i:s'); 

$consultar = mysqli_query($link, "select * from t_matrix where id_matrix='$xeliminar'");   
        $qrres = mysqli_fetch_array($consultar);
	$id_regional = $qrres[id_regional];
        $actividad = $qrres[actividad];

// sql para eliminar
$sql = "DELETE FROM t_matrix WHERE id_matrix=$xeliminar";

if (mysqli_query($link, $sql)) {
    echo "Registro eliminado";
    $sql = "INSERT INTO t_log(usuario,id_matrix,fecha,id_regional,actividad) VALUES('$login_usuario','$xeliminar','$fechaActual','$id_regional','$actividad')";
		mysqli_query($link,$sql);
} else {
    echo "Error al eliminar registro: " . mysqli_error($link);
}

mysqli_close($link);

// Redireccion al index 
header('Location: principal.php');
exit();
?> 
