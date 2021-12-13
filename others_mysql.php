<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "total_billing_system");


$result = $conn->query("SELECT name, cost FROM others");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"Name":"'  . $rs["name"] . '",';
  $outp .= '"Cost":"'   . $rs["cost"] . '",';
  $outp .= '"Image":"'   . $rs["image"]        . '"}';
  
  
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>