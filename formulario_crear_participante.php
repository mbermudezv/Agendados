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
 <legend>Formulario para agregar participante</legend>
<form action="evento_guardar_participante.php" method="POST">
<label>Agregar participante:</label><input type="text" name="participante" autofocus><br>

<div><input type="submit" value="Agregar" name="Crear"></div>
</form>
</fieldset>
<br>



<?php
    $registros=mysqli_query($link,"select id_participante,participante from t_participantes ORDER BY participante ASC") or
      die(mysqli_error($link));
    
    echo "<table WIDTH='75%' FRAME='void' RULES='rows'>";
	echo '<tr><td><b>Ident</b></td><td><b>Participante</b></td></tr>';
    while ($reg=mysqli_fetch_array($registros))
    {
      $valor = $reg['id_participante'];
      echo "<tr>";
      echo "<td align=\"left\">";
      echo $reg['id_participante'];
      echo "</td>";	  
      echo "<td align=\"left\">";
      echo $reg['participante'];	  
      echo "</td>";
      echo "<td align=\"center\">";
      echo "<a onclick=\"return confirmSubmit()\" href=\"eliminar_participante.php?idx=$valor\"><img src=\"basurero.png\" alt=\"eliminar\" /></a>";	  
      echo "</td>";
      echo "<td align=\"center\">";
      echo "<a href=\"formulario_editar_participante.php?idx=$valor\"><img src=\"editar.png\" alt=\"editar\" /></a>";	  
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
