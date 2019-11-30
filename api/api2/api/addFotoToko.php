<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $pmid = $_POST['pmid'];
    // $type_foto = $_POST['type_foto'];


    $image = "FotoToko-".date('dmYHis').str_replace(" ","",basename($_FILES['foto_toko']['name']));
    $destination_dir = "../../../uploads/";
    $imagePath = $destination_dir.$image;
    move_uploaded_file($_FILES['foto_toko']['tmp_name'],$imagePath);

   
        # code...
        $insert = "UPDATE tabel_pm SET foto_toko = '$image' WHERE id = '$pmid'";
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