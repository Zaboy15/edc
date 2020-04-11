<?php

class Utils extends App {

    public static function addRootCause($data) {
        global $database;
        
    	$ticketid = $database->insert("kode_rc", [
            "root_cause" => $data['root_cause'],
            "sub_rc" => $data['sub_rc'],
    		"keterangan" => $data['keterangan'],
            
    	]);

    	if ($ticketid == "0") { return "11"; }
        else {
            // log and return
    		logSystem("Root Cause Added - ID: " . $ticketid);
    		return "10";
        }
    }

    



}

?>
