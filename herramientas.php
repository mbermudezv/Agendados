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

if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}
?>

<!DOCTYPE html>
 
<html lang="es">
 
<head>
<title>Sistema de convocatorias</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="estilomep.css" />
<link rel="shortcut icon" href="/favicon.ico" />

<script LANGUAGE="JavaScript">

function confirmSubmit()
{
var agree=confirm("Está seguro de eliminar este registro? Este proceso no se puede revertir.");
if (agree)
  return true ;
else
   return false ;
}

</script>
</head>
 
<body>
<div id="contenedor"> 
  <div id="header"> 
	<center><H1></H1></center>
  </div>
  <div id="menu">
	<barra>
		
		<div class="botonera" id="uno">
			<a href="principal.php"><img class="icon" src="casa.png"></a>
			<p class="texto">Principal</p>
		</div>

		<div class="botonera" id="dos">
			<a href="formulario_cambiar_contra.php"><img class="icon" src="llave.png"></a>
			<p class="texto">Contraseña</p>
		</div>

		<div class="botonera" id="tres">
			<a href="consulta_filtrada.php"><img class="icon" src="filtrar.png"></a>
			<p class="texto">Filtrar</p>
		</div>

		<div class="botonera" id="cuatro">
			<a href="principal.php"><img class="icon" src="sinfiltrar.png"></a>
			<p class="texto">Quitar filtro</p>
		</div>

		<div class="botonera" id="cinco">
			<a href="formulario_crear_actividad.php"><img class="icon" src="agregar.png"></a>
			<p class="texto">Agregar</p>
		</div>

		<div class="botonera" id="seis">
			<a href="gameover.php"><img class="icon" src="salirsistema.png"></a>
			<p class="texto">Salir</p>
		</div>

	</barra>

  </div>
  <div id="contenido">
   <div id="caja1"><center><a href="formulario_crear_usuario.php"><img height="50" width="50" src="usuario.png" alt="500" /></center><br><center><p>Crear Usuario</p></center></div>
   <div id="caja2"><center><a href="formulario_crear_responsable.php"><img height="50" width="50" src="ente.png" alt="500" /></center><br><center><p>Crear Responsable</p></center> </div>
   <div id="caja3"><center><a href="formulario_crear_participante.php"><img height="50" width="90" src="participantes.png" alt="500" /></center><br><center><p>Crear Participantes</p></center> </div>

     
  </div>

</div>
</body>
</html>
