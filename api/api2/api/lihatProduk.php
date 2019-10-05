<?php
require "../config/connection.php";

    $response = array();
    $sql = mysqli_query($con,"SELECT a.*, b.name from absensi a left join people b on a.staffid = b.id WHERE check_in>= CURRENT_DATE()");
    while ($a = mysqli_fetch_array($sql)){
        $b['id'] = $a['id'];
        $b['check_in'] = $a['check_in'];
        $b['check_out'] = $a['check_out'];
        $b['kordinat_in'] = $a['kordinat_in'];
        $b['kordinat_out'] = $a['kordinat_out'];
        $b['staffid'] = $a['staffid'];
        $b['nama'] = $a['name'];
        $b['foto_in'] = $a['foto_in'];
        $b['foto_out'] = $a['foto_out'];


        
        array_push($response, $b);
    }
    echo json_encode($response);  


?>