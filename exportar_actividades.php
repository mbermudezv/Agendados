<?php
/**
* Mauricio Bermudez Vargas 14/01/2020 9:31 a.m.
*/
ini_set('display_errors', false); 
require_once("conexion.php");
require __DIR__ . "/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$filtroregional = 0;
$fecha1 = "";
$fecha2 = "";
$id_fecha = "";
$actividad = "";
$participantes = "";
$id_responsable = "";
$observaciones = "";

$fecha1 = $_GET['fecha1'];
$fecha2 = $_GET['fecha2'];

$pdo = new \PDO(DB_Str, DB_USER, DB_PASS);

if ($pdo != null) {

  $consultaSQLRegional = "SELECT t_matrix.id_regional as id_regional  
                      FROM t_matrix, regional, t_responsable
                        WHERE id_fecha 
                            BETWEEN '".$fecha1."' AND '".$fecha2."' 
                            AND t_matrix.id_regional = regional.id_regional 
                            AND t_matrix.id_responsable = t_responsable.id_responsable
                            GROUP by t_matrix.id_regional";
  
  $sqlRegional = $pdo->query($consultaSQLRegional);
  $rsRegional = [];
  while ($rowRegional = $sqlRegional->fetch(\PDO::FETCH_ASSOC)) {
          
    $rsRegional[] = ['id_regional' => $rowRegional['id_regional']];	

  }

} else {
    
  die("error");

}

try {

  if(!empty($rsRegional)) {
    
    $documento = new Spreadsheet();        
    $nombreDelDocumento = "Programación de Actividades.xlsx";
    $i=0;

    foreach($rsRegional as $rsRegionalItem) {

        $filtroregional = $rsRegionalItem["id_regional"];

        if ($filtroregional>0) {

            $hoja = $documento->setActiveSheetIndex($i);
            $hoja->setTitle("Nombre Regional");

            $titulo = "Ministerio de Educación Pública 
            Viceministerio de Planificación Institucional y Coordinación Regional 
            Programación de Actividades Regionales 
            Enero 2020 ";                                  

        //Imagen Logo
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Mep');
            $drawing->setDescription('Mep');
            $drawing->setPath('mep.png');
            $drawing->setCoordinates('A1');
            $drawing->setWidthAndHeight(110, 110);
            $drawing->setWorksheet($documento->getActiveSheet());

        // Titulo
            $hoja->setCellValueByColumnAndRow(1, 1, $titulo);
            $hoja->getStyle('A1')->getFont()->setBold(true);
            $hoja->getRowDimension(1)->setRowHeight(100);;
            $hoja->getStyle('A1:F1')->getAlignment()->setWrapText(true); 
            $hoja->mergeCells('A1:F1');
            $hoja->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
            
        //Hancho de columnas
            $hoja->getColumnDimension('A')->setWidth(30);
            $hoja->getColumnDimension('B')->setWidth(4);
            $hoja->getColumnDimension('C')->setWidth(30);
            $hoja->getColumnDimension('D')->setWidth(30);
            $hoja->getColumnDimension('E')->setWidth(30);
            $hoja->getColumnDimension('F')->setWidth(30);

            // Fila encabezado
            $hoja->setCellValueByColumnAndRow(1, 2, "Fecha");
            $hoja->setCellValueByColumnAndRow(2, 2, "#");
            $hoja->setCellValueByColumnAndRow(3, 2, "Actividad");
            $hoja->setCellValueByColumnAndRow(4, 2, "Participantes");
            $hoja->setCellValueByColumnAndRow(5, 2, "Ente Responsable");
            $hoja->setCellValueByColumnAndRow(6, 2, "Observaciones");

            $hoja->getStyle('A2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('286ce6');
            $hoja->getStyle('A2:F2')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $hoja->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
            $hoja->getStyle('A2:F2')->getFont()->setBold(true);
            
            $consultaSQL = "SELECT t_matrix.id_fecha as id_fecha  
            FROM t_matrix, regional, t_responsable
              WHERE id_fecha 
                  BETWEEN '".$fecha1."' AND '".$fecha2."' 
                  AND t_matrix.id_regional = regional.id_regional 
                  AND t_matrix.id_responsable = t_responsable.id_responsable 
                  AND t_matrix.id_regional = ".$filtroregional." 
                  GROUP by t_matrix.id_fecha";

            $sql = $pdo->query($consultaSQL);
            $rs = [];

            while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {

                $rs[] = ['id_fecha' => $row['id_fecha']];	

            }

            $fila=3;
          
            foreach($rs as $rsActividad) {
              
              $id_fecha = $rsActividad["id_fecha"];    
          
              $consultaSQLFecha = "SELECT t_matrix.id_matrix as id_matrix, t_matrix.actividad as actividad, 
              t_matrix.participantes as participantes, t_matrix.observaciones as observaciones, 
              t_matrix.id_fecha as id_fecha, regional.regional as id_regional, 
              t_responsable.responsable as id_responsable  
              FROM t_matrix, regional, t_responsable 
                WHERE id_fecha = '".$id_fecha."'            
                    AND t_matrix.id_regional = regional.id_regional 
                    AND t_matrix.id_responsable = t_responsable.id_responsable 
                    AND t_matrix.id_regional = ".$filtroregional." order by t_matrix.id_fecha";

              $sqlFecha = $pdo->query($consultaSQLFecha);
              $rsFecha = [];

              while ($rowFecha = $sqlFecha->fetch(\PDO::FETCH_ASSOC)) {
                
                $rsFecha[] = [
                  'id_fecha' => $rowFecha['id_fecha'],
                  'actividad' => $rowFecha['actividad'],
                  'participantes' => $rowFecha['participantes'],
                  'id_responsable' => $rowFecha['id_responsable'],
                  'observaciones' => $rowFecha['observaciones']
                ];
                
              }

              $hoja->setCellValueByColumnAndRow(1, $fila, $id_fecha);


              $filaFecha=1;
              $filaInicio=$fila;

              foreach($rsFecha as $rsActividadFecha) {
              
                  $actividad = $rsActividadFecha["actividad"];
                  $participantes = $rsActividadFecha["participantes"];
                  $id_responsable = $rsActividadFecha["id_responsable"];
                  $observaciones = $rsActividadFecha["observaciones"];
                  
                  $hoja->setCellValueByColumnAndRow(2, $fila, $filaFecha);
                  $hoja->setCellValueByColumnAndRow(3, $fila, $actividad);
                  $hoja->setCellValueByColumnAndRow(4, $fila, $participantes);
                  $hoja->setCellValueByColumnAndRow(5, $fila, $id_responsable);
                  $hoja->setCellValueByColumnAndRow(6, $fila, $observaciones);
            
                  $filaFecha=$filaFecha+1;
                  
                  $fila=$fila+1;
                
              }
              
              $filaFin=$fila-1;

              $hoja->getStyle('A'.$filaInicio.':A'.$filaFin)->getAlignment()->setWrapText(true); 
              $hoja->mergeCells('A'.$filaInicio.':A'.$filaFin);
              $hoja->getStyle('A'.$filaInicio.':A'.$filaFin)->getAlignment()->setHorizontal('center');
              $hoja->getStyle('A'.$filaInicio.':A'.$filaFin)->getAlignment()->setVertical('center');
              
                  
              $hoja->getStyle('A'.$fila.':F'.$fila)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('afc9f6');      
              $fila=$fila+1;

              $sqlFecha = null;

            }

            $rs = null;

      }	else {
    
        die("error");
      
      }

      $documento->createSheet();
      $i=$i+1;

    }
    
    $pdo = null;

    $documento->setActiveSheetIndex(0);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
    header('Cache-Control: max-age=0');
 
    $writer = IOFactory::createWriter($documento, 'Xlsx');
    $writer->save('php://output');
    exit;
    
  }
  
} 
catch (Exception $e) {		
	console.log("Error de la aplicación: " + $e->getMessage());
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
  $db = null;
  die("error");
}

?>