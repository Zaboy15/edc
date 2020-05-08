<?php

function build_post_fields( $data,$existingKeys='',&$returnArray=[]){
    if(($data instanceof CURLFile) or !(is_array($data) or is_object($data))){
        $returnArray[$existingKeys]=$data;
        return $returnArray;
    }
    else{
        foreach ($data as $key => $item) {
            build_post_fields($item,$existingKeys?$existingKeys."[$key]":$key,$returnArray);
        }
        return $returnArray;
    }
}

function api_call($url, $key, $method, $resource, $additional_data) {

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $post_query = array();
    $post_query['key'] = $key;
    $post_query['resource'] = $resource;
    $post_query['method'] = $method;

    switch ($method)
    {
        case "get":
            if($additional_data) $post_query['filters'] = $additional_data;
            curl_setopt($ch, CURLOPT_POSTFIELDS, build_post_fields($post_query));
        break;

        case "add":
            if($additional_data) $post_query['data'] = $additional_data;
            curl_setopt($ch, CURLOPT_POSTFIELDS, build_post_fields($post_query));
        break;

        case "edit":
            if($additional_data) $post_query['data'] = $additional_data;
            curl_setopt($ch, CURLOPT_POSTFIELDS, build_post_fields($post_query));
        break;

        case "delete":
            if($additional_data) $post_query['id'] = $additional_data;
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post_query));
        break;

    }


    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {
        return json_decode($response,true);
        //return $response;
    }

}




########## TESTS ##########

$url = "http://localhost/edc/api/";
$key = "5fpqRt23yU2kgJcl7fDo6ARIzsU5zIGAOIYtNPDBNokQcRViNfKnbaSiNow61lXG";

// get one client
// $result = api_call($url, $key, "get", "tickets", $additional_data=["id" => 1]    );



// get all clients
$result = api_call($url, $key, "get", "tickets", $additional_data=[]  );



// add client
//$result = api_call($url, $key, "add", "clients", $additional_data=["name" => "test1112", "asset_tag_prefix" => "asa", "license_tag_prefix" => "asas", "notes" => "asasa"]    );



// edit client
//$result = api_call($url, $key, "edit", "clients", $additional_data=["id"=> 3, "name" => "test######1112", "asset_tag_prefix" => "asa", "license_tag_prefix" => "asas", "notes" => "asasa"]    );




// delete client
//$result = api_call($url, $key, "delete", "clients", $additional_data=3  );



print_r($result);


?>
