<?php

class Whatsapp extends App {

    public static function addRespon($data) {
    	global $database;
    	$lastid = $database->insert("whatsapp_field", [
            "nama" => $data['nama'],
            "respon_text" => $data['respon_text'],
        ]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Respon Added - ID: " . $lastid); return "10"; }
    }

    public static function editRespon($data) {
    	global $database;

        
        $database->update("whatsapp_field", [
            "nama" => $data['nama'],
            "respon_text" => $data['respon_text']
        ], [ "id" => $data['id'] ]);
    

    	logSystem("Whatsapp Respon Edited - ID: " . $data['id']);
    	return "20";
    }



    public static function delete($data) {
        global $database;

        $total = count($data['checkbox']);

        for($i=0; $i<$total; $i++) {
        $database->delete("whatsapp", [ "id" => $data['checkbox'][$i] ]);
    	logSystem("Whatsapp Deleted - ID: " . $data['checkbox'][$i]);
    	
        }
        return "30";
    }
}


?>
