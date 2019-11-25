<?php

class PMBatch extends App {

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
    	$database->update("tabel_pm", [
                    "adminid" => $data['adminid'],
                    "status" => $data['status'],
                    "kondisi_edc" => $data['kondisi_edc'],
                    "detail_edc" => $data['detail_edc'],
                    "request_merchant" => $data['request_merchant'],
                    "kondisi_merchant" => $data['kondisi_merchant']
                    
        ], [ "id" => $data['id'] ]);
    	logSystem("PM Edited - ID: " . $data['id']);
    	return "20";
    	}

    public static function delete($id) {
    	global $database;
        $database->delete("tabel_pm", [ "id" => $id ]);
    	logSystem("PM Deleted - ID: " . $id);
    	return "30";
        }
        
    public static function editAPI($data) {
    	global $database;
    	$database->update("tabel_pm", [
                    "adminid" => $data['adminid'],
                    "tgl_pm" => $data['tgl_pm'],
                    "status" => $data['status'],
                    "kondisi_edc" => $data['kondisi_edc'],
                    "detail_edc" => $data['detail_edc'],
                    "request_merchant" => $data['request_merchant'],
                    "kondisi_merchant" => $data['kondisi_merchant'],
                    
        ], [ "id" => $data['id'] ]);
    	logSystem("PM Edited - ID: " . $data['id']);
    	return "20";
    	}    


}

?>
