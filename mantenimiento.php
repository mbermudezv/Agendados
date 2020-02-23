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

if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}


$cslta = mysqli_query($link, "select tipo from login where username='$logusuario'");   
        $query = mysqli_fetch_array($cslta);
	$tipo = $query[tipo];

switch ($tipo) 
    {
    case 1:
        echo '<script language = javascript>
	self.location = "herramientas.php"
	</script>';
        break;
    case 2:
        echo '<script language = javascript>
	alert("No tiene los permisos requeridos.")
	self.location = "principal.php"
	</script>';
        break;
    case 3:
        echo '<script language = javascript>
	alert("No tiene los permisos requeridos.")
	self.location = "principal.php"
	</script>';
        break;
    }
?>

