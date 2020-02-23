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

if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}



$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$actividad = $_POST['actividad'];
// $participantes = $_POST['participantes'];
$responsable = $_POST['responsable'];
$observaciones = $_POST['observaciones'];

$participantes = implode(',', $_POST['idsparticipantes']);


//echo $excludes;
?>

<html>
	<head>
		<title>Lista de Regionales</title>
<link rel="stylesheet" type="text/css" href="estilomep.css" />
<script src="jquery-3.1.1.min.js"></script>
    <script>
      $(document).ready(function () {  
        //Detectar click en el checkbox superior de la lista
        $('#selectall').on('click', function () {
          //verificar el estado de ese checkbox si esta marcado o no
          var checked_status = this.checked;
 
          /*
           * asignarle ese estatus a cada uno de los checkbox
           * que tengan la clase "selectall"
          */
          $(".selectall").each(function () {
            this.checked = checked_status;
          });
        });
      });
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
			<a href="formulario_crear_actividad.php"><img class="icon" src="atras.png"></a>
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
<form action="evento_guardar_actividad.php" method="post">

<table WIDTH="90%" FRAME="void" RULES="rows">

	<th>Ident. </th>
	<th>Regional</th>
        <th><input type="checkbox" id="selectall"> Seleccionar todos<br></th>
	<th><input type="submit" name="btnGuardar" value="Guardar"/></th>
	<?php
	
	$consulta=mysqli_query($link,"select * from regional ORDER BY id_regional ASC") or
      	die(mysqli_error($link));
	while ($regionales=mysqli_fetch_array($consulta)) { ?>
	<tr>
		<td><?php echo $regionales['id_regional']?></td>
		<td><?php echo $regionales['regional']?></td>
		<td><input type="checkbox" name="idsregionales[]" class="selectall" value="<?php echo $regionales['id_regional']?>"/></td>
	</tr>
	<?php }
	mysqli_close($link);	
	?>
</table>
<input type="hidden" name="fecha1" value="<?php echo $fecha1?>">
<input type="hidden" name="fecha2" value="<?php echo $fecha2?>">
<input type="hidden" name="actividad" value="<?php echo $actividad?>">
<input type="hidden" name="participantes" value="<?php echo $participantes?>">
<input type="hidden" name="responsable" value="<?php echo $responsable?>">
<input type="hidden" name="observaciones" value="<?php echo $observaciones?>">

</form>
     </div>
  </div>

</div>
</body>

</html>

