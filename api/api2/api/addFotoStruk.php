<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $pmid = $_POST['pmid'];
    // $type_foto = $_POST['type_foto'];



    $imagestruk = date('dmYHis').str_replace(" ","",basename($_FILES['foto_struk']['name']));
    $destination_dir = "../../../uploads/";
    $imagePathstruk = $destination_dir.$imagestruk;
    move_uploaded_file($_FILES['foto_struk']['tmp_name'],$imagePathstruk);
    
        # code...
        $insert = "UPDATE tabel_pm SET foto_struk = '$imagestruk' WHERE id = '$pmid'";
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