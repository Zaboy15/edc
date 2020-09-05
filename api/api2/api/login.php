<?php
require "../config/connection.php";
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $cek = "SELECT * FROM people WHERE email='$email' and password='$password'";
    $result = mysqli_fetch_array(mysqli_query($con, $cek));

    if (isset($result)) {
        # code...
        $response['value']=1;
        $response['message']= "Login Berhasil";
        $response['email']= $result['email'];
        $response['name']= $result['name'];
        $response['id']= $result['id'];
        $response['project']= unserialize($result['project']);

        echo json_encode($response);
    } else {
        $response['value']=2;
        $response['message']= "Login gagal Password dan Email tidak sesuai !";
        echo json_encode($response);
    }
    

    
}

?>