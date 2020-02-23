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
// sql para eliminar
$sql = "DELETE FROM t_participantes WHERE id_participante=$xeliminar";

if (mysqli_query($link, $sql)) {
    echo "Registro eliminado";
} else {
    echo "Error al eliminar registro: " . mysqli_error($link);
}

mysqli_close($link);

// Redireccion al index 
header('Location: formulario_crear_participante.php');
exit();
?> 
