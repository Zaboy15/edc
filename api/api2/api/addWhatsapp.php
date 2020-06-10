<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $app = $_POST['app'];
    $sender = $_POST['sender'];
    $message = $_POST['message'];


        # code...
        $insert = "INSERT INTO whatsapp VALUE(NULL,$app,$sender,$message,NULL)";
    if (mysqli_query($con,$insert)) {
        # code...
        $response['value']=1;
        $response['message']= "Berhasil Ditambahkan";
        echo json_encode($response);
    } else {
        # code...
        $response['value']=0;
        $response['message']= "Gagal Ditambahkan";
        echo json_encode($response);

    }
    }
    

    


?>