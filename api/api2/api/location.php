<?php
require "../config/connection.php";

    $response = array();
    $sql = mysqli_query($con,"SELECT * from people WHERE latitude != '' AND longtitude != ''");
    while ($a = mysqli_fetch_array($sql)){
        $b['id'] = $a['id'];
        $b['nik'] = $a['nik'];
        $b['name'] = $a['name'];
        $b['latitude'] = $a['latitude'];
        $b['longtitude'] = $a['longtitude'];
       

        
        array_push($response, $b);
    }
    echo json_encode($response);  


?>