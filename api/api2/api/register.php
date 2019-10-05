<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $name     = $_POST['name'];

    $cek = "SELECT * FROM people WHERE email='$email'";
    $result = mysqli_fetch_array(mysqli_query($con, $cek));

    if (isset($result)) {
        # code...
        $response['value']=2;
        $response['message']= "email sudah digunakan";
        echo json_encode($response);
    } else {
        # code...
        $insert = "INSERT INTO people VALUE(NULL, '$email', '$password','1','$name','1',NOW())";
    if (mysqli_query($con,$insert)) {
        # code...
        $response['value']=1;
        $response['message']= "Berhasil Register";
        echo json_encode($response);
    } else {
        # code...
        $response['value']=0;
        $response['message']= "Gagal Register";
        echo json_encode($response);

    }
    }
    

    
}

?>