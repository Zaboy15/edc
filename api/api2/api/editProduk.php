<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $idstaff = $_POST['staffid'];
    $iddata = $_POST['id'];
    $checkout = $_POST['check_out'];
    $kordinatout = $_POST['kordinat_out'];

    
        $insert = "UPDATE absensi SET staffid = '$idstaff',check_out = '$checkout' ,kordinat_out = '$kordinatout' WHERE id = '$iddata'";
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