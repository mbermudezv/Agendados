
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
$bandera = 0;
$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];
$actividad = $_POST['actividad'];
$participantes = $_POST['participantes'];
$responsable = $_POST['responsable'];
$observaciones = $_POST['observaciones'];
$idsregionales = $_POST['idsregionales'];
$array = explode(',', $participantes);
if (mysqli_connect_errno())

{

echo "Error de conexion a mysql: " . mysqli_connect_error();

} // Fin del if
if (!mysqli_set_charset($link, "utf8")) {
    	echo "Error cargando el conjunto de caracteres utf8";
} else {
    	
}

if(empty($_POST['idsregionales']))
{
	echo '<script language = javascript>
                alert("No seleccionó ninguna regional")
                self.location = "formulario_crear_actividad.php"
                </script>';
}
// Inicia ciclos para comprobar que no existan actividades con participantes iguales
else {
    for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
    	
	foreach($_POST['idsregionales'] as $idregional)
	{

           foreach($array as $comparar)
	   {
                
                $query = "select id_fecha, id_regional, participantes from t_matrix where id_fecha='$i' AND id_regional= '$idregional' AND participantes LIKE '%".$comparar."%'";
                $result = mysqli_query($link,$query);
                $check_user = mysqli_num_rows($result);
                $qrprint = mysqli_fetch_array($result);
	        $printfecha = $qrprint[id_fecha];
                $printregional = $qrprint[id_regional];
                $printparticipante = $qrprint[participantes]; 

	//	$datos[]="Un choque fecha $printfecha en la regional $printregional con la poblacion $printparticipante";
		$datos[]= $printfecha.$printparticipante.$printregional;
                if($check_user>0){
		$bandera = 1;

                } /* Cierre del else que corresponde a else del $check_user>0 */


           } // Fin del foreach tres
	} // Fin del foreach dos

    } // Fin del foreach uno
} //Fin if else

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
<?php
if($bandera>0){

echo "<h2>Reporte de choques</h2><br><br>";
echo "<p>Al existir choques de población en fechas, NO SE ASIGNA ninguna actividad a la matriz, por favor revisar las anotaciones que aquí se le brindan y vuelva a efectuar la asignación de sus actividades ajustando las fechas y participantes.</p><br>";
echo "<p>Nota: para leer este reporte tome en cuenta este orden FECHA(año-mes-día) PARTICIPANTES y el Número al final es la REGIONAL</p><br>";
$newValues=array_filter($datos, "strlen");
sort($newValues); 
for ($x=0;$x<count($newValues) ;$x++) {

       echo $newValues[$x] . "<br>";

}
echo "<br>";
 $pregunta=mysqli_query($link,"select id_regional,regional from regional ORDER BY id_regional ASC") or
      die(mysqli_error($link));
    
    echo "<table WIDTH='75%' FRAME='void' RULES='rows'>";
	echo '<tr><td><b>Ident</b></td><td><b>Regional</b></td></tr>';
    while ($respuesta=mysqli_fetch_array($pregunta))
    {
      echo "<tr>";
      echo "<td align=\"left\">";
      echo $respuesta['id_regional'];
      echo "</td>";	  
      echo "<td align=\"left\">";
      echo $respuesta['regional'];	  
      echo "</td>";	  
      echo "</tr>";	  
    }	
    echo "<table>";	

}else{
for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
    	
	foreach($_POST['idsregionales'] as $idregional)
	{

		$sql = "INSERT INTO t_matrix(id_fecha,id_regional,actividad,participantes,id_responsable,observaciones)	VALUES('$i','$idregional','$actividad','$participantes','$responsable','$observaciones')";
		mysqli_query($link,$sql);




	} // Fin del foreach dos

} // Fin del foreach uno
mysqli_close($link);
echo '<script language = javascript>
                alert("Actividades agregadas")
                self.location = "formulario_crear_actividad.php"
                </script>';

} // fin if else

?>
   </div>
  </div>

</div>
</body>
</html>
