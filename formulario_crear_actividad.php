<?php
session_start();
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "index.php"
</script>';
}
ini_set('display_errors', false);
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
<script LANGUAGE="JavaScript">

function confirmSubmit()
{
var agree=confirm("Está seguro de eliminar este registro? Este proceso es irreversible.");
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
    <div id="formularios">
<fieldset style="width:600px; background-color:White">
 <legend>Formulario para agregar una actividad</legend>
<form action="evento_pasar_actividad.php" method="POST">

<label>Fecha de inicio:</label><input type="date" name="fecha1" value="2020-01-01"
       min="2020-01-01" max="2030-12-31"><br>
<label>Fecha de final:</label><input type="date" name="fecha2" value="2020-01-01"
       min="2020-01-01" max="2030-12-31"><br>
<label>Actividad:</label><input type="text" name="actividad" maxlength="200"><br><br>

<label>Responsable: </label><select name="responsable">
                          <option value="0">Seleccione:</option>   
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
<label>Observaciones:</label><input type="text" name="observaciones" maxlength="200"><br><br>

<table WIDTH="90%" FRAME="void" RULES="rows">

	<th>Ident. </th>
	<th>Participantes</th>
        <th><input type="checkbox" id="selectall"> Seleccionar todos<br></th>
	<?php
	
	$sql=mysqli_query($link,"select * from t_participantes ORDER BY id_participante ASC") or
      	die(mysqli_error($link));
	while ($participantes=mysqli_fetch_array($sql)) { ?>
	<tr>
		<td><?php echo $participantes['id_participante']?></td>
		<td><?php echo $participantes['participante']?></td>
		<td><input type="checkbox" name="idsparticipantes[]" class="selectall" value="<?php echo $participantes['participante']?>"/></td>
	</tr>
	<?php }
	mysqli_close($link);	
	?>
</table>

<div><input type="submit" value="Continuar" name="Crear"></div>
</fieldset>
</form>
<br>
    </div>

  </div>

</div
</body>
</html>
