<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $pmid = $_POST['pmid'];
    // $type_foto = $_POST['type_foto'];


    $image = date('dmYHis')."-".str_replace(" ","",basename($_FILES['file']['name']));
    $destination_dir = "../../../uploads/";
    $imagePath = $destination_dir.$image;
    move_uploaded_file($_FILES['file']['tmp_name'],$imagePath);

   
        # code...
        $insert = "UPDATE tabel_pm SET sign = '$image' WHERE id = '$pmid'";
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