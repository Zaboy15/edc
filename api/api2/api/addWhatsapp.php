<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $app = $_POST['app'];
    $sender = $_POST['sender'];
    $message = $_POST['message'];
    $getrespon = mysqli_fetch_assoc(mysqli_query($con, "SELECT respon_text FROM whatsapp WHERE id = 2"));
    $respon = $getrespon['respon_text'];

        # code...
        $insert = "INSERT INTO whatsapp VALUE(NULL,'$app','$sender','$message',NULL)";
    if (mysqli_query($con,$insert)) {
        # code...
        $response['reply']= $respon;
        echo json_encode($response);
    } else {
        # code...
        $response['reply']= "Gagal Ditambahkan";
        echo json_encode($response);

    }
}
    

    


?>