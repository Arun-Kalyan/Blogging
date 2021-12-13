<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "blogstable");


// $get_id = $_REQUEST['id'];
$result = $conn->query("SELECT title, content, author FROM blogstable" );

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"Title":"'  . $rs["title"] . '",';
  $outp .= '"Content":"'   . $rs["content"] . '",';
  $outp .= '"Author":"'   . $rs["author"]        . '"}';
  
  
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>