<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $idUsers = $_POST['idUsers'];

    $sql = mysqli_query($con,"SELECT * FROM produk WHERE idUsers='$idUsers'");
    while ($a = mysqli_fetch_array($sql)){
        $b['namaProduk'] = $a['namaProduk'];
        $b['idUsers'] = $a['idUsers'];

        array_push($response, $b);
    }
    echo json_encode($response);  
}

?>