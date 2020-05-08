<?php
include 'config.php';
$searchname = $_GET['search'];
$result = array();
$show = "SELECT * FROM `books` WHERE `m_name` = '$searchname'";
$query= mysqli_query($con,$show);
while($row = mysqli_fetch_array($query)){
	$result[]=$row;
}
echo json_encode($result);

?>