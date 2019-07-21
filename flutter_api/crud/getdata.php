<?php
include 'config.php';

$result = array();
$show = "SELECT t.id,t.clientid,clients.name,t.ticket,people.name as nama_engineer,people.id as id_engineer,t.timestamp FROM tickets as t INNER JOIN clients ON t.clientid = clients.id INNER JOIN people ON t.adminid = people.id";
$query= mysqli_query($con,$show);
while($row = mysqli_fetch_array($query)){
	$result[]=$row;
}
echo json_encode($result);

?>