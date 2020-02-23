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
$consulta = mysqli_query($link, "select * from t_matrix where id_matrix='$xeditar'");   
        $qrmatrix = mysqli_fetch_array($consulta);
	$id_matrix = $qrmatrix[id_matrix];
	$id_fecha = $qrmatrix[id_fecha];
	$id_regional = $qrmatrix[id_regional];
	$actividad = $qrmatrix[actividad];
	$participantes = $qrmatrix[participantes];
	$id_responsable = $qrmatrix[id_responsable];
	$observaciones = $qrmatrix[observaciones];

$cslta = mysqli_query($link, "select regional from regional where id_regional='$id_regional'");   
        $qrreg = mysqli_fetch_array($cslta);
	$regional = $qrreg[regional];

$cslta2 = mysqli_query($link, "select responsable from t_responsable where id_responsable='$id_responsable'");   
        $qrres = mysqli_fetch_array($cslta2);
	$responsable = $qrres[responsable];

	
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
			<a href="principal.php"><img class="icon" src="atras.png"></a>
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
 <legend>Formulario para modificar una actividad</legend>
<form action="actualizar_actividad.php" method="POST">
<input type="hidden" name="id_matrix" value="<?php echo $xeditar; ?>" />
<label>Fecha:</label><input type="date" name="fecha" value="<?php echo $id_fecha?>"><br>
<label>Actividad:</label><input type="text" name="actividad" value="<?php echo $actividad?>"><br>
<label>Participantes:</label><input type="text" name="participantes" value="<?php echo $participantes?>"><br>
<label>Responsable: </label><select name="responsable">
                          <option value="<?php echo $id_responsable?>"><?php echo $responsable?></option>   
    			<?php  

     			 $regres=mysqli_query($link,"select id_responsable,responsable from t_responsable order by id_responsable") or
      			 die(mysqli_error($link));

 
    			while ($regr=mysqli_fetch_array($regres))   
    			{
        		?>
   
        		<option value=" <?php echo $regr['id_responsable']; ?> ">
        		<?php echo $regr['responsable']; ?>
        		</option>
       
        		<?php
    			}   
    			?>       
</select><br><br>
<label>Observaciones:</label><input type="text" name="observaciones" value="<?php echo $observaciones?>"><br>
<label>Regional: </label><select name="regional">
                          <option value="<?php echo $id_regional?>"><?php echo $regional?></option>   
    			<?php  

     			 $regi=mysqli_query($link,"select id_regional,regional from regional order by id_regional") or
      			 die(mysqli_error($link));

 
    			while ($regio=mysqli_fetch_array($regi))   
    			{
        		?>
   
        		<option value=" <?php echo $regio['id_regional']; ?> ">
        		<?php echo $regio['regional']; ?>
        		</option>
       
        		<?php
    			}   
    			?>       
</select><br><br>


<input type="submit" value="Actualizar" name="Actualizar">
</form>
</fieldset>
    </div>
  </div>

</div>
</body>
</html>
