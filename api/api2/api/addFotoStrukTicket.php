<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $id = $_POST['id'];
    // $type_foto = $_POST['type_foto'];



    $image = date('dmYHis')."-".str_replace(" ","",basename($_FILES['foto_struk']['name']));
    $destination_dir = "../../../uploads/";
    $imagePath = $destination_dir.$image;
    move_uploaded_file($_FILES['foto_struk']['tmp_name'],$imagePath);
    
        # code...
        $insert = "UPDATE tickets SET foto_struk = '$image' WHERE id = '$id'";
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