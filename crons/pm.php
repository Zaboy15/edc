<?php

// ERROR REPORTING

$debug = false;

if($debug == false) {
    error_reporting(0);
    ini_set('display_errors', '0');
}

if($debug == true) {
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', '1');
}

$scriptpath = dirname(__DIR__);

// LOAD FUNCTIONS
require($scriptpath . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions.php');

// AUTOLOAD CLASSES
spl_autoload_register('vendorClassAutoload');
spl_autoload_register('appClassAutoload');

// composer autoload
require $scriptpath . '/vendor/autoload.php';

# LOAD CONFIGURAGION FILE
require($scriptpath . DIRECTORY_SEPARATOR . 'config.php');

# INITIALIZE MEDOO
$database = new medoo($config);

# DATE & TIME
date_default_timezone_set(getConfigValue("timezone"));

    $assets = $database->select("assets", "*", ["categoryid" => 6, "ORDER" => ["id" => "DESC"]]);
    

    echo "Test";
        
        foreach($assets as $asset) {
            
            
    
           
            // $random = rand(100000,999999);
            // $idpm = "PM".$random;
            // while($database->has("tabel_pm", [ "id_pm" => $idpm ])) { $random = "PM".rand(100000,999999); }
            
            $database->insert("tabel_pm", [
                "id_pm" => 0,
                "adminid" => 0,
                "merchantid" => $asset['clientid'],
                "assetid" => $asset['id'],
                "status" => "Not Yet",
                "kondisi_edc" => "",
                "detail_edc" => "",
                "request_merchant" => "",
                "kondisi_merchant" => "",
                
            ],
            [
            "id_pm" => 0,
            "adminid" => 0,
            "merchantid" => $asset['clientid'],
            "assetid" => $asset['id'],
            "status" => "Not Yet",
            "kondisi_edc" => "",
            "detail_edc" => "",
            "request_merchant" => "",
            "kondisi_merchant" => "",
            
        ]
        ,
            [
            "id_pm" => 0,
            "adminid" => 0,
            "merchantid" => $asset['clientid'],
            "assetid" => $asset['id'],
            "status" => "Not Yet",
            "kondisi_edc" => "",
            "detail_edc" => "",
            "request_merchant" => "",
            "kondisi_merchant" => "",
            
        ],
        [
        "id_pm" => 0,
        "adminid" => 0,
        "merchantid" => $asset['clientid'],
        "assetid" => $asset['id'],
        "status" => "Not Yet",
        "kondisi_edc" => "",
        "detail_edc" => "",
        "request_merchant" => "",
        "kondisi_merchant" => "",
        
    ],
    [
    "id_pm" => 0,
    "adminid" => 0,
    "merchantid" => $asset['clientid'],
    "assetid" => $asset['id'],
    "status" => "Not Yet",
    "kondisi_edc" => "",
    "detail_edc" => "",
    "request_merchant" => "",
    "kondisi_merchant" => "",
    
],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

],
[
"id_pm" => 0,
"adminid" => 0,
"merchantid" => $asset['clientid'],
"assetid" => $asset['id'],
"status" => "Not Yet",
"kondisi_edc" => "",
"detail_edc" => "",
"request_merchant" => "",
"kondisi_merchant" => "",

]
        );

            
   
    }
    
    

?>
