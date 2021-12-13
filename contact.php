<?php
// database connection code

// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
$con = mysqli_connect('localhost', 'root', '','blog');

// get the post records
$txtt = $_POST['title'];
$txtc = $_POST['content'];
$txta = $_POST['author'];


// database insert SQL code
$sql = "INSERT INTO `blogstable` (`title`, `content`, `author`) VALUES ('$txtt', '$txtc', '$txta')";

// insert in database 
$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "<script> location.href='home.html'; </script>";
}

else
{
	echo "Are you a genuine visitor?";
	
}
?>
