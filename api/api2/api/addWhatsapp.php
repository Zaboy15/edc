<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $responsetext = '';
    
    $app = $_POST['app'];
    $sender = $_POST['sender'];
    $message = $_POST['message'];

    $sql = mysqli_query($con,"SELECT respon_text FROM whatsapp_field WHERE id = 2");
    while ($a = mysqli_fetch_array($sql)){
        $responsetext = $a['respon_text'];
    }
    

        # code...
        $insert = "INSERT INTO whatsapp VALUE(NULL,'$app','$sender','$message',NULL)";
    if (mysqli_query($con,$insert)) {
        # code...
        $response['reply']= $responsetext;
        echo json_encode($response);
    } else {
        # code...
        $response['reply']= "Gagal Ditambahkan";
        echo json_encode($response);

    }
}
    

    


?>