<?php
include 'config.php';
$id = $_POST['id'];
$m_name = $_POST['m_name'];
$m_id = $_POST['m_id'];
$ins = "UPDATE `books` SET `m_name`='$m_name',`m_id`='$m_id' WHERE `id` = '$id'";
$query=mysqli_query($con,$ins);

?>