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

    public static function deleteWhatsappOne($id) {
    	global $database;
        

        $database->delete("whatsapp", [ "id" => $id ]);
    	logSystem("WA Deleted - ID: " . $id);
    	return "30";
    }


    public static function deleteWhatsapp() {
    	global $database;

        $database->query("TRUNCATE TABLE whatsapp")->fetchAll();
    	
    	logSystem("WA Deleted");
    	return "30";
    }

    public static function deleteWhatsapp2() {
    	global $database;

        $database->query("TRUNCATE TABLE whatsapp_2")->fetchAll();
    	
    	logSystem("WA 2 Deleted");
    	return "30";
    }

    public static function delete2($data) {
        global $database;

        $total = count($data['checkbox']);

        for($i=0; $i<$total; $i++) {
        $database->delete("whatsapp_2", [ "id" => $data['checkbox'][$i] ]);
    	logSystem("Whatsapp Deleted - ID: " . $data['checkbox'][$i]);
    	
        }
        return "30";
    }
}


?>
