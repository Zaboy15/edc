<?php
include 'config.php';
$username = $_POST['m_name'];
$book = $_POST['m_id'];
$ins = "INSERT INTO `books` (`id`, `m_name`, `m_id`, `date`) VALUES (NULL, '$username', '$book', CURRENT_TIMESTAMP);";
$query=mysqli_query($con,$ins);

?>