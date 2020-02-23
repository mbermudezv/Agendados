<?php
require_once("conexion.php");
$link = $mysqli;
$sql = "SELECT objeto FROM t_objeto ORDER BY objeto";
$result = mysqli_query($link, $sql);

// Associative array
// $row = mysqli_fetch_assoc($result);
//$ans = mysqli_query($link, "select objeto from t_objeto");   
//        $_fbexclude = mysqli_fetch_array($ans);
// $_fbexclude = mysql_query("SELECT fbempfang FROM fbinvite WHERE fbreturn = '1'");
$fbexcludearray = array();
while ($row = mysqli_fetch_assoc($result)) {
  $fbexcludearray[] = $row['objeto'];
}

// Convert the array 
$excludes = implode(',', $fbexcludearray);
echo $excludes;
?>
