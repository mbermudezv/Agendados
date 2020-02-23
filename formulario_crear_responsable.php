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
var agree=confirm("Está seguro de eliminar este registro? Este proceso puede alterar actividades asociadas.");
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
 <legend>Formulario para agregar entes responsables</legend>
<form action="evento_guardar_responsable.php" method="POST">
<label>Agregar ente responsable:</label><input type="text" name="responsable" autofocus><br>

<div><input type="submit" value="Agregar" name="Crear"></div>
</form>
</fieldset>
<br>



<?php
    $registros=mysqli_query($link,"select id_responsable,responsable from t_responsable ORDER BY responsable ASC") or
      die(mysqli_error($link));
    
    echo "<table WIDTH='90%' FRAME='void' RULES='rows'>";
	echo '<tr><td><b>Ident</b></td><td><b>Responsable</b></td></tr>';
    while ($reg=mysqli_fetch_array($registros))
    {
      $valor = $reg['id_responsable'];
      echo "<tr>";
      echo "<td align=\"left\">";
      echo $reg['id_responsable'];
      echo "</td>";	  
      echo "<td align=\"left\">";
      echo $reg['responsable'];	  
      echo "</td>";
      echo "<td align=\"center\">";
      echo "<a onclick=\"return confirmSubmit()\" href=\"eliminar_responsable.php?idx=$valor\"><img src=\"basurero.png\" alt=\"eliminar\" /></a>";	  
      echo "</td>";
      echo "<td align=\"center\">";
      echo "<a href=\"formulario_editar_responsable.php?idx=$valor\"><img src=\"editar.png\" alt=\"editar\" /></a>";	  
      echo "</td>";	  
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
