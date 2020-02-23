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
$logid = $_SESSION['id_login'];
$time = time();
$dia_actual = date("Y-m-d", $time);  // Dia actual
if (mysqli_connect_errno())

{

echo "Error de conexion a mysql: " . mysqli_connect_error();

}

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
    <div id="formularios">
<fieldset style="width:600px; background-color:White">
 <legend>Formulario para cambiar contrase&ntilde;a</legend>
<form action="cambiar_contra.php" method="POST">
<INPUT TYPE="hidden" NAME="login" value="<?php echo $logusuario;?>" SIZE=30 MAXLENGTH=30>
<p>
  <label>Contrase&ntilde;a actual</label>
  <input class="w3-input" name="passwordactual" type="password" placeholder="Tu password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra minúscula y mayúscula, y al menos 8 o más caracteres"></p>
<p>
<p>
  <label>Contrase&ntilde;a nueva</label>
  <input class="w3-input" name="passwordnuevo" type="password" placeholder="Tu password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra minúscula y mayúscula, y al menos 8 o más caracteres"></p>
<p>
  <label>Repite contrase&ntilde;a</label>
  <input class="w3-input" name="passwordrepite" type="password" placeholder="Tu password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra minúscula y mayúscula, y al menos 8 o más caracteres"></p>
<input type="submit" value="Cambiar" name="Crear">
</form>
</fieldset>
<br>
<br>

    </div>
  </div>

</div>
</body>
</html>
