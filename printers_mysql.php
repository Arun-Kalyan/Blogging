<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "total_billing_system");


$result = $conn->query("SELECT name, cost, image, dpi, max_speed, type FROM printers");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"Name":"'  . $rs["name"] . '",';
  $outp .= '"Cost":"'   . $rs["cost"]        . '",';
  $outp .= '"Image":"'   . $rs["image"]        . '",';
  $outp .= '"DPI":"'. $rs["dpi"]     . '",';
  $outp .= '"MaxSpeed":"'. $rs["max_speed"]     . '",';
  $outp .= '"Type":"'. $rs["type"]     . '"}';
  
  
  
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>