<?php
$fecha1 = "2011-01-12";
$fecha2 = "2011-01-12";

for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
    echo $i . "<br />";
 

}
?> 
