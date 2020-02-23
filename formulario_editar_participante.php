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
$xeditar = $_GET['idx']; 
$logid = $_SESSION['id_login'];

if (mysqli_connect_errno())

{

echo "Error de conexion a mysql: " . mysqli_connect_error();

}
if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}
$ans = mysqli_query($link, "select participante from t_participantes where id_participante='$xeditar'");   
        $qrres = mysqli_fetch_array($ans);
	$participante = $qrres[participante];
	
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="estilomep.css" />

</head>
<body>
<div id="contenedor"> 
  <div id="header"> 
	<center><H1></H1></center>
  </div>
  <div id="menu">
	<barra>
		
		<div class="botonera" id="uno">
			<a href="formulario_crear_participante.php"><img class="icon" src="atras.png"></a>
			<p class="texto">Atr&aacute;s</p>
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
    <div id="formularios">
<fieldset style="width:600px; background-color:White">
 <legend>Formulario para modificar un participante</legend>
<form action="actualizar_participante.php" method="POST">
<input type="hidden" name="id_participante" value="<?php echo $xeditar; ?>" />
<label>Ente responsable:</label><input type="text" name="participante" value="<?php echo $participante?>"><br>

<input type="submit" value="Actualizar" name="Actualizar">
</form>
</fieldset>
    </div>
  </div>

</div>
</body>
</html>
