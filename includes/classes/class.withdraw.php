<?php

class Withdraw extends App {

    // TICKETS


    public static function addWithdraw($data) {
        global $database;
        
        if($data['charger'] == false) $charger = "false"; else $charger = "true";
        if($data['batterai'] == false) $batterai = "false"; else $batterai = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['paper'] == false) $paper = "false"; else $paper = "true";
        if($data['idspk'] == 0) $idspk = 0; else $idspk = $data['idspk'];

    	$withdraw = $database->insert("tabel_withdraw", [
    		"idspk" => $idspk,
            "charger" => $charger,
            "batterai" => $batterai,
            "simcard" => $simcard,
            "paper" => $paper,
            "serial_number" => $data['serial_number'],
            "type_edc" => $data['type_edc'],
            "tgl_bast" => $data['tgl_bast'],
            "incoming_warehouse" => $data['incoming_warehouse'],
            "status_unit" => $data['status_unit'],
    	]);


    	if ($withdraw == "0") { return "11"; }
        else {
    		logSystem("Withdraw Added - ID: " . $withdraw);
    		return "10";
        }

    }

    public static function addWithdrawAPI($data) {
        global $database;
        
        if($data['charger'] == "false") $charger = "false"; else $charger = "true";
        if($data['batterai'] == "false") $batterai = "false"; else $batterai = "true";
        if($data['simcard'] == "false") $simcard = "false"; else $simcard = "true";
        if($data['paper'] == "false") $paper = "false"; else $paper = "true";
        if($data['idspk'] == 0) $idspk = 0; else $idspk = $data['idspk'];

    	$withdraw = $database->insert("tabel_withdraw", [
    		"idspk" => $idspk,
            "charger" => $charger,
            "batterai" => $batterai,
            "simcard" => $simcard,
            "paper" => $paper,
            "serial_number" => $data['serial_number'],
            "type_edc" => $data['type_edc'],
            "tgl_bast" => $data['tgl_bast'],
            "status_unit" => $data['status_unit'],
    	]);


    	if ($withdraw == "0") { return "11"; }
        else {
    		logSystem("Withdraw Added - ID: " . $withdraw);
    		return "10";
        }

    }

    

    

    public static function editWithdraw($data) {
    	global $database;
        if($data['charger'] == false) $charger = "false"; else $charger = "true";
        if($data['batterai'] == false) $batterai = "false"; else $batterai = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['paper'] == false) $paper = "false"; else $paper = "true";
        if($data['idspk'] == 0) $idspk = 0; else $idspk = $data['idspk'];

            $database->update("tabel_withdraw", [
            "charger" => $charger,
            "batterai" => $batterai,
            "simcard" => $simcard,
            "paper" => $paper,
            "serial_number" => $data['serial_number'],
            "type_edc" => $data['type_edc'],
            "tgl_bast" => $data['tgl_bast'],
            "incoming_warehouse" => $data['incoming_warehouse'],
            "status_unit" => $data['status_unit'],


            ], [ "idspk" => $idspk ]);
        

    	logSystem("Withdraw Edited - ID: " . $data['id']);
    	return "20";
    }

    public static function editWithdrawAPI($data) {
        global $database;
        if($data['charger'] == "false") $charger = "false"; else $charger = "true";
        if($data['batterai'] == "false") $batterai = "false"; else $batterai = "true";
        if($data['simcard'] == "false") $simcard = "false"; else $simcard = "true";
        if($data['paper'] == "false") $paper = "false"; else $paper = "true";

            $database->update("tabel_withdraw", [
            "charger" => $charger,
            "batterai" => $batterai,
            "simcard" => $simcard,
            "paper" => $paper,
            "serial_number" => $data['serial_number'],
            "type_edc" => $data['type_edc'],
            "tgl_bast" => $data['tgl_bast'],
            "status_unit" => $data['status_unit'],
            ], [ "id" => $data['id'] ]);
        

    	logSystem("Withdraw Edited API - ID: " . $data['id']);
    	return "20";
    }

    public static function delete($id) {
    	global $database;
        File::delete_ticket_files($id);

        $database->delete("tabel_withdraw", [ "id" => $id ]);
    	
    	logSystem("Withdraw Deleted - ID: " . $id);
    	return "30";
    }

    



}

?>
