<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "edc";
$con = mysqli_connect($host,$user,$pass,$db);
if(!$con){
	echo "not connected";
}
?>