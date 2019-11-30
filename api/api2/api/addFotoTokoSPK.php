<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $spkid = $_POST['spkid'];
    // $type_foto = $_POST['type_foto'];


    $image = date('dmYHis')."-".str_replace(" ","",basename($_FILES['foto_toko']['name']));
    $destination_dir = "../../../uploads/";
    $imagePath = $destination_dir.$image;
    move_uploaded_file($_FILES['foto_toko']['tmp_name'],$imagePath);

   
        # code...
        $insert = "UPDATE spk SET foto_toko = '$image' WHERE id = '$spkid'";
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