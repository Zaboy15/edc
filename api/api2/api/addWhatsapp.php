<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $app = $_POST['app'];
    $sender = $_POST['sender'];
    $message = $_POST['message'];


        # code...
        $insert = "INSERT INTO whatsapp VALUE(NULL,'$app','$sender','$message',NULL)";
    if (mysqli_query($con,$insert)) {
        # code...
        $response['reply']= "Terima kasih sudah me response. Mohon maaf atas keterbatasan kami dalam membalas satu persatu memerlukan waktu. Mohon kesediannya menunggu ya kak.";
        echo json_encode($response);
    } else {
        # code...
        $response['reply']= "Gagal Ditambahkan";
        echo json_encode($response);

    }
}
    

    


?>