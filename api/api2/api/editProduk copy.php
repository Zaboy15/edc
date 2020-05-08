<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $namaProduk = $_POST['namaProduk'];
    $qty = ($_POST['qty']);
    $harga = $_POST['harga'];
    $idProduk = $_POST['idProduk'];
    $idUsers = $_POST['idUsers'];
    if($FILES['image']['name'] == null){
        $insert = "UPDATE produk SET namaProduk = '$namaProduk',idUsers = '$idUsers' ,qty = '$qty', harga = '$harga' WHERE id = '$idProduk'";
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
    }else {    
    

    $image = date('dmYHis').str_replace(" ","",basename($_FILES['image']['name']));
    $imagePath = "../upload/".$image;
    move_uploaded_file($_FILES['image']['tmp_name'],$imagePath);

    
        # code...
        $insert = "UPDATE produk SET namaProduk = '$namaProduk',idUsers = '$idUsers' ,qty = '$qty', harga = '$harga' , image = '$image' WHERE id = '$idProduk'";
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
}
    

    


?>