<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $idProduk = $_POST['idProduk'];
        # code...
        $insert = "DELETE FROM produk WHERE id = '$idProduk'";
    if (mysqli_query($con,$insert)) {
        # code...
        $response['value']=1;
        $response['message']= "Berhasil di Edit";
        echo json_encode($response);
    } else {
        # code...
        $response['value']=0;
        $response['message']= "Gagal di Edit";
        echo json_encode($response);

    }
    }
    

    


?>