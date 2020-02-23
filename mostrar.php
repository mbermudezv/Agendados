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

$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
?>

<!DOCTYPE html>
 
<html lang="es">
 
<head>
<title>Sistema de convocatorias</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="estilomep.css" />
<link rel="shortcut icon" href="/favicon.ico" />
<style>

#tblDatos{

	border:1px black solid;
	width:100%;

}

#tblDatos thead{

	background:black;
	color:white;

}

.zebra{
  background:#cccccc;
}

</style>
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
<form action="mostrar.php" method="POST">
 <fieldset style="width:1195px; background-color:White">
  <legend>Filtrado de Actidades</legend>
   <label>Fecha de inicio:</label><input type="date" name="fecha1" value="2020-01-01"
       min="2020-01-01" max="2030-12-31">
  <label>Fecha de final:</label><input type="date" name="fecha2" value="2020-01-01"
       min="2020-01-01" max="2030-12-31">
<button type="submit"><img src="filtro.png" alt="filtar" /></button>
<a id="hyp_excel" href="exportar_actividades.php?fecha1=<?php echo $fecha1;?>&fecha2=<?php echo $fecha2;?>">
    <img alt="Exportar" src="excel.png">
</a>
 </fieldset>
 </fieldset>
</form><br>
<table id="tblDatos">
 <thead>
  <tr>
    <th>Fecha</th>
    <th>Regional</th>
    <th>Actividad</th>
    <th>Participantes</th>
    <th>Responsables</th>
    <th>Observaciones</th>
  </tr>
 </thead>
 <tbody>
   <?php

$sql = "SELECT t_matrix.id_matrix as id_matrix, t_matrix.actividad as actividad, t_matrix.participantes as participantes, t_matrix.observaciones as observaciones, t_matrix.id_fecha as id_fecha, regional.regional as id_regional, t_responsable.responsable as id_responsable  FROM t_matrix, regional, t_responsable WHERE id_fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND t_matrix.id_regional = regional.id_regional AND t_matrix.id_responsable = t_responsable.id_responsable order by t_matrix.id_fecha";

//     $sql = "select id_fecha, id_regional, actividad, participantes, id_responsable, observaciones from t_matrix";
     $ds = mysqli_query($link, $sql);
     $color = true;
     while($fila = mysqli_fetch_assoc($ds)){
       $clase = ($color == true)?'zebra':'';
       $fecha_format_2 = date('d-m-Y', strtotime($fila['id_fecha']));
       $valor = $fila['id_matrix'];
       echo "
         <tr class='{$clase}'>
           <td>{$fecha_format_2}</td>
           <td>{$fila['id_regional']}</td>
           <td>{$fila['actividad']}</td>
           <td>{$fila['participantes']}</td>
           <td>{$fila['id_responsable']}</td>
           <td>{$fila['observaciones']}</td>
	   <td><a onclick=\"return confirmSubmit()\" href=\"eliminar.php?idx=$valor\"><img src=\"basurero.png\" alt=\"eliminar\" /></a></td>
	   <td><a href=\"formulario_editar.php?idx=$valor\"><img src=\"editar.png\" alt=\"editar\" /></a></td>
       ";
       $color = !$color;
     }

   ?>
 </tbody>
</table>

  </div>

</div>
</body>
</html>
