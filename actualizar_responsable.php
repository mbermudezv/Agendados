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

$login_usuario = $_SESSION['username'];


if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}

$id = $_POST["id_responsable"];
$resmod = $_POST["responsable"];  
 
// sql para actualizar

$update = "UPDATE t_responsable SET responsable = '".$resmod."' WHERE id_responsable = '".$id."'";
$link->query($update);  

if (mysqli_query($link, $update)) {
    echo "Registro actualizado";
} else {
    echo "Error al actualizar registro: " . mysqli_error($link);
}

mysqli_close($link);

// Redireccion al index 
header('Location: formulario_crear_responsable.php');
exit();  
?> 
