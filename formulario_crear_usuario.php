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
if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="estilomep.css" />
<script LANGUAGE="JavaScript">

function confirmSubmit()
{
var agree=confirm("Está seguro de eliminar este usuario? Este proceso no se revierte.");
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
			<a href="mantenimiento.php"><img class="icon" src="engrane.png"></a>
			<p class="texto">Configurar</p>
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
<fieldset style="width:520px; background-color:White">
 <legend>Formulario para agregar usuarios al sistema</legend>
<form action="crear_usuario.php" method="POST">
  <label>Login</label>
  <input type="text" name="username" maxlength=30 autofocus>
<br>
  <label>C&eacute;dula o similar</label>
  <input type="text" name="cedula" maxlength=20>
<br>
  <label>Nombre completo</label>
  <input type="text" name="nombre" maxlength=100>
<br>
  <label>Contrase&ntilde;a</label>
  <input name="password" type="password" placeholder="Tu password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra minúscula y mayúscula, y al menos 8 o más caracteres">
<br>
  <label>Repite contrase&ntilde;a</label>
  <input name="passwordrepite" type="password" placeholder="Tu password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra minúscula y mayúscula, y al menos 8 o más caracteres">
<br>
<label>Tipo</label>
<select name="tipo">
  <option value="1">Administrador</option>
  <option value="2">Central</option>
  <option value="3">Regional</option>
</select>
<br>
<br>
<input type="submit" value="Crear" name="Crear">

</form>
</fieldset>
<br>



<?php
    $registros=mysqli_query($link,"select id_login,username from login ORDER BY username ASC") or
      die(mysqli_error($link));
    
    echo "<table WIDTH='75%' FRAME='void' RULES='rows'>";
	echo '<tr><td><b>Ident</b></td><td><b>Login</b></td></tr>';
    while ($reg=mysqli_fetch_array($registros))
    {
      $valor = $reg['id_login'];
      echo "<tr>";
      echo "<td align=\"left\">";
      echo $reg['id_login'];
      echo "</td>";	  
      echo "<td align=\"left\">";
      echo $reg['username'];	  
      echo "</td>";
      echo "<td align=\"center\">";
      echo "<a onclick=\"return confirmSubmit()\" href=\"eliminar_usuario.php?idx=$valor\"><img src=\"basurero.png\" alt=\"eliminar\" /></a>";	  	  
      echo "</tr>";	  
    }	
    echo "<table>";	
 
    mysqli_close($link);
 
  ?> 
      </div>
  </div>

</div>
</body>
</html>
