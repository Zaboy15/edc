<?php

class GPSTrack extends App {

    // ----------------------------------------------------------------------------------------------
    // CLIENTS

    public static function add($data) {
        global $database;
        $assets = $database->select("assets", "*", ["categoryid" => 6, "ORDER" => ["id" => "DESC"]]);
        foreach ($assets as $asset){
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
                    "batch" => $data['batch']
                ]
            );
        }
    	// if ($lastid == "0") { return "11"; } else { logSystem("Role Added - ID: " . $lastid); return "10"; }
    	}

    public static function edit($data) {
    	global $database;
    	$database->update("people", [
                    "latitude" => $data['latitude'],
                    "longtitude" => $data['longtitude'],
        ], [ "id" => $data['id'] ]);
    	logSystem("GPS Track Update - ID: " . $data['id']);
    	return "20";
    	}

    public static function delete($id) {
    	global $database;
        $database->delete("log_location", [ "id" => $id ]);
    	logSystem("GPS Deleted - ID: " . $id);
    	return "30";
        }
        
    public static function editAPI($data) {
    	global $database;
    	$database->update("people", [
            "latitude" => $data['latitude'],
            "longtitude" => $data['longtitude'],
                    
        ], [ "id" => $data['id'] ]);
    	logSystem("GPS Edited - ID: " . $data['id']);
    	return "20";
    	}    


}

?>
